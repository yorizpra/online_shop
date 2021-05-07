	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<!-- <td class="price">Price</td> -->
							<!-- <td class="quantity">Quantity</td> -->
							<td class="total">Total</td>
							<td></td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                        <?php $no = 1 ?>
                        @forelse ($belanja as $pesanan)
						<tr>
							<td class="cart_product">
                                <?php $produk = \App\Models\Produk::where('id', $pesanan->produk_id)->first(); ?>
								<a href=""><img src="{{ asset('storage/photos/'.$produk->gambar) }}" width="110px" alt="">
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $produk->nama }}</a></h4>
                                @if($pesanan->status == 0)
                                <strong>Pesanan Belum ditambahkan ongkir</strong>
                                @endif
                                @if($pesanan->status == 1)
                                <strong>Pesanan Sudah ditambahkan ongkir</strong>
                                @endif
                                @if($pesanan->status == 2)
                                <strong>Pesanan telah dipilih pembayarannya</strong>
                                @endif
								<p>{{ $pesanan->created_at }}</p>
							</td>
							<!-- <td class="cart_price">
								<p>$59</p>
							</td> -->
							<!-- <td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td> -->
							<td class="cart_total">
								<p class="cart_total_price">Rp. {{ number_format($pesanan->total_harga) }}</p>
							</td>
							<td>
								@if($pesanan->status == 0)
                                    <a href="{{ url('TambahOngkir/'.$pesanan->id) }}" class="btn btn-warning btn-block">Tambahkan Ongkir</a>
                                @endif
                                @if($pesanan->status == 1)
                                    <a href="{{ url('Bayar/'.$pesanan->id) }}" class="btn btn-primary btn-block">Pilih Pembayaran</a>
                                @endif
                                @if($pesanan->status == 2)
                                    <a href="{{ url('Bayar/'.$pesanan->id) }}" class="btn btn-primary btn-block">Lihat Status</a>
                                @endif
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" wire:click="destroy({{ $pesanan->id }})"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                        @empty
                        <tr>
                            <td colspan="7">Data Kosong</td>
                        </tr>
                        @endforelse
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>$61</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->