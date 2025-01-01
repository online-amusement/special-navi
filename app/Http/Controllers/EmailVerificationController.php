<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationMail;
use Illuminate\Support\Str;
use App\Services\EmailVerificationService;
use App\Services\MemberService;

class EmailVerificationController extends Controller
{
    protected $emailVerificationService;
    protected $memberService;

    public function __construct(EmailVerificationService $emailVerificationService, MemberService $memberService)
    {
        $this->emailVerificationService = $emailVerificationService;
        $this->memberService = $memberService;
    }
    //仮登録
    public function temporaryRegistration(Request $request) 
    {
        $email = $request->get("email");

        $token = Str::random(80);

        //もしmembersテーブルにemailが存在してない
        $existMail = $this->emailVerificationService->isExistEmail($email);

        if($existMail == false) {
            //仮登録
            $temporary = $this->emailVerificationService->temporaryRegistration($email, $token);
            //メンバーテーブルに仮登録
            $member = $this->emailVerificationService->temporaryMember($email, $token);

            //メールアドレス宛にメールを送信
            Mail::to($email)->send(new RegistrationMail($token));

            //request
            return response()->json([
                "result" => "OK",
                "status" => 200,
                "message" => "仮登録しました。本登録へ進んでください。"
            ]);
        }

        return response()->json([
            "result" => "NG",
            "status" => 401,
            "message" => "仮登録できませんでした。"
        ]);

    }

    //本登録
    public function officialRegistration(Request $request)
    {
        $name = $request->get("name");
        $password = $request->get("password");
        $apiToken = $request->get("api_token");
        $postalCode = $request->get("postal_code");
        $address = $request->get("address");
        $tel = $request->get("tel");

        $memberToken = $this->memberService->findBy("api_token", "=", $apiToken);
        //もしトークンが一致していれば
        if($apiToken == $memberToken) {
            //memberの更新
            $member = $this->memberService->updateMember($name, $password, $apiToken, $postalCode, $address, $tel, $status = 1);

            return response()->json([
                "result" => "OK",
                "status" => 200,
                "message" => "本登録が完了しました。"
            ]);
        }

        return response()->json([
            "result" => "NG",
            "status" => 401,
            "message" => "本登録できませんでした。"
        ]);
        
    }
}
