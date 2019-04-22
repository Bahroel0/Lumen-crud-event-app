<?php

namespace App;

use App\EventUser;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
  protected $table = 'event';
  protected $fillable = [
    'name', 'address', 'date', 'image_url', 'description'
  ];

  public static $validation_roles = [
    'name'    => 'required',
    'address' => 'required',
    'date'    => 'required',
    'image_url' => 'required',
    'description' => 'required'
  ];

  public function event_user(){
    return $this->hasMany(EventUser::class, 'event_id');
  }

  public static function boot(){
    parent::boot();

    static::deleting(
      function($event){
          $event->event_user()->delete();
      }
    );
  }
}