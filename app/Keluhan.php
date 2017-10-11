<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    protected $table = 'tb_keluhan';
    protected $primaryKey = 'id';
    protected $fillable = ['invoice','user_id','product_id','keterangan','status'];
    public $timestamps = true;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function pekerja() {
        return $this->belongsToMany(User::class, 'pekerja_keluhan', 'keluhan_id', 'pekerja_id');
    }

}
