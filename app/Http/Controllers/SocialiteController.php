<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\OAuth;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;

class SocialiteController extends Controller {

    /**
     * @var Guard
     */
    private $auth;

    /**
     * @var array An array of all the socialite providers supported by the auth system.
     */
    private $availableProviders = ['facebook', 'google'];

    /**
     * SocialiteController constructor.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    /**
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect($provider) {
        if (in_array($provider, $this->availableProviders)) {
            return \Socialite::with($provider)->redirect();
        }

        return redirect('/login');
    }

    /**
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callback($provider) {
        if (in_array($provider, $this->availableProviders)) {
            $user = \Socialite::with($provider)->user();
            return $this->authorizeSocialUser($user, $provider);
        }

        return redirect('/login');
    }


    public function authorizeSocialUser($user, $provider) {
        $oauth = OAuth::firstOrNew([
            'auth_id' => $user->getId(),
            'provider' => $provider
        ]);

        if (!$oauth->exists) {
            $dbUser = User::firstOrCreate(['name' => $user->getName(), 'email' => $user->getEmail()]);
            $dbUser->oAuth()->save($oauth);
        } else {
            $dbUser = $oauth->user;
        }

//        $this->auth->login($dbUser, true);

        return redirect('/home');
    }
}
