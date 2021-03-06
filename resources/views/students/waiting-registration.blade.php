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
        .conatiner footer{
          margin-top: 10px;
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
<div style="margin-top:80px; width: 100%;" class="col-lg-10 text-center">
    <div class="card " style="box-shadow: 10px 10px 8px skyblue;">
        <div class="card-body atas" style="background-color: #599be2;">
            <h4 style="color: white; text-shadow: 1px 1px 2px white;"> DATA ANDA SUDAH TERSIMPAN</h4>
            <h5 style="color: white; text-shadow: 1px 1px 2px white;" >Data anda akan di proses, Mohon tunggu konfirmasi dari pihak sekolah.</h5>
            <h5 style="color: white; text-shadow: 1px 1px 2px white;" >Info lebih lanjut silahkan klik <a href="{{ url('download/download-file') }}"><i style="color: white;"><u>Disini</u></i></a></h5>
            <h5 style="color: white; text-shadow: 1px 1px 2px white;" >Untuk Informasi Rincian Biaya PPDB silahkan klik <a href="{{ url('download/download-file-PPDB') }}"><i style="color: white;"><u>Disini</u></i></a></h5>
        </div>
    </div>
</div>
</center>
<div class="row">
        <div class="col-lg-5">
          <div class="card haha">
            <div class="card-body">
              <h5 class="card-title">Data Calon Siswa</h5>
              <div class="table-responsive">
               <table class=" table table-active">
                
                <tbody>
                  <tr>
                    <th >Nama Lengkap</th>
                    <td>:</td>
                    <td>{{ $student_prospective->stu_candidate_name }}</td>
                  </tr>

                  <tr>
                    <th>Email</th>
                    <td>:</td>
                    <td>{{ $student_prospective->usr_email }}</td>
                  </tr>

                  <tr>
                    <th>Jenis Kelamin</th>
                    <td>:</td>
                    <td>{{ $student_prospective->usr_gender }}</td>
                  </tr>
                  @if(isset($student_prospective->personal['nik']))
                  <tr>
                    <th>NIK Siswa</th>
                    <td>:</td>
                    <td>{{ $student_prospective->personal['nik'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->stu_nisn))
                  <tr>
                    <th>NISN</th>
                    <td>:</td>
                    <td>{{ $student_prospective->stu_nisn }}</td>
                  </tr>
                  @endif
                  <tr>
                    <th>No Telepon</th>
                    <td>:</td>
                    <td>{{ $student_prospective->usr_phone_number }}</td>
                  </tr>

                  <tr>
                    <th >No WhattsApp</th>
                    <td>:</td>
                    <td>{{ $student_prospective->usr_whatsapp_number }}</td>
                  </tr>
                  <tr>
                    <th>Tempat Lahir</th>
                    <td>:</td>
                    <td>{{ $student_prospective->usr_place_of_birth }}</td>
                  </tr>

                  <tr>
                    <th>Tanggal Lahir</th>
                    <td>:</td>
                    <td>{{ getDateOfBirth($student_prospective->usr_date_of_birth) }}</td>
                  </tr>

                  @if(isset($student_prospective->personal['birth_certificate_registration_no']))
                  <tr>
                    <th>No Registrasi Akta Lahir</th>
                    <td>:</td>
                    <td>{{ $student_prospective->personal['birth_certificate_registration_no'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->personal['living_together']))
                  <tr>
                    <th>Tinggal Bersama</th>
                    <td>:</td>
                    <td>{{ $student_prospective->personal['living_together'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->personal['status_of_residence']))
                  <tr>
                    <th>Status Tempat Tinggal</th>
                    <td>:</td>
                    <td>{{ $student_prospective->personal['status_of_residence'] }}</td>
                  </tr>
                  @endif
                  <tr>
                    <th>Asal Sekolah</th>
                    <td>:</td>
                    <td>{{ $student_prospective->stu_school_origin }}</td>
                  </tr> 
                  @if(isset($student_prospective->school_origin['npsn']))
                  <tr>
                    <th>NPSN Asal Sekolah</th>
                    <td>:</td>
                    <td>{{ $student_prospective->school_origin['npsn'] }}</td>
                  </tr>
                  @endif
                  <tr>
                    <th>Jurusan yang diminati</th>
                    <td>:</td>
                    <td>{{ $student_prospective->mjr_name }}</td>
                  </tr>
                  @if(isset($student_prospective->personal['child']))
                  <tr>
                    <th>Anak Ke</th>
                    <td>:</td>
                    <td>{{ $student_prospective->personal['child'] }}</td>
                  </tr>
                  @endif
                  <tr>
                    <th>Agama</th>
                    <td>:</td>
                    <td>{{ $student_prospective->usr_religion }}</td>
                  </tr>
                  
                </tbody>
              </table>
            </div>
            </div>
          
         @if(isset($student_prospective->father_data))
         <div class="card-body">
              <h5 class="card-title"> Data Ayah </h5>
              <div class="table-responsive">
                <table class="table table-active">
                  <tbody>
                  @if(isset($student_prospective->father_data['name']))
                  <tr>
                    <th>Nama Ayah kandung</th>
                    <td>:</td>
                    <td>{{ $student_prospective->father_data['name'] }}</td>
                  </tr>
                  @endif

                  @if(isset($student_prospective->father_data['father_name']))
                  <tr>
                    <th>Nama Ayah Sesuai Ijazah</th>
                    <td>:</td>
                    <td>{{ $student_prospective->father_data['father_name'] }}</td>
                  </tr>
                  @endif

                  @if(isset($student_prospective->father_data['nik']))
                  <tr>
                    <th>NIK</th>
                    <td>:</td>
                    <td>{{ $student_prospective->father_data['nik'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->father_data['year_of_birth']))
                  <tr>
                    <th>Tahun lahir</th>
                    <td>:</td>
                    <td>{{ $student_prospective->father_data['year_of_birth'] }}</td>
                  </tr>
                  @endif

                  @if(isset($student_prospective->father_data['education']))
                  <tr>
                    <th>Pendidikan terakhir</th>
                    <td>:</td>
                    <td>{{ $student_prospective->father_data['education'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->father_data['profession']))
                  <tr>
                    <th>Pekerjaan</th>
                    <td>:</td>
                    <td>{{ $student_prospective->father_data['profession'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->father_data['monthly_income']))
                  <tr>
                    <th>Pendapatan perbulan</th>
                    <td>:</td>
                    <td>{{ $student_prospective->father_data['monthly_income'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->father_data['phone_number']))
                  <tr>
                    <th>Nomor telepon</th>
                    <td>:</td>
                    <td>{{ $student_prospective->father_data['phone_number'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->father_data['disability']))
                  <tr>
                    <th>Disabilitas</th>
                    <td>:</td>
                    <td>{{ $student_prospective->father_data['disability'] }}</td>
                  </tr>   
                  @endif               
               </tbody>
                </table>
              </div>
            </div>
            @endif
            @if(isset($student_prospective->mother_data))
             <div class="card-body">
              <h5 class="card-title"> Data Ibu </h5>
              <div class="table-responsive">
                <table class="table table-active">
                  <tbody>
                  @if(isset($student_prospective->mother_data['name']))
                  <tr>
                    <th>Nama Ibu kandung</th>
                    <td>:</td>
                    <td>{{ $student_prospective->mother_data['name'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->mother_data['nik']))
                  <tr>
                    <th>NIK</th>
                    <td>:</td>
                    <td>{{ $student_prospective->mother_data['nik'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->mother_data['year_of_birth']))
                  <tr>
                    <th>Tahun lahir</th>
                    <td>:</td>
                    <td>{{ $student_prospective->mother_data['year_of_birth'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->mother_data['education']))
                  <tr>
                    <th>Pendidikan terakhir</th>
                    <td>:</td>
                    <td>{{ $student_prospective->mother_data['education'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->mother_data['profession']))
                  <tr>
                    <th>Pekerjaan</th>
                    <td>:</td>
                    <td>{{ $student_prospective->mother_data['profession'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->mother_data['monthly_income']))
                  <tr>
                    <th>Pendapatan perbulan</th>
                    <td>:</td>
                    <td>{{ $student_prospective->mother_data['monthly_income'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->mother_data['phone_number']))
                  <tr>
                    <th>Nomor telepon</th>
                    <td>:</td>
                    <td>{{ $student_prospective->mother_data['phone_number'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->mother_data['disability']))
                  <tr>
                    <th>Disabilitas</th>
                    <td>:</td>
                    <td>{{ $student_prospective->mother_data['disability'] }}</td>
                  </tr> 
                  @endif             
                </tbody>
                </table>
              </div>
            </div>
            @endif
            @if(isset($student_prospective->guardian_data))
             <div class="card-body">
              <h5 class="card-title"> Data Wali </h5>
              <div class="table-responsive">
                <table class="table table-active">
                  
                  <tbody>
                  @if(isset($student_prospective->guardian_data['name']))
                  <tr>
                    <th>Nama</th>
                    <td>:</td>
                    <td>{{ $student_prospective->guardian_data['name'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->guardian_data['nik']))
                  <tr>
                    <th>NIK</th>
                    <td>:</td>
                    <td>{{ $student_prospective->guardian_data['nik'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->guardian_data['year_of_birth']))
                  <tr>
                    <th>Tahun lahir</th>
                    <td>:</td>
                    <td>{{ $student_prospective->guardian_data['year_of_birth'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->guardian_data['education']))
                  <tr>
                    <th>Pendidikan terakhir</th>
                    <td>:</td>
                    <td>{{ $student_prospective->guardian_data['education'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->guardian_data['profession']))

                  <tr>
                    <th>Pekerjaan</th>
                    <td>:</td>
                    <td>{{ $student_prospective->guardian_data['profession'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->guardian_data['monthly_income']))
                  <tr>
                    <th>Pendapatan perbulan</th>
                    <td>:</td>
                    <td>{{ $student_prospective->guardian_data['monthly_income'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->guardian_data['phone_number']))
                  <tr>
                    <th>Nomor telepon</th>
                    <td>:</td>
                    <td>{{ $student_prospective->guardian_data['phone_number'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->guardian_data['disability']))
                  <tr>
                    <th>Disabilitas</th>
                    <td>:</td>
                    <td>{{ $student_prospective->guardian_data['disability'] }}</td>
                  </tr> 
                  @endif             
                </tbody>
                </table>
              </div>
            </div>
            @endif
    </div>
    </div>
        
   
      <div class="col-lg-5">
          <div class="card hihi">
              <div class="card-body">
              <h5 class="card-title">Data Domisili</h5>
              <div class="table-responsive">
               <table class="table table-active">       
                <tbody>
                  @foreach($student as $data)
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
                    <td>{{ $student_prospective->usr_address }}</td>
                  </tr>

                  <tr>
                    <th >RT</th>
                    <td>:</td>
                    <td>{{ $student_prospective->usr_rt }}</td>
                  </tr>
                  <tr>
                    <th>RW</th>
                    <td>:</td>
                    <td>{{ $student_prospective->usr_rw }}</td>
                  </tr>

                  <tr>
                    <th >Desa/Kelurahan</th>
                    <td>:</td>
                    <td>{{ $student_prospective->usr_rural_name }}</td>
                  </tr>
                  <tr>
                    <th>Kode pos</th>
                    <td>:</td>
                    <td>{{ $student_prospective->usr_postal_code }}</td>
                  </tr>
                  @if(isset($student_prospective->contact['living_together']))
                  <tr>
                    <th >Telepon rumah</th>
                    <td>:</td>
                    <td>{{ $student_prospective->contact['living_together'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->contact['email']))
                  <tr>
                    <th>Email rumah</th>
                    <td>:</td>
                    <td>{{ $student_prospective->contact['email'] }}</td>
                  </tr>
                  @endif
                </tbody>
            </table>
        </div>
        </div>
            @if(isset($student_prospective->achievement))
            <div class="card-body">
              <h5 class="card-title"> Prestasi </h5>
              <div class="table-responsive">
                <table class="table table-active">     
                  <tbody>
                  @if(isset($student_prospective->achievement['type']))
                  <tr>
                    <th>Jenis / Tipe prestasi</th>
                    <td>:</td>
                    <td>{{ $student_prospective->achievement['type'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->achievement['achievement_level']))
                  <tr>
                    <th scope="row">Tingkat</th>
                    <td>:</td>
                    <td>{{ $student_prospective->achievement['achievement_level'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->achievement['achievement_name']))
                  <tr>
                    <th>Nama prestasi</th>
                    <td>:</td>
                    <td>{{ $student_prospective->achievement['achievement_name'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->achievement['year']))
                  <tr>
                    <th>Tahun</th>
                    <td>:</td>
                    <td>{{ $student_prospective->achievement['year'] }}</td>
                  </tr>
                  @endif
                  @if(isset($student_prospective->achievement['organizer']))
                  <tr>
                    <th>Penyelenggara</th>
                    <td>:</td>
                    <td>{{ $student_prospective->achievement['organizer'] }}</td>
                  </tr>
                  @endif
              </tbody>
          </table>
      </div>
    </div>
    @endif
    <div class="card-body">
              <h5 class="card-title"> Lainnya </h5>
              <div class="table-responsive">
                <table class="table table-active">
                  <body>
                      <tr>
                        <th>Rekomendasi Dari</th>
                        <td>:</td>
                        @if(isset($student_prospective->other['recomended_form']))
                        <td>{{ $student_prospective->other['recomended_from'] }}</td>
                        @endif
                      </tr>
                      
                      <tr>
                        <th scope="row">
                          Foto Calon siswa</th>
                        <td>:</td>
                        <td>
                          @if(isset($student_prospective->usr_profile_picture))
                          <img src="{{ asset($student_prospective->usr_profile_picture)}}" class="img-thumbnail profile" alt="Profile Picture"/>
                          @else                  
                          <img src="{{ asset('images/default_profile_picture_20210228.png')}}" class="img-thumbnail profile" alt="Profile Picture"/>
                          @endif
                        </td>
                      </tr> 
                    <tr>
                        <th scope="row">
                            Surat Tanda Kelulusan SMP dilegalisir</th>
                        <td>:</td>
                        <td>
                        @if(isset($student_prospective->other['certificate_of_graduation']))
                        <a href="{{ url('download-file-student/'. $student_prospective->other['certificate_of_graduation']) }}">
                        {{ $student_prospective->other['certificate_of_graduation'] }}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            Ijazah SMP/MTs dilegalisir</th>
                        <td>:</td>
                        <td>
                        @if(isset($student_prospective->other['junior_high_school_diploma']))
                        <a href="{{ url('download-file-student/'. $student_prospective->other['junior_high_school_diploma']) }}">
                        {{ $student_prospective->other['junior_high_school_diploma'] }}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            Ijazah SD/Mi dilegalisir</th>
                        <td>:</td>
                        <td>
                        @if(isset($student_prospective->other['elementary_school_diploma']))
                        <a href="{{ url('download-file-student/'. $student_prospective->other['elementary_school_diploma']) }}">
                        {{ $student_prospective->other['elementary_school_diploma'] }}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            Akte Kelahiran</th>
                        <td>:</td>
                        <td>
                        @if(isset($student_prospective->other['birth_certificate']))
                        <a href="{{ url('download-file-student/'. $student_prospective->other['birth_certificate']) }}">
                        {{ $student_prospective->other['birth_certificate'] }}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            Kartu Keluarga</th>
                        <td>:</td>
                        <td>
                        @if(isset($student_prospective->other['family_card']))
                        <a href="{{ url('download-file-student/'. $student_prospective->other['family_card']) }}">
                        {{ $student_prospective->other['family_card'] }}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            Keterangan Domisili</th>
                        <td>:</td>
                        <td>
                        @if(isset($student_prospective->other['domicile_statement']))
                        <a href="{{ url('download-file-student/'. $student_prospective->other['domicile_statement']) }}">
                        {{ $student_prospective->other['domicile_statement'] }}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            KTP Ayah</th>
                        <td>:</td>
                        <td>
                        @if(isset($student_prospective->other['id_card_father']))
                        <a href="{{ url('download-file-student/'. $student_prospective->other['id_card_father']) }}">
                        {{ $student_prospective->other['id_card_father'] }}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            KTP Ibu</th>
                        <td>:</td>
                        <td>
                        @if(isset($student_prospective->other['id_card_mother']))
                        <a href="{{ url('download-file-student/'. $student_prospective->other['id_card_mother']) }}">
                        {{ $student_prospective->other['id_card_mother'] }}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            Surat Kesehatan Badan</th>
                        <td>:</td>
                        <td>
                        @if(isset($student_prospective->other['health_certificate']))
                        <a href="{{ url('download-file-student/'. $student_prospective->other['health_certificate']) }}">
                        {{ $student_prospective->other['health_certificate'] }}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            Surat Kesehatan Mata</th>
                        <td>:</td>
                        <td>
                        @if(isset($student_prospective->other['eye_health_letter']))
                        <a href="{{ url('download-file-student/'. $student_prospective->other['eye_health_letter']) }}">
                        {{ $student_prospective->other['eye_health_letter'] }}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            Kartu PIP/KIP/Keterangan Kematian</th>
                        <td>:</td>
                        <td>
                        @if(isset($student_prospective->other['card']))
                        <a href="{{ url('download-file-student/'. $student_prospective->other['card']) }}">
                        {{ $student_prospective->other['card'] }}
                        @endif
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row">
                            Sertifikat/Piagam Penghargaan</th>
                        <td>:</td>
                        <td>
                        @if(isset($student_prospective->other['certificate']))
                        <a href="{{ url('download-file-student/'. $student_prospective->other['certificate']) }}">
                        {{ $student_prospective->other['certificate'] }}
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


      
