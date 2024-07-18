@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header">{{ __('Data Peserta Registrasi') }}</div>

                <div class="card-body" style="overflow-x: auto;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table-striped table-hover" width="100%">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Sekolah</th>
                            <th>Kelas</th>
                            <th>TTL</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Penyakit</th>
                        </tr>
                        @foreach($data as $key => $item)
                        <tr>
                            <td>{{$data->firstitem()+$key}}</td>
                            <td>{{$item->nama_lengkap}}</td>
                            <td>{{$item->sekolah}}</td>
                            <td>{{$item->kelas}}</td>
                            <td>{{$item->ttl}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->penyakit}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
