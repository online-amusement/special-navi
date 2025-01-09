<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationMail;
use Illuminate\Support\Str;
use App\Services\EmailVerificationService;
use App\Services\MemberService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

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
            
            $temporary = $this->emailVerificationService->temporaryRegist($email, $token);

            //メンバーテーブルに仮登録
            $member = $this->emailVerificationService->temporaryMember($email, $token);

            //メールアドレス宛にメールを送信
            Mail::to($email)->send(new \App\Mail\RegistrationMail($token));

            //レスポンス
            return response()->json([
                "result" => "OK",
                "status" => 200,
                "message" => "仮登録しました。本登録へ進んでください。",
                "data" => $member
            ]);
        }

        return response()->json([
            "result" => "NG",
            "status" => 401,
            "message" => "仮登録できませんでした。すでに存在するアドレスです。"
        ]);

    }
    //本登録
    public function officialRegistration(Request $request)
    {
        $name = $request->get("name");
        $password = $request->get("password");
        $token = $request->get("token");
        $postalCode = $request->get("postalCode");
        $address = $request->get("address");
        $address2 = $request->get("address2");
        $address3 = $request->get("address3");
        $tel = $request->get("tel");

        //トークンが一致してるものがあるか
        $memberToken = $this->memberService->findBy("api_token", "=", $token);

        //有効期限が切れてないか
        $verifyToken = $this->emailVerificationService->findBy("token", "=", $token);
        
        //現在日時
        $now = Carbon::now();
        
        //もしトークンが一致していれば
        if(!$memberToken && !$verifyToken->expiration_date > $now) {
            return response()->json([
                "result" => "NG",
                "status" => 401,
                "message" => "本登録できませんでした。"
            ]);
        }

        //memberの更新
        $member = $this->memberService->updateMember($name, $password, $token, $postalCode, $address, $address2, $address3, $tel);

        return response()->json([
            "result" => "OK",
            "status" => 200,
            "message" => "本登録が完了しました。",
            "token" => $memberToken->api_token
        ]);
        
    }

    //住所取得
    public function searchAddress(Request $request)
    {
        $postalCode = $request->get("postalCode");
        
        $response = Http::get("https://zipcloud.ibsnet.co.jp/api/search?zipcode=", [
            "zipcode" => $postalCode
        ]);
        
        if($response->json()['status'] === 200 && !empty($response->json()['results'])) {
            $result = $response->json()['results'][0];
            $address = $result["address1"];
            $result = ["address" => $address, "address2" => $result["address2"], "address3" => $result["address3"]];
            
            return response()->json([
                "result" => "OK",
                "status" => 200,
                "message" => "データを取得しました。",
                "data" => $result
            ]);
        }else {
            session()->flash('error', '郵便番号に該当する住所が見つかりません。');
        }
    }
}
