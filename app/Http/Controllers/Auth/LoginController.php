<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallbackGoogle()
    {


        try {

            $user = Socialite::driver('google')->user();

            $create['name'] = $user->getName();

            $create['email'] = $user->getEmail();

            $create['google_id'] = $user->getId();


            $userModel = new User;

            $createdUser = $userModel->addNewgoogle($create);

            Auth::loginUsingId($createdUser->id);


            return redirect()->route('home');


        }
        catch (exception $e) {


            return redirect('auth/google');


        }


    }


    public function redirectToProviderFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallbackFacebook()
    {
        $user = Socialite::driver('facebook')->user();


        try {
            $user = Socialite::driver('facebook')->user();
            $create['name'] = $user->name;
            $create['email'] = $user->email;
            $create['facebook_id'] = $user->id;

            $userModel = new User;
            $createdUser = $userModel->addNew($create);
            Auth::loginUsingId($createdUser->id);
            return redirect()->route('home');
        }
        catch (exception $e) {
            return redirect('/');
        }


        // $user->token;
    }


}
