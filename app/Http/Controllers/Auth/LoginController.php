<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

// use Illuminate\Http\Request;
// use Microsoft\Graph\Graph;
// use Microsoft\Graph\Model;
// use Microsoft\Graph\Connect\Constants;
// use Microsoft\Graph\Connect\Constants\IdTokenClaimTypes;
// use Microsoft\Graph\Connect\Constants\OidcScopes;
// use Microsoft\Graph\Connect\Constants\SessionClaimTypes;
use Microsoft\Graph\Connect\Constants\TokenTypeIdentifiers;
// use Microsoft\Graph\Connect\ConnectWebApp\UserClaimsFactory;
use Microsoft\Identity\Client\AccessToken;
// use Microsoft\Identity\Client\AuthenticationResult;
// use Microsoft\Identity\Client\PublicClientApplication;
use Microsoft\Identity\Client\TokenCache;
use Microsoft\Identity\Client\TokenCache\InMemoryTokenCache;
// use Microsoft\Identity\Client\Exception\MSALException;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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

    public function redirectToAzure()
    {
        return Socialite::driver('azure')->redirect();
    }

    public function handleAzureCallback()
    {
        $user = Socialite::driver('azure')->user();

        // Xử lý thông tin người dùng đã đăng nhập thành công vào Laravel app của bạn

        // Ví dụ: Lưu thông tin người dùng vào session và chuyển hướng tới trang chính
        session(['user' => $user]);

        return redirect()->route('home');
    }
    //
    //
    //

    // protected $graph;

    // public function __construct()
    // {
    //     $this->graph = new Graph();
    // }

    // public function login()
    // {
    //     $config = [
    //         'client_id' => config('azure_ad.client_id'),
    //         'client_secret' => config('azure_ad.client_secret'),
    //         'redirect_uri' => config('azure_ad.redirect_uri'),
    //         'authority' => config('azure_ad.authority'),
    //         'validate_authority' => false,
    //     ];

    //     $msalApp = new PublicClientApplication($config);
    //     $scopes = ['openid', 'profile', 'email', 'User.Read'];
    //     $loginUrl = $msalApp->getAuthorizationRequestUrl($scopes);

    //     return redirect($loginUrl);
    // }

    // public function handleAzureCallback(Request $request)
    // {
    //     $config = [
    //         'client_id' => config('azure_ad.client_id'),
    //         'client_secret' => config('azure_ad.client_secret'),
    //         'redirect_uri' => config('azure_ad.redirect_uri'),
    //         'authority' => config('azure_ad.authority'),
    //         'validate_authority' => false,
    //     ];

    //     $msalApp = new PublicClientApplication($config);
    //     $tokenCache = new InMemoryTokenCache();
    //     $msalApp->setTokenCache($tokenCache);

    //     try {
    //         $response = $msalApp->acquireTokenByAuthorizationCode($_GET['code'], $scopes);
    //         $accessToken = $response->accessToken;
    //         // Lưu access token vào session hoặc database
    //     } catch (MSALException $e) {
    //         // Xử lý lỗi nếu có
    //     }

    //     // Chuyển hướng người dùng đến trang chính của ứng dụng
    //     return redirect('/');
    // }


}
