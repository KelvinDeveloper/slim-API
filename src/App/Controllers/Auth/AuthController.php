<?php

namespace App\Controllers\Auth;

use App\Models\Model;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Hashing\BcryptHasher as Hash;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AuthController {

    public function Auth (Request $request, Response $response)
    {
        $Hash = new Hash;

        $Data = (object) $request->getParams();
        $User = User::where('email', $Data->username)->first();

        if (! $User || ( $User && ! $Hash->check( $Data->password, $User->password ) ) ) {

            throw new \Exception('Login or password not valid.');
        }

        $JWT = JWT::encode(array_merge(
            [
                'id'        =>  $User->id,
                'password'  =>  $User->password
            ],
            [
                'iat'   =>  time(),
                'exp'   =>  time() + (int) env('JWT_TIME', 1200)
            ]
        ), env('JWT_KEY'));

        $User->token = $JWT;

        return $response->withJSON($User, 200, JSON_UNESCAPED_UNICODE);
    }

    static function Login ($User)
    {
        return (object) $_SESSION['User'] = $User;
    }

    static function User ()
    {
        if (! isset( $_SESSION['User'] ) ) throw new \Exception('User not logged');

        return (object) $_SESSION['User'];
    }
}