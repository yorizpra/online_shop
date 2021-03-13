<?php

namespace App\Http\Livewire;
use App\Models\Produk;
use App\Models\Belanja;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    public $products = [];

    //atribut filtering
    public $search,$min,$max;
    public function beli($id)
    {
        if (!Auth::user()) {
            return Redirect()->route('login');
        }
        //mencari produk
        $produk = Produk::find($id);

        Belanja::create(
            [
                'user_id' => Auth::user()->id,
                'total_harga' => $produk->harga,
                'produk_id' => $produk->id,
                'status' => 0
            ]
            );
            return redirect()->to('BelanjaUser');
    }

    public function render()
    {
        //filter harga max
        if ($this->max) {
            $harga_max = $this->max;
        }
        else {
            $harga_max = 9000000000000;
        }

        //filter harga max
        if ($this->min) {
            $harga_min = $this->min;
        }
        else {
            $harga_min = 0;
        }

        if ($this->search) {
            $this->products = Produk::where('nama','like',"%".$this->search."%")
            ->where('Harga','>=',$harga_min)
            ->where('Harga','<=',$harga_max)
            ->get();
        }
        else {
            $this->products = Produk::where('Harga','>=',$harga_min)
            ->where('Harga','<=',$harga_max)
            ->get();
        }
        return view('livewire.home')->extends('layouts.app')->section('content');
    }
}
