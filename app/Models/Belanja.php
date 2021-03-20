<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belanja extends Model
{
    use HasFactory;
    protected $table = 'belanjas';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','produk_id','total_harga','status'];

    public function produk(){
    	return $this->belongsTo(Produk::class);
	}
}