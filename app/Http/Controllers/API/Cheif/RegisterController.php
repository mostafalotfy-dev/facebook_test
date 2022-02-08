<?php

namespace App\Http\Controllers\API\Cheif;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegisterResource;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\WaitingList;
use App\Traits\HasImage;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Resources\CheifRegisterResource;
use App\Models\Cheif;
use Illuminate\Auth\Events\Registered;
class RegisterController extends AppBaseController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers,HasImage;

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $this->sendSMS($user->phone_number,9999);
        
        WaitingList::create([
            "user_id" => $user->id,
        ]);
        return $this->sendResponse([],"");
    }
    protected function generateRandomNumber($start,$end)
    {
        return rand($start,$end);
    }
    public function sendSMS($phoneNumber,$randomNumber)
    {
        $randomNumber = $this->generateRandomNumber($randomNumber,$randomNumber);
        //TODO:send SMS
    }
    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string',"starts_with:+", 'max:14', 'unique:cheifs'],
            'password' => ['required', 'string', 'min:8'],
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $this->addImage($data,"avatar","storage");
        $user= Cheif::create([
         'name' => $data['name'],
         'phone_number' => $data['phone_number'],
         'password' => Hash::make($data['password']),
         "user_ip"=> request()->ip(),
         "description"=> request("description"),
         "avatar"=> isset($data["avatar"]) ? $data["avatar"] : "avatar.png",
         "address"=> isset($data["address"]) ? $data["address"] : "address.png",
        ]);
        return $user;
    }
    public function guard()
    {
        return auth("chief_api");
    }
}
