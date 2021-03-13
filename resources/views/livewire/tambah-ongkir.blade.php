<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">{{ ("Tambah Ongkir") }}</div>

                <div class="card-body">
                    <form wire:submit.prevent="getOngkir">

                    <label for="provinsi" class="col-md-12 col-form-label text-md-left">{{ ('Silahkan pilih provinsi anda') }}</label>

                    <select name="provinsi" wire:model="provinsi_id" class="form-control">
                        <option value="0">--PILIH PROVINSI--</option>
                        @forelse ($daftarProvinsi as $p)
                        <option value="{{$p['province_id']}}">{{ $p['province'] }}</option>
                        @empty
                        <option value="0">Provinsi tidak ada</option>
                        @endforelse
                    </select>

                    <label for="kota" class="col-md-12 col-form-label text-md-left">{{ ('Silahkan pilih kota anda') }}</label>

                    <select name="kota" wire:model="kota_id" class="form-control">
                        <option value="">--PILIH KABUPATEN/KOTA--</option>
                        @if ($provinsi_id)
                        @forelse ($daftarKota as $k)
                        <option value="{{$k['city_id']}}">{{ $k['city_name'] }}</option>
                        @empty
                        <option value="0">PILIH KABUPATEN/KOTA</option>
                        @endforelse
                        @endif
                    </select>

                    <label for="jasa" class="col-md-12 col-form-label text-md-left">{{ ('Jasa Pengiriman') }}</label>

                    <select name="jasa" wire:model="jasa" class="form-control">
                        <option value="">--PILIH JASA PENGIRIMAN--</option>
                        <option value="jne">JNE</option>                        
                        <option value="pos">Pos Indonesia</option>
                        <option value="tiki">TIKI</option>
                    </select>

                    <br><br>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success btn-block">Lihat Daftar Ongkir</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
