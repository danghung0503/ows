<?php
namespace controller;

use base\controller\Controller;
use http\Request;
use middleware\AuthMiddleware;
use service\AuthService;

class AuthController extends Controller
{
    private object $service;
    private AuthMiddleware $middleware;
    public function __construct()
    {
        $this->middleware = new AuthMiddleware();
        $this->middleware($this->middleware)->except(['/auth/login']);
        $this->service = new AuthService();
    }

    public function login(Request $request){
        $result = $this->service->login($request);
        $data = [
          'jwt' => $result,
          'message' => 'Success'
        ];
        return response()->json($data);
    }

    public function signUp(Request $request){
        $this->service->create($request);
    }

    public function logout(){
        echo 'logout';
    }

    public function detail(Request $request){
        $result = $this->service->getDetail($request);
        return response()->json($result);
    }

    public function update(Request $request){
        $result = $this->service->update($request);
        return response()->json($result);
    }
}
