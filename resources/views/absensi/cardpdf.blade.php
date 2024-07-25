<style type="text/css">
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f0f0f0;
    font-family: Arial, sans-serif;
}

.id-card {
    width: 300px;
    height: 450px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    overflow: hidden;
    border: 1px solid #ddd;
}

.header {
    background-color: #0044cc;
    color: white;
    padding: 10px 0;
}

.photo {
    margin: 20px 0;
}

.photo img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 3px solid #0044cc;
}

.details {
    padding: 0 20px;
}

.details h2 {
    margin: 10px 0 5px;
    font-size: 20px;
    color: #333;
}

.details p {
    margin: 5px 0;
    color: #777;
    font-size: 14px;
}

.footer {
    background-color: #f8f8f8;
    padding: 10px 0;
    position: absolute;
    bottom: 0;
    width: 100%;
}

.footer p {
    margin: 0;
    color: #777;
    font-size: 12px;
}

</style>

    <div class="row">
    @foreach($data as $key => $idcard) 
    <div align="" class="col">
        <div class="id-card" style="background-image: url({{public_path('storage/image/idcard.svg')}}); background-size: 254px; background-repeat: no-repeat;">
            <div class="col">
                <img class="img" src="{{public_path('storage/registrasi/'.$idcard->kode_trip.'/'.$idcard->id_reg.'/'.$idcard->foto) }}" alt="Profile Picture">
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card Design</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="id-card">
        <div class="header">
            <h1>Company Name</h1>
        </div>
        <div class="photo">
            <img src="photo.jpg" alt="Profile Photo">
        </div>
        <div class="details">
            <h2>John Doe</h2>
            <p>ID: 123456789</p>
            <p>Position: Software Engineer</p>
        </div>
        <div class="footer">
            <p>www.companywebsite.com</p>
        </div>
    </div>
</body>
</html>