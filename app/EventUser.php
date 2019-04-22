<?php

namespace App;
use App\User;
use App\Event;
use Illuminate\Database\Eloquent\Model;

class EventUser extends Model {
  protected $table = 'event_user';
  protected $fillable = [
    'user_id', 'event_id'
  ];

  public static $validation_roles = [
    'user_id' => 'required',
    'event_id' => 'required'
  ];

  public function users(){
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function event(){
    return $this->belongsTo(Event::class, 'event_id', 'id');
  }

}