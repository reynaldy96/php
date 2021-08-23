@extends('Layouts.Member')

@section('content')

<section id="main" class="wrapper">
    <div class="container">
        <h2 class="text-center">Produck {{ $order->	billing_name }} Status order</h2>
      <hr>
    </div>
    <div class="inner">
        <div class="content">
                <div class="form-group">
                    <label for="name" class="col-md-12 text-md-center">{{ __('Nama Pembeli') }}</label>
            
                    <div class="col-md-12">
                        <input class="form-control" value="{{$order->user->first_name}}" autocomplete="name" readonly autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-md-12 text-md-center">{{ __('Email ') }}</label>
            
                    <div class="col-md-12">
                        <input class="form-control" value="{{$order->user->email}}" autocomplete="name" readonly autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12 text-md-center">{{ __('Harga Barang ') }}</label>
                
                    <div class="col-md-12">
                        <input class="form-control" value="@currency($order->billing_subtotal)" autocomplete="price" readonly autofocus>
                    </div>
    
                </div>
        
                <div class="form-group">
                    <label class="col-md-12 text-md-center">{{ __('Biaya System ') }}</label>
                
                    <div class="col-md-12">
                        <input class="form-control" value="@currency($order->billing_tax)" autocomplete="price" readonly autofocus>
                    </div>
    
                </div>

                <div class="form-group">
                    <label class="col-md-12 text-md-center">{{ __('Total Barang yang harus diBayar') }}</label>
                    
                    <div class="col-md-12">
                        <input class="form-control" value="@currency($order->billing_total)" autocomplete="price" readonly autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12 text-md-center">{{ __('Status Pesanan') }}</label>
                    
                    <div class="col-md-12">
                        @if($order->status_transaksi == 0)
                        <center>
                            <span class="badge badge-warning">Menunggu Pembayaran</span>
                        </center>
                        @else
                        <center>
                            <span class="badge badge-success">Transaksi Selesai</span>
                        </center>
                        @endif  
                    </div>
                </div>

                <hr>

                <form method="post" action="{{ route('konfirmasi.store', $order->id) }}" enctype="multipart/form-data">    
                    @csrf 
                    <input type="hidden" name="order_id" value="{{$orderproduk->order_id}}">
                    <input type="hidden" name="product_id" value="{{$orderproduk->product_id}}">

                    <div class="form-group">  
                        <label for="title" class="col-md-12 text-md-center">{{ __('Bank Transfer') }}</label>
                        <p>
                        <div class="col-md-12">                                           
                            <select name="bank_transfer_id">
                                @foreach($bank as $key)
                                    <option value="{{$key->id}}"> {{$key->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label for="title" class="col-md-12 text-md-center">Gambar untuk Halaman Depan</label>
                                    <div class="col-md-12">
                                        <div class="custom-file">
                                            <input type="file" name="thumbnails" class="custom-file-input" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="button-box">
                            <button type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" class="default-btn btn-login floatcenter btn-block text-uppercase">Upload </button>
                        </div>
                    </div>

                </form>

        </div>
    </div>
</section> 
@endsection