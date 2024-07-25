@extends('layouts.side')

@section('content')
<style type="text/css">
    .id-card {
    width: 256px;
    height: 400px;
    background-color: #ffffff;
    border: 1px solid #ccc;
/*    padding: 20px;*/
    margin: 5px;
    text-align: center;
}

.img {
    width: 110px;
    height: 110px;
/*    border-radius: 50%;*/
    object-fit: cover;
    margin-bottom: 10px;
    margin-top: 35%;
    margin-right: auto;
}

.id-card h1 {
    font-size: 18px;
    margin-bottom: 5px;
}

.id-card p {
    font-size: 15px;
}

</style>
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        @foreach($idcard as $key => $idcard) 
                        <div align="" class="col">
                            <div class="id-card" style="background-image: url({{asset('storage/image/idcard.svg')}}); background-size: 254px; background-repeat: no-repeat;">
                                <div class="col">
                                    <img class="img" src="{{asset('storage/image/logo.png')}}" alt="Profile Picture">
                                    <h1 class="pb-4 m-0">{{ $idcard->sekolah }}</h1>
                                </div>

                                <div class="row">
                                    <div class="col-sm-7">
                                        <div align="left" class="row ps-3">
                                            <p class="px-2 py-0 mb-0 float-start" style="float: left !important;">{{ $idcard->nama_lengkap }}</p>
                                        </div>
                                        <div align="left" class="row ps-3">
                                            <p class="px-2 font-italic py-0 mb-0 float-start">Kelas {{ $idcard->kelas }}</p>
                                        </div>
                                    </div>
                                    <div class="col" >
                                        <img class="p-1 me-2 float-end" id='barcode{{$key}}' 
                                            src="https://api.qrserver.com/v1/create-qr-code/?data={{base64_encode(base64_encode($idcard->id_reg))}}&amp;size=300x300" 
                                            alt="" 
                                            title="{{($idcard->id_reg)}}" 
                                            width="80" 
                                            height="80" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
