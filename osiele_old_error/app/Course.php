<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'SubjectID';
    // protected $fillable = [
    //     'SubjectName', 'SubjectCode', 'SubjectValue', 'SubjectUnit', 'Semester', 'SubjectLevel', 'Active'
    // ];
}
