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
	</p>
		<img class="qr-code" id='barcode' 
                                    src="https://api.qrserver.com/v1/create-qr-code/?data={{base64_encode(base64_encode($details['idreg']))}}&amp;size=300x300" 
                                    alt="" 
                                    width="200" 
                                    height="200" />
</body>
</html>