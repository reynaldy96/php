@extends('Layouts.Member')

@section('content')

<div id="heading" >
    <h1>Pesan</h1>
</div>

<section id="main" class="wrapper" style="">
    <div class="inner">
        <div class="content" style="">
            <div class="row">
                <div class="col-lg-3 " style="">
                    <ul class="alt">
                        <li><a href="{{ route('messenger.index') }}"><h3>Semua Pesan</h3></a></li>
                        <li><a href="{{ route('messenger.showInbox') }}">                                            
                            @if($unreads['inbox'] > 0)
                                <strong>
                                    Pesan Masuk
                                    ({{ $unreads['inbox'] }})
                                </strong>
                            @else
                                Pesan Masuk 
                            @endif
                    </a></li>   
                    <li>
                        <a href="{{ route('messenger.showOutbox') }}">
                            @if($unreads['outbox'] > 0)
                                <strong>
                                    Pesan diBalas
                                    ({{ $unreads['outbox'] }})
                                </strong>
                            @else
                                    Pesan diBalas
                            @endif
                        </a> 
                    </li>
                    </ul>
                    <hr>
                </div>
                <div class="col-lg-9">
                    @yield('messenger-content')

                </div>
            </div>
        </div>
    </div>
</section>

@stop