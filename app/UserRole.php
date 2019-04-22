<?php
namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model {
  protected $table = 'role_user';
  protected $fillable = [ 'role'];

  public function users(){
    return $this->hasMany(User::class, 'role_id');
  }

}