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
</style>
                    <table class="table-striped table-hover" width="100%">
                        <tr>
                            <th>No</th>
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
                            <td>{{$data->firstitem()+$key}}</td>
                            <td>{{$item->id_reg}}</td>
                            <td>{{$item->nama_lengkap}}</td>
                            <td>{{$item->sekolah}}</td>
                            <td>{{$item->kelas}}</td>
                            <td>{{explode(',', $item->ttl)[0]}}, {{Carbon\Carbon::parse(str_replace(' ', '', explode(',', $item->ttl)[1]))->isoFormat('DD MMMM YYYY')}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->penyakit}}</td>
                            <td align="center" class="d-flex justify-content-center">
                                <span class="px-1"><a href="/datareg/edit/{{$item->id_reg}}" class="btn btn-primary btn-sm p-1">Ubah</a></span>
                                <form method="POST" action="/datareg/hapus/{{$item->id}}" onsubmit="return loding(this);">
                                 @csrf
                                 @method('DELETE')
                                    <div class="form-group px-1">
                                        <input type="submit" class="btn btn-danger delete-user btn-sm p-1" value="Hapus">
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
