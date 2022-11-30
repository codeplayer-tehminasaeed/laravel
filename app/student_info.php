<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student_info extends Model
{
    protected $primaryKey = 'student_info_id';
    public $timestamps = false;

    public function student(){
        return $this->belongsTo('App\User','student_id');
    }
    
     public function dep(){
        return $this->belongsTo('App\Departments','dep_id');
    } 

    public function sections(){
        return $this->belongsTo('App\Sections','sec_id');
    }

}
