@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header">{{ __('Data Peserta Registrasi') }}</div>

                <div class="card-body" style="overflow-x: auto;">
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
                    <table class="table-striped table-hover" width="100%">
                        <tr>
                            <th>No</th>
                            <th>Kode Trip</th>
                            <th>Bus</th>
                            <th>No. Registrasi</th>
                            <th>Nama</th>
                            <th>Sekolah</th>
                            <th>Kelas</th>
                            <th>TTL</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Penyakit</th>
                            <th>Opsi</th>
                        </tr>
                        @foreach($data as $key => $item)
                        <tr>
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$data->firstitem()+$key}}</td>
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->kode_trip}}</td>
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->bus}}</td>
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->id_reg}}</td>
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->nama_lengkap}}</td>
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->sekolah}}</td>
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->kelas}}</td>
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{explode(',', $item->ttl)[0]}}, {{Carbon\Carbon::parse(str_replace(' ', '', explode(',', $item->ttl)[1]))->isoFormat('DD MMMM YYYY')}}</td>
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->email}}</td>
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->alamat}}</td>
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->penyakit}}</td>
                            <td>
                                <div style="display: flex;">
                                    <div class="px-1">
                                        <a href="/datareg/edit/{{$item->id_reg}}"  hidden>
                                            <button id="{{$data->firstitem() + $key}}" type="submit" title="Ubah Data"></button>
                                        </a>
                                            <label for="{{$data->firstitem() + $key}}" class="bi bi-pencil-fill bg-warning btn-sm align-self-center m-0" style="cursor: pointer;"></label>
                                    </div>
                                    <div class="px-1">    
                                        <form action="/datareg/hapus/{{$item->id}}" method="post" onsubmit="return loding(this);">
                                        @csrf
                                        @method('DELETE')
                                            <button id="del{{$data->firstitem() + $key}}" type="submit" title="Hapus Data Sekolah" hidden></button>
                                                <label for="del{{$data->firstitem() + $key}}" class="bi bi-trash-fill bg-danger btn-sm align-self-center m-0" style="cursor: pointer;"></label>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card Design</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .id-card {
            width: 250px;
            height: 400px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background-image: url({{asset('storage/image/idcard.svg')}}); 
            background-size: cover;
            position: relative;
            margin: 50px auto;
            color: white;
            text-align: center;
        }
        .id-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid white;
            margin-top: 30px;
            z-index: 1;
            position: relative;
        }
        .details {
            margin-top: 20px;
            z-index: 1;
            position: relative;
        }
        .details h2 {
            margin: 10px 0 5px;
            font-size: 1.2em;
        }
        .details p {
            margin: 5px 0;
            font-size: 0.9em;
        }
        .qr-code {
            width: 80px;
            height: 80px;
            margin-top: 20px;
            z-index: 1;
            position: relative;
        }
    </style>
</head>
<body>
    <div class="id-card">
        <img src="{{asset('storage/image/logo.png')}}" alt="Profile Picture" class="profile-pic">
        <div class="details">
            <h2>John Doe</h2>
            <p>Position: Software Engineer</p>
            <p>ID: 123456789</p>
        </div>
        <img class="p-1 me-2 float-end" id='barcode' 
            src="https://api.qrserver.com/v1/create-qr-code/?data={{base64_encode(base64_encode('ini isinya kode registrasi'))}}&amp;size=300x300" 
            alt="" 
            title="{" 
            width="80" 
            height="80" />
    </div>
</body>
</html>
<script type="text/javascript">
     function loding(form){
    Swal.fire({
          title: "Sudah Yakin ?",
          text: "Data terhapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Batal",
          confirmButtonText: "Hapus"
        }).then((result) => {
          if (result.isConfirmed) {
        form.submit();
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang menghapus data registrasi",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                target.style.opacity = '0'
            }
            });  
          }
        });
    return false;
 }
</script>

@endsection
