@extends('layouts.side')

@section('content')
@if (Auth::user()->role === 'user')
        {{abort(403)}}
@endif
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header fw-bold">{{ __('User Manager') }}
                    <a href="{{route('user')}}/tambah"><span class="btn btn-primary float-right btn-sm">Tambah User</span></a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table-hover table-striped" width="100%" >
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            {{-- <th>Level</th> --}}
                            <th>Opsi</th>
                        </tr>
                    @foreach($data as $key => $item)
                        <tr>
                            <td>{{$data->firstitem()+$key}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->role}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
