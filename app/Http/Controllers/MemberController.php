<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MemberController extends Controller
{
    protected $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function login(Request $request)
    {
        $email = $request->get("email");
        $password = $request->get("password");

        //メールアドレスが一致するメンバーを検索
        $member = $this->memberService->findBy("email", "=", $email);

        if($member) {

            $token = Str::random(80);
            //リフレッシュトークン
            $member->api_token = $token;
            $member->save();

            return response()->json([
                "result" => true,
                "status" => 200,
                "message" => "ログインしました。",
                "token" => $member->api_token,
                "data" => $member
            ]);
        }

        if(!$member) {
            return response()->json([
                "result" => false,
                "status" => 401,
                "message" => "メールアドレスが存在しません。",
                "token" => null,
            ]);
        }

        if(!Hash::check($password, $member->password)) {
            return response()->json([
                "result" => false,
                "status" => 401,
                "message" => "パスワードが一致しません。",
                "token" => null,
            ]);
        }
    }

    public function me(Request $request)
    {
        $token = $request->bearerToken();

        $member = $this->memberService->findBy("api_token", "=", $token);

        if($member) {
            return response()->json([
                "result" => true,
                "status" => 200,
                "message" => "ユーザー情報を取得しました。",
                "data" => $member,
            ]);
        }

        return response()->json([
            "result" => false,
            "status" => 401,
            "message" => "ユーザーが存在しません。",
            "data" => null,
        ]);
    }
}
