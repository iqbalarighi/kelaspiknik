@extends('layouts.side')

@section('content')
<style type="text/css">
    th {
        vertical-align: middle;
        text-align: center;
    }
</style>

        @if ($message = Session::get('sukses'))
            <script type="text/javascript">
            Swal.fire({
              icon: "success",
              title: "Berhasil",
              text: "{{$message}}",
              showConfirmButton: false,
              timer: 1500
            });
            </script>
        @endif
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header">{{ __('Data Sekolah') }}
                    <a href="{{route('trip')}}/tambah"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a>
                </div>
                <div class="card-body">

                <table style="width: 100%;" class="table-stripped table-hover">
                    <tr>
                        <th>No</th>
                        <th>Kode Trip</th>
                        <th>Judul Trip</th>
                        <th>Nama Sekolah</th>
                        <th>Jumlah Bus</th>
                        <th>Opsi</th>
                    </tr>
                    @foreach($data as $key=>$item)
                    <tr>
                        <td>{{$data->firstitem()+$key}}</td>
                        <td>{{$item->kode_trip}}</td>
                        <td>{{$item->judul_trip}}</td>
                        <td>{{$item->nama_sekolah}}</td>
                        <td>{{$item->jumlah_bus}}</td>
                        <td>
                            <div style="display: flex;">
                                <div class="px-1">
                                    <a href="{{route('trip')}}/ubah/{{$item->id}}" hidden>
                                        <button id="{{$data->firstitem() + $key}}" type="submit" title="Ubah Data"></button>
                                    </a>
                                        <label for="{{$data->firstitem() + $key}}" class="bi bi-pencil-fill bg-warning btn-sm align-self-center m-0" style="cursor: pointer;"></label>
                                </div>
                                <div class="px-1">    
                                    <form action="{{route('trip')}}/hapus/{{$item->id}}" method="post" onsubmit="return loding(this);">
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

