<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;

use App\Providers\RouteServiceProvider;

use DB;
class VerificationController extends AppBaseController
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */
    public function verify()
    {
        $this->validate(request(),[
            "phone_number"=>"required",
            "verify_number"=>"required",
        ]);
        $user = DB::table("users")
        ->where("phone_number",request("phone_number"))
        ->whereNull("phone_number_verified_at")->first();
        if(!$user)
        {
            return $this->sendError("Phone Number Not Exists Or Already Verified");
        }
        if($user->verify_number != request("verify_number"))
        {
            return $this->sendError("Wrong Verify Number");
        }
        DB::table("users")->whereNull("phone_number_verified_at")
        ->where("phone_number",request("phone_number"))->update([
            "phone_number_verified_at" => now()
        ]);
        return $this->sendSuccess("Account Verified Successfully");
    }
    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}