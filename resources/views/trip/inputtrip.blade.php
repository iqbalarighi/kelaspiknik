@extends('layouts.side')

@section('content')
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
                    <form action="{{Route('trip')}}/simpan" method="POST" enctype="multipart/form-data" onsubmit="return loding(this);">
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
@endsection


