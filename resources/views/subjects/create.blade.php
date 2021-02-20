@extends('layouts.master')

@push('title')
- Tambah Mata Pelajaran
@endpush

@push('styles')
<!-- simplebar CSS-->
<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
<!-- Bootstrap core CSS-->
<link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
<!-- animate CSS-->
<link href="{{ asset('assets/css/animate.css')}}" rel="stylesheet" type="text/css" />
<!-- Icons CSS-->
<link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
<!-- Sidebar CSS-->
<link href="{{ asset('assets/css/sidebar-menu.css')}}" rel="stylesheet" />
<!-- Custom Style-->
<link href="{{ asset('assets/css/app-style.css')}}" rel="stylesheet" />

@endpush

@section('content')
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
        <h4 class="page-title">Tambah Mata Pelajaran</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">SMK Mahaputra</a></li>
            <li class="breadcrumb-item"><a href="{{ url('subjects') }}">Mata Pelajaran</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Mata Pelajaran</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Tambah Mata Pelajarann</div>
                <hr>
                <form method="POST" autocomplete="off" action="{{ url('subject/create')}}" id="form-validate">
                    @csrf
                    <div class="form-group row">
                        <label for="input-2" class="col-sm-3 col-form-label">Nama Mata Pelajaran</label>
                        <div class="col-sm-9">
                            <input type="text" name="sbj_name" class="form-control form-control-rounded @error('sbj_name') is-invalid @enderror" value="{{ old('sbj_name') }}" placeholder="Masukan Nama  Mata Pelajaran">
                            @error('sbj_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="input-1" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary shadow-primary px-5">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- End Row-->

@endsection



@push('scripts')

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>

<!-- simplebar js -->
<script src="{{ asset('assets/plugins/simplebar/js/simplebar.js')}}"></script>
<!-- waves effect js -->
<script src="{{ asset('assets/js/waves.js')}}"></script>
<!-- sidebar-menu js -->
<script src="{{ asset('assets/js/sidebar-menu.js')}}"></script>
<!-- Custom scripts -->
<script src="{{ asset('assets/js/app-script.js')}}"></script>
<!--Form Validatin Script-->
<script src="{{ asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>

<script>
    $().ready(function() {

    $("#form-validate").validate({
        rules: {
            sbj_name: {
              required: true,
            },
            pst_honorarium:{
                required: true
            },
        },
        messages: {
            sbj_name: {
              required: "Nama mata pelajaran harus di isi"
            },     
        }
    });
});
</script>
@endpush