@extends('Pages.Member.Pesan.Template')

@section('messenger-content')
<hr>

<div class="row">
    <div class="col-12-small" style="">
        @forelse($topics as $topic)
            <dl>
                <dt>                        
                    <a href="{{ route('messenger.showMessages', [$topic->id]) }}">
                    @php($receiverOrCreator = $topic->receiverOrCreator())
                        @if($topic->hasUnreads())
                        <strong>
                            {{ $receiverOrCreator !== null ? $receiverOrCreator->first_name : '' }}
                        </strong>
                        @else
                            {{ $receiverOrCreator !== null ? $receiverOrCreator->first_name : '' }}
                        @endif
                    </a>
                </dt>
                <blockquote>
                    <a href="{{ route('messenger.showMessages', [$topic->id]) }}">
                        @if($topic->hasUnreads())
                            <strong>
                                {{ $topic->subject }}
                            </strong>
                        @else
                            {{ $topic->subject }}
                        @endif
                    </a>
                </blockquote>
            </dl>
        @empty
            <div class="row">
                <div class="container">    
                    <center>Anda Belum memiliki Pesan Baru </center> 
                </div>
            </div>
        @endforelse
    </div>    
</div>
@endsection