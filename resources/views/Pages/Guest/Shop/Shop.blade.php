@extends('Layouts.Guest')

@section('content')

<div class="container">
    <form action="{{ route('search.product') }}" method="GET">
        <div class="input-group">
                <input type="text" class="form-control" name="query" placeholder="Search users"> 
                    <span class="input-group-btn">
                        <button class="default-btn btn-login floatright btn-block text-uppercase"><i class="fas fa-search"></i> Search</button> 
                    </span>
        </div>
    </form>
</div>

<section class="section-main bg padding-y">
    <div class="container">
    <div class="row">
        <aside class="col-md-3">
            <h5 class="text-center">Category Barang</h5>
            <hr>
            <nav class="card">
                <ul class="menu-category">
                    @foreach ($categories as $category)
                        <li class="{{ setActiveCategory($category->slug) }}"><a href="{{ route('shop.index', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </nav>
            <br>
        </aside> 
        <div class="col-md-9">
            <div id="carousel2_indicator" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                  @foreach($products as $key =>$order)
                  <div class="carousel-item  {{$key == 0 ? 'active' : '' }}">
                    <img class="d-block w-100" src="{{ $order->ProductsThumbnailImages->thumbnail_product_image_path }}" alt="Third slide">
                    <article class="carousel-caption d-none d-md-block">
                      <h5>{{ $order->name }}</h5>
                        <div class="col text-center">
                            <a class="default-btn btn-login floatright btn-block text-uppercase" href="{{ route('shop.show', $order->slug) }}">View Product</a>
                        </div>
                    </article> 
                  </div>
                  @endforeach
                </div>
                <a class="carousel-control-prev" href="#carousel2_indicator" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel2_indicator" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>
        </div> 
    </div> 
    </div> 
</section>

<div class="container">
    <main class="main bg-grid">
        @forelse ($products as $order)
        <article class="card">
            <div class="card-img">
                <img src="{{ $order->ProductsThumbnailImages->thumbnail_product_image_path }}">
            </div>
            <div class="card-name">
                <p> {{ $order->name }}</p>
            </div>
            <div class="card-body">
                <h4 class="card-title text-center">
                    <a href="#">{{ $order->name }}</a>
                </h4>
                <h5 class="text-center">@currency($order->price)</h5>
            </div>
            <div class="col text-center">
                <a class="default-btn btn-login floatright btn-block text-uppercase" href="{{ route('shop.show', $order->slug) }}">View Product</a>
            </div>
        </article>
        @empty
            <div style="text-align: left">Belum Ada Barang yang Dijual</div>
        @endforelse
    </main>
</div>

    <div class="container">
        <div class="row">
        <div class="col-lg-3">   
            <div class="card">
                <article class="filter-group">
                    <header class="card-header">
                        <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="false" class="collapsed">
                            <h3><i class="icon-control fa fa-chevron-down"></i> Category Barang </h3>
                        </a>
                    </header>
                    <div class="filter-content collapse" id="collapse_1">
                        <div class="card-body">
                            <ul class="list-menu">
                                <a href="">Low to High</a> |
                                <a href="">High to Low</a>    
                            </ul>
                        </div> 
                    </div>
                </article> 
            </div>
            <br>
            <div class="card">
                <article class="filter-group">
                    <header class="card-header">
                        <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="false" class="collapsed">
                            <h3><i class="icon-control fa fa-chevron-down"></i> Kondisi Barang </h3>
                        </a>
                    </header>
                    <div class="filter-content collapse" id="collapse_2">
                        <div class="card-body">
                            <ul class="list-menu">
                                <a href="">Baru</a> |
                                <a href="">Bekas</a>    
                            </ul>
                        </div> 
                    </div>
                </article> 
            </div>
            <br>
            <div class="card">
                <article class="filter-group">
                    <header class="card-header">
                        <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="false" class="collapsed">
                            <h3><i class="icon-control fa fa-chevron-down"></i> Urutan Harga </h3>
                        </a>
                    </header>
                    <div class="filter-content collapse" id="collapse_3">
                        <div class="card-body">
                            <ul class="list-menu">
                                <a href="">Baru</a> |
                                <a href="">Bekas</a>    
                            </ul>
                        </div> 
                    </div>
                </article> 
            </div>
            <br>
        </div>
        
        <div class="col-lg-9">
            <main class="main bg-grid">
                @forelse ($products as $order)
                    <article class="card">
                        <div class="card-img">
                            <a href="#"><img class="card-img-top" src="{{ $order->ProductsThumbnailImages->thumbnail_product_image_path }}"></a>
                        </div>
                        <div class="card-price">
                            <a href="#">{{ $order->name }}  </a> 
                        <div>
                            <span class="price card-price-after"> | @currency($order->price)</span>
                        </div>
                        </div>
                        <div class="card-footer">
                            <div class="col text-center">
                                <a class="default-btn btn-login floatright btn-block text-uppercase" href="{{ route('shop.show', $order->slug) }}">View Product</a>
                            </div>
                        </div>
                        </article>
                    @empty
                        <div style="text-align: left">Belum Ada Barang yang Dijual</div>
                    @endforelse
            </main>  
        </div>
        <div class="spacer"></div>
            {{ $products->appends(request()->input())->links() }}
        </div>
    </div>

    {{ $products->appends(request()->input())->links() }}

    <section class="blog_section">
                <div class="container">
                    <div class="blog_content">
                        <div class="owl-carousel owl-theme">
                        @forelse ($products as $order)
                            <div class="blog_item">
                                <div class="blog_image">
                                    <img class="img-fluid" src="{{ $order->ProductsThumbnailImages->thumbnail_product_image_path }}" alt="images not found">
                                    <span><i class="icon ion-md-create"></i></span>
                                </div>
                                <div class="blog_details">
                                    <div class="blog_title">
                                        <h5><a href="#">{{ $order->name }}</a></h5>
                                    </div>
                                    <ul>
                                        <li><i class="icon ion-md-person"></i>Alex</li>
                                        <li><i class="icon ion-md-calendar"></i>August 1, 2018</li>
                                    </ul>
                                    <a href="#">Read More<i class="icofont-long-arrow-right"></i></a>
                                </div>
                            </div>                        
                            @empty
                            <div style="text-align: left">Belum Ada Barang yang Dijual</div>
                        @endforelse
                        </div>
                    </div>
                </div>
</section>
@endsection

@section('ajax')
<script>
  jQuery(document).ready(function($){
      $('.owl-carousel').owlCarousel({
      loop:true,
      margin:10,
      dots:false,
      nav:true,
      autoplay:true,   
      smartSpeed: 3000, 
      autoplayTimeout:7000,
      responsive:{
          0:{
              items:1
          },
          200:{
              items:2
          },
          600:{
              items:3
          },
          1000:{
              items:4
          }
      }
      })
  })
  </script>   
@endsection