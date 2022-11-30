<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    
    protected $primaryKey = 'program_id';
    protected $fillable = ['prg_name','dep_id','no_of_semesters'];
    public $timestamps = false;
}
