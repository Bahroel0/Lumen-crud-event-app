<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;

class GlobalFunc {
  public static function validates($input, $roles) {
    $validate   = Validator::make($input, $roles);
    if ($validate->fails()) {
        return false;
    }
    return true;
  }

  public static function convertDate($params){
    $array = explode('-', $params);
    $month = ['Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni',
     'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];
    $index = (int) $array[1];
     return $array[2].' '.$month[$index-1].' '.$array[0];
  } 

  public static function stringDateValidator($params){
    $regex = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
    if(preg_match($regex, $params)) 
      return true;
    return false;
  }
}