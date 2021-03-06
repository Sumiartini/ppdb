@extends('layouts.master')

@push('title')
- Edit Berkas Informasi Halaman Arahan 
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
        <h4 class="page-title">Edit Berkas Informasi</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">SMK Mahaputra</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Kelola Berkas Informasi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Berkas Informasi</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Edit Berkas Informasi</div>
                <hr>
                <form method="POST" autocomplete="off" action="{{ url('master-slide/edit/'.$master_slide->mss_id) }}" id="form-validate" novalidate="novalidate" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="input-2" class="col-sm-3 col-form-label">Nama<span style="color:red"> *</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="mss_name" class="form-control form-control-rounded @error('mss_name') is-invalid @enderror" value="{{$master_slide->mss_name}}" placeholder="Masukan Nama Berkas">
                        @error('mss_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-2" class="col-sm-3 col-form-label">Poster<span style="color:red"> *</span></label>
                    
                        <div class="col-sm-9">
                            <img src="{{ asset($master_slide->mss_file) }}" class="img-thumbnail" id="tampil_picture" style="object-fit: cover;"/>
                            <div></div>
                            <input type="file" name="mss_file" value="{{$master_slide->mss_file}}" id="preview_gambar" class="@error('mss_file') is-invalid @enderror" accept="image/x-png,image/gif,image/jpeg" onchange="document.getElementById('mss_file').value=this.value" /><br>

                            @error('mss_file')
                            <p>
                                <strong style="font-size: 80%;color: #dc3545;">{{$message}}</strong>
                            </p>
                            @enderror 
                        </div>
                    </div>

        </div>
                    <div class="form-group row">
                        <label for="input-1" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <a href="{{url('master-slides')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>  
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
    function bacaGambar(input) {
       if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#tampil_picture').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }
  $("#preview_gambar").change(function(){
   bacaGambar(this);
});
</script>
<script>
   $().ready(function() {

    $("#form-validate").validate({
        rules: {
            mss_name: {
              required: true,
            },
           
            pst_honorarium:{
                required: true
            },
           
        },
        messages: {
            mss_name: {
              required: "Nama foto harus di isi"
            },
           
        }
    });
});
</script>
@endpush


