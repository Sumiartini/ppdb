@extends('layouts.master')

@push('title')
- Tambah Wali Kelas
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
<!-- select2 -->
<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />


@endpush

@section('content')
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
        <h4 class="page-title">Tambah Wali Kelas</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">{{ env('APP_NAME') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('homeroom-teachers') }}">Wali Kelas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Wali Kelas</li>
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
                <div class="card-title">Tambah Wali Kelas</div>
                <hr>
                <form method="POST" autocomplete="off" action="{{ url('homeroom-teacher/create')}}" id="form-validate">
                    @csrf
                    <div class="form-group row">
                        <label for="input-2" class="col-sm-3 col-form-label">Nama Wali Kelas <span style="color:red;">*</span></label>
                        <div class="col-sm-9">
                        <select  name="usr_name" class="form-control single-select form-control-rounded @error('usr_name') is-invalid @enderror">
                                <option disabled="true" selected="true"> Pilih </option>
                                @foreach($teachers as $teacher)
                                <option {{ old('usr_name') == "$teacher->tcr_id" ? 'selected' : '' }} value="{{$teacher->tcr_id}}">{{$teacher->usr_name}}</option>
                                @endforeach
                            </select>
                        @error('usr_name')
                        <p>
                            <strong style="font-size: 80%;color: #dc3545;">{{$message}}</strong>
                        </p>
                        @enderror 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-2" class="col-sm-3 col-form-label">Nama Kelas <span style="color:red;">*</span></label>
                        <div class="col-sm-9">
                        <select name="cls_name" class="form-control single-select form-control-rounded @error('cls_name') is-invalid @enderror">
                                <option disabled="true" selected="true"> Pilih </option>
                                @foreach($classes as $class)
                                <option {{ old('cls_name') == "$class->cls_id" ? 'selected' : '' }} value="{{$class->cls_id}}">{{$class->grl_name . ' ' . $class->mjr_name . ' ' . $class->cls_number}} | {{ $class->scy_name }}</option>
                                @endforeach
                            </select>
                        @error('cls_name')
                        <p>
                            <strong style="font-size: 80%;color: #dc3545;">{{$message}}</strong>
                        </p>
                        @enderror 
                        </div>
                    </div>
                    

                    <div class="form-group row">
                        <label for="input-1" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <a href="{{url('homeroom-teachers')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>  
                            <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i> BATAL</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- End Row-->





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
            usr_name: {
              required: true,
            },
            cls_name: {
                required: true,
            },
            
        },
        messages: {
            usr_name: {
              required: "Nama Wali Kelas harus di isi"
            },
            cls_name: {
                required: "Nama Kelas harus di isi"
            }     
        }
    });
});
</script>

<!-- script select2 -->
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.single-select').select2();                 
    });
</script>
@endpush
@endsection