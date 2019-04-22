<?php

namespace App\Http\Controllers;

use App\User;
use App\Operation\BaseCrud;
use App\Helpers\GlobalFunc;
use App\Helpers\GlobalVar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{

  public function register(Request $request){
    $user = new BaseCrud(new User());
    $checkEmail = $user->isExistByEmail($request->input('email'));

    if($checkEmail){
      return response($checkEmail);
    }

    // validate model role
    $hasher = app()->make('hash');
    $password   = $hasher->make($request->input('password'));
    $roles      = User::$validation_roles;
    $params = [
      'email'     => $request->input('email'),
      'password'  => $password,
      'role_id'   => $request->input('role_id'),
      'api_token' => sha1(time())
    ];

    $res = $user->createGetData($params, $roles);
    return response($res);
  }

  public function login(Request $request){
    $user = User::where('email', $request->input('email'))->first(); 

    if(!$user){
      return response(GlobalVar::$EMAIL_NOT_EXIST);
    }

    $hasher = app()->make('hash');
    $password = $request->input('password');
    $res = [];

    if($hasher->check($password, $user->password)){
      $process = User::where('id', $user->id)->update(['api_token' => sha1(time())]);
      $data = User::where('id', $user->id)->first();
      if($process){
        $res['success'] = true;
        $res['message'] = 'Login berhasil';
        $res['data'] = $data;
      }else{
        $res['success'] = false;
        $res['message'] = 'Token update failed!';
      }
    }else{
      $res['success'] = false;
      $res['message'] = 'Login failed!';
    }
    return response($res);
  }

  public function authenticate(Request $request){
    $user = Auth::user();
    if($user){
      $res['success'] = true;
      $res['message'] = "User authenticate!";
    }else{
      $res['success'] = false;
      $res['message'] = "User not authenticate!";
    }
    return response($res);
  }
}
