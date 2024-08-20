@extends('layouts.side')

@section('content')
@if (Auth::user()->role === 'user')
        {{abort(403)}}
@endif

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
<style>
.containerx {
  position: relative;
  width: 50%;
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

<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header">{{ __('Data Sekolah') }}
                    <a href="{{route('trip')}}"><span class="btn btn-primary float-right btn-sm">Kembali</span></a>
                </div>
        @if ($message = Session::get('sukses'))
            <script type="text/javascript">
            Swal.fire({
              icon: "success",
              title: "{{$message}}",
              showConfirmButton: false,
              timer: 1500
            });
            </script>
        @endif
                <div class="card-body  col-md-5">
                    <form action="{{Route('trip')}}/update/{{$data->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="card-body">
                            <div class="form-floating ">
                                <input value="{{$data->judul_trip}}" class="form-control form-control-sm" placeholder="Leave a comment here" id="judul_trip" name="judul_trip" required>
                                <label for="judul_trip">Judul Trip <font size="2" color="red">*</font></label>
                            </div>
                            <div class="form-floating mb-1">
                                <input value="{{$data->nama_sekolah}}" type="text" class="form-control form-control-sm" placeholder="" id="nama" name="nama" value="" required>
                                <label for="nama">Nama Sekolah <font size="2" color="red">*</font></label>
                            </div>
                            <div class="form-floating mb-1">
                                <input value="{{$data->jumlah_bus}}" type="number" class="form-control form-control-sm" placeholder="" id="bus" name="bus" value="" required>
                                <label for="bus">Jumlah Bus <font size="2" color="red">*</font></label>
                            </div>
                            <div class="form-floating mb-1">
                                <input value="{{$data->kapasitas}}" type="number" class="form-control form-control-sm" placeholder="" id="kapasitas" name="kapasitas" value="" required>
                                <label for="kapasitas">Kapasitas Bus <font size="2" color="red">*</font></label>
                            </div>
                            <div class="form-floating mb-1">
                                <input value="{{$data->lama_trip}}" type="number" class="form-control form-control-sm" placeholder="" id="numberInput" name="lama_trip" maxlength="1" value="" required>
                                <label for="lama_trip">Lama Trip <font size="2" color="red">*</font></label>
                            </div>
                            @if ($data->file == null)
                                <div class="input-group custom-file-button mt-1">
                                <label class="input-group-text p-1" class="form-control form-control-sm" for="imginpt" style="font-size: 10pt;">Upload ID Card<font size="2" color="red">*</font></label>
                                <input type="file" class="form-control form-control-sm" accept=".jpeg, .jpg, .png" name="images" id="imginpt" required>
                                </div>
                            <div class="mt-2"><center><img id="blah" src="" alt="your image" width="200px" /></center></div>
                            @else
                            <div style="text-align: left !important;"><b>Layout ID Card</b>:
                                <div class="row">
                                    <div class="containerx">
                                       <img class="image" src="{{asset('storage/trip')}}/{{$data->kode_trip}}/{{$data->file}}" style="width: 100%; margin-bottom: 5pt"> &nbsp;
                                        <div class="middle">
                                            <div class="text">
                                                <i class="bi bi-trash3" style="color: red; cursor: pointer;" title="Hapus Foto" onclick="return hapus(this);"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <div class="text-center mt-2">
                                <button type="submit" class="btn btn-primary ">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function() {
            $('#numberInput').on('input', function() {
                // Get the current value
                var value = $(this).val();

                // If the length is more than 1 or the value is not between 1 and 8, clear the input
                if (value.length > 1 || value < 1 || value > 8) {
                    $(this).val('');
                }
            });

            // Prevent manual input longer than 1 character
            $('#numberInput').on('keypress', function(e) {
                if (this.value.length >= 1) {
                    e.preventDefault();
                }
            });

            // Ensure only numbers 1-8 can be entered
            $('#numberInput').on('keydown', function(e) {
                var key = e.which || e.keyCode;
                if (!((key >= 49 && key <= 56) || key === 8 || key === 46)) { // 49-56 are keycodes for 1-8, 8 is backspace, 46 is delete
                    e.preventDefault();
                }
            });
        });
    </script> 
    <script>
        $(document).ready(function() {
            $('#numberInput').on('input', function() {
                // Get the current value
                var value = $(this).val();

                // If the length is more than 1 or the value is not between 1 and 8, clear the input
                if (value.length > 1 || value < 1 || value > 8) {
                    $(this).val('');
                }
            });

            // Prevent manual input longer than 1 character
            $('#numberInput').on('keypress', function(e) {
                if (this.value.length >= 1) {
                    e.preventDefault();
                }
            });

            // Ensure only numbers 1-8 can be entered
            $('#numberInput').on('keydown', function(e) {
                var key = e.which || e.keyCode;
                if (!((key >= 49 && key <= 56) || key === 8 || key === 46)) { // 49-56 are keycodes for 1-8, 8 is backspace, 46 is delete
                    e.preventDefault();
                }
            });
        });
    </script>
<script type="text/javascript">
     function hapus(form){
    Swal.fire({
          title: "Hapus Foto ?",
          text: "Data terhapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Batal",
          confirmButtonText: "Hapus"
        }).then((result) => {
          if (result.isConfirmed) {
        window.location.href = "{{url('/trip/hapus/foto/'.$data->id)}}";
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
    var imginpt = document.getElementById('imginpt');
    var blah = document.getElementById('blah');

    blah.style.visibility = 'hidden';

    imginpt.onchange = evt => {
  const [file] = imginpt.files
  if (file) {
    blah.style.visibility = 'visible';
    blah.src = URL.createObjectURL(file);
  } else {
    blah.style.visibility = 'hidden';
  }
}
</script>
@endsection


