@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header">{{ __('Email') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="col-md-5">
                    <form method="post" action="{{url('email/update')}}/{{$data->id}}" >
                        @csrf
                        @method('PUT')
                        <textarea class="form-control form-control-sm" rows="4" name="mail">{{$data==null ? '' : $data->isi}}</textarea>
                        
                        <center>
                            <input type="submit" class="btn btn-primary btn-sm mt-1" value="Update">
                        </center>
                    </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection