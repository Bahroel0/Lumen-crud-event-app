<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventUser;
use App\Operation\BaseCrud;
use App\Helpers\GlobalFunc;
use App\Helpers\GlobalVar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EventController extends Controller{

  public function getAllEvent(Request $request){
    $event = new BaseCrud(new Event());
    $res['success'] = true;
    $res['data']    = $event->findAll();
    
    return response($res);
  }

  public function getEvent(Request $request, $id){
    $event = new BaseCrud(new Event());
    $res['success'] = true;
    $res['data']    = $event->findById($id);
    
    return response($res);
  }

  public function create(Request $request){
    $validation = $this->requestValidation($request);


    if(!$validation['success']){
      return response($validation);
    }

    $event  = new BaseCrud(new Event());
    $roles  = Event::$validation_roles;
    $res = $event->createGetData($validation['data'], $roles);
    return response($res);

  }

  public function update(Request $request, $id){    
    $validation = $this->requestValidation($request);

    if(!$validation['success']){
      return response($validation);
    }

    $event  = new BaseCrud(new Event());
    $roles  = Event::$validation_roles;
    $res = $event->update($validation['data'], $roles, $id);
    return response($res);
  }

  public function delete(Request $request, $id){
    $event  = new BaseCrud(new Event());
    $res    = $event->delete($id);

    return response($res);
  }

  public function join(Request $request){
    $evus   = new BaseCrud(new EventUser());
    $roles  = EventUser::$validation_roles;
    
    $params = [
      'user_id'   => $request->input('user_id'),
      'event_id'  => $request->input('event_id')
    ];

    $res = $evus->create($params, $roles);
    return response($res);
  }

  public function unjoin(Request $request){
    $evus = new BaseCrud(new EventUser());
    $temp  = $evus->findWhere([
      'user_id' => $request->input('user_id'),
      'event_id' => $request->input('event_id')
    ]);
    $id = $temp['0']->id;
    $res = $evus->delete($id);
    return response($res);
  }


  public function getEventUserRegister(Request $request, $id){
    $res['data'] = EventUser::with(
      ['users']
    )->where('event_id', $id)->get();
    $res['total'] = count($res['data']);
    return response($res);
  }

  public function getEventRegisteredByUser(Request $request, $id){
    $evus = new BaseCrud(new EventUser());
    $res['data']  = $evus->findWithWhere(['event'], ['user_id' => $id]);
    $res['total'] = count($res['data']);
    return response($res);
  }

  public function requestValidation(Request $request){
    $result = [];
    $form = $request->all();

    $validateImage = Validator::make($form,[
      'image' => 'mimes:jpeg,jpg,png|required|max:2000'
    ]);

    if($validateImage->fails()){
      return GlobalVar::$VALIDATE_IMAGE_FAILED;
    }

    $validateDateFormat = GlobalFunc::stringDateValidator($form['date']);

    if(!$validateDateFormat){
      return GlobalVar::$WRONG_DATE_FORMAT;
    }

    $upload = $this->uploadImage($request->file('image'), $request->input('name'));
    if(!$upload['success']) return GlobalVar::$FAILED_SAVE_FILE;
    
    $params = [
      'name' => $request->input('name'),
      'address' => $request->input('address'),
      'description' => $request->input('description'),
      'date' => GlobalFunc::convertDate($request->input('date')),
      'image_url' => $upload['imageUrl']
    ]; 

    $result['success']  = true;
    $result['data']     = $params;

    return $result;
  }

  public function uploadImage($image, $name){
    $date = date("Y-m-d");
    $imageExt  = $image->getClientOriginalExtension();
    $imageName =  $name.'-'.$date.'.'.$imageExt;
    
    $save = $image->move('upload/images', $imageName);

    if($save){
      $res['success'] = true;
      $res['imageUrl'] = 'upload/images/'.$imageName;
    }else{
      $res['success'] = true;
      $res['imageUrl'] = 'upload/images/'.$imageName;
    }
    return $res;
  }
 
}