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
                <div class="card-header">{{ __('Master Data') }}
                    {{-- <a href="{{route('tambah-sekolah')}}"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a> --}}
                </div>
                <div class="card-body">

                    <div class="card col-md-6">
                        <div class="card-header p-1">{{ __('Data Sekolah') }}
                            <a href="{{route('masterdata')}}/tambah"><span class="btn btn-primary float-right btn-sm p-0">Tambah Data</span></a>
                        </div>

                        <div class="card-body">
                            <div class="">
                            <table style="width: 100%;" class="table-stripped table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Trip</th>
                                    <th>Judul Trip</th>
                                    <th>Nama Sekolah</th>
                                    <th>Opsi</th>
                                </tr>
                                @foreach($data as $key=>$item)
                                <tr>
                                    <td>{{$data->firstitem()+$key}}</td>
                                    <td>{{$item->kode_trip}}</td>
                                    <td>{{$item->judul_trip}}</td>
                                    <td>{{$item->nama_sekolah}}</td>
                                    <td align="center" class="d-flex justify-content-center">
                                        <span class="px-1"><a href="{{route('masterdata')}}/ubah/{{$item->id}}" class="btn btn-primary btn-sm p-1" title="Ubah Data Sekolah">Ubah</a></span>
                                        <form method="POST" action="{{route('masterdata')}}/hapus/{{$item->id}}" onsubmit="return loding(this);">
                                         @csrf
                                         @method('DELETE')
                                            <div class="form-group px-1">
                                                <input type="submit" class="btn btn-danger delete-user btn-sm p-1" title="Hapus Data Sekolah" value="Hapus">
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            </div>
                        </div>
                    </div>
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

