@extends('Pages.Member.Pesan.Template')

@section('messenger-content')

<div class="row">
    <div class="col-lg-12">
        <form action="{{ route("messenger.reply", [$topic->id]) }}" method="POST">
            @csrf
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label for="content" class="control-label">
                               Balas Pesan
                            </label>
                            <textarea name="content" class="form-control"></textarea>
                        </div>
                    </div>
                    <input onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" type="submit" value="Balas Pesan" class="btn btn-success" />
        </form>
    </div>
</div>
@stop