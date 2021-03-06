<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Provinces;
use App\StaffDetails;
use App\GtkNumber;

class Staffs extends Model
{
    protected $primaryKey = 'stf_id';
    const CREATED_AT = 'stf_created_at';
    const UPDATED_AT = 'stf_updated_at';
    protected $guarded = [];

    public static function getStaffs($request)
    {
        $staffs = Staffs::join('users', 'staffs.stf_user_id', '=', 'users.usr_id')
            ->join('gtk_numbers', 'staffs.stf_gtk_number_id','=','gtk_numbers.gtn_id')
            ->where('staffs.stf_registration_status', 1)
            ->where('users.usr_is_regist', 1)->select('users.usr_id', 'users.usr_name','users.usr_is_active','staffs.stf_id','gtn_number');
        return $staffs;
    }

    public function getStaffsDetail($staffID)
    {
        $staffs = Staffs::join('users', 'staffs.stf_user_id', '=', 'users.usr_id')
            // ->join('majors', 'students.stu_major_id', '=', 'majors.mjr_id')
            // ->join('entry_types', 'students.stu_entry_type_id', '=', 'entry_types.ent_id')
            ->where('stf_id', $staffID)->firstOrFail();

        $staff_details = StaffDetails::where('sfd_staff_id', $staffs->stf_id)->where('sfd_deleted_at', null)->get();
        $staff_details = mappingDataStaff($staff_details, $staffs);

        return $staff_details;
    }

    public static function getStaffsProspective($request)
    {

        $staffs_prospective = Staffs::join('users', 'staffs.stf_user_id', '=', 'users.usr_id')
            ->where('staffs.stf_registration_status', 0)
            ->where('users.usr_is_regist', 1)
            ->select('users.usr_name','staffs.stf_id','staffs.stf_nuptk');
        // dd($staff_prospective);
        return $staffs_prospective;
    }

    public function getStaffProsvectiveDetail($staffID)
    {
        $staffs_prospective = Staffs::join('users', 'staffs.stf_user_id', '=', 'users.usr_id')
            ->where('stf_id', $staffID)->firstOrFail();

        $staff_prospective_details = StaffDetails::where('sfd_staff_id', $staffs_prospective->stf_id)->get();
        $staff_prospective_details = mappingDataStaff($staff_prospective_details, $staffs_prospective);
        //dd($staffs_prospective);
        return $staff_prospective_details;
    }

    public function getStaffPendingVeification($staffID)
    {
        $staffs_prospective = Staffs::join('users', 'staffs.stf_user_id', '=', 'users.usr_id')
            ->where('stf_user_id', $staffID)->firstOrFail();

        $staff_prospective_details = StaffDetails::where('sfd_staff_id', $staffs_prospective->stf_id)->get();
        $staff_prospective_details = mappingDataStaff($staff_prospective_details, $staffs_prospective);
        //dd($staffs_prospective);
        return $staff_prospective_details;
    }

    public static function getStaffsRejected($request)
    {

        $staffs_rejected = Staffs::join('users', 'staffs.stf_user_id', '=', 'users.usr_id')
            // ->join('majors', 'students.stu_major_id','=','majors.mjr_id')
            ->where('staffs.stf_registration_status', 2)
            ->where('users.usr_is_regist', 1);
        // dd($staffs_rejected);
        return $staffs_rejected;
    }

    public function getStaffRejectedDetail($staffID)
    {
        $staffs_rejected = Staffs::join('users', 'staffs.stf_user_id', '=', 'users.usr_id')
            ->where('stf_id', $staffID)->firstOrFail();

        $staff_rejected_details = StaffDetails::where('sfd_staff_id', $staffs_rejected->stf_id)->get();
        $staff_rejected_details = mappingDataStaff($staff_rejected_details, $staffs_rejected);
        //dd($staffs_rejected);
        return $staff_rejected_details;
    }
    public function getStaffEdit($staffID)
    {
        $staffs_edit = Staffs::join('users', 'staffs.stf_user_id', '=', 'users.usr_id')            
            ->where('stf_id', $staffID)->firstOrFail();

        $get_staff_edit = staffDetails::where('sfd_staff_id', $staffs_edit->stf_id)->get();
        $get_staff_edit = mappingDataStaff($get_staff_edit, $staffs_edit);

        return $get_staff_edit;
    }

    public function no_gtk()
    {
        return $this->belongsTo(GtkNumber::class, 'stf_gtk_number_id','gtn_id');
    }
    public function school_year()
    {
        return $this->belongsTo(Years::class, 'stf_school_year_id', 'scy_id');
    }
}
