<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Email Response</title>
</head>
<body>
	<p style="text-align: justify; text-justify: inter-word;">
		Terima Kasih {{$details['nama']}} telah melakukan registrasi di kelaspiknik.com. 
		Berikut QRCode untuk di scan sebagai absensi dan ditukarkan dengan id card di tempat yang telah di tentukan.
	</p>
	<p>
		Klik QRCode berikut untuk mengunduh <br>
		<a href="https://api.qrserver.com/v1/create-qr-code/?data={{base64_encode(base64_encode($details['idreg']))}}&amp;size=300x300" download>
		<img style="left:50%; right: 50%;"
		class="qr-code" 
		id='barcode' 
        src="https://api.qrserver.com/v1/create-qr-code/?data={{base64_encode(base64_encode($details['idreg']))}}&amp;size=300x300" 
        alt="" 
        width="200" 
        height="200" 
         />
    </a>
	</p>
</body>
</html>