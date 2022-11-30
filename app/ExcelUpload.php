<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExcelUpload extends Model
{
    protected $primaryKey = 'upload_id';
    public $timestamps = false;
}
