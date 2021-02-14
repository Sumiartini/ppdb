@extends('layouts.master')

@push('title')
- Detail Guru
@endpush

@push('styles')
<!--favicon-->
<link rel="icon" href="{{ URL::to('assets/images/favicon.ico')}}" type="image/x-icon">
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
@if($teacher->tcr_registration_status == 1)
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
        <h4 class="page-title">Detail Guru</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">SMK Mahaputra</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/students/')}}">Daftar Guru </a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Guru</li>
        </ol>
    </div>
</div>

@elseif($teacher->tcr_registration_status == 0)
<div class="row pt-2 pb-2">
  <div class="col-sm-9">
    <h4 class="page-title">Daftar Calon Guru</h4>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">SMK Mahaputra</a></li>
      <li class="breadcrumb-item"><a href="{{ url('/students-prospective')}}">Daftar Calon Guru</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail Calon Guru</li>
  </ol>
</div>
</div>

@else
<div class="row pt-2 pb-2">
  <div class="col-sm-9">
    <h4 class="page-title">Daftar Guru Ditolak</h4>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">SMK Mahaputra</a></li>
      <li class="breadcrumb-item"><a href="{{ url('/students-rejected')}}">Daftar Guru Ditolak</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail Guru Ditolak</li>
  </ol>
</div>
</div>
@endif

<!-- <div class="col-lg-12">
    <div class="profile-card-3 ">
        <div class="text-center">
            <img src="{{ url('assets/images/avatars/avatar-2.png')}}" alt="user avatar" class="card-img-top" style="width: 200px;
            height: 200px;
            background: #dac52c;
            border-radius: 100%;">
        </div>
        <hr>
    </div>
</div> -->

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
</div>


<div class="row">
        <div class="col-lg-4">
           <div class="profile-card-3">
            <div class="card">
             <div class="user-fullimage text-center">
               <img src="{{ asset($teacher->usr_profile_picture)}}" alt="user avatar" class="card-img-top" style="margin-top: 40px; width: 200px; height: 200px;">
<!--                 <div class="details">
                  <h5 class="mb-1 text-blue ml-3">{{ $teacher->stu_candidate_name }}</h5>
                  <h6 class="text-blue ml-3">{{ $teacher->usr_email }}</h6>
                 </div> -->
              </div>
              <div class="card-body">
                <div class="row" style="margin-top: 30px;">
                    <div class="col-lg-4">
                        <a href="">
                        <i class="fa fa-file-text-o fa-3x" aria-hidden="true" style="margin-left: 20px;"></i>
                        </a>
                    </div>
                    <div class="col-lg-8" style="text-align: left; font-weight: bold; margin-left: -30px; margin-top: 5px;">
                        <p>Kartu Tanda Penduduk (KTP)</p> 
                    </div>     
                </div>
            </div>  
            <div class="card-body">
                <div class="row" style="margin-top: 30px;">
                    <div class="col-lg-4">
                        <a href="">
                        <i class="fa fa-file-text-o fa-3x" aria-hidden="true" style="margin-left: 20px;"></i>
                        </a>
                    </div>
                    <div class="col-lg-8" style="text-align: left; font-weight: bold; margin-left: -30px; margin-top: 5px;">
                        <p>Kartu Keluarga</p> 
                    </div>     
                </div>
            </div>  
            <div class="card-body">
                <div class="row" style="margin-top: 30px;">
                    <div class="col-lg-4">
                        <a href="">
                        <i class="fa fa-file-text-o fa-3x" aria-hidden="true" style="margin-left: 20px;"></i>
                        </a>
                    </div>
                    <div class="col-lg-8" style="text-align: left; font-weight: bold; margin-left: -30px; margin-top: 5px;">
                        <p>Surat Tanda Kelulusan Minimal D4/S1 dilegalisir </p> 
                    </div>     
                </div>
            </div>  
            <div class="card-body">
                <div class="row" style="margin-top: 30px;">
                    <div class="col-lg-4">
                        <a href="">
                        <i class="fa fa-file-text-o fa-3x" aria-hidden="true" style="margin-left: 20px;"></i>
                        </a>
                    </div>
                    <div class="col-lg-8" style="text-align: left; font-weight: bold; margin-left: -30px; margin-top: 5px;">
                        <p>Curriculum vitae (CV)</p> 
                    </div>     
                </div>
            </div>  
            <div class="card-body">
                <div class="row" style="margin-top: 30px;">
                    <div class="col-lg-4">
                        <a href="">
                        <i class="fa fa-file-text-o fa-3x" aria-hidden="true" style="margin-left: 20px;"></i>
                        </a>
                    </div>
                    <div class="col-lg-8" style="text-align: left; font-weight: bold; margin-left: -30px; margin-top: 5px;">
                        <p>Surat Lamaran</p> 
                    </div>     
                </div>
            </div>  
            <div class="card-body">
                <div class="row" style="margin-top: 30px;">
                    <div class="col-lg-4">
                        <a href="">
                        <i class="fa fa-file-text-o fa-3x" aria-hidden="true" style="margin-left: 20px;"></i>
                        </a>
                    </div>
                    <div class="col-lg-8" style="text-align: left; font-weight: bold; margin-left: -30px; margin-top: 5px;">
                        <p>Resume</p> 
                    </div>     
                </div>
            </div> 

            </div>
            </div>
        </div>
            <div class="col-lg-8">
           <div class="card">
            <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#guru" data-toggle="pill" class="nav-link active show"><i class="icon-user"></i> <span class="hidden-xs">Guru</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#persuratan" data-toggle="pill" class="nav-link"><i class="icon-envelope-open"></i> <span class="hidden-xs">Persuratan</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#pendidikan" data-toggle="pill" class="nav-link"><i class="icon-book-open"></i> <span class="hidden-xs">Riwayat Pendidikan</span></a>
                </li>
                
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#mengajar" data-toggle="pill" class="nav-link"><i class="ti-id-badge"></i> <span class="hidden-xs">Riwayat Mengajar</span></a>
                </li>
                
            </ul> 
            <div class="tab-content p-3">
                <div class="tab-pane active show" id="guru"> 
                    
                    <div class="row">

                        <dt class="col-sm-5">Nama Guru</dt>
                        <dd class="col-sm-7">
                            <p>{{ $teacher->usr_name }}</p>
                        </dd>
                        @if(isset($student->personal['nik']))
                        <dt class="col-sm-5">NIK</dt>
                        <dd class="col-sm-7">
                            <p>{{ $teacher->personal['nik'] }}</p>
                        </dd>
                        @endif
                        <dt class="col-sm-5">NUPTK</dt>
                        <dd class="col-sm-7">
                            <p>{{ $teacher->tcr_nuptk }}</p>
                        </dd>
                        <dt class="col-sm-5">Tempat Lahir</dt>
                        <dd class="col-sm-7">
                            <p>{{ $teacher->usr_place_of_birth }}</p>
                        </dd>
                        <dt class="col-sm-5">Tanggal Lahir</dt>
                        <dd class="col-sm-7">
                            <p>{{ $teacher->usr_date_of_birth}}</p>
                        </dd>
                        <dt class="col-sm-5">Agama</dt>
                        <dd class="col-sm-7">
                            <p>{{ $teacher->usr_religion }}</p>
                        </dd>
                        <dt class="col-sm-5">Jenis Kelamin</dt>
                        <dd class="col-sm-7">
                            <p>{{ $teacher->usr_gender}}</p>
                        </dd>
                        <dt class="col-sm-5">No. WhatsApp </dt>
                        <dd class="col-sm-7">
                            <p>{{ $teacher->usr_whatsapp_number }}</p>
                        </dd>
                    </div>
                </div>

                <div class="tab-pane" id="persuratan">
                    
                    <div class="row">

                        @foreach($user as $data)
                        <dt class="col-sm-5">Provinsi</dt>
                        <dd class="col-sm-7">
                            <p>{{ $data->prv_name }}</p>
                        </dd>

                        <dt class="col-sm-5">Kota / Kabupaten</dt>
                        <dd class="col-sm-7">
                            <p>{{ $data->cit_name }}</p>
                        </dd>

                        <dt class="col-sm-5">Kecamatan</dt>
                        <dd class="col-sm-7">
                            <p>{{ $data->dst_name }}</p>
                        </dd>
                        @endforeach

                        <dt class="col-sm-5">Alamat</dt>
                        <dd class="col-sm-7">
                            <p>{{ $teacher->usr_address }}</p>
                        </dd>

                        <dt class="col-sm-5">RT</dt>
                        <dd class="col-sm-7">
                            <p>{{ $teacher->usr_rt }}</p>
                        </dd>

                        <dt class="col-sm-5">RW</dt>
                        <dd class="col-sm-7">
                            <p>{{ $teacher->usr_rw }}</p>
                        </dd>

                        <dt class="col-sm-5">Desa / Kelurahan </dt>
                        <dd class="col-sm-7">
                            <p>{{ $teacher->usr_rural_name }}</p>
                        </dd>

                        <dt class="col-sm-5">Kode Pos</dt>
                        <dd class="col-sm-7">
                            <p>{{ $teacher->usr_postal_code }}</p>
                        </dd>
                    </div>
                </div>

                <div class="tab-pane" id="pendidikan">             
                    
                    <div class="row">

                        <dt class="col-sm-5">Nama SD/Sederajat</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->educational_background['grade_school']}}</p>
                        </dd>
                        <dt class="col-sm-5">Tahun SD/Sederajat</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->educational_background['year_grade_school']}}</p>
                        </dd>
                        <dt class="col-sm-5">Nama SMP/Sederajat</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->educational_background['junior_high_school']}}</p>
                        </dd>
                        <dt class="col-sm-5">Tahun SMP/Sederajat</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->educational_background['year_junior_high_school']}}</p>
                        </dd>
                        <dt class="col-sm-5">Nama SMA/Sederajat</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->educational_background['senior_high_school']}}</p>
                        </dd>
                        <dt class="col-sm-5">Tahun SMA/Sederajat</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->educational_background['year_senior_high_school']}}</p>
                        </dd>
                        <dt class="col-sm-5">Nama Perguruan Tinggi</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->educational_background['college']}}</p>
                        </dd>
                        <dt class="col-sm-5">Tahun Perguruan Tinggi</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->educational_background['year']}}</p>
                        </dd>
                        <dt class="col-sm-5">Nama Fakultas</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->educational_background['faculty_name']}}</p>
                        </dd>
                        <dt class="col-sm-5">Nama Jurusan</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->educational_background['faculty_major']}}</p>
                        </dd>
                        <dt class="col-sm-5">Tahun Lulus</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->educational_background['year']}}</p>
                        </dd>
                        <dt class="col-sm-5">Gelar</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->educational_background['degree']}}</p>
                        </dd>
                    </div>
                 </div>

                  <div class="tab-pane" id="mengajar">             
                    
                    <div class="row">
                        <dt class="col-sm-5">Nama Sekolah</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->teaching_history['school_name']}}</p>
                        </dd>
                        <dt class="col-sm-5">Mata Pelajaran</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->teaching_history['subject']}}</p>
                        </dd>
                            <dt class="col-sm-5">Kelas/Tingkat</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->teaching_history['grade_or_level']}}</p>
                        </dd>
                        <dt class="col-sm-5">Jumlah Jam</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->teaching_history['number_of_hours']}}</p>
                        </dd>
                        <dt class="col-sm-5">Dari Tahun/Sampai</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->teaching_history['from_year_to_year']}}</p>
                        </dd>
                        <dt class="col-sm-5">Status</dt>
                        <dd class="col-sm-7">
                            <p>{{$teacher->teaching_history['status']}}</p>
                        </dd>
                    </div>
                 </div>
                
            </div>
        </div>
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