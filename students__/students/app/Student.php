<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'students';
    protected $primaryKey = 'StudentID';
    protected $fillable = [
        'StudentKey', 'MatricNo', 'Firstname',
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
