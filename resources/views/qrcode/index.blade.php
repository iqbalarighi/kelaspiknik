@extends('layouts.side')

@section('content')
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
	color: #1d9bf0;
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
              icon: "success",
              title: "Berhasil",
              text: "{{$message}} berhasil melakukan absensi",
              showConfirmButton: true,

            });
            </script>
        @endif
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
<center>
                    <div class="containers">
				        <div class="sections">
				            <div id="my-qr-reader">
				            </div>
				        </div>
				    </div>
</center>
				    <script src="{{asset('storage/html5-qrcode.min.js')}}"></script>
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
		  window.location.replace("http://localhost:8000/absensi/" +decodeText, decodeResult);
		
	}

	let htmlscanner = new Html5QrcodeScanner(
		"my-qr-reader",
		{ fps: 10, qrbos: 250 }
	);
	htmlscanner.render(onScanSuccess);
});

				    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

