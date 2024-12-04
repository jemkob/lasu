<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'Id';
    // protected $fillable = [
    //     'SubjectName', 'SubjectCode', 'SubjectValue', 'SubjectUnit', 'Semester', 'SubjectLevel', 'Active'
    // ];
}
