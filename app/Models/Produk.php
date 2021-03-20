<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $primaryKey = 'id';
    protected $fillable = ['nama','gambar','harga','berat'];

    public function belanja(){
    	return $this->hasMany(Belanja::class);
	}
}
