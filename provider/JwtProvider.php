<?php

namespace provider;
use Firebase\JWT\JWT;
use Exception;
class JwtProvider
{
    private string $secretKey;
    private array $tokenData;
    private string $tokenType;
    public function __construct()
    {
        $this->secretKey = base64_decode(config('jwt.secretKey'));
        $this->tokenType = 'Bearer';
        $this->initTokenData();
    }

    private function initTokenData(){
        $tokenId    = base64_encode(random_bytes(32));
        $issuedAt   = time();
        $notBefore  = $issuedAt + 10;             //Adding 10 seconds
        $expire     = $notBefore + 60000;            // Adding 60 seconds
        $serverName = config('jwt.serverName'); // Retrieve the server name from config file
        $this->tokenData = [
            'iat'  => $issuedAt,         // Issued at: time when the token was generated
            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss'  => $serverName,       // Issuer
            'nbf'  => $notBefore,        // Not before
            'exp'  => $expire,           // Expire
        ];
    }

    public function createToken($data){
        $this->tokenData['data'] = $data;
        $jwt = JWT::encode(
            $this->tokenData,      //Data to be encoded in the JWT
            $this->secretKey, // The signing key
            'HS512'
        );
        return $this->tokenType.' '.$jwt;
    }

    public function decode($token){
        try {
            $params = explode($this->tokenType. ' ',$token);
            $data = null;
            if(count($params) > 1) {
                $jwt = explode($this->tokenType. ' ',$token)[1];
                $data = JWT::decode($jwt, $this->secretKey, array('HS512'));
            }
            return $data;
        }catch(Exception $ex) {
            echo $ex->getMessage();
            return null;
        }
    }
}
