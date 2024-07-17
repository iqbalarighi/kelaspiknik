@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header">{{ __('Master Data') }}
                    <a href="{{route('tambah-sekolah')}}"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Ini Halaman Master Data!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection