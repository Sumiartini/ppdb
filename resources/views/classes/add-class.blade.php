@extends('layouts.master')

@push('title')
- Tambah Kelas
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
        <h4 class="page-title">Tambah Kelas</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">{{ env('APP_NAME') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('classes') }}">Kelas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Kelas</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <div class="alert-icon contrast-alert">
            <i class="icon-check"></i>
        </div>
        <div class="alert-message">
            <span><strong>Berhasil!</strong> {{$message}}.</span>
        </div>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <div class="alert-icon contrast-alert">
            <i class="icon-close"></i>
        </div>
        <div class="alert-message">
            <span><strong>Gagal!</strong> {{$message}}.</span>
        </div>
    </div>
    @endif
<div class="card">
    <div class="card-body">
        <div class="card-title">Tambah Kelas</div>
        <hr>
        <form method="POST" autocomplete="off" action="{{ url('class/create')}}" id="form-validate">
            @csrf

            <div class="form-group row">
                <label for="input-2" class="col-sm-3 col-form-label">Tingkatan</label>
                <div class="col-sm-9">
                    <select name="cls_grade_level" class="form-control form-control-rounded @error('grade_level') is-invalid @enderror">
                        <option disabled="" selected> Pilih </option>
                        @foreach($grade_levels as $grade_level)
                        <option value="{{ $grade_level->grl_id }}">{{ $grade_level->grl_name }}</option>
                        @endforeach
                    </select>
                    @error('grade_level')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror 
                </div>
            </div>

            <div class="form-group row">
                <label for="input-2" class="col-sm-3 col-form-label">Jurusan</label>
                <div class="col-sm-9">
                    <select name="cls_major" class="form-control form-control-rounded @error('major') is-invalid @enderror">
                        <option disabled="" selected> Pilih </option>
                        @foreach($majors as $major)
                        <option value="{{ $major->mjr_id }}">{{ $major->mjr_name }}</option>
                        @endforeach
                    </select>

                    @error('major')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror 
                </div>
            </div>

            <div class="form-group row">
                <label for="input-2" class="col-sm-3 col-form-label">Nomor Kelas</label>
                <div class="col-sm-9">
                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="cls_number" class="form-control form-control-rounded @error('cls_number') is-invalid @enderror" value="{{ old('cls_number') }}" placeholder="Masukan Nomor Kelas">
                    @error('cls_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror 
                </div>
            </div>

            <div class="form-group row">
                <label for="input-2" class="col-sm-3 col-form-label">Tahun Kelas</label>
                <div class="col-sm-9">
                    <select name="cls_school_year_id" class="form-control form-control-rounded">
                        <option disabled="" selected> Pilih </option>
                        @foreach($school_years as $school_year)
                        <option value="{{ $school_year->scy_id }}">{{ $school_year->scy_name }}</option>
                        @endforeach
                    </select>
                    @error('cls_school_year')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror 
                </div>
            </div>

            <div class="form-group row">
                <label for="input-1" class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <a href="{{url('classes')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>  
                    <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i> BATAL</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Simpan</button>
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
            cls_number: {
              required: true,
          },
          cls_major:{
            required: true
        },
        cls_grade_level:{
            required: true
        },
        cls_school_year_id:{
            required: true
        },
    },
    messages: {
        cls_number: {
          required: "Nomor Kelas harus di isi"
        },     
        cls_major: {
            required: "Nama jurusan harus di pilih"
        },
        cls_grade_level:{
            required: "Tingkatan kelas harus di pilih"
        },
        cls_school_year_id:{
            required: "Tahun ajaran kelas harus di pilih"
        },
}
});
});
</script>
@endpush