<?php

namespace App\Http\Controllers;

use App\Students;
use Illuminate\Http\Request;
use App\User;
use App\StudentDetails;
use App\Majors;
use App\Years;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\AddStudent;
use App\Mail\PaymentMail;
use App\Mail\SchoolPaymentMail;
use Illuminate\Support\Carbon;
use App\EntryTypes;
use App\Provinces;
use App\Districts;
use App\StudentRegistration;
use App\StudentPayments;
use App\StudentClass;
use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function list_rejected()
    {
        return view('students.list-student-rejected');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $majors = Majors::where('mjr_is_active', true)->get();
        $school_years = Years::orderBy('scy_name','ASC')->get();
        $entry_types = EntryTypes::get();
        $province = Provinces::select('prv_id', 'prv_name')->get();
        return view('students.add-student', ['majors' => $majors, 'entry_types'  => $entry_types, 'province' => $province, 'school_years' => $school_years]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //dd($request);
        $requests = $request->input();
        $messages = [
            'required'  => 'Kolom wajib diisi',
            'unique'    => 'Kolom yang digunakan telah terdaftar',
            'mimes'     => 'Foto tidak support, ukuran max 2 MB',
        ];

        $request->validate([
            'usr_name'                      => 'required',
            'usr_email'                     => 'required|unique:users,usr_email',
            'stu_candidate_name'            => 'required',
            'usr_gender'                    => 'required',
            'stu_nisn'                      => 'required | unique:students,stu_nisn',
            'stu_entry_type_id'             => 'required',
            'usr_phone_number'              => 'required | unique:users,usr_phone_number',
            'usr_whatsapp_number'           => 'required | unique:users,usr_whatsapp_number',
            'usr_place_of_birth'            => 'required',
            'usr_date_of_birth'             => 'required',
            'personal.living_together'      => 'required',
            'stu_school_origin'             => 'required',
            'stu_major_id'                  => 'required',
            'usr_religion'                  => 'required',
            'usr_profile_picture'           => 'required | mimes:jpeg,jpg,png|max:2048',
            'father_data.name'              => 'required',
            'father_data.nik'               => 'required',
            'father_data.year_of_birth'     => 'required',
            'father_data.education'         => 'required',
            'father_data.profession'        => 'required',
            'father_data.phone_number'      => 'required',
            'mother_data.name'              => 'required',
            'mother_data.nik'               => 'required',
            'mother_data.year_of_birth'     => 'required',
            'mother_data.education'         => 'required',
            'mother_data.profession'        => 'required',
            'mother_data.phone_number'      => 'required',
            'prv_name'                      => 'required',
            'cit_name'                      => 'required',
            'dst_name'                      => 'required',
            'usr_address'                   => 'required',
            'usr_rt'                        => 'required',
            'usr_rw'                        => 'required',
            'usr_rural_name'                => 'required',
            'usr_postal_code'               => 'required',
            'contact.email'                 => 'required',
            'str_school_year_id'            => 'required',
            'stu_entry_type_id'             => 'required',

            'other.certificate_of_graduation'   => 'required | mimes:jpeg,png,jpg,pdf,doc,docx | max:2048',
            'other.junior_high_school_diploma'  => 'required | mimes:jpeg,png,jpg,pdf,doc,docx | max:2048',
            'other.elementary_school_diploma'   => 'required | mimes:jpeg,png,jpg,pdf,doc,docx | max:2048',
            'other.birth_certificate'           => 'required | mimes:jpeg,png,jpg,pdf,doc,docx | max:2048',
            'other.family_card'                 => 'required | mimes:jpeg,png,jpg,pdf,doc,docx | max:2048',
            'other.domicile_statement'          => 'max:2048 | mimes:jpeg,png,jpg,pdf,doc,docx',
            'other.id_card_father'              => 'required | mimes:jpeg,png,jpg,pdf,doc,docx | max:2048',
            'other.id_card_mother'              => 'required | mimes:jpeg,png,jpg,pdf,doc,docx | max:2048',
            'other.health_certificate'          => 'max:2048 | mimes:jpeg,png,jpg,pdf,doc,docx',
            'other.eye_health_letter'           => 'max:2048 | mimes:jpeg,png,jpg,pdf,doc,docx',
            'other.card'                        => 'max:2048 | mimes:jpeg,png,jpg,pdf,doc,docx',
            'other.certificate'                 => 'max:2048 | mimes:jpeg,png,jpg,pdf,doc,docx',


        ], $messages);

        $user                       = new User;
        $user->usr_name             = $request->usr_name;
        $user->usr_email            = $request->usr_email;
        $user->usr_phone_number     = $request->usr_phone_number;
        $rand_string                = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 6);
        $rand_int                   = substr(str_shuffle('0123456789'), 0, 4);
        $rand_password              = $rand_string . $rand_int;
        $user->usr_password         = Hash::make($rand_password);
        $user->usr_gender           = $request->usr_gender;
        $user->usr_whatsapp_number  = $request->usr_whatsapp_number;
        $user->usr_place_of_birth   = $request->usr_place_of_birth;
        $user->usr_date_of_birth    = $request->usr_date_of_birth;
        $user->usr_religion         = $request->usr_religion;
        $user->usr_district_id      = $request->dst_name;
        $user->usr_address          = $request->usr_address;
        $user->usr_postal_code      = $request->usr_postal_code;
        $user->usr_rt               = $request->usr_rt;
        $user->usr_rw               = $request->usr_rw;
        $user->usr_rural_name       = $request->usr_rural_name;
        $user->usr_is_regist        = '1';
        $user->usr_is_active        = '1';
        $user->usr_email_verified_at = now();
        $user->usr_created_by       = Auth()->user()->usr_id;
        $user->assignRole('student');
        Mail::to($user['usr_email'])->send(new AddStudent($user,$rand_password));

        if ($request->hasFile('usr_profile_picture')) {
            $files = $request->file('usr_profile_picture');
            $path = public_path('images/users_profile');
            $files_name = 'images' . '/' . 'users_profile' . '/' . date('Ymd') . '_' . $files->getClientOriginalName();
            $files->move($path, $files_name);
            $user->usr_profile_picture = $files_name;
        }

        if ($user->save()) {
            $student                       = new Students;
            $student->stu_candidate_name   = $request->stu_candidate_name;
            $student->stu_user_id          = $user->usr_id;
            $student->stu_entry_type_id    = $request->stu_entry_type_id;
            // $student->stu_school_year_id   = 5;
            $student->stu_nisn             = $request->stu_nisn;
            $student->stu_school_origin    = $request->stu_school_origin;
            $student->stu_major_id         = $request->stu_major_id;
            // $student->stu_registration_status   = 1;
            $student->stu_created_by = Auth()->user()->usr_id;

            if ($student->save()) {
                $student_registration  = new StudentRegistration;
                $student_registration->str_student_id = $student->stu_id;
                $student_registration->str_school_year_id = $request->str_school_year_id;
                $student_registration->str_status = 1;
                $student_registration->str_created_by = Auth()->user()->usr_id;
                $student_registration->save();

                foreach ($requests as $key => $requestData) {
                    if (is_array($requestData)) {
                        foreach ($requestData as $requestKey => $requestValue) {
                            $studentDetail = new StudentDetails;
                            $studentDetail->std_student_id = $student->stu_id;
                            $studentDetail->std_type       = $key;
                            $studentDetail->std_key        = $requestKey;
                            $studentDetail->std_value      = $requestValue;
                            $studentDetail->std_created_by = Auth()->user()->usr_id;
                            $studentDetailSave              = $studentDetail->save();
                        }
                    }
                }
            } else {
                dd('gagal student ');
            }
            $images = $request->file('other');
            // dd($image);
            if ($images) {
                foreach ($images as $key => $image) {
                    // dd($images, $key, $image);
                    if ($image) {
                        $path = public_path('images/student_files');
                        $files_name = 'images' .'/'. 'student_files' .'/'. date('Ymd') . '_' . $image->getClientOriginalName();
                        // dd($images);
                        $image->move($path, $files_name);
                        $studentDetail = new StudentDetails;
                        $studentDetail->std_student_id = $student->stu_id;
                        $studentDetail->std_type       = 'other';
                        $studentDetail->std_key        = $key;
                        $studentDetail->std_value      = $files_name;
                        $studentDetail->std_created_by = $user->usr_id;
                        $studentDetail->save();
                    }
                }
            }
        
        } else {
            dd('gagal user');
        }
        return redirect('/students')->with('success', 'Data berhasil ditambahkan');
    }

    public function show_student($studentID)
    {
        $student = new students;
        $student = $student->getStudentDetail($studentID);
        $user = User::join('districts', 'districts.dst_id', '=', 'users.usr_district_id')
        ->join('cities', 'cities.cit_id', '=', 'districts.dst_city_id')
        ->join('provinces', 'provinces.prv_id', '=', 'cities.cit_province_id')
        ->select('users.*', 'districts.*', 'cities.*', 'provinces.*')
        ->where('usr_id', $student->usr_id)
        ->get();

        $student_check = StudentClass::where('student_classes.stc_student_id', $studentID)->first();
        $student_class = StudentClass::join('classes', 'classes.cls_id', 'student_classes.stc_class_id')
                                       ->join('grade_levels','classes.cls_grade_level_id','=','grade_levels.grl_id')
                                       ->join('majors','classes.cls_major_id','=','majors.mjr_id')
                                       ->where('student_classes.stc_student_id', $studentID)
                                       ->get();
        return view('students.detail-student', ['student' => $student, 'user' => $user, 'student_class' => $student_class, 'student_check' => $student_check]);
    }
    public function show_prospective($studentID)
    {
        $student_prospective = new Students;
        $student_prospective = $student_prospective->getStudentProsvectiveDetail($studentID);
        //dd($student_prospective);
        return view('students.detail-student-prospective', ['student_prospective' => $student_prospective]);
    }
    public function show_rejected($studentID)
    {
        $student_rejected = new Students;
        $student_rejected = $student_rejected->getStudentRejectedDetail($studentID);
        // dd($student_rejected);
        return view('students.detail-student-rejected', ['student_rejected' => $student_rejected]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit($studentID)
    {
        $entry_types = EntryTypes::select('ent_id', 'ent_name')->get();
        $majors      = Majors::where('mjr_is_active', '1')->get();
        $student = new Students;

        $student_edit = $student->getStudentEdit($studentID);        
        $province = Provinces::select('prv_id', 'prv_name')->get();
        $user = User::join('districts', 'districts.dst_id', '=', 'users.usr_district_id')
        ->join('cities', 'cities.cit_id', '=', 'districts.dst_city_id')
        ->join('provinces', 'provinces.prv_id', '=', 'cities.cit_province_id')
        ->select('users.*', 'districts.*', 'cities.*', 'provinces.*')
        ->where('usr_id', $student_edit->usr_id)
        ->get();   
        
        return view('students.edit-student',['student_edit' => $student_edit, 'province' => $province, 'entry_types' => $entry_types, 'majors' => $majors, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $studentID)
    {
        // dd($request);
        $student                        = Students::where('stu_id', $studentID)->first();
        $user                       = User::where('usr_id', $student->stu_user_id)->first();

        $requests = $request->input();
        $messages = [
            'required'  => 'Kolom wajib diisi',
            'unique'    => 'Kolom yang digunakan telah terdaftar',
            'mimes'     => 'File tidak support',
            'size'      => 'Ukuran file Max 2 MB',
            'uploaded'  => 'Gagal di unggah, ukuran file max 2 MB'
        ];

        $request->validate([
            'stu_candidate_name'            => 'required',
            'usr_gender'                    => 'required',
            'stu_nisn'                      => 'required | unique:students,stu_nisn,'.$student->stu_id.',stu_id',
            'usr_phone_number'              => 'required | unique:users,usr_whatsapp_number,'.$user->usr_id.',usr_id',
            'usr_whatsapp_number'           => 'required | unique:users,usr_whatsapp_number,'.$user->usr_id.',usr_id',
            'usr_place_of_birth'            => 'required',    
            'usr_date_of_birth'             => 'required',            
            'personal.living_together'      => 'required',            
            // 'school_origin.npsn'            => 'required'
            'stu_school_origin'             => 'required',
            'stu_major_id'                  => 'required',
            'usr_religion'                  => 'required',
            // 'usr_profile_picture'           => 'required | max:2048',
            'father_data.name'              => 'required',
            // 'father_data.father_name'       => 'required',
            'father_data.nik'               => 'required',
            'father_data.year_of_birth'     => 'required',
            'father_data.education'         => 'required',
            'father_data.profession'        => 'required',
            'father_data.phone_number'      => 'required',
            'mother_data.name'              => 'required',
            'mother_data.nik'               => 'required',
            'mother_data.year_of_birth'     => 'required',
            'mother_data.education'         => 'required',
            'mother_data.profession'        => 'required',
            'mother_data.phone_number'      => 'required',
            'prv_name'                      => 'required',
            'cit_name'                      => 'required',
            'dst_name'                      => 'required',
            'usr_address'                   => 'required',
            'usr_rt'                        => 'required',
            'usr_rw'                        => 'required',
            'usr_rural_name'                => 'required',
            'usr_postal_code'               => 'required',
            'contact.email'                 => 'required',

            // 'other.certificate_of_graduation'   => 'required | max:2048',
            // 'other.junior_high_school_diploma'  => 'required | max:2048',
            // 'other.elementary_school_diploma'   => 'required | max:2048',
            // 'other.birth_certificate'           => 'required | max:2048',
            // 'other.family_card'                 => 'required | max:2048',
            // 'other.domicile_statement'          => 'max:2048',
            // 'other.id_card_father'              => 'required | max:2048',
            // 'other.id_card_mother'              => 'required | max:2048',
            // 'other.health_certificate'          => 'max:2048',
            // 'other.eye_health_letter'           => 'max:2048',
            // 'other.card'                        => 'max:2048',
            // 'other.certificate'                 => 'max:2048',

        ], $messages);

//proses update data student
        $student->stu_candidate_name    = $request->stu_candidate_name;
        $student->stu_nisn              = $request->stu_nisn;
        $student->stu_school_origin     = $request->stu_school_origin;
        $student->stu_major_id          = $request->stu_major_id;
        $student->stu_updated_by        = Auth()->user()->usr_id;
        $student->stu_entry_type_id     = $request->stu_entry_type_id;
        $student->update();

//proses update data user
        $user->usr_name             = $request->usr_name;
        // $user->usr_phone            = $request->usr_phone; //no.telp saat registrasi
        $user->usr_phone_number     = $request->usr_phone_number;
        $user->usr_gender           = $request->usr_gender;
        $user->usr_whatsapp_number  = $request->usr_whatsapp_number;
        $user->usr_place_of_birth   = $request->usr_place_of_birth;
        $user->usr_date_of_birth    = $request->usr_date_of_birth;
        $user->usr_religion         = $request->usr_religion;
        $user->usr_district_id      = $request->dst_name;
        $user->usr_address          = $request->usr_address;
        $user->usr_postal_code      = $request->usr_postal_code;
        $user->usr_rt               = $request->usr_rt;
        $user->usr_rw               = $request->usr_rw;
        $user->usr_rural_name       = $request->usr_rural_name;
        $user->usr_updated_by       = Auth()->user()->usr_id;
        if ($request->hasFile('usr_profile_picture')) {
            $files = $request->file('usr_profile_picture');
            $path = public_path('images/users_profile');
            $files_name = 'images' . '/' . 'users_profile' . '/' . date('Ymd') . '_' . $files->getClientOriginalName();
            $files->move($path, $files_name);
            $user->usr_profile_picture = $files_name;
        }
        if ($user->update()) {
            foreach ($requests as $type => $requestData) {
                if (is_array($requestData)) {
                    foreach ($requestData as $requestKey => $requestValue) {
                        $studentDetail = StudentDetails::where('std_student_id', $student->stu_id)
                        ->where('std_type', $type)
                        ->where('std_key', $requestKey)->first();
                        if (isset($studentDetail)) {
                            $studentDetail->std_value       = $requestValue;
                            $studentDetail->std_updated_by  = Auth()->user()->usr_id;
                            $studentDetailSave              = $studentDetail->update();                            
                        }else{
                            $studentDetail = new StudentDetails;
                            $studentDetail->std_student_id = $student->stu_id;
                            $studentDetail->std_type       = $type;
                            $studentDetail->std_key        = $requestKey;
                            $studentDetail->std_value      = $requestValue;
                            $studentDetail->std_created_by = Auth()->user()->usr_id;
                            $studentDetailSave              = $studentDetail->save();
                            }
                        }
                    }
                }
                $images = $request->file('other');
                // dd($image);
                if ($images) {
                    foreach ($images as $key => $image) {
                        // dd($images, $key, $image);
                        if ($image) {
                            $path = public_path('images/student_files');
                            $files_name = 'images' .'/'. 'student_files' .'/'. date('Ymd') . '_' . $image->getClientOriginalName();
                            // dd($images);
                            $image->move($path, $files_name);
                            $studentDetail = StudentDetails::where('std_student_id', $student->stu_id)
                            ->where('std_type', $type)
                            ->where('std_key', $requestKey)->first();
                        if (isset($studentDetail)) {
                            $studentDetail = new StudentDetails;
                            $studentDetail->std_student_id = $student->stu_id;
                            $studentDetail->std_type       = 'other';
                            $studentDetail->std_key        = $key;
                            $studentDetail->std_value      = $files_name;
                            $studentDetail->std_created_by = $user->usr_id;
                            $studentDetail->update();
                        }else{
                            $studentDetail = new StudentDetails;
                            $studentDetail->std_student_id = $student->stu_id;
                            $studentDetail->std_type       = 'other';
                            $studentDetail->std_key        = $key;
                            $studentDetail->std_value      = $files_name;
                            $studentDetail->std_created_by = $user->usr_id;
                            $studentDetail->save();
                        }
                    }
                } 
            }
        }
 
        return redirect('student/' . $studentID)->with('success', 'Data berhasil diubah');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            User::findOrFail($request->studentID)->delete();
            return $this->getResponse(true, 200, '', 'Student berhasil dihapus');
        }
    }
    public function formRegistrasion()
    {
        $user = Auth::user();
        $student = Students::where('stu_user_id', $user->usr_id)->first();
        $payment = StudentPayments::where('stp_student_id', $student->stu_id)->first();
        if ($payment->stp_payment_status == 2 && $user->hasRole('student')) {
            if ($user->usr_is_regist == 0) {
                $school_year = Years::where('scy_is_form_registration', 1)->first();
                // dd($year['scy_name'], $year->scy_name);
                $majors = Majors::where('mjr_is_active', true)->get();
                $province = Provinces::select('prv_id', 'prv_name')->get();

                return view('students.registration-student', ['majors' => $majors, 'province' => $province, 'school_year' => $school_year]);
            } else {
                return redirect('/pending-verification');
            }
        } else{
            return redirect ('/payment-upload');
        }
        
    }

    public function storeFormRegistrasion(Request $request)
    {
         // dd($request);
        $requests = $request->input();
        $messages = [
            'required'  => 'Kolom wajib diisi',
            'unique'    => 'Kolom yang digunakan telah terdaftar',
            'mimes'     => 'File tidak support',
            'size'      => 'Ukuran file Max 2 MB',
            'uploaded'  => 'Gagal di unggah, ukuran file max 2 MB'
        ];

        $request->validate([
            'stu_candidate_name'            => 'required',
            'usr_gender'                    => 'required',
            'stu_nisn'                      => 'required | unique:students,stu_nisn',
            'usr_phone_number'              => 'required | unique:users,usr_whatsapp_number',
            'usr_whatsapp_number'           => 'required | unique:users,usr_whatsapp_number',
            'usr_place_of_birth'            => 'required',    
            'usr_date_of_birth'             => 'required',            
            'personal.living_together'      => 'required',            
            // 'school_origin.npsn'            => 'required'
            'stu_school_origin'             => 'required',
            'stu_major_id'                  => 'required',
            'usr_religion'                  => 'required',
            'usr_profile_picture'           => 'required | max:2048',
            'father_data.name'              => 'required',
            // 'father_data.father_name'       => 'required',
            'father_data.nik'               => 'required',
            'father_data.year_of_birth'     => 'required',
            'father_data.education'         => 'required',
            'father_data.profession'        => 'required',
            'father_data.phone_number'      => 'required',
            'mother_data.name'              => 'required',
            'mother_data.nik'               => 'required',
            'mother_data.year_of_birth'     => 'required',
            'mother_data.education'         => 'required',
            'mother_data.profession'        => 'required',
            'mother_data.phone_number'      => 'required',
            'prv_name'                      => 'required',
            'cit_name'                      => 'required',
            'dst_name'                      => 'required',
            'usr_address'                   => 'required',
            'usr_rt'                        => 'required',
            'usr_rw'                        => 'required',
            'usr_rural_name'                => 'required',
            'usr_postal_code'               => 'required',
            'contact.email'                 => 'required',

            'other.certificate_of_graduation'   => 'required | max:2048',
            'other.junior_high_school_diploma'  => 'required | max:2048',
            'other.elementary_school_diploma'   => 'required | max:2048',
            'other.birth_certificate'           => 'required | max:2048',
            'other.family_card'                 => 'required | max:2048',
            'other.domicile_statement'          => 'max:2048',
            'other.id_card_father'              => 'required | max:2048',
            'other.id_card_mother'              => 'required | max:2048',
            'other.health_certificate'          => 'max:2048',
            'other.eye_health_letter'           => 'max:2048',
            'other.card'                        => 'max:2048',
            'other.certificate'                 => 'max:2048',

        ], $messages);

        $student = Students::join('users', 'students.stu_user_id', '=', 'users.usr_id')
        ->where('students.stu_user_id', Auth::user()->usr_id)->first();
        $user = Auth()->user();
        // dd($user->usr_name);
        $user->usr_gender           = $request->usr_gender;
        $user->usr_whatsapp_number  = $request->usr_whatsapp_number;
        $user->usr_phone_number  = $request->usr_phone_number;
        $user->usr_place_of_birth   = $request->usr_place_of_birth;
        $user->usr_date_of_birth    = $request->usr_date_of_birth;
        $user->usr_religion         = $request->usr_religion;
        $user->usr_district_id      = $request->dst_name;
        $user->usr_address          = $request->usr_address;
        $user->usr_postal_code      = $request->usr_postal_code;
        $user->usr_rt               = $request->usr_rt;
        $user->usr_rw               = $request->usr_rw;
        $user->usr_rural_name       = $request->usr_rural_name;
        $user->usr_is_regist        = '1';
        if ($request->hasFile('usr_profile_picture')) {
            $files = $request->file('usr_profile_picture');
            $path = public_path('images/users_profile');
            $files_name = 'images' . '/' . 'users_profile' . '/' . date('Ymd') . '_' . $files->getClientOriginalName();
            $files->move($path, $files_name);
            $user->usr_profile_picture = $files_name;
        }

        if ($user->update()) {
            $student->stu_candidate_name   = $request->stu_candidate_name;
            $student->stu_user_id          = $user->usr_id;
            $student->stu_entry_type_id    = 1;
            $student->stu_nisn             = $request->stu_nisn;
            $student->stu_school_origin    = $request->stu_school_origin;
            $student->stu_major_id         = $request->stu_major_id;
            $student->stu_created_by = Auth()->user()->usr_id;

            $student_registration          = StudentRegistration::where('str_student_id', $student->stu_id)->first();
            $student_registration->str_school_year_id = $request->str_school_year_id;
            $student_registration->str_created_by = Auth()->user()->usr_id;
            $student_registration->update();

            if ($student->update()) {
                foreach ($requests as $key => $requestData) {
                    if (is_array($requestData)) {
                        foreach ($requestData as $requestKey => $requestValue) {
                            // dd($requests, $request, $requestData, $requestKey, $requestValue, $key);                            
                            $studentDetail = new StudentDetails;
                            $studentDetail->std_student_id = $student->stu_id;
                            $studentDetail->std_type       = $key;
                            $studentDetail->std_key        = $requestKey;
                            $studentDetail->std_value      = $requestValue;
                            $studentDetail->std_created_by = $user->usr_id;
                            $studentDetail->save();
                        }
                    }
                }
            } else {
                dd('gagal student ');
            }
            $images = $request->file('other');
            // dd($image);
            if ($images) {
                foreach ($images as $key => $image) {
                    // dd($images, $key, $image);
                    if ($image) {
                        $path = public_path('images/student_files');
                        $files_name = 'images' .'/'. 'student_files' .'/'. date('Ymd') . '_' . $image->getClientOriginalName();
                        // dd($images);
                        $image->move($path, $files_name);
                        $studentDetail = new StudentDetails;
                        $studentDetail->std_student_id = $student->stu_id;
                        $studentDetail->std_type       = 'other';
                        $studentDetail->std_key        = $key;
                        $studentDetail->std_value      = $files_name;
                        $studentDetail->std_created_by = $user->usr_id;
                        $studentDetail->save();
                    }
                }
            }
        } else {
            dd('gagal user');
        }
        return redirect('/pending-verification');
    }

    public function receipted($str_id)
    {
        $student_registration = StudentRegistration::where('str_id',$str_id)->first();

        $student_registration->str_status = '1';
        $student_registration->str_reason = 'Siswa diterima karena data yang di inputkan telah terverifikasi';
        $student_registration->update();

       return redirect('students-prospective')->with('success', 'Siswa berhasil diterima'); 
    }

    public function rejected($stu_id)
    {

        $student_registration = Students::join('student_registrations','student_registrations.str_student_id','=','students.stu_id')->where('stu_id',$stu_id)->first();

        return view('students.reason-student-rejected',compact('student_registration'));
    }

    public function storeRejected(Request $request, $str_id)
    {
        $student_registration = StudentRegistration::where('str_id',$str_id)->first();
        $student_registration->str_reason = $request->str_reason;
        $student_registration->str_status = '2';
        $student_registration->update();
        return redirect('students-prospective')->with('success', 'Siswa berhasil ditolak');
    }

    public function restore($stu_id){
        $student_registration = StudentRegistration::where('str_student_id',$stu_id)->first();

        $student_registration->str_status = '0';
        $student_registration->update();

        return back()->with('success', 'Siswa berhasil dikembalikan menjadi calon siswa');
    }

    public function payment(){
        $user = Auth::user();
        $student = Students::where('stu_user_id', $user->usr_id)->first();
        $payment = StudentPayments::where('stp_student_id', $student->stu_id)->first();        
        if ($payment->stp_payment_status == 2 && $user->hasRole('student')) {
            if ($user->usr_is_regist == 0) {
                return redirect('/student-registration');
            } else {
                return redirect('/pending-verification');
            }
        } else{
            return view('students.payment', ['payment' => $payment]);
        }        
    }

    public function payment_upload(Request $request)
    {        
        $userID = Auth::user()->usr_id;        
        $payment = StudentPayments::join('students', 'students.stu_id', '=', 'student_payments.stp_student_id')
        ->where('students.stu_user_id', $userID)->first();        
        $payment->stp_payment_status = 1;
        $payment->stp_payment_method = $request->stp_payment_method;
        $payment->stp_reason = null;
        $payment->stp_type_payment = 1;
        $payment->stp_date_verification = null;
        $payment->stp_date = now();
        if ($request->hasFile('stp_picture')) {
            $files = $request->file('stp_picture');
            $path = public_path('images/student_files/payments');
            $files_name = 'images' . '/' . 'student_files' . '/' . 'payments' .  '/' . date('Ymd') . '_' . $files->getClientOriginalName();
            $files->move($path, $files_name);
            $payment->stp_picture = $files_name;
        }
        if ($payment->update()) {
            return back()->with('success', 'Pembayaran berhasil diupload, tunggu konfirmasi selanjutnya. Kami akan mengkonfirmasi melalui email atau nomor telepon anda.');            
        }        

    }

    public function payment_detail($paymentID)
    {        
        $payment = StudentPayments::join('students', 'students.stu_id', '=', 'student_payments.stp_student_id')
        ->join('users', 'users.usr_id', '=', 'students.stu_user_id')
        ->where('student_payments.stp_id', $paymentID)
        ->get();
        return view('students.detail-payment', ['payment' => $payment]);
    }

    public function acceptPayment($studentID)
    {
        $payment = StudentPayments::where('stp_student_id', $studentID)->first();
        $payment->stp_reason = 'Pembayaran diterima karena data valid';
        $payment->stp_payment_status = '2';        
        $payment->stp_date_verification = now();
        $payment->update();

        $student = Students::findOrFail($studentID);
        $user = User::where('usr_id', $student->stu_user_id)->first();        
        Mail::to($user['usr_email'])->send(new PaymentMail($user, $payment));
        return redirect('/student/payment/'.$payment->stp_id)->with('success', 'Pembayaran berhasil diterima');
    }

    public function refusePayment($studentID)
    {

        $student_payment = Students::join('student_payments','student_payments.stp_student_id','=','students.stu_id')->where('stu_id',$studentID)->first();

        return view('students.reason-payment-refuse',compact('student_payment'));
    }

    public function storeRefusePayment(Request $request,$studentID)
    {
        $payment = StudentPayments::where('stp_student_id', $studentID)->first();
        $payment->stp_reason = $request->stp_reason;
        $payment->stp_payment_status = '3';
        $payment->stp_date_verification = now();
        $payment->update();

        $student = Students::findOrFail($studentID);
        $user = User::where('usr_id', $student->stu_user_id)->first();        
        Mail::to($user['usr_email'])->send(new PaymentMail($user, $payment));
        return redirect('/student/payment/'.$studentID)->with('success', 'Pembayaran berhasil ditolak');
    }

    public function schoolPayment(Request $request)
    {        
        $school_year = Years::join('students', 'students.stu_school_year_id', 'school_years.scy_id')
                              ->join('student_payments', 'stp_student_id', 'students.stu_id')
                              ->where('students.stu_user_id', Auth::user()->usr_id)                              
                              ->where('stp_type_payment', 2);
        //dd($school_year);
        $student = Students::where('stu_user_id', Auth()->user()->usr_id)
        ->join('student_registrations', 'student_registrations.str_student_id','=','students.stu_id')
        ->join('school_years', 'student_registrations.str_school_year_id','=','school_years.scy_id')
        ->firstOrFail();
        
        $student_payment = StudentPayments::where('stp_student_id',$student->stu_id)->where('stp_payment_status', 2)->where('stp_type_payment', 2)->sum('stp_nominal');
        $ppdb_payment_price = $student->scy_payment_price;
        $remaining_payment = $ppdb_payment_price - $student_payment;

        return view('school-payments.school-payment' , ['school_year' => $school_year, 'remaining_payment' => $remaining_payment]);   
    }

    public function storeSchoolPayment(Request $request)
    {
        
        $student = Students::join('users','students.stu_user_id','=','users.usr_id')->where('students.stu_user_id',Auth()->user()->usr_id)
        ->join('student_registrations', 'student_registrations.str_student_id','=','students.stu_id')
        ->join('school_years', 'student_registrations.str_school_year_id','=','school_years.scy_id')
        ->firstOrFail();

        $student_payment = StudentPayments::where('stp_student_id',$student->stu_id)->where('stp_payment_status', 2)->where('stp_type_payment', 2)->sum('stp_nominal');
        $ppdb_payment_price = $student->scy_payment_price;
        $remaining_payment = $ppdb_payment_price - $student_payment;

        if ($student->scy_payment_price == $student_payment) {
            return redirect()->back()->with('error', 'Terimakasih Anda sudah melunasi pembayaran PPDB, Anda tidak dapat melakukan pembayaran lagi!');
        }

        $payment = new StudentPayments;
        $payment->stp_student_id = $student->stu_id;
        $payment->stp_payment_status = 1;
        $payment->stp_payment_method = $request->stp_payment_method;
        $payment->stp_reason = null;
        $payment->stp_date_verification = null;
        $payment->stp_date = now();
        $payment->stp_nominal = str_replace(".", "", $request->stp_nominal);
        $payment->stp_type_payment = $request->stp_type_payment;
        if ($request->hasFile('stp_picture')) {
            $files = $request->file('stp_picture');
            $path = public_path('images/student_files/payments');
            $files_name = 'images' . '/' . 'student_files' . '/' . 'payments' .  '/' . date('Ymd') . '_' . $files->getClientOriginalName();
            $files->move($path, $files_name);
            $payment->stp_picture = $files_name;
        }
        //dd($payment);
        if ($payment->save()) {
            return back()->with('success', 'Pembayaran berhasil diupload, tunggu konfirmasi selanjutnya. Kami akan mengkonfirmasi melalui email anda.');            
        }        

    }

    public function createSchoolPayment()
    {
         $school_year = Years::join('students', 'students.stu_school_year_id', 'school_years.scy_id')
                              ->join('student_payments', 'stp_student_id', 'students.stu_id')                 
                              ->where('stp_type_payment', 2);
        $student = Students::orderBy('stu_candidate_name','ASC')->get();
        //dd($school_year);
        return view('school-payments.add-school-payment' , ['school_year' => $school_year, 'student' => $student]);  
    }

    public function storeCreate(Request $request)
    {
        
        $student = Students::join('users','students.stu_user_id','=','users.usr_id')        
        ->join('student_registrations', 'student_registrations.str_student_id','=','students.stu_id')
        ->join('school_years', 'student_registrations.str_school_year_id','=','school_years.scy_id')
        ->where('stu_id', $request->stp_student_id)
        ->firstOrFail();

        $student_payment = StudentPayments::where('stp_student_id',$student->stu_id)->where('stp_payment_status', 2)->where('stp_type_payment', 2)->sum('stp_nominal');
        $ppdb_payment_price = $student->scy_payment_price;
        $remaining_payment = $ppdb_payment_price - $student_payment;

        if ($student->scy_payment_price == $student_payment) {
             //dd($student, $student_payment);
            return redirect('/school-payments')->with('error', 'Data Gagal Ditambahkan, Siswa telah melunasi pembayarannya!');
        }

        $payment = new StudentPayments;
        $payment->stp_student_id = $request->stp_student_id;
        $payment->stp_payment_status = 1;
        $payment->stp_payment_method = $request->stp_payment_method;
        $payment->stp_reason = null;
        $payment->stp_date_verification = null;
        $payment->stp_date = now();
        $payment->stp_nominal = str_replace(".", "", $request->stp_nominal);
        $payment->stp_type_payment = $request->stp_type_payment;
        if ($request->hasFile('stp_picture')) {
            $files = $request->file('stp_picture');
            $path = public_path('images/student_files/payments');
            $files_name = 'images' . '/' . 'student_files' . '/' . 'payments' .  '/' . date('Ymd') . '_' . $files->getClientOriginalName();
            $files->move($path, $files_name);
            $payment->stp_picture = $files_name;
        }
        //dd($payment);
        if ($payment->save()) {
            return redirect('/school-payments')->with('success', 'Data Berhasil Ditambahkan');
        }        

    }

     public function student_payment_detail($studentID)
    {        
        $no = 1;
        $payment = StudentPayments::join('students', 'students.stu_id', '=', 'student_payments.stp_student_id')
        ->join('users', 'users.usr_id', '=', 'students.stu_user_id')
        ->where('student_payments.stp_student_id', $studentID)
        ->where('student_payments.stp_type_payment', 2)
        ->get();

         $student = Students::where('stu_id',$studentID)
        ->join('student_registrations', 'student_registrations.str_student_id','=','students.stu_id')
        ->join('school_years', 'student_registrations.str_school_year_id','=','school_years.scy_id')
        ->firstOrFail();
        
        $student_payment = StudentPayments::where('stp_student_id',$student->stu_id)->where('stp_payment_status', 2)->where('stp_type_payment', 2)->sum('stp_nominal');
        $ppdb_payment_price = $student->scy_payment_price;
        $remaining_payment = $ppdb_payment_price - $student_payment;

        return view('school-payments.detail-student-payment', compact('no','payment','student_payment','ppdb_payment_price','remaining_payment'));
    }

    public function school_payment_detail($studentPaymentID)
    {
        $payment = StudentPayments::join('students', 'students.stu_id', '=', 'student_payments.stp_student_id')
        ->join('users', 'users.usr_id', '=', 'students.stu_user_id')
        ->where('student_payments.stp_id', $studentPaymentID)
       ->get();
        return view('school-payments.detail-school-payment', ['payment' => $payment]);    
    }


    public function acceptSchoolPayment($studentPaymentID)
    {

        $school_payment = StudentPayments::join('students', 'students.stu_id', '=', 'student_payments.stp_student_id')
                            ->where('stp_id',$studentPaymentID)->first();
        $school_payment->stp_payment_status = '2';
        $school_payment->stp_reason = 'Pembayaran diterima karena data valid';
        $school_payment->update();

        $user = User::where('usr_id', $school_payment->stu_user_id)->first();        
        Mail::to($user['usr_email'])->send(new SchoolPaymentMail($user, $school_payment));

       return redirect('/school-payment/detail/'.$school_payment->stp_id)->with('success', 'Pembayaran berhasil dierima');    

   }

    public function refuseSchoolPayment($studentPaymentID)
    {

        $school_payment = StudentPayments::join('students', 'students.stu_id', '=', 'student_payments.stp_student_id')
                            ->where('stp_id',$studentPaymentID)->first();

        return view('school-payments.reason-payment-refuse',compact('school_payment'));
    }

    public function storeRefuseSchoolPayment(Request $request,$studentPaymentID)
    {

        $school_payment = StudentPayments::join('students','student_payments.stp_student_id','=','students.stu_id')->where('stp_id', $studentPaymentID)->first();
        $school_payment->stp_reason = $request->stp_reason;
        $school_payment->stp_payment_status = '3';
        $school_payment->stp_date_verification = now();
        $school_payment->update();
        
        $user = User::where('usr_id', $school_payment->stu_user_id)->first();        
        Mail::to($user['usr_email'])->send(new SchoolPaymentMail($user, $school_payment));

        return redirect('/school-payment/detail/'.$school_payment->stp_id)->with('success', 'Pembayaran berhasil ditolak');
    }

    public function updateStatusToReRegistration(Request $request)
    {
         if ($request->ajax()) {
            $students = Students::join('student_registrations', 'student_registrations.str_student_id','=','students.stu_id')->select('str_id', 'str_student_id' ,'str_status')->where('str_status', 1)->orWhere('str_status', 6)->get();
            $check_status_student = StudentRegistration::where('str_status',1)->orWhere('str_status', 6)->count();
            if ($check_status_student == 0) {
               return response()->json(['code' => 400, 'message' => 'Tidak ada siswa yang harus daftar ulang'], 400);
            }else{
                foreach ($students as $student) {
                    $student_registration = StudentRegistration::where('str_status', $student->str_status)->first();
                    $student_registration->str_status = 5;
                    $student_registration->str_updated_by = Auth()->user()->usr_id;
                    $student_registration->update();
                }
             return response()->json(['code' => 200, 'message' => 'Semua status siswa menjadi sedang daftar ulang'], 200);
           }
        }
    }

    public function reRegistration()
    {
        $student = Students::where('stu_user_id', Auth()->user()->usr_id)
        ->join('users','students.stu_user_id','=','users.usr_id')
        ->join('student_registrations', 'student_registrations.str_student_id','=','students.stu_id')
        ->join('school_years', 'student_registrations.str_school_year_id','=','school_years.scy_id')
        ->firstOrFail();
        if ($student->str_status != '5') {
            return back();
        }
        $student_payment = StudentPayments::where('stp_student_id',$student->stu_id)->where('stp_payment_status', 2)->where('stp_type_payment', 2)->sum('stp_nominal');
        $ppdb_payment_price = $student->scy_payment_price;
        $remaining_payment = $ppdb_payment_price - $student_payment;
        return view('students.re-registration',compact('student', 'student_payment', 'ppdb_payment_price', 'remaining_payment'));
    }
    public function reRegistrationStore(Request $request)
    {
        if ($request->ajax()) {
            if(Hash::check($request->usr_password, Auth()->user()->usr_password)) {
            $student_registration = StudentRegistration::where('str_student_id', $request->stu_id)->first();
            $student_registration->str_status = 6;
            $student_registration->str_reason = "Selamat anda diterima daftar ulang";
            $student_registration->str_updated_by = Auth()->user()->usr_id;
            $student_registration->update();
            return response()->json([
                    'success' => true,
                    'message' => 'Selamat anda berhasil daftar ulang'
                ], 200);
            }
            return response()->json([
                'success' => false,
                'message' => 'Konfirmasi kata sandi salah'
            ], 401);
        }
    }
    public function getShowReRegistration($studentID)
    {
        $student_re_registration = Students::find($studentID);
        return response()->json($student_re_registration);
    }

    public function studentMove($studentID)
    {
        $student = Students::where('stu_id', $studentID)->firstOrFail();
        return view('students.student-move', ['student' => $student]);
    }
    public function updateStudentMove(Request $request, $studentID)
    {
        $messages = [
            'required'  => 'Kolom wajib diisi',
            'size'      => 'Ukuran file Max 2 MB',
            'uploaded'  => 'Gagal di unggah, ukuran file max 2 MB'
        ];

        $request->validate([
            'str_upload_file'   => 'required | max:2048',
        ], $messages);

        $student_registration = StudentRegistration::where('str_student_id', $studentID)->firstOrFail();
        $student = Students::where('stu_id', $studentID)->first();
        $user = User::where('usr_id', $student->stu_user_id)->firstOrFail();
        // dd($student_registration, $student, $user);
        if (Hash::check($request->usr_password, Auth()->user()->usr_password)) {
            if ($request->hasFile('str_upload_file')) {
                $files = $request->file('str_upload_file');
                $path = public_path('images/student_files/student_move');
                $files_name = 'images' . '/' . 'student_files' .'/'. 'student_move' . '/' . date('Ymd') . '_' . $files->getClientOriginalName();
                $files->move($path, $files_name);
                $student_registration->str_upload_file = $files_name;
            }
            $student_registration->str_reason = $request->str_reason;
            $student_registration->str_status = 4;
            $student_registration->str_updated_by = Auth()->user()->usr_id;
            $student_registration->update();
            
            $user->usr_is_active = false;
            $user->usr_updated_by = Auth()->user()->usr_id;
            $user->update();
            return redirect('students')->with('success', 'Data siswa pindah berhasil di simpan');   
        }
        return back()->with('error', 'Kata sandi verifikasi salah');    
    }

    public function studentDropOut($studentID)
    {
        $student = Students::where('stu_id', $studentID)->firstOrFail();
        return view('students.student-drop-out', ['student' => $student]);
    }
    public function updateStudentDropOut(Request $request, $studentID)
    {
        $messages = [
            'required'  => 'Kolom wajib diisi',
            'size'      => 'Ukuran file Max 2 MB',
            'uploaded'  => 'Gagal di unggah, ukuran file max 2 MB'
        ];

        $request->validate([
            'str_upload_file'   => 'required | max:2048',
        ], $messages);

        $student_registration = StudentRegistration::where('str_student_id', $studentID)->firstOrFail();
        $student = Students::where('stu_id', $studentID)->first();
        $user = User::where('usr_id', $student->stu_user_id)->firstOrFail();
        // dd($student_registration, $student, $user);
        if (Hash::check($request->usr_password, Auth()->user()->usr_password)) {
            if ($request->hasFile('str_upload_file')) {
                $files = $request->file('str_upload_file');
                $path = public_path('images/student_files/student_drop_out');
                $files_name = 'images' . '/' . 'student_files' .'/'. 'student_drop_out' . '/' . date('Ymd') . '_' . $files->getClientOriginalName();
                $files->move($path, $files_name);
                $student_registration->str_upload_file = $files_name;
            }
            $student_registration->str_reason = $request->str_reason;
            $student_registration->str_status = 3;
            $student_registration->str_updated_by = Auth()->user()->usr_id;
            $student_registration->update();
            
            $user->usr_is_active = false;
            $user->usr_updated_by = Auth()->user()->usr_id;
            $user->update();
            return redirect('students')->with('success', 'Data siswa dikeluarkan berhasil di simpan');   
        }
        return back()->with('error', 'Kata sandi verifikasi salah');    
    }
    public function generateNis(Request $request)
    {
        if ($request->ajax()) {
            $student_check_nis = Students::join('student_registrations', 'student_registrations.str_student_id','=','students.stu_id')->where('stu_nis', NULL)->where('str_status', 1)->orWhere('str_status',6)->orderBy('stu_candidate_name','desc')->get();
            $check_count_nis = Students::join('student_registrations', 'student_registrations.str_student_id','=','students.stu_id')->where('stu_nis', NULL)->where('str_status', 1)->orWhere('str_status',6)->count();
                if ($check_count_nis == 0) {
                    return response()->json(['status' => false,'code' => 400, 'message' => 'Tidak ada siswa yang perlu digenerate'], 400);
                }
            foreach($student_check_nis as $key => $student){
                $count_nis = Students::join('student_registrations', 'student_registrations.str_student_id','=','students.stu_id')->where('stu_nis', NULL)->where('str_status', 1)->orWhere('str_status',6)->count();
                $school_year_first = StudentRegistration::find($student->str_id)->getSchoolYear->scy_first_year;
                $school_year_last = StudentRegistration::find($student->str_id)->getSchoolYear->scy_last_year;
                $school_year_combined = schoolYearFirst($school_year_first, $school_year_last);
                for ($i=1; $i <= $count_nis; $i++) { 
                    $start_format = $i;
                }
                $student->stu_nis = $school_year_combined.'10'. sprintf("%03d", $start_format);
                $student->update();
            };
            return response()->json(['status' => true, 'code' => 200, 'message' => 'Nis siswa berhasil di generate'], 200);
        }
    }
}
