<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Lecturer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'lecturers';
    protected $primaryKey = 'LecturerID';
    protected $fillable = [
        'AdminKey', 'Username', 'Password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Password', 'remember_token',
    ];

    // public function is_admin(){
    //     if($this->admin){
    //         return true;
    //     }
    //     return false;
    // }
}
