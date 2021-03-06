@extends('layouts.masterFront')

@push('title')
- Formulir Staf
@endpush

@push('styles')

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
<!-- select2 -->
<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<style>
   footer {
    color: #272727;
    text-align: center;
    padding: 12px 30px;
    margin-bottom: -10px;
    margin-top: 10px;
    border-top: 1px solid rgb(223, 223, 255);
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
</style>
</style>
@endpush
@section('content')

<div class="container-fluid" style="margin-top: 80px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-validate" autocomplete="off" method="POST" action="{{ url('staff-registration') }}" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        <h4 class="form-header text-uppercase">
                            <i class=""></i>
                            Biodata Diri
                        </h4>

                        <div class="form-group row">

                            <div class="col-sm-4">
                                <label>Nama Lengkap <span style="color:red;">*</span></label>
                                <input type="text" class="form-control form-control-rounded @error('usr_name') is-invalid @enderror" name="usr_name" placeholder="Masukan Nama Lengkap" value="{{ old('usr_name') }}">
                                @error('usr_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <label>NIK <span style="color:red;">*</span></label>
                                <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" class="form-control form-control-rounded @error('personal.nik') is-invalid @enderror"  name="personal[nik]" placeholder="Masukan NIK" value="{{ old('personal.nik') }}">
                                @error('personal.nik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <label>NUPTK</label>
                                <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" class="form-control form-control-rounded @error('stf_nuptk') is-invalid @enderror" name="stf_nuptk" placeholder="Masukan NUPTK" value="{{ old('stf_nuptk') }}">
                                @error('stf_nuptk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <p style="margin-top:5px; font-size: 12px;">( opsional )</p>    
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label>Tempat Lahir <span style="color:red;">*</span></label>
                                <input type="text" class="form-control form-control-rounded @error('usr_place_of_birth') is-invalid @enderror"  name="usr_place_of_birth" placeholder="Masukan Tempat Lahir" value="{{ old('usr_place_of_birth') }}">
                                @error('usr_place_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <label>Tanggal Lahir <span style="color:red;">*</span></label>
                                <input type="text" id="autoclose-datepicker" class="form-control form-control-rounded @error('usr_date_of_birth') is-invalid @enderror" name="usr_date_of_birth" placeholder="Tanggal/Bulan/Tahun" value="{{ old('usr_date_of_birth') }}">
                                @error('usr_date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <label> Agama <span style="color:red"> *</span></label>
                                <select class="form-control form-control-rounded @error('usr_religion') is-invalid @enderror" name="usr_religion" value="{{ old('usr_religion') }}">
                                    <option disabled="" {{ old('usr_religion') == "" ? 'selected' : '' }} > Pilih </option>
                                    <option {{ old('usr_religion') == "Islam" ? 'selected' : '' }}  value="Islam"> Islam </option>
                                    <option {{ old('usr_religion') == "Protestan" ? 'selected' : '' }}  value="Protestan"> Protestan </option>
                                    <option {{ old('usr_religion') == "Katolik" ? 'selected' : '' }}  value="Katolik"> Katolik </option>
                                    <option {{ old('usr_religion') == "Hindu" ? 'selected' : '' }}  value="Hindu"> Hindu </option>
                                    <option {{ old('usr_religion') == "Budha" ? 'selected' : '' }}  value="Budha"> Budha </option>
                                    <option {{ old('usr_religion') == "Khonghucu" ? 'selected' : '' }}  value="Khonghucu"> Khonghucu </option>
                                </select>
                                @error('usr_religion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label> Jenis Kelamin <span style="color:red"> *</span></label>
                                <select name="usr_gender" class="form-control form-control-rounded @error('usr_gender') is-invalid @enderror">
                                    <option disabled="" {{ old('usr_gender') == "" ? 'selected' : '' }}> Pilih </option>
                                    <option {{ old('usr_gender') == "Laki-Laki" ? 'selected' : '' }} value="Laki-laki"> Laki Laki </option>
                                    <option {{ old('usr_gender') == "Perempuan" ? 'selected' : '' }} value="Perempuan"> Perempuan </option>
                                </select>
                            @error('usr_gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            <div class="col-sm-4">
                                <label> No. WhatsApp <span style="color:red"> *</span></label>
                                <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" class="form-control form-control-rounded @error('usr_whatsapp_number') is-invalid @enderror" name="usr_whatsapp_number" placeholder="Masukan No. WhatsApp" value="{{ old('usr_whatsapp_number') }}" value="{{ old('usr_whatsapp_number') }}">
                                @error('usr_whatsapp_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <h4 class="form-header text-uppercase">
                            <i class=""></i>
                            Data Domisili
                        </h4>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label> Provinsi <span style="color:red"> *</span></label>

                                <select name="prv_name" class="form-control single-select form-control-rounded @error('prv_name') is-invalid @enderror" id="provinces">
                                    <option disabled="true" selected="true"> Pilih Provinsi </option>
                                    @foreach($province as $data)
                                    <option value="{{$data->prv_id}}">{{$data->prv_name}}</option>
                                    @endforeach
                                </select>
                                @error('prv_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <label> Kabupaten/Kota <span style="color:red"> *</span></label>

                                <select name="cit_name" class="form-control single-select form-control-rounded @error('cit_name') is-invalid @enderror" id="cities">
                                    <option disabled checked="true" selected="true"> Pilih Kabupaten/Kota </option>
                                </select>
                                @error('cit_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <label> Kecamatan <span style="color:red"> *</span></label>

                                <select name="dst_name" class="form-control single-select form-control-rounded @error('dst_name') is-invalid @enderror" id="districts">
                                    <option disabled checked="true" selected="true"> Pilih Kecamatan </option>
                                </select>
                                @error('dst_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-sm-4">
                                <label> Alamat <span style="color:red"> *</span></label>
                                <input type="text" name="usr_address" class="form-control form-control-rounded @error('usr_address') is-invalid @enderror" placeholder="Masukan Alamat" value="{{ old('usr_address') }}">
                                @error('usr_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-sm-2">
                                <label> RT <span style="color:red"> *</span></label>
                                <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" name="usr_rt" class="form-control form-control-rounded @error('usr_rt') is-invalid @enderror" placeholder="Masukan Nomor RT" value="{{ old('usr_rt') }}">
                                @error('usr_rt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label> RW <span style="color:red"> *</span></label>
                                <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" name="usr_rw" class="form-control form-control-rounded @error('usr_rw') is-invalid @enderror" placeholder="Masukan Nomor RW" value="{{ old('usr_rw') }}">
                                @error('usr_rw')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                               <label>Desa/Kelurahan<span style="color:red"> *</span></label>
                               <input type="text" name="usr_rural_name" class="form-control form-control-rounded @error('usr_rural_name') is-invalid @enderror" placeholder="Masukan Desa/Kelurahan" value="{{ old('usr_rural_name') }}">
                               @error('usr_rural_name')
                               <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label> Kode Pos <span style="color:red"> *</span></label>
                            <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" name="usr_postal_code" class="form-control form-control-rounded @error('usr_postal_code') is-invalid @enderror" placeholder="Masukan Kode Pos" value="{{ old('usr_postal_code') }}">
                            @error('usr_postal_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>                    
                    <h4 class="form-header text-uppercase">
                        <i class=""></i>
                        Riwayat Pendidikan
                    </h4>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Tahun SD/Sederajat <span style="color:red;">*</span></label>
                            <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" class="form-control form-control-rounded @error('educational_background.year_grade_school') is-invalid @enderror year_picker"  name="educational_background[year_grade_school]" placeholder="Masukan Tahun SD/Sederajat" value="{{ old('educational_background.year_grade_school') }}">
                            @error('educational_background.year_grade_school')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label>Nama SD/Sederajat <span style="color:red;">*</span></label>
                            <input type="text" class="form-control form-control-rounded @error('educational_background.grade_school') is-invalid @enderror"  name="educational_background[grade_school]" placeholder="Masukan Nama SD/Sederajat" value="{{ old('educational_background.grade_school') }}">
                            @error('educational_background.grade_school')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-sm-4">
                            <label>Tahun SMP/Sederajat <span style="color:red;">*</span></label>
                            <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" class="form-control form-control-rounded @error('educational_background.year_junior_high_school') is-invalid @enderror year_picker"  name="educational_background[year_junior_high_school]" placeholder="Masukan Tahun SMP/Sederajat" value="{{ old('educational_background.year_junior_high_school') }}">
                            @error('educational_background.year_junior_high_school')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Nama SMP/Sederajat <span style="color:red;">*</span></label>
                            <input type="text" class="form-control form-control-rounded @error('educational_background.junior_high_school') is-invalid @enderror"  name="educational_background[junior_high_school]" placeholder="Masukan Nama SMP/Sederajat" value="{{ old('educational_background.junior_high_school') }}">
                            @error('educational_background.junior_high_school')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-sm-4">
                            <label>Tahun SMA/Sederajat <span style="color:red;">*</span></label>
                            <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" class="form-control form-control-rounded @error('educational_background.year_senior_high_school') is-invalid @enderror year_picker"  name="educational_background[year_senior_high_school]" placeholder="Masukan Tahun SMA/Sederajat" value="{{ old('educational_background.year_senior_high_school') }}">
                            @error('educational_background.year_senior_high_school')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label>Nama SMA/Sederajat <span style="color:red;">*</span></label>
                            <input type="text" class="form-control form-control-rounded @error('educational_background.senior_high_school') is-invalid @enderror"  name="educational_background[senior_high_school]" placeholder="Masukan Nama SMA/Sederajat" value="{{ old('educational_background.senior_high_school') }}">
                            @error('educational_background.senior_high_school')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-sm-4">
                            <label>Tahun Perguruan Tinggi</label>
                            <input type="text" class="form-control form-control-rounded @error('educational_background.year_entry') is-invalid @enderror year_picker" name="educational_background[year_entry]" placeholder="Masukan Tahun Perguruan Tinggi" value="{{ old('educational_background.year_entry') }}">
                            @error('educational_background.year_entry')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label>Nama Perguruan Tinggi</label>
                            <input type="text" class="form-control form-control-rounded @error('educational_background.college') is-invalid @enderror"  name="educational_background[college]" placeholder="Masukan Nama Perguruan Tinggi" value="{{ old('educational_background.college') }}">
                            @error('educational_background.college')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label>Nama Fakultas</label>
                            <input type="text" class="form-control form-control-rounded @error('educational_background.faculty_name') is-invalid @enderror"  name="educational_background[faculty_name]" placeholder="Masukan Nama Fakultas" value="{{ old('educational_background.faculty_name') }}">
                            @error('educational_background.faculty_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-sm-4">
                            <label>Nama Jurusan</label>
                            <input type="text" class="form-control form-control-rounded @error('educational_background.faculty_major') is-invalid @enderror"  name="educational_background[faculty_major]" placeholder="Masukan Nama Jurusan" value="{{ old('educational_background.faculty_major') }}">
                            @error('educational_background.faculty_major')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label>Tahun Lulus</label>
                            <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" class="form-control form-control-rounded @error('educational_background.year_graduated') is-invalid @enderror year_picker"  name="educational_background[year_graduated]" placeholder="Masukan Tahun Lulus" value="{{ old('educational_background.year_graduated') }}">
                            @error('educational_background.year_graduated')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label>Gelar</label>
                            <input type="text" class="form-control form-control-rounded @error('educational_background.degree') is-invalid @enderror"  name="educational_background[degree]" placeholder="Masukan Gelar" value="{{ old('educational_background.degree') }}">
                            @error('educational_background.degree')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <h4 class="form-header text-uppercase">
                        <i class=""></i>
                        Riwayat Bekerja
                    </h4>

                    <div class="form-group row">

                        <div class="col sm-4">
                            <label>Nama Pekerjaan </label>
                            <input type="text" class="form-control form-control-rounded @error('history_job.name') is-invalid @enderror"  name="history_job[name]" placeholder="Masukan Nama Pekerjaan" value="{{ old('history_job.name') }}">    
                            @error('history_job.name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col sm-4">
                            <label>Dari tahun/sampai </label>
                            <input type="text" class="form-control form-control-rounded @error('history_job.lenght_of_work') is-invalid @enderror"  name="history_job[lenght_of_work]" placeholder="Masukan Tahun" value="{{ old('history_job.lenght_of_work') }}">    
                            @error('history_job.lenght_of_work')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <h4 class="form-header text-uppercase">
                        <i class=""></i>
                        Keahlian
                    </h4>

                    <div class="form-group row">

                       <div class="col sm-4">
                           <label>Nama Keahlian </label>
                           <input type="text" class="form-control form-control-rounded @error('expertise.name') is-invalid @enderror"  name="expertise[name]" placeholder="Masukan Nama Keahlian" value="{{ old('expertise.name') }}">                                        
                           @error('expertise.name')
                           <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>                            

                    <div class="col sm-4">
                       <label>Nama Istansi/Lembaga </label>
                       <input type="text" class="form-control form-control-rounded @error('expertise.name_of_agency') is-invalid @enderror"  name="expertise[name_of_agency]" placeholder="Masukan Nama Istansi/Lembaga" value="{{ old('expertise.name_of_agency') }}">                                        
                       @error('expertise.name_of_agency')
                       <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div> 
            </div>

            <h4 class="form-header text-uppercase">
                <i class=""></i>
                Lainnya <small>(Maksimal File Ukuran 2 MB)</small>
            </h4>

            <div class="row" style="margin-top: 30px;">
                <div class="col-sm-4">
                    <label> Upload Kartu Tanda Penduduk (KTP) <span style="color:red"> *</span></label>
                    <input accept="image/x-png,image/gif,image/jpeg, application/pdf, .doc,.docx,application/msword," type="file" name="other[identity_card]">
                    @error('other.identity_card')
                    <p>
                        <strong style="font-size: 80%;color: #dc3545;">{{$message}}</strong>
                    </p>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <label> Upload Kartu Keluarga <span style="color:red"> *</span></label>
                    <input accept="image/x-png,image/gif,image/jpeg, application/pdf, .doc,.docx,application/msword," type="file" name="other[family_card]">
                    @error('other.family_card')
                    <p>
                        <strong style="font-size: 80%;color: #dc3545;">{{$message}}</strong>
                    </p>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <label> Upload Ijazah Minimal SMA/SMK dilegalisir <span style="color:red"> *</span></label>
                    <input accept="image/x-png,image/gif,image/jpeg, application/pdf, .doc,.docx,application/msword," type="file" name="other[senior_high_school_diploma]">
                    @error('other.senior_high_school_diploma')
                    <p>
                        <strong style="font-size: 80%;color: #dc3545;">{{$message}}</strong>
                    </p>
                    @enderror
                </div>
            </div>

            <div class="row" style="margin-top: 30px;">     
                <div class="col-sm-4">
                    <label> Upload Curriculum vitae (CV) <span style="color:red"> *</span></label>
                    <input accept="image/x-png,image/gif,image/jpeg, application/pdf, .doc,.docx,application/msword," type="file" name="other[curriculum_vitae]">
                    @error('other.curriculum_vitae')
                    <p>
                        <strong style="font-size: 80%;color: #dc3545;">{{$message}}</strong>
                    </p>
                    @enderror
                </div>   
                <div class="col-sm-4">
                    <label> Upload Surat Lamaran <span style="color:red"> *</span></label>
                    <input accept="image/x-png,image/gif,image/jpeg, application/pdf, .doc,.docx,application/msword," type="file" name="other[application_letter]">
                    @error('other.application_letter')
                    <p>
                        <strong style="font-size: 80%;color: #dc3545;">{{$message}}</strong>
                    </p>
                    @enderror
                </div>
                <div class="col-sm-3">
                    <label> Upload Resume <span style="color:red"> *</span></label>
                    <input accept="image/x-png,image/gif,image/jpeg, application/pdf, .doc,.docx,application/msword," type="file" name="other[resume]">
                    @error('other.resume')
                    <p>
                        <strong style="font-size: 80%;color: #dc3545;">{{$message}}</strong>
                    </p>
                    @enderror
                </div>
            </div>
            <label style="margin-top: 30px;">Foto calon staf<span style="color:red"> *</span></label>
            <div class="form-group row">

                <div class="col-sm-4">
                    <img class="img-thumbnail" id="tampil_picture" style="object-fit: cover; height: 200px; width: 200px"/> 
                    <input type="file" name="usr_profile_picture" id="preview_gambar" accept="image/x-png,image/gif,image/jpeg" onchange="document.getElementById('usr_profile_picture').value=this.value" /><br>
<!--                     <button type="button" id="usr_profile_picture" class="btn btn-outline-primary btn-sm waves-effect waves-light m-2" onclick="document.getElementById('preview_gambar').click()"> Pilih Gambar </button> -->
                    @error('usr_profile_picture')
                    <p>
                        <strong style="font-size: 80%;color: #dc3545;">{{$message}}</strong>
                    </p>
                    @enderror
                </div>

            </div>
            <input type="checkbox" name="terms_and_conditions">
             <label>Demikian formulir ini saya buat dengan sebenar-benarnya sesuai dengan petunjuk pengisian dan dapat dipertanggung jawabkan di kemudian hari </label>
            <input type="hidden" name="stf_school_year_id" value="{{ $school_year->scy_id }}">

            <div class="form-footer">
                <button id="btnSubmit" type="reset" class="btn btn-danger"><i class="fa fa-times"></i> BATAL</button>
                <button id="btnSubmit" type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> SIMPAN</button>
            </div>

        </form>
    </div>
</div>
</div>
</div>
</div>
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

<!-- script select2 -->
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.single-select').select2();                 
    });

</script>

<!--Form Validatin Script-->
 <script src="{{ asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>

<script>
    $().ready(function() {
    $("#form-validate").validate({
        rules: {
            usr_name:{
                required: true
            },
            "personal[nik]":{
                required: true,
                minlength: 10
            },
            usr_place_of_birth:{
                required: true,
            },
            usr_date_of_birth:{
                required: true
            },
            usr_gender:{
                required: true
            },
            usr_whatsapp_number:{
                required: true,
                minlength: 10
            },
            usr_religion:{
                required: true
            },
            prv_name:{
                required: true
            },
            cit_name:{
                required: true
            },
            dst_name:{
                required: true
            },
            usr_address:{
                required: true
            },
            usr_rt:{
                required: true
            },
            usr_rw:{
                required: true
            },
            usr_rural_name:{
                required: true
            },
            usr_postal_code:{
                required:true
            },
            "educational_background[year_grade_school]":{
                required: true,
                maxlength: 4
            },
            "educational_background[grade_school]":{
                required: true
            },
            "educational_background[year_junior_high_school]":{
                required: true,
                maxlength: 4
            },
            "educational_background[junior_high_school]":{
                required: true
            },
            "educational_background[year_senior_high_school]":{
                required: true,
                maxlength: 4,
            },
            "educational_background[senior_high_school]":{
                required: true
            },
            "educational_background[year_entry]":{
                maxlength: 4
            },
            "educational_background[year_graduated]":{
                maxlength: 4
            },
            "other[identity_card]":{
                required: true
            },
            "other[family_card]":{
                required: true,
            },
            "other[senior_high_school_diploma]":{
                required: true
            },
            "other[curriculum_vitae]":{
                required: true
            },
            "other[application_letter]":{
                required: true
            },
            "other[resume]":{
                required: true
            },
            usr_profile_picture:{
                required:true
            },
            terms_and_conditions:{
                required: true
            },

        },  
        messages: {
            usr_name:{
                required: "Nama lengkap harus di isi"
            },
            usr_place_of_birth:{
                required: "Tempat lahir harus di isi"
            },
            usr_date_of_birth:{
                required: "Data lahir harus di isi"
            },
            "personal[nik]":{
                required: "Nomor NIK harus di isi",
                minlength: "Minimal 10 digit"
            },
            usr_gender:{
                required: "Jenis kelamin harus di pilih"
            },
            usr_whatsapp_number:{
                required: "No WhatsApp harus di isi",
                minlength: "Minimal 10 digit"
            },
            usr_phone_number:{
                required: "No Hp harus di isi"
            },
            usr_religion:{
                required: "Agama harus di pilih"
            },
            "school_origin[npsn]":{
                required: "NPSN asal sekolah harus di isi"
            },
            prv_name:{
                required: "Provinsi harus di pilih"
            },
            cit_name:{
                required: "Kabupaten atau kota harus di pilih"
            },
            dst_name:{
                required: "Kecamatan harus di pilih"
            },
            usr_address:{
                required: "Alamat harus di isi"
            },
            usr_rt:{
                required: "RT harus di isi"
            },
            usr_rw:{
                required: "RW harus di isi"
            },
            usr_rural_name:{
                required: "Desa harus di isi"
            },
            usr_postal_code:{
                required: "Kode pos harus di isi"
            },
            "educational_background[year_grade_school]":{
                required: "Tahun lulus SD sederajat harus di isi",
                maxlength: "Maksimal 4 digit"
            },
            "educational_background[grade_school]":{
                required: "Nama SD sederajat harus di isi"
            },
            "educational_background[year_junior_high_school]":{
                required: "Tahun lulus SMP sederajat harus di isi",
                maxlength: "Maksimal 4 digit"
            },
            "educational_background[junior_high_school]":{
                required: "Nama SMP sederajat harus di isi"
            },
            "educational_background[year_senior_high_school]":{
                required: "Tahun lulus SMA sederajat harus di isi",
                maxlength: "Maksimal 4 digit"
            },
            "educational_background[senior_high_school]":{
                required: "Nama SMA sederajat harus di isi"
            },
            "educational_background[year_entry]":{
                maxlength: "Maksimal 4 digit"
            },
            "educational_background[year_graduated]":{
                maxlength: "Maksimal 4 digit"
            },
            "other[identity_card]":{
                required: "KTP harus di upload"
            },
            "other[family_card]":{
                required: "Kartu keluarga harus di upload",
            },
            "other[senior_high_school_diploma]":{
                required: "ijazah legalisir SMA atau SMK harus di upload"
            },
            "other[curriculum_vitae]":{
                required: "CV harus di upload"
            },
            "other[application_letter]":{
                required: "Surat lamaran harus di upload"
            },
            "other[resume]":{
                required: "Resume harus di upload"
            },
            usr_profile_picture:{
                required: "Foto calon staff tidak boleh kosong"
            },
            terms_and_conditions:{
                required: "&nbsp S&K harus di centang"
            }

        }
    });
});
</script>

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

<!--Bootstrap Datepicker Js-->
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    $('#default-datepicker').datepicker({
        todayHighlight: true
    });
    $('#autoclose-datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "yyyy-mm-dd",
        year: 2021,
        starYear: 2000
    });

    $('#inline-datepicker').datepicker({
        todayHighlight: true
    });

    $('.year_picker').datepicker({
        autoclose: true,
        minViewMode: 2,
        format: 'yyyy'
    });

    $('#dateragne-picker .input-daterange').datepicker({});
</script>

<script>
    $('#provinces').on('change', function (e) {
        console.log(e);
        var prov_id = e.target.value;
        $.get('{{URL::to('api/json-cities')}}/'+ prov_id  , function (variable) {
            console.log('variable');
            $('#cities').empty();
            $('#cities').append('<option value="">Pilih Kabupaten/Kota</option>');

            $.each(variable.cities, function (val, citiesObj) {
                $('#cities').append('<option value="'+citiesObj.cit_id+'">'+citiesObj.cit_name+'</option>');
            });

        });
    });

    $('#cities').on('change', function (e) {
        console.log(e);
        var cit_id = e.target.value;
        $.get('{{URL::to('api/json-districts')}}/'+ cit_id  , function (variable) {
            console.log('variable');
            $('#districts').empty();
            $('#districts').append('<option value="">Pilih Kecamatan</option>');

            $.each(variable.districts, function (val, districtsObj) {
                $('#districts').append('<option value="'+districtsObj.dst_id+'">'+districtsObj.dst_name+'</option>');
            });

        });
    });
</script>
@endpush
@endsection