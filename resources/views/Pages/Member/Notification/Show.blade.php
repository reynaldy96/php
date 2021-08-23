@extends('Layouts.Member')

@section('content')
<section id="main" class="wrapper">
    <div class="inner">
        <div class="d-flex justify-content-between">
            <div> <h1>{{ $topic->subject }}</h1></div>
            <div>Notification</div>
        </div>
        <hr>
        <div class="content">
            <div class="container">
                @foreach($topic->messages as $message)
                <div class="d-flex justify-content-between">
                        <dt>{{ $message->sender->first_name }} 
                            <div class="text-right">{{ $message->created_at->diffForHumans() }}</div>
                        </dt>
                        <blockquote>
                            {{ $message->content }}
                        </blockquote>
                </div>
                @endforeach
            </div>
            <p>
                @if($topic->receiverOrCreator() !== null && !$topic->receiverOrCreator()->trashed())
                    <a href="{{ route('notification.reply', [$topic->id]) }}" class="btn btn-outline-primary text-right">
                        Balas Pesan
                    </a>
                @endif
            </p>
        </div>
    </div>
</section> 
@endsection