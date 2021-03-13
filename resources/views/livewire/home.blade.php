<div class="container">
    @if(Auth::user())
        @if(Auth::user()->level == 1)
        <div class="col-md-3">
            <a href="{{ url('TambahProduk/') }}" class="btn btn-success btn-block">Tambah Produk</a>
        </div>
        @endif
    @endif
    <br>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input wire:model="search" type="text" class="form-control" placeholder="Search.." aria-label="Search" ariadescribedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <input wire:model="min" type="text" class="form-control" placeholder="Harga min.." aria-label="Harga min" ariadescribedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <input wire:model="max" type="text" class="form-control" placeholder="Harga max.." aria-label="Harga max" ariadescribedby="basic-addon1">
            </div>
        </div>
    </div>

    <section class="products mb-5">
        <div class="row mt-4">
            @foreach($products as $product)
            
            <div class="col-md-3 mb-3">
                <div class="card">

                    <div class="card-body text-center">
                    <img src="{{ asset('storage/photos/'.$product->gambar) }}" width="200px" height="270px">
                        <div class="row mt-2">
                            <div class="col-md-12">
                            <h5><strong>{{ $product->nama }}</strong></h5>
                            <h6><strong>Rp. {{ number_format($product->harga) }}</strong></h6>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                            <button class="btn btn-success btn-block" wire:click="beli({{ $product->id }})">Beli</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @endforeach
            
        </div>
    </section>

</div>