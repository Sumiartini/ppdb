<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\Majors;
use App\GradeLevels;
use App\StudentClass;
use App\Students;
use App\HomeroomTeachers;
use App\Years;
class ClassController extends Controller
{
    public function create()
    {
    	$majors = Majors::where('mjr_is_active', 1)->get();
    	$grade_levels = GradeLevels::all();
        $school_years = Years::select('scy_id','scy_name')->get();
    	return view('classes.add-class',['grade_levels' => $grade_levels, 'majors' => $majors, 'school_years' => $school_years]);
    }
    public function store(Request $request)
    {
    	// dd($request);
        $messages = [
            'required'  => 'Kolom wajib diisi',
        ];
        $request->validate([
      		'cls_grade_level'	=> 'required',
      		'cls_major'			=> 'required',
      		'cls_number'		=> 'required',
            'cls_school_year_id'    => 'required'
        ], $messages);
    	
    	$class_check = Classes::where('cls_grade_level_id', $request->cls_grade_level)->where('cls_major_id', $request->cls_major)->where('cls_number', $request->cls_number)->where('cls_school_year_id', $request->cls_school_year_id)->first();
    	// dd($class_check);
    	if ($class_check) {
    		return redirect()->back()->with('error', 'Kelas sudah tersedia');
    	}

    	$class = new Classes;
    	$class->cls_major_id = $request->cls_major;
    	$class->cls_grade_level_id = $request->cls_grade_level;
    	$class->cls_number = $request->cls_number;
    	$class->cls_is_active = 1;
        $class->cls_school_year_id = $request->cls_school_year_id;
    	$class->cls_created_by = Auth()->user()->usr_id;
    	$class->save();

    	return redirect('/classes')->with('success', 'Kelas berhasil ditambahkan');	
    }

    public function edit($classID)
    {
    	$majors = Majors::where('mjr_is_active', 1)->get();
    	$grade_levels = GradeLevels::all();
        $school_years = Years::select('scy_id','scy_name')->get();
    	$class = Classes::join('majors','classes.cls_major_id','=','majors.mjr_id')->join('grade_levels','classes.cls_grade_level_id','=','grade_levels.grl_id')->join('school_years','cls_school_year_id','=','school_years.scy_id')->where('classes.cls_id', $classID)->first();
    	// dd($class);
    	return view('classes.edit-class',['grade_levels' => $grade_levels, 'majors' => $majors, 'class' => $class, 'school_years'  => $school_years]);
    }
    public function update(Request $request, $classID)
    {
    	// dd($request, $classID);
    	$messages = [
            'required'  => 'Kolom wajib diisi',
        ];
        $request->validate([
      		'cls_grade_level'	=> 'required',
      		'cls_major'			=> 'required',
      		'cls_number'		=> 'required',
            'cls_school_year_id'    => 'required'
        ], $messages);
    	
    	$class = Classes::where('cls_id', $classID)->first();
    	$class_check = Classes::where('cls_grade_level_id', $request->cls_grade_level)->where('cls_major_id', $request->cls_major)->where('cls_number', $request->cls_number)->where('cls_school_year_id', $request->cls_school_year_id)->first();
    	// dd($class_check);

    	if ($class->cls_grade_level_id == $request->cls_grade_level && $class->cls_major_id == $request->cls_major && $class->cls_number == $request->cls_number && $class->cls_school_year_id == $request->cls_school_year_id) {
    		return redirect('/classes');
    	}

    	if ($class_check) {
    		return redirect()->back()->with('error', 'Kelas sudah tersedia');
    	}

    	$class = Classes::where('cls_id', $classID)->first();
    	$class->cls_major_id = $request->cls_major;
    	$class->cls_grade_level_id = $request->cls_grade_level;
    	$class->cls_number = $request->cls_number;
    	$class->cls_updated_by = Auth()->user()->usr_id;
    	$class->update();

    	return redirect('/classes')->with('success', 'Kelas berhasil diubah');
    }



    public function editStatus($classID)
    {
        // dd($classID);
        $class = Classes::where('cls_id', $classID)->first();
        if ($class->cls_is_active == 1) {
            $class->cls_is_active = 0;
            $class->cls_updated_by = Auth()->user()->usr_id;
            $class->update();
            return redirect()->back()->with('success', 'Kelas berhasil di non aktifkan');
        }else{
            $class->cls_is_active = 1;
            $class->update();
            return redirect()->back()->with('success', 'Kelas berhasil di aktifkan');
        }
    }

    public function show_class($classID)
    {
        $class = Classes::join('grade_levels','classes.cls_grade_level_id','=','grade_levels.grl_id')
        ->join('majors','classes.cls_major_id','=','majors.mjr_id')
        ->join('school_years','classes.cls_school_year_id','=','school_years.scy_id')
        ->where('cls_id', $classID)
        ->get();

        $teacher = HomeroomTeachers::join('classes', 'classes.cls_id', '=', 'homeroom_teachers.hrt_class_id')
                                    ->join('teachers', 'teachers.tcr_id', 'homeroom_teachers.hrt_teacher_id')
                                    ->join('users', 'users.usr_id', '=', 'teachers.tcr_user_id')
                                    ->where('classes.cls_id', $classID)->first();
        $student = StudentClass::join('students', 'students.stu_id', '=', 'student_classes.stc_student_id')
                   ->join('classes', 'classes.cls_id', '=', 'student_classes.stc_class_id')
                   ->where('classes.cls_id', $classID)
                   ->get();
        return view('classes.detail-class', ['class' => $class, 'student' => $student, 'teacher' => $teacher]);
    }

    public function add_student($classID)
    {
        $student = Students::all();
        $class = Classes::join('grade_levels','classes.cls_grade_level_id','=','grade_levels.grl_id')
        ->join('majors','classes.cls_major_id','=','majors.mjr_id')
        ->join('school_years','classes.cls_school_year_id','=','school_years.scy_id')
        ->where('cls_id', $classID)
        ->get();
        return view('classes.add-student-class', ['student' => $student, 'class' => $class]);
    }

    public function store_add_student(Request $request)
    {
        $student_check = StudentClass::where('stc_student_id', $request->stu_id)->orderBy('stc_class_id', 'desc')->first();;
        $class_check = Classes::where('cls_id', $request->cls_id)->first();     

        if ($student_check == null) {
            if ($class_check->cls_grade_level_id == 1) {
            $studentClass = new StudentClass;
            $studentClass->stc_student_id    = $request->stu_id;
            $studentClass->stc_class_id      = $request->cls_id;
            $studentClass->stc_created_by    = Auth()->user()->usr_id;
            $studentClass->save();
            return redirect('/class/'.$studentClass->stc_class_id)->with('success', 'Siswa telah ditambahkan');
            }else{
                return back()->with('error', 'Masukkan dulu kelas siswa sebelumnya. Siswa tidak dapat loncat kelas');
            }
        }else{
            $student_class = Classes::where('cls_id', $student_check->stc_class_id)->first();
            if ($class_check->cls_grade_level_id > $student_class->cls_grade_level_id) {
                if ($class_check->cls_grade_level_id == 3 && $student_class->cls_grade_level_id == 1 ) {
                    return back()->with('error', 'Masukkan dulu kelas siswa sebelumnya. Siswa tidak dapat loncat kelas');
                }elseif($class_check->cls_grade_level_id == 2) {
                    $studentClass = new StudentClass;
                    $studentClass->stc_student_id    = $request->stu_id;
                    $studentClass->stc_class_id      = $request->cls_id;
                    $studentClass->stc_created_by    = Auth()->user()->usr_id;
                    $studentClass->save();
                    return redirect('/class/'.$studentClass->stc_class_id)->with('success', 'Siswa telah ditambahkan');
                }elseif($class_check->cls_grade_level_id == 3){
                    $studentClass = new StudentClass;
                    $studentClass->stc_student_id    = $request->stu_id;
                    $studentClass->stc_class_id      = $request->cls_id;
                    $studentClass->stc_created_by    = Auth()->user()->usr_id;
                    $studentClass->save();
                    return redirect('/class/'.$studentClass->stc_class_id)->with('success', 'Siswa telah ditambahkan');

                }else{
                    return back()->with('error', 'Masukkan dulu kelas siswa sebelumnya. Siswa tidak dapat loncat kelas');
                }
            }else{
                return back()->with('error', 'Siswa telah memiliki kelas atau kelas siswa sebelumnya lebih rendah atau sama dengan kelas yang baru ditambahkan');
            }
        }
    }

    public function move_student_class($studentClassID)
    {
        $student = StudentClass::join('students', 'students.stu_id', '=', 'student_classes.stc_student_id')
                                ->join('classes', 'classes.cls_id', 'student_classes.stc_class_id')
                                ->join('grade_levels','classes.cls_grade_level_id','=','grade_levels.grl_id')
                                ->join('majors','classes.cls_major_id','=','majors.mjr_id')
                                ->join('school_years' , 'classes.cls_school_year_id', '=' , 'school_years.scy_id')
                                ->where('stc_id', $studentClassID)->get();
        $class = Classes::join('grade_levels','classes.cls_grade_level_id','=','grade_levels.grl_id')
        ->join('majors','classes.cls_major_id','=','majors.mjr_id')
        ->join('school_years','classes.cls_school_year_id','=','school_years.scy_id')
        ->get();
        return view('classes.move-student-class', ['student' => $student, 'class' => $class]);
    }

    public function store_move_student_class(Request $request, $studentClassID)
    {
        $class_check = Classes::where('cls_id', $request->cls_id)->first();
        $student = StudentClass::where('stc_id', $studentClassID)->first();
        $class_student = Classes::where('cls_id', $student->stc_class_id)->first();
        
        if ($class_check->cls_grade_level_id == $class_student->cls_grade_level_id) {
        $studentClass = StudentClass::where('stc_id', $studentClassID)->first();
        $studentClass->stc_class_id = $request->cls_id;
        $studentClass->stc_updated_by = Auth()->user()->usr_id;
        $studentClass->update();
        return redirect('/class/'.$studentClass->stc_class_id)->with('success', 'Siswa Berhasil Dipindahkan');
        }else{
            return back()->with('error', 'Siswa hanya dapat pindah kelas dengan tingkatan yang sama');
        }
    }

    public function add_class_student($studentID)
    {
        $student = Students::where('stu_id', $studentID)->first();
        $class = Classes::join('grade_levels','classes.cls_grade_level_id','=','grade_levels.grl_id')
        ->join('majors','classes.cls_major_id','=','majors.mjr_id')
        ->join('school_years','classes.cls_school_year_id','=','school_years.scy_id')
        ->get();
        return view('classes.add-class-student', ['student' => $student, 'class' => $class]);        
    }

    public function store_add_class_student(Request $request)
    {
        $student_check = StudentClass::where('stc_student_id', $request->stu_id)->orderBy('stc_class_id', 'desc')->first();
        $class_check = Classes::where('cls_id', $request->cls_id)->first();     
        if ($student_check == null) {
            if ($class_check->cls_grade_level_id == 1) {
            $studentClass = new StudentClass;
            $studentClass->stc_student_id    = $request->stu_id;
            $studentClass->stc_class_id      = $request->cls_id;
            $studentClass->stc_created_by    = Auth()->user()->usr_id;
            $studentClass->save();
            return redirect('/class/'.$studentClass->stc_class_id)->with('success', 'Siswa telah ditambahkan');
            }else{
                return back()->with('error', 'Masukkan dulu kelas siswa sebelumnya. Siswa tidak dapat loncat kelas');
            }
        }else{
            $student_class = Classes::where('cls_id', $student_check->stc_class_id)->first();
            if ($class_check->cls_grade_level_id > $student_class->cls_grade_level_id) {
                if ($class_check->cls_grade_level_id == 3 && $student_class->cls_grade_level_id == 1 ) {
                    return back()->with('error', 'Masukkan dulu kelas siswa sebelumnya. Siswa tidak dapat loncat kelas');
                }elseif ($class_check->cls_grade_level_id == 2) {
                    $studentClass = new StudentClass;
                    $studentClass->stc_student_id    = $request->stu_id;
                    $studentClass->stc_class_id      = $request->cls_id;
                    $studentClass->stc_created_by    = Auth()->user()->usr_id;
                    $studentClass->save();
                    return redirect('/class/'.$studentClass->stc_class_id)->with('success', 'Siswa telah ditambahkan');;        
                }elseif($class_check->cls_grade_level_id == 3){
                    $studentClass = new StudentClass;
                    $studentClass->stc_student_id    = $request->stu_id;
                    $studentClass->stc_class_id      = $request->cls_id;
                    $studentClass->stc_created_by    = Auth()->user()->usr_id;
                    $studentClass->save();
                    return redirect('/class/'.$studentClass->stc_class_id)->with('success', 'Siswa telah ditambahkan');;
                }else{
                    return back()->with('error', 'Masukkan dulu kelas siswa sebelumnya. Siswa tidak dapat loncat kelas');
                }
            }else{
                return back()->with('error', 'Siswa telah memiliki kelas atau kelas siswa sebelumnya lebih rendah atau sama dengan kelas yang baru ditambahkan');
            }
        }
    }
}
