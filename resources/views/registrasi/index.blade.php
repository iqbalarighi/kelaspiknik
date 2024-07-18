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
</style>



<div class="container">
        @if ($message = Session::get('sukses'))
            <script type="text/javascript">
            Swal.fire({
              icon: "success",
              title: "Terima Kasih Telah Melakukan Registrasi",
              text: "{{$message}}",
              showConfirmButton: false,
              timer: 2000
            });

            setTimeout(function () {
               window.location.replace("https://www.instagram.com/kelaspiknik/");
            }, 2500); 
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
                    <select style="width:100%;" class="form-select" id="school" name="sekolah" required></select>
                </div>
                    
                    <div class="fw-bold">Data Peserta</div>
                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm" placeholder="" id="nama" name="nama" value="" required>
                        <label for="nama">Nama Lengkap <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm" placeholder="" id="kelas" name="kelas" value="" required>
                        <label for="kelas">Kelas <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="nis" name="nis" value="" required>
                        <label for="nis">Nomor Induk Siswa (NIS) <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm" placeholder="" id="tempat" name="tempat" value="" required>
                        <label for="tempat">Tempat Lahir<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="date" class="form-control form-control-sm" placeholder="" id="tgl" name="tgl" value="" required>
                        <label for="tgl">Tanggal Lahir <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="email" class="form-control form-control-sm" placeholder="" id="email" name="email" value="" required>
                        <label for="email">Email<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating ">
                        <textarea class="form-control form-control-sm" placeholder="Leave a comment here" id="alamat" style="height: 100px;" name="alamat" required></textarea>
                        <label for="alamat">Alamat Lengkap <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating ">
                        <textarea class="form-control form-control-sm" placeholder="Leave a comment here" id="penyakit" style="height: 100px;" name="penyakit" required></textarea>
                        <label for="penyakit">Riwayat Penyakit Khusus <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="notel" name="notel" value="" required>
                        <label for="notel">Nomor Telepon<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="nowa" name="nowa" value="" required>
                        <label for="nowa">Nomor Whatsapp<font size="2" color="red">*</font></label>
                    </div>

                    <div class="input-group custom-file-button mt-1">
                        <label class="input-group-text p-1" class="form-control form-control-sm" for="foto" style="font-size: 10pt;">Upload Foto Peserta <font size="2" color="red">*</font></label>
                        <input type="file" class="form-control form-control-sm" accept=".jpeg, .jpg, .png" name="images[]" id="foto" multiple required>
                    </div>
                    
                    <div class="mt-3 fw-bold">Data Orang Tua Peserta</div>
                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm" placeholder="" id="nm_ortu" name="nm_ortu" value="" required>
                        <label for="nm_ortu">Nama Orang Tua (Ibu/Ayah) <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="notel_ortu_1" name="notel_ortu_1" value="" required>
                        <label for="notel_ortu_1">Nomor Telepon Orang Tua 1<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="notel_ortu_2" name="notel_ortu_2" value="" required>
                        <label for="notel_ortu_2">Nomor Telepon Orang Tua 2<font size="2" color="red">*</font></label>
                    </div>

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
placeholder: 'Pilih Nama Sekolah',
width: 'resolve'

});

</script>
@endsection




                