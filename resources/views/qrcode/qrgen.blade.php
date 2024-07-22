@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

        @foreach ($data as $key => $item)


            <img class="p-1 m-1" id='barcode{{$key}}' 
                src="https://api.qrserver.com/v1/create-qr-code/?data={{base64_encode($item->id_reg)}}&amp;size=300x300" 
                alt="" 
                title="{{($item->id_reg)}}" 
                width="100" 
                height="100" />

        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

peserta isi formulir, setelah di isi nanti mereka dapat file lanyard untuk di print berfungsi juga sebagai kartu absensi.