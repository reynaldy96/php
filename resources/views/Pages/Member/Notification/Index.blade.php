@extends('Layouts.Member')

@section('content')
<section id="main" class="wrapper">
    <div class="inner">
        <div class="content">
            <div class="container">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Tentang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topics as $topic)
                        <tr>
                            <td>        
                                @php($receiverOrCreator = $topic->receiverOrCreator())
                                    @if($topic->hasUnreads())
                                    <strong>
                                        {{ $receiverOrCreator !== null ? $receiverOrCreator->first_name : '' }}
                                    </strong>
                                    @else
                                        {{ $receiverOrCreator !== null ? $receiverOrCreator->first_name : '' }}
                                    @endif
                            </td>
                            <td>        
                                @if($topic->hasUnreads())
                                    <strong>
                                        {{ $topic->subject }}
                                    </strong>
                                @else
                                    {{ $topic->subject }}
                                @endif
                            </td>
                            <td><a href="{{ route('notification.showMessages', [$topic->id]) }}">Lihat</a></td>
                        </tr>
                        @empty
                            <div class="row">
                                <div class="container">    
                                    <center>Anda Belum memiliki Pesan Baru </center> 
                                </div>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</section> 
@endsection