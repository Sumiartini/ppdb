@extends('layouts.masterFront')

@push('title')
- Tunggu Konfirmasi
@endpush

@push('styles')
<!-- simplebar CSS-->
<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet">
<!-- Bootstrap core CSS-->
<link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
<!-- animate CSS-->
<link href="{{ asset('assets/css/animate.css')}}" rel="stylesheet" type="text/css">
<!--Bootstrap Datepicker-->
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
<!-- Icons CSS-->
<link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
<!-- Sidebar CSS-->
<link href="{{ asset('assets/css/sidebar-menu.css')}}" rel="stylesheet">
<!-- Custom Style-->
<link href="{{ asset('assets/css/app-style.css')}}" rel="stylesheet">
<style>
    html , body{
    max-width: 100%;
    overflow-x: hidden;
    }
    footer{
      bottom: 0px;
      color: #272727;
      text-align: center;
      padding: 12px 30px;
      right: 0;
      left: 0;
      background-color: #f9f9f9;
      border-top: 1px solid rgb(223, 223, 255);
      -webkit-transition: all 0.3s ease;
      -moz-transition: all 0.3s ease;
      -o-transition: all 0.3s ease;
      transition: all 0.3s ease; 
    }
    .atas{
       padding: 20px 5px;
    }
    .haha {
        margin-right:40px;
        margin-left:40px;
      }
    .hihi {
      margin-right:40px;
      margin-left:40px;
    }
    .profile{
        object-fit: cover;
        width: 200px;
        height: 200px;
    }
    h4, h5{
      font-size: 18px;
    }
    /*desktop version*/
    @media (min-width: 992px){

    .haha {
        margin-left: 50px;
        margin-right: -110px;
      }
    .hihi {
      margin-left:120px;
      margin-right: -180px;
    }

    }

    /* Untuk Smartphone */
    @media all and (max-width: 670px) {
      .profile{
          object-fit: cover;
          width: 145px;
          height: 140px;
      }
    }

</style>
@endpush
@section('content')

<center>
<div style="margin-top:80px; " class="col-lg-10">
    <div class="card " style="box-shadow: 10px 10px 8px skyblue;">
        <div class="card-body atas" style="background-color: #599be2;">
            <h4 style="color: white; text-shadow: 1px 1px 2px white;"> DATA ANDA SUDAH TERSIMPAN</h4>
            <h5 style="color: white; text-shadow: 1px 1px 2px white;" >Data anda akan di proses, Mohon tunggu konfirmasi dari pihak sekolah.</h5>          
        </div>
    </div>
</div>
</center>

<div class="row">
        <div class="col-lg-5">
          <div class="card haha">
            <div class="card-body">
              <h5 class="card-title">Biodata Diri</h5>
              <div class="table-responsive">
               <table class=" table table-active">
                
                <tbody>
                  <tr>
                    <th >Nama Lengkap</th>
                    <td>:</td>
                    <td>{{ $teacher_prospective->usr_name }}</td>
                  </tr>
                  @if(isset($teacher_prospective->personal['nik']))
                  <tr>
                      <th>NIK</th>
                      <td>:</td>
                      <td>{{ $teacher_prospective->personal['nik']}}</td>
                  </tr>
                  @endif
                  @if(isset($teacher_prospective->tcr_nuptk))
                  <tr>
                      <th>NUPTK</th>
                      <td>:</td>
                      <td>{{ $teacher_prospective->tcr_nuptk }}</td>
                  </tr>
                  @endif
                  <tr>
                      <th>Tempat Lahir</th>
                      <td>:</td>
                      <td>{{ $teacher_prospective->usr_place_of_birth}}</td>
                  </tr>

                  <tr>
                      <th>Tanggal Lahir</th>
                      <td>:</td>
                      <td>{{ getDateOfBirth($teacher_prospective->usr_date_of_birth) }}</td>
                  </tr>

                  <tr>
                      <th>Agama</th>
                      <td>:</td>
                      <td>{{ $teacher_prospective->usr_religion}}</td>
                  </tr>

                  <tr>
                      <th>Jenis Kelamin</th>
                      <td>:</td>
                      <td>{{ $teacher_prospective->usr_gender}}</td>
                  </tr>
                 
                  <tr>
                      <th>No. WhatsApp</th>
                      <td>:</td>
                      <td>{{ $teacher_prospective->usr_whatsapp_number}}</td>
                  </tr>
                  
            </tbody>
              </table>
            </div>
            </div>

        <div class="card-body">
              <h5 class="card-title">Data Domisili</h5>
              <div class="table-responsive">
               <table class="table table-active">       
                <tbody>
                  @foreach($teacher as $data)
                  <tr>
                    <th >Provinsi</th>
                    <td>:</td>
                    <td>{{$data->prv_name}}</td>
                  </tr>
                  <tr>
                    <th>Kota/Kabupaten</th>
                    <td>:</td>
                    <td>{{$data->cit_name}}</td>
                  </tr>

                  <tr>
                    <th >Kecamatan</th>
                    <td>:</td>
                    <td>{{$data->dst_name}}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <th>Alamat</th>
                    <td>:</td>
                    <td>{{ $teacher_prospective->usr_address }}</td>
                  </tr>

                  <tr>
                    <th >RT</th>
                    <td>:</td>
                    <td>{{ $teacher_prospective->usr_rt }}</td>
                  </tr>
                  <tr>
                    <th>RW</th>
                    <td>:</td>
                    <td>{{ $teacher_prospective->usr_rw }}</td>
                  </tr>

                  <tr>
                    <th >Desa/Kelurahan</th>
                    <td>:</td>
                    <td>{{ $teacher_prospective->usr_rural_name }}</td>
                  </tr>
                  <tr>
                    <th>Kode pos</th>
                    <td>:</td>
                    <td>{{ $teacher_prospective->usr_postal_code }}</td>
                  </tr>
                  
                </tbody>
            </table>
        </div>
        </div>

            <div class="card-body">
                <h5 class="card-title"> Riwayat Pendidikan </h5>
                <div class="table-responsive">
                <table class="table table-active">
                  <tbody>
                    @if(isset($teacher_prospective->educational_background['year_grade_school']))
                    <tr>
                        <th>Tahun SD/Sederajat</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->educational_background['year_grade_school'] }}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->educational_background['grade_school']))
                    <tr>
                        <th>Nama SD/Sederajat</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->educational_background['grade_school'] }}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->educational_background['year_junior_high_school']))
                    <tr>
                        <th>Tahun SMP/Sederajat</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->educational_background['year_junior_high_school'] }}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->educational_background['junior_high_school']))
                    <tr>
                        <th>Nama SMP/Sederajat</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->educational_background['junior_high_school'] }}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->educational_background['year_senior_high_school']))
                    <tr>
                        <th>Tahun SMA/Sederajat</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->educational_background['year_senior_high_school'] }}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->educational_background['senior_high_school']))
                    <tr>
                        <th>Nama SMA/Sederajat</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->educational_background['senior_high_school'] }}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->educational_background['college']))
                    <tr>
                      <th>Nama Perguruan Tinggi</th>
                      <td>:</td>
                      <td>{{$teacher_prospective->educational_background['college']}}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->educational_background['year_entry']))
                    <tr>
                        <th>Tahun Perguruan Tinggi</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->educational_background['year_entry'] }}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->educational_background['faculty_name']))
                    <tr>
                        <th>Nama Fakultas</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->educational_background['faculty_name'] }}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->educational_background['faculty_major']))
                    <tr>
                        <th>Nama Jurusan</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->educational_background['faculty_major'] }}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->educational_background['year_graduated']))
                    <tr>
                        <th>Tahun Lulus</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->educational_background['year_graduated'] }}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->educational_background['degree']))
                    <tr>
                        <th>Gelar</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->educational_background['degree'] }}</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
                </div>
            </div>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="card hihi">
            <div class="card-body">
                <h5 class="card-title"> Riwayat Mengajar </h5>
                <div class="table-responsive">
                <table class="table table-active">
                  <tbody>
                    @if(isset($teacher_prospective->teaching_history['school_name']))
                    <tr>
                        <th>Nama Sekolah</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->teaching_history['school_name']}}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->teaching_history['subject']))
                    <tr>
                        <th>Mata Pelajaran</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->teaching_history['subject']}}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->teaching_history['grade_or_level']))
                    <tr>
                        <th>Kelas/Tingkat</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->teaching_history['grade_or_level']}}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->teaching_history['number_of_hours']))
                    <tr>
                        <th>Jumlah Jam</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->teaching_history['number_of_hours']}}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->teaching_history['from_year_to_year']))
                    <tr>
                        <th>Dari Tahun/Sampai</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->teaching_history['from_year_to_year']}}</td>
                    </tr>
                    @endif
                    @if(isset($teacher_prospective->teaching_history['status']))
                    <tr>
                        <th>Status</th>
                        <td>:</td>
                        <td>{{ $teacher_prospective->teaching_history['status']}}</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
                </div>
            </div>

            <div class="card-body">
              <h5 class="card-title"> Lainnya </h5>
              <div class="table-responsive">
                <table class="table table-active">
                  <body>
                       <tr>
                        <th scope="row">
                            Foto Calon Guru</th>
                        <td>:</td>
                        <td>
                        @if(isset($teacher_prospective->usr_profile_picture))
                        <img src="{{ asset($teacher_prospective->usr_profile_picture)}}" class="img-thumbnail profile" alt="Profile Picture"/>
                        @else                  
                        <img src="{{ asset('images/default_profile_picture_20210228.png')}}" class="img-thumbnail profile" alt="Profile Picture"/>
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Kartu Tanda Penduduk (KTP)</th>
                        <td>:</td>
                        <td>
                        @if(isset($teacher_prospective->other['identity_card']))
                        <a href="{{ url('download-file-teacher/'. $teacher_prospective->other['identity_card']) }}">
                        {{ $teacher_prospective->other['identity_card'] }}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            Kartu Keluarga</th>
                        <td>:</td>
                        <td>
                        @if(isset($teacher_prospective->other['family_card']))
                        <a href="{{ url('download-file-teacher/'. $teacher_prospective->other['family_card']) }}">
                        {{$teacher_prospective->other['family_card']}}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            Surat Tanda Kelulusan Minimal D4/S1 dilegalisir </th>
                        <td>:</td>
                        <td>
                        @if(isset($teacher_prospective->other['scholar_diploma']))
                        <a href="{{ url('download-file-teacher/'. $teacher_prospective->other['scholar_diploma']) }}">
                        {{$teacher_prospective->other['scholar_diploma']}}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            Curriculum vitae (CV)</th>
                        <td>:</td>
                        <td>
                        @if(isset($teacher_prospective->other['curriculum_vitae']))
                        <a href="{{ url('download-file-teacher/'. $teacher_prospective->other['curriculum_vitae']) }}">
                          {{$teacher_prospective->other['curriculum_vitae']}}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            Surat Lamaran</th>
                        <td>:</td>
                        <td>
                        @if(isset($teacher_prospective->other['application_letter']))
                        <a href="{{ url('download-file-teacher/'. $teacher_prospective->other['application_letter']) }}">
                        {{$teacher_prospective->other['application_letter'] }}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            Resume</th>
                        <td>:</td>
                        <td>
                        @if(isset($teacher_prospective->other['resume']))
                        <a href="{{ url('download-file-teacher/'. $teacher_prospective->other['resume']) }}">
                        {{$teacher_prospective->other['resume']}}
                        @endif
                        </td>
                    </tr>
                  </body>
                </table>
              </div>
            </div>

          </div>
        </div>
    </div>
@push('scripts')
<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
@endpush
@endsection
      
