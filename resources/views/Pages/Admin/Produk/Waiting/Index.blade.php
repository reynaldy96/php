@extends('Layouts.Admin')

@section('content')
   <section id="main" class="wrapper">
        <div class="container">
            <h2 class="text-center">Produck Status Waiting</h2>
          <hr>
          <div class="row">
              @forelse ($waiting as $key=>$row)
              <div class="col-lg-3 col-md-7 mb-4">
                <h4 class="text-center">{{ $key +1 }}</h4>
                <div class="card h-100">
                  <a href="#"><img class="card-img-top" src="{{ $row->ProductsThumbnailImages->thumbnail_product_image_path }}" height="200px" alt=""></a>
                  <div class="card-body">
                    <h4 class="card-title text-center">
                      <a href="#">{{ $row->name }}</a>
                    </h4>
                    @if($row->status == 0)
                    <h4 class="card-title text-center">
                        <span class="badge badge-warning">
                            Waiting 
                        </span>
                    </h4>
                    @endif   
                    <h5 class="text-center">@currency($row->price)</h5>
                    <p class="card-text">{{$row->description}}</p>
                  </div>
                  <div class="card-footer">
                    <div class="col text-center">
                      <a class="btn btn-default" href="{{ URL::to('produk/update/waiting-produk/'. $row->id ) }}">Update Status Barang</a>
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
