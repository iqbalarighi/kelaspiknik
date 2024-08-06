@extends('layouts.pdf')

@section('content')
 <style>
        body {
           size: landscape;
        }
        .id-card {
            width: 312px;
            height: 470px;
/*            border-radius: 15px;*/
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            position: relative;
            margin: 10px auto;
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
            width: 320px;
            height: 470px;
/*            border-radius: 15px;*/
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background-size: cover;
            position: absolute;
            margin-left: -95px;
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
            font-size: 18pt;
            font-weight: bold;
        }
        .pad {
            text-align: left;
            margin-top: 50px;
            
            margin-bottom: -10px;
            font-size: 15pt;
        }
        .qr-code {
            width: 110px;
            height: 110px;
            z-index: 3;
            position: absolute;
              bottom: 90px;
              right: 15px;
/*              border: 1px black solid;*/
              padding: 0;


    .printme {
        display: none;
        }
        @media print {
            .no-printme  {
                display: none;
            }
            .printme  {
                display: block;
            }
        }
        }
    </style>


 <body class="printme" onload="window.print()">
                        <div class="row">
                        @foreach($idcard as $key => $idcard) 

                            <div class="id-card" >
                            <img class="id-img mt-0" src="{{asset('storage/image/idcard.png')}}" width="318px" style="">
                                <img src="{{asset('storage/image/logo.png')}}" alt="Profile Picture" class="profile-pic">
                            <div class="details">
                                <div>
                                    <h1>{{$idcard->trip->nama_sekolah}}</h1>
                                </div>
                                <div class="row">
                                    <div class="pad">
                                        <p style="margin-bottom: 0px; width: 150px;">{{$idcard->nama_lengkap}}</p>
                                        <p style="margin-bottom: 0px; width: 150px;font-style: italic; font-size: 10pt;">Kelas {{$idcard->kelas}}</p>
                                    </div>

                                </div>
                            </div>
                                        <img class="qr-code" id='barcode{{$key}}' 
                                    src="https://api.qrserver.com/v1/create-qr-code/?data={{base64_encode(base64_encode($idcard->id_reg))}}&amp;size=300x300" 
                                    alt="" 
                                    title="{{($idcard->nama_lengkap)}}" 
                                    width="150" 
                                    height="150" />


                            </div>

                        @endforeach
                               </div>
                    </body>

{{-- <script type="text/javascript">
         window.onafterprint = window.close;
         window.print();
      </script> --}}
@endsection
