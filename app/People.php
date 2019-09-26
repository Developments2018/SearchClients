<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'personas';
    protected $fillable = [
        'rut','ncliente','sector','nombre','comuna'];
}
