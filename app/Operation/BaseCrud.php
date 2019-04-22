<?php

namespace App\Operation;

use App\Helpers\GlobalVar;
use App\Helpers\GlobalFunc;
use Carbon\Carbon;
use App\TechEvent;
use Illuminate\Support\Facades\Validator;

class BaseCrud{
  protected $model;

  public function __construct($model = null){
    $this->model = $model;
  }

  public function isExistById($id){
    $data = $this->model->find($id);
    if(!$data)
      return false;
    return true;
  }

  public function isExistByEmail($email){
    $data = $this->model->where('email', $email)->first();
    if($data)
      return GlobalVar::$EMAIL_EXIST;
    return false;
  }

  public function findAll(){
    $data = $this->model->all();
    if (!$data) {
        return GlobalVar::$DATA_NOT_FOUND;
    }
    return $data;
  }

  public function findById($id) {
    $data = $this->model->find($id);
    if (!$data) {
        return GlobalVar::$DATA_NOT_FOUND;
    }
    return $data;
  }

  public function findWhere($conditions = []) {
    $data = $this->model->where($conditions)->get();
    if (count($data) == 0) {
        return GlobalVar::$DATA_NOT_FOUND;
    }
    return $data;
  }
  
  public function findWith($with = []) {
      $data = $this->model->with($with)->get();
      if (!$data) {
          return GlobalVar::$DATA_NOT_FOUND;
      }
      return $data;
  }

  public function findWithWhere($with = [], $where = []) {
      $data = $this->model->with($with)->where($where)->get();
      if (!$data) {
          return GlobalVar::$DATA_NOT_FOUND;
      }
      return $data;
  }

  public function create($input = [], $roles = []) {
      $validated  = GlobalFunc::validates($input, $roles);
      if (!$validated)
          return GlobalVar::$VALIDATE_FAILED;
      $input['created_at'] = Carbon::now()->toDateTimeString();
      $input['updated_at'] = Carbon::now()->toDateTimeString();
      $process    = $this->model->insert($input);
      if ($process) {
          return [
              'success'   => true,
              'message'   => GlobalVar::$SAVE_SUCCESS_MESSAGE
          ];
      } else {
          return [
              'success'   => false,
              'message'   => GlobalVar::$SAVE_FAILED_MESSAGE
          ];
      }
  }

  public function createGetData($input = [], $roles = []) {
      $validated  = GlobalFunc::validates($input, $roles);
      if (!$validated)
          return GlobalVar::$VALIDATE_FAILED;
      $input['created_at'] = Carbon::now()->toDateTimeString();
      $input['updated_at'] = Carbon::now()->toDateTimeString();
      $id   = $this->model->insertGetId($input);
      $data = $this->model->find($id); 
      if ($data) {
          return [
              'success'   => true,
              'message'   => GlobalVar::$SAVE_SUCCESS_MESSAGE,
              'data'      => $data
          ];
      } else {
          return [
              'success'   => false,
              'message'   => GlobalVar::$SAVE_FAILED_MESSAGE
          ];
      }
  }

  public function update($input, $roles, $id) {
      $validated  = GlobalFunc::validates($input, $roles);
      if (!$validated)
          return GlobalVar::$VALIDATE_FAILED;
      $input['updated_at'] = Carbon::now()->toDateTimeString();
      if ($this->isExistById($id)) {
          $process = $this->model->where('id', $id)->update($input);
          if ($process) {
              return [
                  'success' => true,
                  'message' => GlobalVar::$UPDATE_SUCCESS_MESSAGE,
                  'data'    => $this->model->where('id', $id)->first()
              ];
          } else {
              return [
                  'success' => false,
                  'message' => GlobalVar::$UPDATE_FAILED_MESSAGE
              ];
          }
      } else {
          return GlobalVar::$DATA_NOT_FOUND;
      }
  }

  public function delete($id) {
      if ($this->isExistById($id)) {
          $process    = $this->model->where('id', $id)->delete();
          if ($process) {
              return [
                  'success'   => true,
                  'message'   => GlobalVar::$DELETE_SUCCESS_MESSAGE
              ];
          } else {
              return [
                  'success'   => false,
                  'message'   => GlobalVar::$DELETE_FAILED_MESSAGE
              ];
          }
      } else {
          return GlobalVar::$DATA_NOT_FOUND;
      }
  }
  
  public function deleteWhere($key, $value) {
      if ($this->isExistById($value)) {
          $process    = $this->model->where($key, $value)->delete();
          if ($process) {
              return [
                  'success'   => true,
                  'message'   => GlobalVar::$DELETE_SUCCESS_MESSAGE
              ];
          } else {
              return [
                  'success'   => false,
                  'message'   => GlobalVar::$DELETE_FAILED_MESSAGE
              ];
          }
      } else {
          return GlobalVar::$DATA_NOT_FOUND;
      }
  }
}