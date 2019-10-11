<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
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

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');  //必须登录后才能访问控制的动作
        $this->middleware('signed')->only('verify');    //只有verify动作使用signed中间件进行认证 URL签名认证
        $this->middleware('throttle:6,1')->only('verify', 'resend');//对verify、resend动作做了频率限制 throttle 中间件是框架提供的访问频率限制功能。 限制1分钟<=6次
    }
}
