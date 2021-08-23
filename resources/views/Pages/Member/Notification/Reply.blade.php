@extends('Layouts.Member')

@section('content')

    <div class="col-lg-12">
        <form action="{{ route("notification.reply", [$topic->id]) }}" method="POST">
            @csrf
                    <div class="col-lg-12 form-group">
                        <label for="content" class="control-label">
                            Balas Pesan
                        </label>
                        <textarea name="content" class="form-control"></textarea>
                        <br>
                        <input onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" type="submit" value="Balas Pesan" class="btn btn-success" />
                    </div>
        </form>
    </div>
@stop