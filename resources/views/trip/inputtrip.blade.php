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
                    <form action="{{Route('trip')}}/simpan" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                            <div class="form-floating ">
                                <input class="form-control form-control-sm" placeholder="Leave a comment here" id="judul_trip" name="judul_trip" required></input>
                                <label for="judul_trip">Judul Trip <font size="2" color="red">*</font></label>
                            </div>
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control form-control-sm" placeholder="" id="nama" name="nama" value="" required>
                                <label for="nama">Nama Sekolah <font size="2" color="red">*</font></label>
                            </div>
                            <div class="form-floating mb-1">
                                <input type="number" class="form-control form-control-sm" placeholder="" id="bus" name="bus" value="" required>
                                <label for="bus">Jumlah Bus <font size="2" color="red">*</font></label>
                            </div>
                            <div class="form-floating mb-1">
                                <input type="number" class="form-control form-control-sm" placeholder="" id="kapasitas" name="kapasitas" value="" required>
                                <label for="kapasitas">Kapasitas Bus <font size="2" color="red">*</font></label>
                            </div>
                            <div class="form-floating mb-1">
                                <input type="number" class="form-control form-control-sm" placeholder="" id="lama_trip" name="lama_trip" value="" required>
                                <label for="lama_trip">Lama Trip<font size="2" color="red">*</font></label>
                            </div>
                            <div class="input-group custom-file-button mt-1">
                                <label class="input-group-text p-1" class="form-control form-control-sm" for="imginpt" style="font-size: 10pt;">Upload ID Card<font size="2" color="red">*</font></label>
                                <input type="file" class="form-control form-control-sm" accept=".jpeg, .jpg, .png" name="images" id="imginpt" required>
                            </div>
                            <div class="mt-2"><center><img id="blah" src="" alt="your image" width="200px" /></center></div>
                            <div class="text-center mt-2">
                                <button type="submit" class="btn btn-primary ">Kirim</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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


