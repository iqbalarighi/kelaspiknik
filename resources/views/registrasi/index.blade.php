@extends('layouts.app')

@section('content')
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

    .select2-selection__placeholder {
  color: black !important;
}
</style>



<div class="container">
@if ($errors->any())
<script type="text/javascript">
    Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "Perhatikan kembali isian formulir, silahkan bertanya jika mengalami kesulitan",
});
</script>
@endif


        @if ($message = Session::get('sukses'))
            <script type="text/javascript">
            Swal.fire({
              icon: "success",
              title: "Terima Kasih Telah Melakukan Registrasi",
              text: "{{$message}}",
              showConfirmButton: false,
              timer: 2500
            });

            setTimeout(function () {
               window.location.replace("https://www.instagram.com/kelaspiknik/");
            }, 3500); 
            </script>
        @endif
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header fw-bold bg-header text-white">{{ __('Formulir Registrasi') }}</div>
                <form action="{{Route('regis')}}" method="POST" enctype="multipart/form-data" onsubmit="return loding(this);">
            @csrf

                <div class="card-body">
            
                <div class="mb-3">
                    <select style="width:100%;" class="form-contol form-select" id="school" name="sekolah" required>
                        @if( old('sekolah') )
                            <option value="{{ old('sekolah') }}" selected>{{ old('sekolah') }}</option>
                        @endif
                    </select>
                </div>
                    
                    <div class="fw-bold">Data Peserta</div>
                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm" placeholder="" id="nama" name="nama" value="{{ old('nama') }}" required>
                        <label for="nama">Nama Lengkap <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm" placeholder="" id="kelas" name="kelas" value="{{ old('kelas') }}" required>
                        <label for="kelas">Kelas <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="nis" name="nis" value="{{ old('nis') }}" required>
                        <label for="nis">Nomor Induk Siswa (NIS) <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm" placeholder="" id="tempat" name="tempat" value="{{ old('tempat') }}" required>
                        <label for="tempat">Tempat Lahir<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="date" class="form-control form-control-sm" placeholder="" id="tgl" name="tgl" value="{{ old('tgl') }}" required>
                        <label for="tgl">Tanggal Lahir <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="email" class="form-control form-control-sm" placeholder="" id="email" name="email" value="{{ old('email') }}" required>
                        <label for="email">Email<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating ">
                        <textarea class="form-control form-control-sm" placeholder="Leave a comment here" id="alamat" style="height: 100px;" name="alamat" required>{{ old('alamat') }}</textarea>
                        <label for="alamat">Alamat Lengkap <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating ">
                        <textarea class="form-control form-control-sm" placeholder="Leave a comment here" id="penyakit" style="height: 100px;" name="penyakit" required>{{ old('penyakit') }}</textarea>
                        <label for="penyakit">Riwayat Penyakit Khusus <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="notel" name="notel" value="{{ old('notel') }}" required>
                        <label for="notel">Nomor Telepon<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="nowa" name="nowa" value="{{ old('nowa') }}" required>
                        <label for="nowa">Nomor Whatsapp<font size="2" color="red">*</font></label>
                    </div>

                    <div class="input-group custom-file-button mt-1">
                        <label class="input-group-text p-1" class="form-control form-control-sm" for="foto" style="font-size: 10pt;">Upload Foto Peserta <font size="2" color="red">*</font></label>
                        <input type="file" class="form-control form-control-sm" accept=".jpeg, .jpg, .png" name="images" id="foto" value="{{ old('images') }}" required>
                    </div>
                @if ($errors->has('images'))
                    @foreach($errors->get('images') as $err ) 
                        <div><span class="text-danger">{{$err}}</span></div>
                    @endforeach
                @endif
                    
                    <div class="mt-3 fw-bold">Data Orang Tua Peserta</div>
                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm" placeholder="" id="nm_ortu" name="nm_ortu" value="{{ old('nm_ortu') }}" required>
                        <label for="nm_ortu">Nama Orang Tua (Ibu/Ayah) <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="notel_ortu_1" name="notel_ortu_1" value="{{ old('notel_ortu_1') }}" required>
                        <label for="notel_ortu_1">Nomor Telepon Orang Tua 1<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="notel_ortu_2" name="notel_ortu_2" value="{{ old('notel_ortu_2') }}" required>
                        <label for="notel_ortu_2">Nomor Telepon Orang Tua 2<font size="2" color="red">*</font></label>
                    </div>

                    <div class="input-group custom-file-button mt-1">
                        <label class="input-group-text p-1" class="form-control form-control-sm" for="foto2" style="font-size: 10pt;">Upload Surat Pernyataan <font size="2" color="red">*</font></label>
                        <input type="file" class="form-control form-control-sm" accept=".jpeg, .jpg, .png" name="images2" id="foto2" value="{{ old('images2') }}" required>
                    </div>
                @if ($errors->has('images2'))
                    @foreach($errors->get('images2') as $errs ) 
                        <div><span class="text-danger">{{$errs}}</span></div>
                    @endforeach
                @endif

                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-primary ">Kirim</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
          confirmButtonText: "Kirim"
        }).then((result) => {
          if (result.isConfirmed) {
        form.submit();
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang menyimpan data registrasi",
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

<script>
$(".kontak").on("input change paste",
function filterNumericAndDecimal(event) {
    var formControl;
    formControl = $(event.target);
    var newtext = formControl.val().replace(/[^0-9]+/g, "");
    formControl.val(''); //without this the DOT will not go away on my phone!
    formControl.val(newtext);
});
</script>

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
color: 'black',
placeholder: 'Nama Sekolah',
width: 'resolve',
allowClear: true

});

</script>
@endsection




                