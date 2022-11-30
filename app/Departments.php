<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $primaryKey = 'department_id';
    protected $fillable = ['dep_name'];
     public $timestamps = false;
    public function students(){
        return $this->hasMany('App\student_info');
    }
}
