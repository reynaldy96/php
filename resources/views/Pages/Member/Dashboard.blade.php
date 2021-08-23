@extends('Layouts.Member')

@section('content')
    <section id="main" class="wrapper">
        <div class="container">
            <h2 class="text-center">Dashboard Seller </h2>
          <hr>
          <div class="row">
              @forelse ($prodcs as $order)
              <div class="col-lg-3 col-md-7 mb-4">
                <div class="card h-100">
                  <a href="#"><img class="card-img-top" src="{{ $order->ProductsThumbnailImages->thumbnail_product_image_path }}" height="200px" alt=""></a>
                  <div class="card-body">
                    <h4 class="card-title text-center">
                      <a href="#">{{ $order->name }}</a>
                    </h4>
                    <h5 class="text-center">@currency($order->price)</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                  </div>
                  <div class="card-footer">
                    <div class="col text-center">
                      <a class="btn btn-default" href="{{ URL::to('update-barang/product/'. $order->id . '/data/'. $order->slug ) }}">Update Data Barang</a>
                    </div>
                  </div>
                </div>
              </div>
              @empty
              <div style="text-align: left">Belum Ada Barang yang Dijual</div>
            @endforelse
          </div>
          
      </div>   
    </section> 
@endsection