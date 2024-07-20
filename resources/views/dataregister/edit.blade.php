@extends('layouts.side')

@section('content')
{{-- style --}}
<style>
.containerx {
  position: relative;
  width: 30%;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.containerx:hover .image {
  opacity: 0.3;
}

.containerx:hover .middle {
  opacity: 1;
}

.text {
  color: black;
  font-size: 24px;
  padding: auto;
}
</style>
<style type="text/css">
    .custom-file-button input[type=file] {
  margin-left: -2px !important;
}

.custom-file-button input[type=file]::-webkit-file-upload-button {
  display: none;
}

.custom-file-button input[type=file]::file-selector-button {
  display: none;
}

.custom-file-button:hover label {
  background-color: #dde0e3;
  cursor: pointer;
}
</style>
<style type="text/css">
    .bg-header {
        background-color: #1ec28b;
    }
</style>
{{-- style --}}
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header">{{ __('Edit Data Registrasi') }}
                     <a href="{{route('datareg')}}"><span class="btn btn-primary float-right btn-sm">Kembali</span></a>
                </div>

                <div class="card-body">
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
                    <center>
                    <div class="col-sm-6">
                    <form action="{{Route('datareg')}}/update/{{$data->id}}" method="POST" enctype="multipart/form-data" onsubmit="return loding(this);">
            @csrf
            @method('PUT')
                <div class="card-body">
            
                <div class="mb-3">
                    <select style="width:100%;" class="form-select" id="school" name="sekolah" required>
                        <option value="{{$data->sekolah}}" selected>{{$data->sekolah}}</option>
                    </select>
                </div>
                    
                    <div class="fw-bold" style="text-align: left !important;">Data Peserta</div>
                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm" placeholder="" id="nama" name="nama" value="{{$data->nama_lengkap}}" required>
                        <label for="nama">Nama Lengkap <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm" placeholder="" id="kelas" name="kelas" value="{{$data->kelas}}" required>
                        <label for="kelas">Kelas <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="nis" name="nis" value="{{$data->nis}}" required>
                        <label for="nis">Nomor Induk Siswa (NIS) <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm" placeholder="" id="tempat" name="tempat" value="{{$value[0]}}" required>
                        <label for="tempat">Tempat Lahir<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="date" class="form-control form-control-sm" placeholder="" id="tgl" name="tgl" value="{{Carbon\Carbon::parse(str_replace(' ', '', $value[1]))->format('Y-m-d')}}" required>
                        <label for="tgl">Tanggal Lahir <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="email" class="form-control form-control-sm" placeholder="" id="email" name="email" value="{{$data->email}}" required>
                        <label for="email">Email<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating ">
                        <textarea class="form-control form-control-sm" placeholder="Leave a comment here" id="alamat" style="height: 100px;" name="alamat" required>{{$data->alamat}}</textarea>
                        <label for="alamat">Alamat Lengkap <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating ">
                        <textarea class="form-control form-control-sm" placeholder="Leave a comment here" id="penyakit" style="height: 100px;" name="penyakit" required>{{$data->penyakit}}</textarea>
                        <label for="penyakit">Riwayat Penyakit Khusus <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="notel" name="notel" value="{{$data->no_tel}}" required>
                        <label for="notel">Nomor Telepon<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="nowa" name="nowa" value="{{$data->no_wa}}" required>
                        <label for="nowa">Nomor Whatsapp<font size="2" color="red">*</font></label>
                    </div>

                @if ($data->foto == null)
                   <div class="input-group custom-file-button mt-1">
                        <label class="input-group-text p-1" class="form-control form-control-sm" for="foto" style="font-size: 10pt;">Upload Foto Peserta <font size="2" color="red">*</font></label>
                        <input type="file" class="form-control form-control-sm" accept=".jpeg, .jpg, .png" name="images[]" id="foto" multiple required>
                    </div>
                @else
                    <div style="text-align: left !important;"><b>Foto Peserta</b>:
                        <div class="row">
                            <div class="containerx">
                               <img class="image" src="{{asset('storage/registrasi')}}/{{$data->id_reg}}/{{$data->foto}}" style="width: 100%; margin-bottom: 5pt"> &nbsp;
                                <div class="middle">
                                    <div class="text">
                                        <i class="bi bi-trash3" style="color: red; cursor: pointer;" title="Hapus Foto" onclick="return hapus(this);"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mt-3 fw-bold" style="text-align: left !important;">Data Orang Tua Peserta</div>
                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm" placeholder="" id="nm_ortu" name="nm_ortu" value="{{$data->nm_ortu}}" required>
                        <label for="nm_ortu">Nama Orang Tua (Ibu/Ayah) <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="notel_ortu_1" name="notel_ortu_1" value="{{$data->no_tel_ortu1}}" required>
                        <label for="notel_ortu_1">Nomor Telepon Orang Tua 1<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="notel_ortu_2" name="notel_ortu_2" value="{{$data->no_tel_ortu2}}" required>
                        <label for="notel_ortu_2">Nomor Telepon Orang Tua 2<font size="2" color="red">*</font></label>
                    </div>

                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-primary ">Kirim</button>
                    </div>
                </div>
                </form>
                </div>
                </center>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$('#school').select2({
        ajax: {
            url: "{{route('school')}}",
            dataType: "json",
              delay: 250,

processResults: function (data) {
      // Transforms the top-level key of the response object from 'items' to 'results'
      return {
        results: $.map(data, function (item) {
                        return { text: item.lokasi, id: item.id }
                    })
      };
    }
},
maximumSelectionLength: 1,
placeholder: 'Pilih Nama Sekolah',
width: 'resolve',
allowClear: true

});

</script>

<script type="text/javascript">
     function hapus(form){
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
        window.location.href = "{{url('/datareg/hapus/foto/'.$data->id)}}";
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang menghapus foto registrasi",
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
<script type="text/javascript">
 function loding(form){
    Swal.fire({
          title: "Sudah Yakin ?",
          text: "Pastikan seluruh data benar dan lengkap",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Batal",
          confirmButtonText: "Update"
        }).then((result) => {
          if (result.isConfirmed) {
        form.submit();
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang menyimpan pembaruan data",
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
