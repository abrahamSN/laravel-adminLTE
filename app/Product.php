<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tb_product';
    protected $fillable = [
        'name','keterangan'
    ];
    public $timestamps = true;
}
