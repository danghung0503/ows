<?php
namespace middleware;

use http\Request;
use provider\JwtProvider;
use base\middleware\Middleware;
class AuthMiddleware extends Middleware
{
    public function handler(Request $request){
        $token = $request->getHeader('Authorization');
        $jwtProvider = new JwtProvider();
        $jwtData = $jwtProvider->decode($token);
        // if token is invalid
        if(empty($jwtData)) {
            return false;
        }
        return true;
    }
}
