@extends('layouts.side')

@section('content')
{{-- <style type="text/css">
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

</style> --}}
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

                    {{-- <div class="row">
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
                </div> --}}
            </div>
        </div>
    </div>
</div>

 <style>
        body {
            font-family: Arial, sans-serif;
        }
        .id-card {
            width: 256px;
            height: 400px;
/*            border-radius: 15px;*/
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            position: relative;
            margin: 30px auto;
            color: black;
            text-align: center;
        }
        /*.id-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;*/
/*            background: rgba(0, 0, 0, 0.5);*/
/*        }*/

        .id-img {
            width: 250px;
            height: 400px;
/*            border-radius: 15px;*/
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background-size: cover;
            position: absolute;
            margin-left: -60px;
            color: black;
            text-align: center;
            z-index: 0; 
        }

        .profile-pic {
            width: 130px;
            height: 130px;
            /*border-radius: 50%;
            border: 3px solid white;*/
            margin-top: 60px;
            z-index: 1;
            position: relative;
        }
        .details {
            margin-top: 20px;
            z-index: 1;
            position: relative;
        }
        .details h1 {
            margin-top:-40px;
            font-size: 16pt;
            font-weight: bold;
        }
        .pad {
            text-align: left;
            margin-top: 20px;
            
            margin-bottom: -10px;
            font-size: 13pt;
        }
        .qr-code {
            width: 80px;
            height: 80px;
            z-index: 3;
            position: absolute;
              bottom: 80px;
              right: 15px;
              border: 1px black solid;
              padding: 0;
        }
    </style>

<body>
    <div class="row">
    @foreach($idcard as $key => $idcard) 

        <div class="id-card" >
        <img class="id-img mt-0" src="{{asset('storage/image/idcard.png')}}" width="250px" style="">
            <img src="{{asset('storage/image/logo.png')}}" alt="Profile Picture" class="profile-pic">
        <div class="details">
            <div>
                <h1>{{$idcard->sekolah}}</h1>
            </div>
            <div class="row">
                <div class="pad">
                    <p style="margin-bottom: 0px; width: 150px;">{{$idcard->nama_lengkap}}</p>
                    <p style="margin-bottom: 0px; width: 150px;font-style: italic; font-size: 10pt;">Kelas {{$idcard->kelas}}</p>
                </div>

            </div>
        </div>
                    @php
                    $qrcode = base64_encode(SimpleSoftwareIO\QrCode\Facades\QrCode::size(70)->format('svg')->size(80)->errorCorrection('H')->generate(base64_encode(base64_encode($idcard->kode_trip))));
                    @endphp
                    <img class="qr-code" src="data:image/png;base64, {!! $qrcode !!}" > 

        </div>

    @endforeach
           </div>
</body>
@endsection

{{--             <div class="row">
                <div class="col-sm-7">
                    <div align="left" class="row ps-3">
                        <p class="px-2 py-0 mb-0 float-start" style="float: left !important;">{{ $idcard->nama_lengkap }}</p>
                    </div>
                    <div align="left" class="row ps-3">
                        <p class="px-2 font-italic py-0 mb-0 float-start">Kelas {{ $idcard->kelas }}</p>
                    </div>
                </div>
                <div class="col" >
                    <img />
                </div>
            </div> --}}