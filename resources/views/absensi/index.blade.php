@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header justify-content-between" style="display: flex;">    
                    @if($data != null)
                        <h5>{{$trip->judul_trip}}</h5>
                    @else
                        {{ __('Absensi') }}
                    @endif
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
                                {{-- <select class="form-select form-select-sm" name="kode_trip" onchange="form.submit()">
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
                                </select> --}}
                        <select style="width:100%;" id="js-example-basic-multiple" class="form-select form-select-sm" name="kode_trip" aria-label="Default select example" onchange="form.submit()">
                            @if($data != null)
                                <option selected value="{{$data == null ? '' : $kode_trip}}">{{$data == null ? '' : $kode_trip}}</option>
                            @endif
                        </select>
                                {{-- @if($data == null)
                            @else
                            <input type="text" name="kode_trip" value="{{$kode_trip}}" >
                            @endif --}}
                            </div>

                            @if($data != null)
                            <div class="col-sm-auto pb-1">
                                    <select class="form-select form-select-sm mobil-bus" name="bus" id="bus" aria-label="Default select example" required onchange="form.submit()">

                                        <option value="{{$bus == null ? '' : $bus}}">{{$bus == null ? '' : $bus}}</option>

                                    </select>
                            </div>
                                @endif

                                @if($data != null)
                            <div class="col-sm-auto pb-1">
                                    <select class="form-select form-select-sm absen" name="absen" id="absen" required onchange="form.submit()">
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

                            @if($data != null)
                                    <div class="col pb-1"> 
                                @if(count($data) != null)
                                    @if($kode_trip != null && $bus != null && $absen != null)    
                                        <span class="btn btn-sm btn-info" data-toggle="modal" onclick="$('#html5-qrcode-button-camera-stop').click(); start();" id="scan" data-target="#abs" >ScanQR</span> 
                                     <script type="text/javascript">
                                         function start() {
                                            setTimeout( function(){
                                             $('#html5-qrcode-button-camera-start').click();                                             
                                            }, 100);
                                         }
                                     </script>
                            @endif
                                @if($kode_trip != null && $bus != null) 
                                    @if(Auth::user()->role == 'admin')
                                        <a href="/absensi/cardpdf/{{$kode_trip}}/{{$bus}}" target="_blank"><span class="btn btn-primary btn-sm ml-2 float-end">Download ID Card</span></a>
                                    @endif
                                @endif 
                            @endif
                                    </div>
                        @endif
                </div>
        </div>

        <div style="overflow-x: auto;">
            
            <table class="table-hover table-bordered table-striped" width="100%" >
                @if($data != null)
                <tr>
                    <th colspan="15">
                        {{$trip->nama_sekolah}}
                    </th>
                </tr>
                @endif
                <tr>
                    <th rowspan="2">No</th>
                    {{-- <th rowspan="2">Kode Trip</th> --}}
                    <th rowspan="2">Bus</th>
                    <th rowspan="2">Nama</th>
                    {{-- <th rowspan="2">Sekolah</th> --}}
                    <th rowspan="2">Kelas</th>
                    <th colspan="9">Absensi</th>
                </tr>
                @if($data == null)
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
                @else
                <tr id="lama_trip">
                    
                </tr>
                @endif
            @if($data != null)
                @foreach($data as $key => $item)
                <tr>
                    <td align="center">{{$data->firstitem()+$key}}</td>
                    {{-- <td align="center">{{$item->kode_trip}}</td> --}}
                    <td align="center">{{$item->bus}}</td>
                    <td>{{$item->nama_lengkap}}</td>
                    {{-- <td>{{$item->sekolah}}</td> --}}
                    <td align="center">{{$item->kelas}}</td>
                    @if($item->absen1 != null) 
                        <td align="center"><i style="color: green;" class="bi bi-check-square-fill"></i></td> 
                    @endif
                    @if($item->absen2 != null) 
                        <td align="center"><i style="color: green;" class="bi bi-check-square-fill"></i></td> 
                    @endif
                    @if($item->absen3 != null) 
                        <td align="center"><i style="color: green;" class="bi bi-check-square-fill"></i></td> 
                    @endif
                    @if($item->absen4 != null) 
                        <td align="center"><i style="color: green;" class="bi bi-check-square-fill"></i></td> 
                    @endif
                    @if($item->absen5 != null) 
                        <td align="center"><i style="color: green;" class="bi bi-check-square-fill"></i></td> 
                    @endif
                    @if($item->absen6 != null) 
                        <td align="center"><i style="color: green;" class="bi bi-check-square-fill"></i></td> 
                    @endif
                    @if($item->absen7 != null) 
                        <td align="center"><i style="color: green;" class="bi bi-check-square-fill"></i></td> 
                    @endif
                    @if($item->absen8 != null) 
                        <td align="center"><i style="color: green;" class="bi bi-check-square-fill"></i></td> 
                    @endif
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
        @if($kode_trip != null && $bus != null && $absen != null)  

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
                window.location.replace("{{url('/')}}/"+urls+'/'+decodeText, decodeResult);

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

        
    }

    let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader",
        { fps: 10, qrbos: 250}, 
        
    );
htmlscanner.clear();
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
                window.location.replace("{{url('/')}}/"+urls+'/'+decodeText, decodeResult);

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
    for (var i = 1; i <= {{$trip->jumlah_bus}}; i++) {
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
    for (var i = 1; i <= {{$trip->lama_trip}}; i++) {
        var option = document.createElement('option');
        option.value = "absen" + i;
        option.appendChild(document.createTextNode("Day " + i));
        df.appendChild(option);

    }
    elm.appendChild(df);
}());
    </script>
    @endif

@if($data != null)
    <script type="text/javascript">
(function() {
   var $tableTr = $('#lama_trip');
for (var i = 1; i <= {{$trip->lama_trip}}; i++) {
      $tableTr.append($('<th>').html('Day ' + i)).css("background-color","#f2f2f2");

        console.log(i);
  }
    $tableTr.append($tableTr);
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


<script>
$('#js-example-basic-multiple').select2({
        ajax: {
            url: "{{route('kode_trip')}}",
            dataType: "json",
              delay: 250,

processResults: function (data) {
      // Transforms the top-level key of the response object from 'items' to 'results'
      return {
        results: $.map(data, function (item) {
                        return { text: item.kodex, id: item.kodex }
                    })
      };
    }
},

placeholder: 'Kode Trip',
width: 'auto',
allowClear: true

});

</script>

<script type="text/javascript">
    $(document).ready(function() {
    $('.mobil-bus').select2({
    placeholder: "Pilih Bus",
    width: 'auto',
    allowClear: true
});
});
</script>

<script type="text/javascript">
    $(document).ready(function() {
    $('.absen').select2({
    placeholder: "Pilih Hari",
    width: 'auto',
    allowClear: true
});
});
</script>
@endsection

