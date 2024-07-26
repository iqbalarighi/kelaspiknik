<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Email Response</title>
</head>
<body>
	<p>
		Terima Kasih {{$details['nama']}} telah melakukan registrasi di kelaspiknik.com. 
		Berikut QRCode untuk di scan sebagai absensi dan ditukarkan dengan id card di tempat yang telah di tentukan.


		@php
        $qrcode = base64_encode(SimpleSoftwareIO\QrCode\Facades\QrCode::size(70)->format('svg')->size(80)->errorCorrection('H')->generate(base64_encode(base64_encode($details['nama']))));
        @endphp
        <img class="qr-code" src="data:image/png;base64, {!! $qrcode !!}" > 
	</p>
</body>
</html>