@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header">{{ __('Absensi') }}
                    <a href="{{route('absensi')}}"><span class="btn btn-secondary float-right btn-sm">Reset</span></a>
                </div>
                <div class="card-body">
        @if ($message = Session::get('sukses'))
            <script type="text/javascript">
            Swal.fire({
              icon: "success",
              title: "Berhasil",
              text: "{{$message}}",
              showConfirmButton: false,
              timer: 2000
            });
            </script>
        @endif
<style type="text/css">
    th {
        vertical-align: middle;
        text-align: center;
    }
    td {
        padding-left: 5px;
        padding-right: 5px;
    }
</style>
<style type="text/css">
    /* style.css file*/
.containers {
    justify-content: center;
    width: 100%;
    max-width: 400px;
    margin: 5px;
}

.containers h1 {
    color: #ffffff;
}

.sections {
    background-color: #ffffff;
    padding: 10px;
    border: 1.5px solid #b2b2b2;
    border-radius: 0.25em;
    box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
}

#my-qr-reader {
    padding: 20px !important;
    border: 1.5px solid #b2b2b2 !important;
    border-radius: 8px;
}

#my-qr-reader img[alt="Info icon"] {
    display: none;
}

#my-qr-reader img[alt="Camera based scan"] {
    width: 100px !important;
    height: 100px !important;
}

.html5-qrcode-element {
    padding: 10px 20px;
    border: 1px solid #b2b2b2;
    outline: none;
    border-radius: 0.25em;
    color: white;
    font-size: 15px;
    cursor: pointer;
    margin-top: 15px;
    margin-bottom: 10px;
    background-color: #008000ad;
    transition: 0.3s background-color;
}

.html5-qrcode-element:hover {
    background-color: #008000;
}

#html5-qrcode-anchor-scan-type-change {
    text-decoration: none !important;
    color: white;
}

video {
    width: 100% !important;
    border: 1px solid #b2b2b2 !important;
    border-radius: 0.25em;
}

</style>

        @if ($message = Session::get('error'))
        <script type="text/javascript">
            Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "{{$message}}",
        });
        </script>
        @endif

        @if ($message = Session::get('sukses'))
            <script type="text/javascript">
            
            Swal.fire({
              // icon: "success",
              title: "Berhasil",
              text: "{{$message}}",
              imageUrl: "{{asset('storage/registrasi/'.Session::get('kode').'/'.Session::get('idre').'/'.Session::get('foto'))}}",
              imageWidth: 250,
              showConfirmButton: true,
              allowOutsideClick: false,
            }).then((result) => {
                  if (result.isConfirmed) {
                    $('#scan').click();
                    $('#html5-qrcode-button-camera-stop').click();
                  } 
                });
            </script>
        @endif

        @if ($message = Session::get('warning'))
            <script type="text/javascript">
            
            Swal.fire({
              icon: "warning",
              title: "Perhatian",
              text: "{{$message}}",
              showConfirmButton: true,
              allowOutsideClick: false,
            }).then((result) => {
                  if (result.isConfirmed) {
                    $('#scan').click();
                    $('#html5-qrcode-button-camera-stop').click();
                  } 
                });
            </script>
        @endif
        <div class="mb-2">

            <form action="" method="GET" >
                    <div class="row" width="100%">
                        <div class="col-sm-auto pb-1">
                                <select class="form-select form-select-sm" name="kode_trip" onchange="form.submit()">
                                    <option value="" disabled selected>Kode Trip</option>
                                @if($data == null)
                                    @foreach($kode as $item)
                                        <option value="{{$item->kode_trip}}">{{$item->kode_trip}}</option>
                                    @endforeach
                                @else
                                    <option value="{{$kode_trip}}" selected>{{$kode_trip}}</option>
                                    @foreach($kode as $item)
                                        <option value="{{$item->kode_trip}}">{{$item->kode_trip}}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>

                            @if($data != null)
                            <div class="col-sm-auto pb-1">
                                    <select class="form-select form-select-sm" name="bus" id="bus" required onchange="form.submit()">
                                        <option value="" selected disabled>Pilih bus</option>
                                @if($debus != null)
                                        <option value="{{$debus}}" selected>{{$debus}}</option>
                                @endif
                                    </select>
                            </div>
                                @endif

                                @if($data != null)
                            <div class="col-sm-auto pb-1">
                                    <select class="form-select form-select-sm" name="absen" id="absen" required onchange="form.submit()">
                                        <option value="" selected disabled>Pilih Hari</option>
                                       @if($absen != null)
                                        <option value="{{$absen}}" selected >
                                            @if($absen == 'absen1')
                                                Day 1
                                                @elseif($absen == 'absen2')
                                                Day 2
                                                @elseif($absen == 'absen3')
                                                Day 3
                                                @elseif($absen == 'absen4')
                                                Day 4
                                                @elseif($absen == 'absen5')
                                                Day 5
                                                @elseif($absen == 'absen6')
                                                Day 6
                                                @elseif($absen == 'absen7')
                                                Day 7
                                                @elseif($absen == 'absen8')
                                                Day 8
                                            @endif
                                        </option>
                                        @endif
                                    </select>
                            </div>
                            @endif 
                            </form>

                                    <div class="col pb-1"> 
                            @if($data != null)
                                @if(count($data) != null)
                                    @if($kode_trip != null && $debus != null && $absen != null)    
                                        <span class="btn btn-sm btn-info" data-toggle="modal" onclick="$('#html5-qrcode-button-camera-stop').click();" id="scan" data-target="#abs" >ScanQR</span> 
                                     
                            @endif
                                @if($kode_trip != null && $debus != null) 
                                    @if(Auth::user()->role == 'Superadmin')
                                        <a href="/absensi/cardpdf/{{$kode_trip}}/{{$debus}}" target="_blank"><span class="btn btn-primary btn-sm ml-2 float-end">Download ID Card</span></a>
                                    @endif
                                @endif 
                            @endif
                        @endif
                                    </div>
                    </div>

                
        </div>
        <div  style="overflow-x: auto;">
            
            <table class="table-striped table-hover" width="100%" >
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kode Trip</th>
                    <th rowspan="2">Bus</th>
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">Sekolah</th>
                    <th rowspan="2">Kelas</th>
                    <th colspan="9">Absensi</th>
                </tr>
                <tr>
                    <th colspan="1">Day 1</th>
                    <th colspan="1">Day 2</th>
                    <th colspan="1">Day 3</th>
                    <th colspan="1">Day 4</th>
                    <th colspan="1">Day 5</th>
                    <th colspan="1">Day 6</th>
                    <th colspan="1">Day 7</th>
                    <th colspan="1">Day 8</th>

                </tr>
            @if($data != null)
                @foreach($data as $key => $item)
                <tr>
                    <td>{{$data->firstitem()+$key}}</td>
                    <td>{{$item->kode_trip}}</td>
                    <td>{{$item->bus}}</td>
                    <td>{{$item->nama_lengkap}}</td>
                    <td>{{$item->sekolah}}</td>
                    <td>{{$item->kelas}}</td>
                    <td align="center">@if($item->absen1 != null) <i style="color: green;" class="bi bi-check-square-fill"></i> @endif</td>
                    <td align="center">@if($item->absen2 != null) <i style="color: green;" class="bi bi-check-square-fill"></i> @endif</td>
                    <td align="center">@if($item->absen3 != null) <i style="color: green;" class="bi bi-check-square-fill"></i> @endif</td>
                    <td align="center">@if($item->absen4 != null) <i style="color: green;" class="bi bi-check-square-fill"></i> @endif</td>
                    <td align="center">@if($item->absen5 != null) <i style="color: green;" class="bi bi-check-square-fill"></i> @endif</td>
                    <td align="center">@if($item->absen6 != null) <i style="color: green;" class="bi bi-check-square-fill"></i> @endif</td>
                    <td align="center">@if($item->absen7 != null) <i style="color: green;" class="bi bi-check-square-fill"></i> @endif</td>
                    <td align="center">@if($item->absen8 != null) <i style="color: green;" class="bi bi-check-square-fill"></i> @endif</td>
                </tr>
                @endforeach

            @else
            <tr>
                <td colspan="15" align="center">Pilih Kode Trip, Bus dan Hari Absensi</td>
            </tr>
            @endif
            </table>
            
        </div>
@if($data != null)
@if(count($data) != null)
{{ $data->onEachSide(5)->links() }}
@endif
@endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade "
        id="abs"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
         
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Add image inside the body of modal -->
                <div align="center" class="modal-body center">
                    <center>
                        <div class="containers">

                            <div class="sections">
                                <div id="my-qr-reader">
                                </div>
                            </div>
                        </div>
                    </center>
                </div>

@if($data != null)
    @if(count($data) != null)
        @if($kode_trip != null && $debus != null && $absen != null)  

    <script src="{{asset('storage/html5-qrcode.min.js')}}"></script>
@if($agent->isDesktop())
                    <script type="text/javascript">
                        // script.js file

function domReady(fn) {
    if (
        document.readyState === "complete" ||
        document.readyState === "interactive"
    ) {
        setTimeout(fn, 1000);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

domReady(function () {
    // If found you qr code
    function onScanSuccess(decodeText, decodeResult) {
    var urls = '{{$absen}}';
    
    if(urls == ""){
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Pilih hari terlebih dahulu !",
        });
        $('#html5-qrcode-button-camera-stop').click();
        return false;
    }

        // alert("You Qr is : {{url('/')}}/"+$('#absen').find(":selected").val()+'/'+decodeText, decodeResult);
            $('#html5-qrcode-button-camera-stop').click();

            Swal.fire({
            title: "Loading . . . ",
            text: "Sedang validasi absensi",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                target.style.opacity = '0'
            }
            });

            
            setTimeout(
              function() 
              {
                    window.location.replace("{{url('/')}}/"+urls+'/'+decodeText, decodeResult);
            }, 2000);

        
    }

    let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader",
        { fps: 10, qrbos: 250}, 
        
    );

    htmlscanner.render(onScanSuccess);
});
                    </script>
                    @else 
                    <script type="text/javascript">
                        // script.js file

function domReady(fn) {
    if (
        document.readyState === "complete" ||
        document.readyState === "interactive"
    ) {
        setTimeout(fn, 1000);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

domReady(function () {

    // If found you qr code
    function onScanSuccess(decodeText, decodeResult) {
    var urls = '{{$absen}}';

    if(urls == ""){
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Pilih hari terlebih dahulu !",
        });
        $('#html5-qrcode-button-camera-stop').click();
        return false;
    }
        // alert("You Qr is : " + decodeText, decodeResult);
            $('#html5-qrcode-button-camera-stop').click();

            Swal.fire({
            title: "Loading . . . ",
            text: "Sedang validasi absensi",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                target.style.opacity = '0'
            }
            });
            
            setTimeout(
              function() 
              {
                    window.location.replace("{{url('/')}}/"+urls+'/'+decodeText, decodeResult);
            }, 2000);
        
    }

    let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader",
        { fps: 10, qrbos: 250, videoConstraints: {
                    facingMode: { exact: "environment" },
                },
            }, 
        );

    htmlscanner.render(onScanSuccess);
});
                    </script>


    @endif
    @endif
    @endif
    @endif

                <div class="modal-footer">
                
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                </button>
                </div>
            </div>
        </div>
    </div>
{{-- end of modal --}}
</div>

@if($data != null)
    <script type="text/javascript">
(function() {
    var elm = document.getElementById('bus'),
        df = document.createDocumentFragment();
    for (var i = 1; i <= {{$bus[0]->jumlah_bus}}; i++) {
        var option = document.createElement('option');
        option.value = "Bus " + i;
        option.appendChild(document.createTextNode("Bus " + i));
        df.appendChild(option);
    }
    elm.appendChild(df);
}());
    </script>
    @endif

@if($data != null)
    <script type="text/javascript">
(function() {
    var elm = document.getElementById('absen'),
        df = document.createDocumentFragment();
    for (var i = 1; i <= 8; i++) {
        var option = document.createElement('option');
        option.value = "absen" + i;
        option.appendChild(document.createTextNode("Day " + i));
        df.appendChild(option);
    }
    elm.appendChild(df);
}());
    </script>
    @endif

<script type="text/javascript">
    var usedNames = {};
$("select[name='bus'] > option").each(function () {
    if(usedNames[this.text]) {
        $(this).remove();
    } else {
        usedNames[this.text] = this.value;
    }
});
</script>
<script type="text/javascript">
    var usedNames = {};
$("select[name='kode_trip'] > option").each(function () {
    if(usedNames[this.text]) {
        $(this).remove();
    } else {
        usedNames[this.text] = this.value;
    }
});
</script>
<script type="text/javascript">
    var usedNames = {};
$("select[name='absen'] > option").each(function () {
    if(usedNames[this.text]) {
        $(this).remove();
    } else {
        usedNames[this.text] = this.value;
    }
});
</script>

@endsection

