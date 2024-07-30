@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header fw-bold">{{ __('Edit Data User') }}
                     <a href="{{route('user')}}"><span class="btn btn-primary float-right btn-sm">Kembali</span></a>
                </div>
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
                position: "top-end",
                icon: "success",
                title: "{{$message}}",
                showConfirmButton: false,
                timer: 2000
            });

            </script>
        @endif
                <div class="card-body">
                    <form method="post" action="{{route('user')}}/ubah/simpan/{{$data->id}}" autocomplete="off">
                        @csrf
                        @method('PUT')

                    <div class="col-sm-6">
                        <table class="table-hover table-striped" width="100%">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="nama" value="{{$data->name}}" class="form form-control form-control-sm" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>
                                    <input type="email" name="email" value="{{$data->email}}"  class="form form-control form-control-sm" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>:</td>
                                <td>
                                    <select class="form-select form-select-sm" name="role" value="{{$data->role}}" id="role" required>
                                        <option value="" disabled>Pilih Role Akses</option>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>:</td>
                                <td>
                                    <input type="password" value="{{old('password')}}" id="password" name="pass" class="form form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Konfirmasi Password</td>
                                <td>:</td>
                                <td>
                                    <input type="password" value="{{old('password')}}" id="password-confirm" class="form form-control form-control-sm passwordx">
                                    <div style="margin-top: 0px;" id="CheckPasswordMatch"></div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="lihat" onclick="cekPass()"> 
                                        <label class="form-check-label" for="lihat">
                                           {{ __('Lihat Password') }}
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <div class="mt-3">
                            <center>
                            <button type="submit" class="btn btn-primary" style = "text-align:center" id="sub" onclick="return load()">
                                {{ __('Update') }}
                            </button>
                            </center>
                                
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function load() {
            Swal.fire({
            title: "Loading . . . ",
            text: "Sedang menyimpan perubahan",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                target.style.opacity = '0'
            }
            });  
    }
</script>
<script>
$(document).ready(function () {
   $("#password-confirm").on('keyup', function(){
    var password = $("#password").val();
    var confirmPassword = $("#password-confirm").val();
    if (confirmPassword == password){
        $("#CheckPasswordMatch").html('Password Sama ! <i style="font-size:15pt;" class="bi bi-check-circle-fill ps-3"></i>').css("color","green");
        // $('#sub').prop('disabled', false);
    }
    else
    {
        $("#CheckPasswordMatch").html('Password Tidak Sama ! <i style="font-size:15pt;" class="bi bi-x-circle-fill ps-3"></i>').css("color","red");
    }
   
});


$("#password").on('keyup', function(){
     if (!$('#password').val().length) {
    $("#CheckPasswordMatch").html("").css("color","");
    $("#password-confirm").val("");
  }
});

$("#password").on('keyup', function(){
   if ($("#password").val().length === 0){
        $("#CheckPasswordMatch").html("").css("color","");
        $("#password-confirm").val("");
        $("#password-confirm").prop("disabled", true);
    } else if ( 5 >= $("#password").val().length){
        $("#CheckPasswordMatch").html("Password kurang dari 6 karakter !").css("color","red");
        $("#password-confirm").prop("disabled", true);
        $("#password-confirm").prop("required", false);
    } else  {
        $("#CheckPasswordMatch").html("").css("color","");
        $("#password-confirm").prop("disabled", false);
        $("#password-confirm").prop("required", true);

    }
});

});
</script>

<script>

    function cekPass() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
      } else {
    x.type = "password";
  }
}

$(document).ready(function () {
    $("#lihat").on('click', function(){
      if ($(".passwordx").attr("type") === "password") {
        $(".passwordx").attr("type", "text");
      } else {
        $(".passwordx").attr("type", "password");
      }
});
});
</script>
@if (Auth::user()->role === 'user')
        {{abort(403)}}
@endif
@endsection
