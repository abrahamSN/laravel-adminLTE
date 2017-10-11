<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PekerjaKeluhan extends Model
{
    protected $table = 'pekerja_keluhan';
    protected $fillable = ['pekerja_id', 'keluhan_id'];
    public $timestamps = false;
}
