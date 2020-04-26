<?php

namespace service;
use http\Request;
use model\User;
use provider\JwtProvider;
use repository\UserRepository;
class AuthService
{
    private UserRepository $repository;

    private User $user;
    private object $jwtProvider;
    public function __construct()
    {
        $this->user = new User();
        $this->repository = new UserRepository($this->user);
        $this->jwtProvider = new JwtProvider();
    }

    public function create(Request $request){
        $fields = $this->user->getFillable();
        $data = [];
        foreach($fields as $field) {
            $data[$field] = $request->get($field);
        }
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->repository->create($data);
    }

    public function getDetail(Request $request){
        $id = $request->get('id');
        return $this->repository->findById($id);
    }

    public function update(Request $request){
        $fields = $this->user->getFillable();
        $data = [];
        foreach($fields as $field) {
            $data[$field] = $request->get($field);
        }
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $id = $request->get('id');
        return $this->repository->update($data, $id);
    }

    public function login(Request $request) {
        $email = $request->get('email');
        $password = $request->get('password');

        $user = $this->repository->findByField('email', $email);
        if(!$user)
            return null;
        if(password_verify($password, $user['password'])){
            $jwtData = [
                'id'    => $user['id'],
                'email' => $user['email']
            ];
            return $this->jwtProvider->createToken($jwtData);
        }else{
            echo 'login that bai';
        }
    }
}
