@extends('Layouts.Admin')

@section('content')
<section id="main" class="wrapper">
    <div class="container">
        <h2 class="text-center">Produck {{ $waiting->name }} Status Waiting</h2>
      <hr>
    </div>
    <div class="inner">
        <div class="content">
                <div class="form-group">
                    <label for="name" class="col-md-12 text-md-center">{{ __('Penjual') }}</label>
            
                    <div class="col-md-12">
                        <input class="form-control" value="{{$waiting->user->first_name}}" autocomplete="name" readonly autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-md-12 text-md-center">{{ __('Nama Barang') }}</label>
            
                    <div class="col-md-12">
                        <input id="name" class="form-control" value="{{ $waiting->name }}" autocomplete="name" readonly autofocus>
                    </div>
                </div>
        
                <div class="form-group">
                    <label for="quantity" class="col-md-12 text-md-center">{{ __('Jumlah Barang Yang diJual ') }}</label>
            
                    <div class="col-md-12">
                        <input id="quantity" type="number" class="form-control" value="{{ $waiting->quantity }}" autocomplete="quantity" readonly autofocus>
                    </div>
                </div>
        
                <div class="form-group">
                <label for="price" class="col-md-12 text-md-center">{{ __('Harga') }}</label>
            
                <div class="col-md-12">
                    <input id="price" type="number" class="form-control" value="{{ $waiting->price }}" autocomplete="price" readonly autofocus>
                </div>

                </div>
        
                <div class="form-group">
                    <label for="phone_produk" class="col-md-12 text-md-center">{{ __('Nomor Telephone Penjual') }}</label>
            
                    <div class="col-md-12">
                        <input class="form-control" value="{{ $waiting->phone_produk }}" readonly autofocus>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-6 ml-auto">
                        <div class="form-group">  
                            <label for="title" class="col-md-12 text-md-center">{{ __('Kepemilikan') }}</label>
                            <p>
                           
                            <div class="col-md-12">                                 
                                <input class="form-control" value="{{$waiting->HandsProduk->Hands->name}}" readonly autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ml-auto">
                        <div class="form-group">  
                            <label for="title" class="col-md-10 text-md-center">{{ __('Bersedia') }}</label>
                            <p>
                            <div class="col-md-12">                                           
                                <input class="form-control" value="{{$waiting->CodProduk->Cod->name}}" readonly autofocus>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="text-center">Lokasi & Category </h3>
                <hr>
                
                <div class="row">
                    <div class="col-md-6 ml-auto">
                        <label class="col-md-12 text-md-center">Lokasi Anda Tinggal</label>
                            <hr>
                            <div class="form-group row">
                                <label for="title" class="col-md-4 text-md-right">Select Provinsi:</label>
                                    <div class="col-md-7">
                                        <input class="form-control" value="{{$waiting->ProvinsiProduk->Province->name}}" readonly autofocus>
                                    </div>
                            </div>
            
                            <div class="form-group row">
                                <label for="title" class="col-md-4 text-md-right">Select State:</label>
                                <div class="col-md-7">
                                    <input class="form-control" value="{{$waiting->KabupatenProduk->Districts->name}}" readonly autofocus>
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label for="title" class="col-md-4 text-md-right">Select City:</label>
                                <div class="col-md-7">
                                    <input class="form-control" value="{{$waiting->KotaProduk->Cities->name}}" readonly autofocus>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-6 ml-auto">
                        <label class="col-md-12 text-md-center">Category Barang</label>
                            <hr>
                            <div class="form-group row">
                                <div class="col-md-7">
                                    <input class="form-control" value="{{$waiting->CategoryProduk->Category->name}}" readonly autofocus>
                                </div>
                                <label for="title" class="col-md-4 text-md-right">{{ __('  Category Barang') }}</label>
                            </div>
            
                            <div class="form-group row">
                                <div class="col-md-7">
                                    <input class="form-control" value="{{$waiting->SubCategoryProduk->SubCategory->name}}" readonly autofocus>
                                </div>
                                <label for="title" class="col-md-4 text-md-right">{{ __('  Jenis Barang') }}</label>
                            </div>
                        
                            <div class="form-group row">
                                <div class="col-md-7">
                                    <input class="form-control" value="{{$waiting->BrandCategoryProduk->Brand->name}}" readonly autofocus>
                                </div>
                                <label for="title" class="col-md-4 text-md-right">{{ __('  Merk Barang') }}</label>
                            </div>
                    </div>
                </div>
                <hr>

                <h3 class="text-center">Informasi Barang & Transaksi</h3>
                <hr>
                <div class="row">       
                    <div class="col-md-6 ml-auto">
                        <div class="form-group">
                        <label for="exampleFormControlTextarea2" class="col-md-12 text-md-center">{{ __('Description') }}</label>
                            <div class="col-md-12">
                                <textarea name="description" id="exampleFormControlTextarea2" rows="6" readonly>{{ $waiting->description }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6 ml-auto">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="col-md-12 text-md-center">{{ __('Tempat Transaksi yang diSarankan') }}</label>
                
                        <div class="col-md-12">
                            <textarea name="body" id="exampleFormControlTextarea1" rows="6" readonly>{{ $waiting->body }}</textarea>
                            @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    </div>
                </div>                
                <hr>

                <div class="row">
                    <div class="col-md-12 ml-auto">
                        <div class="form-group ">
                            <label for="title" class="col-md-12 text-md-center">Gambar untuk Halaman Depan</label>
                                <div class="col-md-12">
                                    <div class="custom-file">
                                        <img class="card-img-top" src="{{ $waiting->ProductsThumbnailImages->thumbnail_product_image_path }}" height="200px" alt="">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <label for="title" class="col-md-12 text-md-center">Gambar untuk Detail Produk</label>
                
                <div class="row">
                    @forelse ($multiple as $item)
                        <div class="col-md-6 ml-auto">
                            <div class="form-group ">       
                                <img class="card-img-top" src="{{ $item->product_image_path }}" height="200px" alt="">   
                            </div>
                        </div>
                    @empty
                        <div style="text-align: left">Belum Ada Barang yang Dijual</div>    
                    @endforelse
                </div>

                <hr>

                <form method="post" action="{{ URL('produk/update/waiting-produk/'. $waiting->id) }} " enctype="multipart/form-data">    
                    @csrf
                
                    <div class="row">
                        <div class="col-md-6 ml-auto">
                            <div class="form-group">  
                                <label for="title" class="col-md-12 text-md-center">{{ __('Apakah Admin Sudah Memeriksa Product User ?') }}</label>
                                <p>
                               
                                <div class="col-md-12">   
                                    <select name="status">
                                        <option value="">Pilih</option>
                                        <option value="1">Ya, Admin Periksa</option>
                                    </select>                              
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ml-auto">
                            <div class="form-group">  
                                <label for="title" class="col-md-10 text-md-center">{{ __('Apakah Produck Layak Publish ?') }}</label>
                                <p>
                                <div class="col-md-12">                                           
                                    <select name="featured">
                                        <option value="">Pilih</option>
                                        <option value="0">Produk Tidak Layak Publish</option>
                                        <option value="1">Produk Layak Publish</option>
                                    </select>   
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="button-box">
                    <button type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" class="default-btn btn-login floatcenter btn-block text-uppercase">Posting </button>
                </div>
                </form>
        </div>
    </div>
</section> 
@endsection