<?php

namespace App\Http\Controllers\API\Cheif;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\VerifiesEmails;
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
        $user = DB::table("cheifs")
        ->where("phone_number",request("phone_number"))
        ->whereNull("phone_number_verified_at")->first();
        if(!$user)
        {
            return $this->sendError("Phone Number Not Exists Or Already Verified");
        }
        if($user->verify_number != request("verify_number"))
        {
            return $this->sendError("Wrong Verification Number");
        }
        DB::table("cheifs")
        ->whereNull("phone_number_verified_at")
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
        $this->middleware('auth:cheif_api');
        // $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
