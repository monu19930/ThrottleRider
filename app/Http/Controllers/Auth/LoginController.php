<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;
use Exception;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
    
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToSocial($social) {
        return Socialite::driver($social)->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleSocialCallback($social) {
       
        $userDetails = Socialite::driver($social)->user();
        $user = $this->createUser($userDetails,$social);
        Auth::login($user);
        if ($user) {
            return redirect('/my-profile');
        } else {
            return redirect()->back();
        }
    }

    protected function createUser($userDetails,$social) {
        $user = User::where('provider_id', $userDetails->id)->first();
        if (!$user) {
            $user = User::create([
                'name'     => $userDetails->name,
                'email'    => $userDetails->email,
                'provider'  => $social,
                'provider_id' => $userDetails->id
            ]);
        }
        return $user;
    }

}
