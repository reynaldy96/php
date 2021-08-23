@extends('Pages.Member.Pesan.Template')

@section('messenger-content')
<div class="row">
    <div class="col-12-small" style="">
        @foreach($topic->messages as $message)
            <dl>
                <dt>{{ $message->sender->first_name }} <div class="text-right">{{ $message->created_at->diffForHumans() }}</div></dt>
                <blockquote>
                    {{ $message->content }}
                </blockquote>
            </dl>
        @endforeach
    </div>    
</div>
<p>
    @if($topic->receiverOrCreator() !== null && !$topic->receiverOrCreator()->trashed())
        <a href="{{ route('messenger.reply', [$topic->id]) }}" class="btn btn-outline-primary">
            Balas Pesan
        </a>
    @endif
</p>
@endsection