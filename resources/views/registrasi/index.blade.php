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

@if ($message = Session::get('error'))
<script type="text/javascript">
    Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "{{$message}}",
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
              timer: 4000
            });

            setTimeout(function () {
               window.location.replace("https://www.instagram.com/kelaspiknik/");
            }, 5000); 
            </script>
        @endif
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">   
                    @if($data != null)
                        <div class="card-header fw-bold bg-header text-white">{{ __('Formulir Registrasi') }}
                            <a href="{{route('data-register')}}"><span class="btn btn-secondary float-end btn-sm">Kembali</span></a>
                        </div>
                    @else
                        <div class="card-header fw-bold bg-header text-white">{{ __('Input Kode Trip') }}</div>
                    @endif

                    @if($data == null)
                    <form action="" method="GET">
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control form-control-sm" maxlength="5" placeholder="" id="kode_trip" name="kode_trip" value="{{ old('kode_trip') }}" required>
                            <label for="kode_trip">Input Kode Trip</label>
                        </div>

                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-primary ">Kirim</button>
                        </div>
                    </form>
                        @else
                   
                    <form action="{{url('regis')}}/{{$kode}}" method="POST" enctype="multipart/form-data" onsubmit="return loding(this);">
                @csrf
                    <div class="mb-3 mt-1">
                        <input type="text" class="form-control form-control-sm" placeholder="" id="sekolah" name="sekolah" value="{{$data->nama_sekolah}}" required readonly>
                    </div>

                    <div class="mb-3 mt-1">
                        <select class="form-select form-select-sm" name="bus" id="bus" required>
                             <option value="" selected disabled>Pilih Bus</option>
                        </select>
                        <center><span id="hasil"></span></center>
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

{{--                     <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" id="nis" name="nis" value="{{ old('nis') }}" required>
                        <label for="nis">Nomor Induk Siswa (NIS) <font size="2" color="red">*</font></label>
                    </div> --}}

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm" placeholder="" id="tempat" name="tempat" value="{{ old('tempat') }}" required>
                        <label for="tempat">Tempat Lahir<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="date" class="form-control form-control-sm" placeholder="" id="tgl" name="tgl" min="1980-01-01" max="{{Carbon\Carbon::now()->addYear(-6)->format('Y-m-d')}}" value="{{ old('tgl') }}" required>
                        <label for="tgl">Tanggal Lahir <font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="email" class="form-control form-control-sm" placeholder="" id="email" onblur="warning()" name="email" value="{{ old('email') }}" required>
                        <label for="email">Email<font size="2" color="red">*</font></label>
                       {{--  <script type="text/javascript">
                            function warning() {
                            if ($('#email').val() == "" ) {
                                $('#warning').html('').css("color","");
                                } else {
                                $('#warning').html('Pastikan email benar dan aktif untuk menerima pesan dari kelaspiknik.com<i style="font-size:15pt;" class="bi bi-exclamation-circle-fill ps-3"></i>').css("color","orange");
                                }
                            }
                        </script> --}}
                    </div>
                    <div class="form-floating mb-1">
                        <input type="email" class="form-control form-control-sm" placeholder="" id="email-confirm" onblur="warning()" name="email" value="{{ old('email') }}" required>
                        <label for="email">Konfirmasi Email<font size="2" color="red">*</font></label>
                        <center><span id="warning"></span></center>
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
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" onblur="checkLength(this)" maxlength="15" id="notel" name="notel" value="{{ old('notel') }}" required>
                        <label for="notel">Nomor Telepon<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" onblur="checkLength(this)" maxlength="15" id="nowa" name="nowa" value="{{ old('nowa') }}" required>
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
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" onblur="checkLength(this)" maxlength="15" id="notel_ortu_1" name="notel_ortu_1" value="{{ old('notel_ortu_1') }}" required>
                        <label for="notel_ortu_1">Nomor Telepon Orang Tua 1<font size="2" color="red">*</font></label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control form-control-sm kontak" placeholder="" onblur="checkLength(this)" maxlength="15" id="notel_ortu_2" name="notel_ortu_2" value="{{ old('notel_ortu_2') }}" required>
                        <label for="notel_ortu_2">Nomor Telepon Orang Tua 2</label>
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
                </form>
                 @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 function loding(form){
    console.log($('#notel').val().length);
    if ($('#notel').val().length < 10) {
        $('#notel').focus();
        return false;
    } else if ($('#nowa').val().length < 10) {
        $('#nowa').focus();
        return false;
    } else if ($('#notel_ortu_1').val().length < 10) {
        $('#notel_ortu_1').focus();
        return false;
    } else if ($('#notel_ortu_2').val().length < 10) {
        $('#notel_ortu_2').focus();
        return false;
    } else {

    Swal.fire({
          title: "Halo "+$('#nama').val()+" !",
          html: `Pastikan seluruh data benar dan lengkap 
                  <br>
                  Jangan lupa yaa untuk cek email kamu setelah registrasi
                  <br>
                  <h2><b>Siap Tour Bersama Kelas Piknik ?</b></h2>
                  `,
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Tidak",
          confirmButtonText: "Ya, Saya Siap"
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

 }
</script>
<script>
$(document).ready(function () {
   $("#email-confirm").on('keyup', function(){
    var email = $("#email").val();
    var confirmEmail = $("#email-confirm").val();
    if (confirmEmail == email){
        $('#warning').html('Email Sama ! <i style="font-size:15pt;" class="bi bi-check-circle-fill ps-3"></i>').css('color','green');
    }
    else
    {
        $("#warning").html("Email Tidak Sama !").css("color","red");
    }
   
});


$("#email").on('keyup', function(){
     if (!$('#email').val().length) {
    $("#warning").html("").css("color","");
    $("#email-confirm").val("");
  }
});

});
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

<script type="text/javascript">
    function checkLength(el) {
  if (el.value.length < 10) {
    el.focus();
        Swal.fire({
          icon: "warning",
          title: "Peringatan",
          text: "Nomor Anda kurang dari 10 angka",
        });
  }
}
</script>
{{-- <script>
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

</script> --}}
@if($data != null)
    <script type="text/javascript">
(function() {
    var elm = document.getElementById('bus'),
        df = document.createDocumentFragment();
    for (var i = 1; i <= {{$data->jumlah_bus}}; i++) {
        var option = document.createElement('option');
        option.value = "Bus " + i;
        option.appendChild(document.createTextNode("Bus " + i));
        df.appendChild(option);
    }
    elm.appendChild(df);
}());
    </script>
  

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}

<script type="text/javascript">

    $('#bus').on('change', function() {
    $value = $(this).val();
    $kode = "{{$kode}}";

    $.ajax({
        type : 'get',
        url : '{{route('bus')}}/',
        data:{'bus':$value, 'kode':$kode},
        
        success:function(data){
            console.log(data.limit);
            if(data.bus < data.limit){
                var sisa = data.limit - data.bus;
        $('#hasil').html(data.bus2 +' masih tersedia '+sisa+' kursi<i style="font-size:15pt;" class="bi bi-check-circle-fill ps-3"></i>').css("color","green");
    } else {
        $('#hasil').html(data.bus2 +' tidak tersedia <i style="font-size:15pt;" class="bi bi-x-circle-fill ps-3"></i>').css("color","red");
        $('#bus').val('');
    }

        }
    });
});
</script>
  @endif

@endsection