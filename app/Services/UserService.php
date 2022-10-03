<?php

namespace App\Services;

use App\Models\User;
use App\Services\UtilsService;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserService
{

  public function login($request_data)
  {
    try{
      $user = User::firstWhere('email', $request_data['email']);
      if(password_verify($request_data['password'], $user->password)) {
        $jwt = $this->generateUserTokenJwt($user->email);
        $this->updateUserJWT($user->id, $jwt);
        $response = ['login'=>true, 'jwt_token'=> $jwt,'id'=>$user->id, 'email' => $user->email, 'name' => $user->name];
      }else{
        $response = ['login'=>false];
      }
    }catch(\Exception $e){
      $response = ['login'=>false];
    }
    
    return $response;
  }

  public function updateUserJWT($user_id, $jwt)
  {
    $user = User::find($user_id);
    $user->token_jwt = $jwt;
    $user->save();
  }

  public function generateUserTokenJwt($email)
  {
    $timestamp = strtotime("+1 day");
    $payload = [
      'email' => $email,
      'exp' => $timestamp,
      'nbf' => 1357000000
    ];
    $jwt = JWT::encode($payload, env('JWT_KEY'), 'HS256');

    return $jwt;
  }

  public function decodeUserJwt($jwt)
  {
    $decoded = JWT::decode($jwt, new Key(env('JWT_KEY'), 'HS256'));

    return $decoded;
  }

  public function userAutentication($jwt_cookie)
  {
    try{
      $decoded = $this->decodeUserJwt($jwt_cookie);
      $user = User::firstWhere('email', $decoded->email);

      return ['status' => true, $user];
    }catch(\Exception $e){

      return ['status' => false,'message' => 'token inválido', 'jwt_token' => $jwt_cookie];
    }
  }

}