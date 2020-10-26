<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewUserHasRegisteredEvent;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Notifications\WelcomeNotification;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Nexmo\Laravel\Facade\Nexmo;

class RegisterController extends Controller
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

    use RegistersUsers;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
        ]);

        /** dispatch an event after registeration */
        // event(new NewUserHasRegisteredEvent($user));

        /** alternative way to dispatch an event using the dispatchable trait on the event class.*/
        //  NewUserHasRegisteredEvent::dispatch($user);

        /**sending sms via Nexmo api */
        Nexmo::message()->send([
            'to'   => $data['phone_number'],
            'from' => '2348168266555',
            'text' => 'Hi, thanks for signing up on Message_sys!.'
        ]);

         // sending notification to users
        $user->notify(new WelcomeNotification($user));

        return $user;

    }
}
