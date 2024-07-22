@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header">{{ __('Detail') }}
                    <a href="{{route('datareg')}}"><span class="btn btn-primary float-right btn-sm">Kembali</span></a>
                </div>

                <div class="card-body">
                    
<table class="table-striped table-hover">
    <tr>
        <td>Sekolah</td>
        <td>:</td>
        <td>{{$data->sekolah}}</td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{$data->nama_lengkap}}</td>
    </tr>
    <tr>
        <td>NIS</td>
        <td>:</td>
        <td>{{$data->nis}}</td>
    </tr>
    <tr>
        <td>Kelas</td>
        <td>:</td>
        <td>{{$data->kelas}}</td>
    </tr>
    <tr>
        <td>Tempat, Tanggal Lahir</td>
        <td>:</td>
        <td>{{$item[0]}}, {{Carbon\Carbon::parse(str_replace(' ', '', $item[1]))->isoFormat('DD MMMM YYYY')}}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{$data->alamat}}</td>
    </tr>
    <tr>
        <td>Penyakit</td>
        <td>:</td>
        <td>{{$data->penyakit}}</td>
    </tr>
    <tr>
        <td>No Telepon</td>
        <td>:</td>
        <td>{{$data->no_tel}}</td>
    </tr>
    <tr>
        <td>No Whatsapp</td>
        <td>:</td>
        <td>{{$data->no_wa}}</td>
    </tr>
    <tr>
        <td>Foto</td>
        <td>:</td>
        <td> <img src="{{asset('storage/registrasi/'.$data->id_reg.'/'.$data->foto)}}" width="300px"> </td>
    </tr>
    <tr>
        <td>Nama Orang Tua</td>
        <td>:</td>
        <td>{{$data->nm_ortu}}</td>
    </tr>
    <tr>
        <td>No Telepon Orang tua 1</td>
        <td>:</td>
        <td>{{$data->no_tel_ortu1}}</td>
    </tr>
    <tr>
        <td>No Telepon Orang tua 2</td>
        <td>:</td>
        <td>{{$data->no_tel_ortu2}}</td>
    </tr>
    <tr>
        <td>Surat Pernyataan</td>
        <td>:</td>
        <td> <img src="{{asset('storage/registrasi/'.$data->id_reg.'/'.$data->surat)}}" width="300px"> </td>
    </tr>
</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
