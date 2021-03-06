@extends('layouts.master')

@push('title')
- Edit Kata Sandi
@endpush

@push('styles')
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<meta name="description" content=""/>
<meta name="author" content=""/>
<!--favicon-->
<link rel="icon" href="{{ asset('assets/images/logo.png')}}" type="image/x-icon">
<!-- simplebar CSS-->
<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
<!-- Bootstrap core CSS-->
<link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
<!-- animate CSS-->
<link href="{{ asset('assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>
<!-- Icons CSS-->
<link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
<!-- Sidebar CSS-->
<link href="{{ asset('assets/css/sidebar-menu.css')}}" rel="stylesheet"/>
<!-- Custom Style-->
<link href="{{ asset('assets/css/app-style.css')}}" rel="stylesheet"/>

@endpush

@section('content')
<div class="row pt-2 pb-2">
  <div class="col-sm-9">
    <h4 class="page-title">Edit Kata Sandi</h4>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">SMK Mahaputra</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Kata Sandi</li>
    </ol>
  </div>
</div>


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

@if ($message = Session::get('failed'))
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

<div class="row">
  <div class="col-lg-12">
    <div class="card">
     <div class="card-body">
       <div class="card-title">Edit Kata Sandi</div>
       <hr>
       <form method="POST" autocomplete="off" action="{{ url('account/profile/edit-password')}}" id="form-validate">
        @csrf

        <div class="form-group row">
          <label for="input-4" class="col-sm-2 col-form-label">Kata Sandi Lama</label>
          <div class="col-sm-10">
            <input type="password" name="current_password" class="form-control form-control-rounded @error('current_password') is-invalid @enderror" id="input-4" placeholder="Masukan Kata Sandi Lama" value="{{ old('current_password') }}">
            @error('current_password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="input-5" class="col-sm-2 col-form-label">Kata Sandi Baru</label>
          <div class="col-sm-10">
            <input type="password" name="new_password" class="form-control form-control-rounded @error('new_password') is-invalid @enderror" id="password" placeholder="Masukan Kata Sandi Baru" value="{{ old('new_password') }}">
            @error('new_password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="input-6" class="col-sm-2 col-form-label">Ulangi Kata Sandi</label>
          <div class="col-sm-10">
            <input type="password" name="confirm_new_password" class="form-control form-control-rounded @error('confirm_new_password') is-invalid @enderror" id="input-6" placeholder="Ulangi Kata Sandi Baru" value="{{ old('confirm_new_password') }}">
            @error('confirm_new_password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="input-1" class="col-sm-2 col-form-label"></label>
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary shadow-primary px-5"><i class="icon-lock"></i> Perbarui</button>
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
          current_password: "required",
          new_password: {
            required: true,
            minlength: 8
          },
          confirm_new_password: {
            required: true,
            equalTo: "#password"
          },
          
      },
      messages: {
          current_password: {
            required: "Kata sandi lama harus di isi",
          },
          new_password: {
            required: "Kata sandi baru harus di isi",
            minlength: "Minimal kata sandi 8 digit"
          },
          confirm_new_password: {
            required: "Ulangi kata sandi harus di isi",
            equalTo: "Kata sandi harus sesuai dengan yang baru"
          },
      }
  });
});

  </script>
@endpush
@endsection   