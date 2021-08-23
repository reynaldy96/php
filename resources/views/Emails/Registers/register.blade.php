@component('mail::message')
    <a class="default-btn btn-login floatright btn-block text-uppercase" href="{{ env('APP_URL') }}/activate/{{$user->email}}/{{$code }}">Klik button</a>
@endcomponent