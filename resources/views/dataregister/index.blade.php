@extends('layouts.side')

@section('content')
@if (Auth::user()->role === 'user')
        {{abort(403)}}
@endif
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header">{{ __('Data Peserta Registrasi') }}</div>

                <div class="card-body" >
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
    <div>
        <div class="row" >
                <form action="" method="GET">
                    <div class="col-sm-4 float-end" style="display: flex;">
                        <input type="text" name="cari" class="form-control form-control-sm">
                        &nbsp;
                        <input type="submit" value="{{$cari != null ? 'Reset' : 'Cari'}}" class="btn btn-sm btn-primary">
                    </div>
                </form>
        </div>
    </div>
    <div class="mt-2" style="overflow-x: auto;">
                    <table class="table-striped table-hover" width="100%">
                        <tr>
                            <th>No</th>
                            <th>Kode Trip</th>
                            {{-- <th>Bus</th> --}}
                            {{-- <th>No. Registrasi</th> --}}
                            <th>Nama</th>
                            <th>Sekolah</th>
                            {{-- <th>Kelas</th> --}}
                            {{-- <th>TTL</th> --}}
                            <th>Email</th>
                            {{-- <th>Alamat</th> --}}
                            {{-- <th>Penyakit</th> --}}
                            <th>Opsi</th>
                        </tr>
                        @foreach($data as $key => $item)
                        <tr>
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$data->firstitem()+$key}}</td>
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->kode_trip}}</td>
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->bus}}</td> --}}
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->id_reg}}</td> --}}
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->nama_lengkap}}</td>
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->sekolah}}</td>
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->kelas}}</td> --}}
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{explode(',', $item->ttl)[0]}}, {{Carbon\Carbon::parse(str_replace(' ', '', explode(',', $item->ttl)[1]))->isoFormat('DD MMMM YYYY')}}</td> --}}
                            <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->email}}</td>
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->alamat}}</td> --}}
                            {{-- <td onclick="window.location.href='{{route('datareg')}}/detail/{{$item->id_reg}}'" style="cursor: pointer;" title="klik untuk lihat detail">{{$item->penyakit}}</td> --}}
                            <td>
                                <div style="display: flex;" class="justify-content-center">
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
               <div class="px-2"> {{ $data->onEachSide(5)->links() }} </div>
            </div>
        </div>
    </div>
</div>

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
