@extends('Pages.Member.Pesan.Template')

@section('messenger-content')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route("messenger.storeTopic") }}" method="POST">
            @csrf
            <div class="card card-default">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="recipient" class="control-label text-center">
                                Tanya Penjual
                            </label>
                            <input name="recipient" type="hidden" value="{{$product->user_id}}">
                            <input type="text" value="{{$product->UserProduct->User->first_name}}">
                        </div>

                        <div class="col-lg-6 form-group">
                            <label for="recipient" class="control-label text-center">
                                Tentang Barang
                            </label>
                            <input name="subject" type="text" value="Saya ingin Bertanya Tentang {{ $product->name }} ?" readonly>
                        </div>

                        <div class="col-lg-12 form-group">
                            <label for="content" class="control-label text-center">
                                Pertanyaan Saya
                            </label>
                             <textarea name="content" rows="4" placeholder="Pertanyaan saya ?"></textarea>
                        </div>
                    </div>
                    <input onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" type="submit" value="Submit" class="btn btn-success" />
                </div>
            </div>
        </form>
    </div>
</div>
@stop