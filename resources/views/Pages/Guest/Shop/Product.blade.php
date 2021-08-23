@extends('Layouts.Guest')
@section('content')
<br>
    <div class="container"> 
        <div class=" container d-flex justify-content-center">
            <ul class="pagination shadow-lg">
                <li class="page-item "><a class="page-link" href="{{ route('shop.index') }}"><i class="fa fa-home "></i> <small>Home</small> </a></li>
                <li class="page-item "><a class="page-link " href="{{ route('shop.index', ['product' => $product->CategoryProduk->Category->slug]) }}"><small>{{$product->CategoryProduk->Category->name}} &nbsp; </small></a></li>
                <li class="page-item "><a class="page-link" href="#"><small>{{$product->SubCategoryProduk->SubCategory->name}}</small></a></li>
                <li class="page-item "><a class="page-link" href="#"><small>{{$product->BrandCategoryProduk->Brand->name}}</small></a></li>
                <li class="page-item active "><a class="page-link " href=""><small>{{ $product->name }}</small></a></li>
            </ul>
        </div>
    </div>
    <br>
    
        <div class="container"> 
            <div class="card">
                <div class="row">
                    <aside class="col-sm-5 border-right">
                            <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">

                                <div class="carousel-inner" role="listbox">
                                    @foreach($multiple as $key =>$order)
                                  <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                    <img class="d-block" src="{{ $order->product_image_path }}" width="450px" height="600px">
                                  </div>
                                  @endforeach
                                </div>

                                <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                                <ol class="carousel-indicators">
                                    @foreach($multiple as $key =>$order)
                                        <li data-target="#carousel-thumb" data-slide-to="{{$key == 0 }}" class="{{$key == 0 ? 'active' : '' }}">
                                            <img src="{{ $order->product_image_path }}" width="100">
                                        </li>
                                    @endforeach
                                </ol>
                              </div>
                    
                              
                          <hr>
                          <blockquote>                                
                              <h3>Description Barang</h3>
                              {{ $product->description }}
                          </blockquote>
                    </aside>
                <aside class="col-sm-7">
                    <article class="card-body p-5">
                            <div class="row">
                                <div class="col-8">
                                    <h3 class="title mb-3">{{ $product->name }}</h3>
                                </div>
                                <div class="col-4">
                                    <h3 class="title mb-3">{{ $product->UserProduct->User->first_name }}</h3>
                                </div>
                            </div>
                            <hr>
                                <span class="price h3"> 
                                    @currency($product->price)
                                </span> 
                            <hr>
                            <table class="table table-striped">
                                <tbody>
                                  <tr>
                                    <td>Nama Barang</td>
                                    <td>{{ $product->name }}</td>
                                  </tr>
                                  <tr>
                                    <td>Harga Barang</td>
                                    <td>@currency($product->price)</td>
                                  </tr>
                                  <tr>
                                      <td>Jumlah Barang</td>
                                      <td>{{ $product->quantity }}</td>
                                  </tr>
                                  <tr>
                                    <td>Tempat Penjual</td>
                                    <td>
                                        {{$product->ProvinsiProduk->Province->name}} <i class="fas fa-arrow-right"></i>
                                        {{$product->KabupatenProduk->Districts->name}} <i class="fas fa-arrow-right"></i>
                                        {{$product->KotaProduk->Cities->name}}
                                    </td>
                                </tr>
                                  <tr>
                                    <td>Category Barang</td>
                                    <td>
                                        {{$product->CategoryProduk->Category->name}} <i class="fas fa-arrow-right"></i>
                                        {{$product->SubCategoryProduk->SubCategory->name}} <i class="fas fa-arrow-right"></i>
                                        {{$product->BrandCategoryProduk->Brand->name}}
                                    </td>
                                  </tr>
  
                                  <tr>
                                      <td>Kepemilikan Barang</td>
                                      <td> 
                                        {{$product->HandsProduk->Hands->name}}
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>Keterangan Transaksi Barang</td>
                                      <td>
                                        {{$product->CodProduk->Cod->name}}
                                      </td>
                                  </tr>                           
                                </tbody>
                              </table>
                             
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="table-wrapper">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Catatan dari MoreSellCom</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Pastikan Anda telah Bertanya sebelum Membeli</td>
                                                    </tr>
                
                                                </tbody>
                                                <br>
                                            </table>
                                        </div> 
                                    </div> 
                                    <div class="col-sm-4">
                                        <hr>
                                            <a class="btn btn-outline-danger" href="{{route('messenger.createTopic', $product->slug)}}"><i class="far fa-comments"></i> Chat Penjual</a>
                                        <hr>
                                            @if ($product->quantity > 0)
                                                <form action="{{ route('cart.store', $product) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-outline text-uppercase"><i class="fas fa-shopping-cart" aria-hidden="true"></i> Add to Cart</button>
                                                </form>
                                            @endif
                                    </div> 
                                </div>
                    </article> 
                </aside>
                </div>  
            </div> 
        </div>  
    
    <div class="container">
        <hr>
        <h5 class="text-left"> Review Product</h5>
        <div class="card">
        @foreach($komentar as $review)
                <div class="card-body">
                    @for ($i=0; $i<5; $i++)
                        @if(floor($review->star_raiting)- $i >= 1)
                            <i class="fas fa-star text-warning"></i>
                        @elseif($review->star_raiting - $i > 0)
                            <i class="fas fa-star-half-alt text-warning"></i>
                        @else
                            <i class="fas fa-star"></i>
                        @endif
                    @endfor
                    {{$review->first_name}}
                   {{ $review->created_at }}
                    <blockquote>                                
                        <h3>Description Barang</h3>
                        {{ $review->content }}
                    </blockquote>
            </div>
        @endforeach
        </div>
        {{ $komentar->appends(request()->input())->links() }}
        <hr>
    </div>
    @if(Sentinel::check())
    <section id="main" class="wrapper">
        <div class="inner">
            <div class="content">
                <form method="POST" action="{{ route('jual_store') }}" enctype="multipart/form-data">
                    @csrf        
                    <input name="recipient" type="hidden" value="{{$product->user_id}}">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="col-md-12 text-md-center">{{ __('Komentar Buat Penjual ') }}</label>
                                <input type="text" class="text-center" placeholder="{{ $product->UserProduct->User->first_name }}" type="text" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-md-12 text-md-center">{{ __('saya  ') }}</label>
                                <input type="text" name="first_name" class="text-center" value=" {{ Sentinel::getUser()->first_name }}" readonly> 
                        </div>
                        <div class="col-lg-12">
                            <label class="col-md-12 text-md-center">{{ __('Judul yang ingin saya sampaikan ') }}</label>
                                <input type="text" name="subject" value="">
                        </div> 
                        <div class="col-lg-12">
                        <label class="col-md-12 text-md-center">{{ __('Komentar Saya') }}</label>
                            <div class="text-leave">
                                <textarea  name="content" placeholder="Comment*"></textarea>
                            </div>
                        </div>
                        <label class="col-md-12 text-md-center">{{ __('Penilaian Saya') }}</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><input type="radio" id="radio-alpha1" name="star_raiting" value = "1" >
                                        <label for="radio-alpha1">Sangat Buruk</label></p>
                                </div>
                                <div class="col-md-6 text-warning">
                                    <i class="fa fa-star"></i>                            
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <p><input type="radio" id="radio-alpha2" name="star_raiting" value = "2" >
                                        <label for="radio-alpha2">Barang Buruk</label></p>
                                </div>
                                <div class="col-md-6 text-warning">
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <p><input type="radio" id="radio-alpha3" name="star_raiting" value = "3" >
                                        <label for="radio-alpha3">Barang Baik</label></p>
                                </div>
                                <div class="col-md-6 text-warning">
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <p><input type="radio" id="radio-alpha4" name="star_raiting" value = "4" >
                                        <label for="radio-alpha4">Sangat Baik</label></p>
                                </div>
                                <div class="col-md-6 text-warning">
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <p><input type="radio" id="radio-alpha5" name="star_raiting" value = "5" >
                                        <label for="radio-alpha5">Recomended</label></p>
                                </div>
                                <div class="col-md-6 text-warning">
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                </div>
                            </div>
                        
                        <div class="col-12">
                            <div class="leave-btn">
                                <button type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" class="default-btn btn-login floatcenter btn-block text-uppercase">Post Komen </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section> 
    @else
    <div class="container">
        <h5 class="text-left">Anda Belum Login</h5>
    </div>
    <hr>
    @endif
@endsection