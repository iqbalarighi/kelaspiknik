
<style>
        body {
            font-family: Arial, sans-serif;
            margin-top: 0;
            page-break-after: auto;
        }
        .id-card { 
            page-break-after: auto;
            width: 256px;
            height: 400px;
/*            border-radius: 15px;*/
            overflow: hidden;
/*            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);*/
            position: relative;
            margin: 30px auto;
/*            color: black;*/
            text-align: center;
            border: 1px black solid;
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
            width: 256px;
            height: 399px;
/*            border-radius: 15px;*/
            overflow: hidden;
/*            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);*/
            background-size: cover;
            position: absolute;
            margin-left: 1px;
/*            color: black;*/
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
            padding-left: 10px;
            margin-bottom: -10px;
            font-size: 13pt;
        }
        .qr-code {
            width: 75px;
            height: 75px;
            z-index: 3;
            position: absolute;
              bottom: 80px;
              right: 12px;
/*              border: 1px black solid;*/
              padding: 0;
        }

        .gridx { 
    display: inline-block;
    width: 40%;
}
    </style>

<body>
    <div class="row">
    @foreach($data as $key => $idcard) 
        <div class="gridx">
        <div class="id-card">
        <img class="id-img mt-0" src="{{public_path('storage/image/idcard.png')}}" width="250px" style="">
            <img src="{{public_path('storage/image/logo.png')}}" alt="Profile Picture" class="profile-pic">
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
                    $qrcode = base64_encode(SimpleSoftwareIO\QrCode\Facades\QrCode::size(70)->format('svg')->size(80)->errorCorrection('H')->generate(base64_encode(base64_encode($idcard->id_reg))));
                    @endphp
                    <img class="qr-code" src="data:image/png;base64, {!! $qrcode !!}" > 

        </div>
</div>
    @endforeach
           </div>
</body>

{{-- onclick="window.print()" --}}