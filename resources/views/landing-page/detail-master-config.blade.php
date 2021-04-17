@extends('layouts.master')

@push('title')
- Detail Konfigurasi
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
<link href="{{ asset('assets/css/app-style.css')}}" rel="stylesheet"/>
@endpush

@section('content')

<div class="row pt-2 pb-2">
  <div class="col-sm-9">
    <h4 class="page-title">Detail Konfigurasi</h4>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">{{ env('APP_NAME') }}</a></li>
      <li class="breadcrumb-item"><a href="{{ url('/master-slides')}}">Daftar Konfigurasi</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail Konfigurasi</li>
    </ol>
  </div>
</div>

  <div class="card">
    <div class="card-body">
      <h5 class="card-title text-primary">Data Konfigurasi</h5>
      <hr>  
      <div class="row" style="margin-top: 20px;">
      @foreach($master_config as $master_config)
      <dt class="col-sm-2">Nama</dt>
      <dd class="col-sm-10">
          <p>{{ $master_config->msc_name }}</p>
      </dd>

      <dt class="col-sm-2">Deskripsi</dt>
      <dd class="col-sm-10">
          <p>{{ $master_config->msc_description }}</p>
      </dd>

      <dt class="col-sm-2">Nama Video</dt>
      <dd class="col-sm-10">
          <p>{{ $master_config->msv_name }}</p>
      </dd>

      <dt class="col-sm-2">Video</dt>
      <dd class="col-sm-10">
          <iframe class="rounded" src="{{ $master_config->msv_file }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </dd>
       
      <dt class="col-sm-2">URL Video</dt>
      <dd class="col-sm-10">
          <p>{{ $master_config->msv_file }}</p>
      </dd>

      <dt class="col-sm-2">Visi Sekolah</dt>
      <dd class="col-sm-10">
          <p>{{ $master_config->msc_vision }}</p>
      </dd>

      <dt class="col-sm-2">Misi Sekolah</dt>
      <dd class="col-sm-10">
          <p>{{ $master_config->msc_mision }}</p>
      </dd>

      <dt class="col-sm-2">Foto</dt>
      <dd class="col-sm-10">
           <div class="user-fullimage ">
            <img src="{{ asset($master_config->msc_logo)}}" alt="user avatar"  class="card-img-top" style="margin-bottom: 10px; width: 200px; height: 200px;">
          </div>
      </dd>

      <dt class="col-sm-2">No telepon</dt>
      <dd class="col-sm-10">
          <p>{{ $master_config->msc_school_phone_number }}</p>
      </dd>
      <dd class="col-sm-12">  
          <a href="{{url('/master-config/edit/'.$master_config->msc_id)}}" class="btn btn-success" style="float: right;"> <i class="fa fa-edit fa-lg"></i>edit</a> 
      </dd>
      @endforeach
       </div>
     
   
      </div>
    </div>


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

</body>

@endpush