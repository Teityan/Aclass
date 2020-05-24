<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use PragmaRX\Google2FAQRCode\Google2FA;
use App\User;

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

    protected function validateLogin(\Illuminate\Http\Request $request)
    {
      $request->merge(['hash_login_id' => hash('sha256', $request->input('hash_login_id'))]);

      if(User::where('hash_login_id', $request->input('hash_login_id'))->first()['twofactor']===NULL){
        $request->merge([ 'twofactor' => true ]);
      }else if(empty($request->input('twofactor'))){
        $request->merge([ 'twofactor' => null ]);
      }else{
        $twofactor = new Google2FA();
        $twofactor_result = $twofactor->verifyKey(
          decryptData(User::where('hash_login_id', $request->input('hash_login_id'))->first()['twofactor'], 'USER_KEY'),
          $request->input('twofactor')
        );
        $request->merge([ 'twofactor' => $twofactor_result ]);
      }


      if(config('app.NOCAPTCHA_SECRET') !== NULL && config('app.NOCAPTCHA_SITEKEY') !== NULL){
        $this->validate($request, [
          $this->username() => 'required|string',
          'password' => 'required|string',
          'g-recaptcha-response' => 'required|captcha',
          'twofactor' => 'required|accepted'
        ]);
      }else{
        $this->validate($request, [
          $this->username() => 'required|string',
          'password' => 'required|string',
          'twofactor' => 'required|accepted'
        ]);
      }
    }

    public function username()
    {
        return 'hash_login_id';
    }
}
