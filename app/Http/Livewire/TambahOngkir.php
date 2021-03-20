<?php

namespace App\Http\Livewire;
use App\Models\Belanja;
use App\Models\Produk;
use Livewire\Component;
use Kavist\RajaOngkir\RajaOngkir;
use Illuminate\Support\Facades\Auth;

class TambahOngkir extends Component
{
    public $belanja;
    private $apiKey = '742f327a03d8c4460bd54314d75faa93';
    public $provinsi_id, $kota_id, $jasa, $daftarProvinsi, $daftarKota, $nama_jasa;
    public $result = [];
    
    public function mount($id)
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $this->belanja = Belanja::find($id);

        if($this->belanja->user_id != Auth::user()->id){
            return redirect()->to('');
        }
    }

    public function getOngkir()
    {
        //validasi
        if (!$this->provinsi_id || !$this->kota_id || !$this->jasa) {
            return;
    }

        //mengambil data produk
        $produk = Produk::find($this->belanja->produk_id);
        // $produk->belanja();
        // dd($produk);

        //mengambil biaya ongkir
        $rajaOngkir = new RajaOngkir($this->apiKey);
        $cost = $rajaOngkir->ongkosKirim([
            'origin' => 489,
            'destination' => $this->kota_id,
            'weight' => $produk->berat,
            'courier' => $this->jasa
        ])->get();

        //pengecekan
        // dd($cost);

        //nama jasa
        $this->nama_jasa = $cost[0]['name'];
        
        foreach ($cost[0]['costs'] as $row) {
            $this->result[] = array(
                'description' => $row['description'],
                'biaya' => $row['cost'][0]['value'],
                'etd' => $row['cost'][0]['etd']
            );
        }
        
        // dd($this->result);
    }

    public function save_ongkir($biaya_pengiriman){
        $this->belanja->total_harga += $biaya_pengiriman;
        $this->belanja->status = 1;
        $this->belanja->update();

        //redirect ke belanja
        return redirect()->to('BelanjaUser');
    }

    public function render()
    {
        $rajaOngkir = new RajaOngkir($this->apiKey);
        $this->daftarProvinsi = $rajaOngkir->provinsi()->all();

        
        if ($this->provinsi_id) {
            $this->daftarKota = $rajaOngkir->kota()->dariProvinsi($this->provinsi_id)->get();
        }
        
        return view('livewire.tambah-ongkir')->extends('layouts.app')->section('content');
    }
}
