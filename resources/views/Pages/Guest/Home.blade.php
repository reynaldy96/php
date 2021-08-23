@extends('Layouts.Guest')

@section('content')

 <main class="l-main bd-grid">
    <div class="home">
        <div class="sneaker">
            <div class="sneaker__figure">
            </div>

            <div>
                <img src="assets/img/NikeAirMaxMotion2.png" alt="" class="sneaker__img shows" color="#6CB36C">
                <img src="assets/img/NikeAirMax Motion2black.png" alt="" class="sneaker__img" color="#111111">
            </div>

            <div class="sneaker__colors">
                <span class="sneaker__color sneaker__colors-one " primary="#6CB36C" color="#6CB36C"></span>
                <span class="sneaker__color sneaker__colors-two active" primary="#111111" color="#111111"></span>
            </div>
        </div>

        <div class="info">
            <div class="data">
                <span class="data__subtitle">Hot</span>
                <h1 class="data__title">Air Max Motion 2</h1>
                <p class="data__description">Combinan la malla transpirable sin costuras para <br> un estilo tradicional.</p>
            </div>

            <div class="actions">
                <div class="size">
                    <h3 class="size__title">Tallas</h3>
                    <div class="size__content">
                        <span class="size__tallas active">
                            8.5
                        </span>
                        <span class="size__tallas">
                            9
                        </span>
                        <span class="size__tallas">
                            9.5
                        </span>
                    </div>
                </div>

                <div class="cant">
                    <h3 class="cant__title">Cant.</h3>
                    <div class="cant__content"> 
                        <span>-</span>
                        <span>1</span>
                        <span>+</span>
                    </div>
                </div>
            </div>

            <div class="preci">
                <span class="preci__title">$99.00</span>
                <a href="#" class="preci__button">ADD TO CART</a>
            </div>
        </div>
    </div>
</main>

    <main class="main bg-grid">
        
        @forelse ($prodcs as $order)
        <article class="card">
            <div class="card-img">
                <img src="{{ $order->ProductsThumbnailImages->thumbnail_product_image_path }}">
            </div>
            <div class="card-name">
            <p> Air Xoom Pegasus</p>
            </div>
            <div class="card-price">
                <a href="#" class="card-icon"><ion-icon name="heart-outline"></ion-icon></a>
                <div>
                    <span class="price card-price-before">Rp.10000</span>
                    <span class="price card-price-after">Rp.10000</span>
                </div>
                <a href="#" class="card-icon"><ion-icon name="cart-outline"></ion-icon></a>
            </div>
        </article>
        @empty
            <div style="text-align: left">Belum Ada Barang yang Dijual</div>
        @endforelse

    </main>

    <div class = "products">
        <div class = "container">
                <div class="row">
                    <div class = "product-items">
                        @forelse ($prodcs as $order)
                        <div class = "product">
                            <div class = "product-content">
                                <div class = "product-img">
                                    <img src = "{{ $order->ProductsThumbnailImages->thumbnail_product_image_path }}" width="200px" height="180px" alt="product image">
                                </div>
                            </div>

                            <div class = "product-info">
                                <a href = "{{ route('shop.show', $order->slug) }}" class = "product-name">{{ $order->name }}</a>
                                <p class = "text-center">@currency($order->price)</p>
                                {{$order->CodProduk->Cod->name}}
                            </div>
                            <button type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" class="default-btn btn-login floatright btn-block text-uppercase">View</button>
                               
                        </div>

                        @empty
                        <div style="text-align: left">Belum Ada Barang yang Dijual</div>
                    @endforelse
                    </div>
                </div>
        </div>
    </div>

<section class="blog_section">
    <div class="container">
        <div class="blog_content">
            <div class="owl-carousel owl-theme">
              @forelse ($prodcs as $order)
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