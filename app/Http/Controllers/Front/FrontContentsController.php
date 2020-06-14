<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Admission;
use DateTime;
use App\Models\Profile;
use App\Models\Document;
use App\Models\Course;
use App\Models\Payment;

class FrontContentsController extends Controller
{
    public function index(){
        // return view('front.index');
        $requests = Admission::where('status',1)
                                ->join('profiles','profiles.id','=','admissions.profile_id')
                                ->join('courses','profiles.course','=','courses.id')
                                ->select('courses.code as course','profiles.last_name','profiles.first_name','profiles.school_id','admissions.status','admissions.created_at','admissions.profile_id')
                                ->get();
        return $requests;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAdmission()
    {
        $courses = Course::all();
        return view('front.online-admission')->with('courses', $courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAdmission(Request $request)
    {
        // if(request()->ajax()){
            $applicantDetails[] = '';

            $validation = Validator::make($request->all(),[
                'applicant-img'           => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'first-name'              => 'required',
                'middle-name'             => 'required',
                'last-name'               => 'required',
                'gender'                  => 'required',
                'civil-status'            => 'required',
                'contact-number'          => 'required',
                'religion'                => 'required',
                'street-barangay'         => 'required',
                'municipality'            => 'required',
                'province'                => 'required',
                'zip-code'                => 'required',
                'parent-guardian-name'    => 'required',
                'parent-guardian-contact' => 'required',
                'school-graduated'        => 'required',
                'year-graduated'          => 'required',
                'school-address'          => 'required',
                'course'                  => 'required',
                'year-level'              => 'required',
                'sf9-front'               => 'image|nullable|mimes:jpeg,png,jpg,gif,svg',
                'sf9-back'                => 'image|nullable|mimes:jpeg,png,jpg,gif,svg',
                'gmc'                     => 'image|nullable|mimes:jpeg,png,jpg,gif,svg',
                'psa-bc'                  => 'image|nullable|mimes:jpeg,png,jpg,gif,svg',
                'med-cert'                => 'image|nullable|mimes:jpeg,png,jpg,gif,svg',
                'hd'                      => 'image|nullable|mimes:jpeg,png,jpg,gif,svg'
            ]);

            $error_array = array();
            $success_output = '';


            if($validation->fails()){
                foreach($validation->messages()->getMessages() as $field_name => $messages){
                    $error_array[] = $messages;
                }
            } else {
                // file upload
                $now = new \DateTime('NOW');
                $date = $now->format('m-d-Y_H.i.s');

                if($request->has('applicant-img')){
                    $applicant_Img_WithExt = $request->file('applicant-img')->getClientOriginalName();
                    $applicant_Img_filename = pathinfo($applicant_Img_WithExt, PATHINFO_FILENAME);
                    $applicant_Img_extension = $request->file('applicant-img')->getClientOriginalExtension();
                    $applicant_img = $applicant_Img_filename.'-'.$date.'.'.$applicant_Img_extension;
                    $path_applicant_img = $request->file('applicant-img')->storeAs('public/uploads/applicant-img', $applicant_img);
                } else {
                    $applicant_img = '';
                }
                
                // DOCUMENTS BLOCK
                if($request->has('sf9-front')){
                    $sf9_front_WithExt = $request->file('sf9-front')->getClientOriginalName();
                    $sf9_front_filename = pathinfo($sf9_front_WithExt, PATHINFO_FILENAME);
                    $sf9_front_extension = $request->file('sf9-front')->getClientOriginalExtension();
                    $sf9_front = $sf9_front_filename.'-'.$date.'.'.$sf9_front_extension;
                    $path_sf9_front = $request->file('sf9-front')->storeAs('public/uploads/sf9-front', $sf9_front);
                } else {
                    $sf9_front = '';
                }

                if($request->has('sf9-back')){
                    $sf9_back = $request->file('sf9-back')->getClientOriginalName();
                    $sf9_back = pathinfo($sf9_back, PATHINFO_FILENAME);
                    $sf9_back_extension = $request->file('sf9-back')->getClientOriginalExtension();
                    $sf9_back = $sf9_back.'-'.$date.'.'.$sf9_back_extension;
                    $path_sf9_back = $request->file('sf9-back')->storeAs('public/uploads/sf9-back', $sf9_back);
                } else {
                    $sf9_back = '';
                }

                if($request->has('gmc')){
                    $gmc_WithExt = $request->file('gmc')->getClientOriginalName();
                    $gmc_filename = pathinfo($gmc_WithExt, PATHINFO_FILENAME);
                    $gmc_extension = $request->file('gmc')->getClientOriginalExtension();
                    $gmc = $gmc_filename.'-'.$date.'.'.$gmc_extension;
                    $path_gmc = $request->file('gmc')->storeAs('public/uploads/gmc', $gmc);
                } else {
                    $gmc = '';
                }

                if($request->has('psa-bc')){
                    $psa_bc_WithExt = $request->file('psa-bc')->getClientOriginalName();
                    $psa_bc_filename = pathinfo($psa_bc_WithExt, PATHINFO_FILENAME);
                    $psa_bc_extension = $request->file('psa-bc')->getClientOriginalExtension();
                    $psa_bc = $psa_bc_filename.'-'.$date.'.'.$psa_bc_extension;
                    $path_psa_bc = $request->file('psa-bc')->storeAs('public/uploads/psa-bc', $psa_bc);
                } else {
                    $psa_bc = '';
                }

                if($request->has('med-cert')){
                    $med_cert_WithExt = $request->file('med-cert')->getClientOriginalName();
                    $med_cert_filename = pathinfo($med_cert_WithExt, PATHINFO_FILENAME);
                    $med_cert_extension = $request->file('med-cert')->getClientOriginalExtension();
                    $med_cert = $med_cert_filename.'-'.$date.'.'.$med_cert_extension;
                    $path_med_cert = $request->file('med-cert')->storeAs('public/uploads/med-cert', $med_cert);
                } else {
                    $med_cert = '';
                }

                if($request->has('hd')){
                    $hd_WithExt = $request->file('hd')->getClientOriginalName();
                    $hd_filename = pathinfo($hd_WithExt, PATHINFO_FILENAME);
                    $hd_extension = $request->file('hd')->getClientOriginalExtension();
                    $hd = $hd_filename.'-'.$date.'.'.$hd_extension;
                    $path_hd = $request->file('hd')->storeAs('public/uploads/hd', $hd);
                } else {
                    $hd = '';
                }
                // END OF DOCUMENTS BLOCK
            

                // create admission
                $profile = new Profile;
                $profile->school_id               = '0';
                $profile->profile_pic             = $applicant_img;
                $profile->first_name              = $request->input('first-name');
                $profile->middle_name             = $request->input('middle-name');
                $profile->last_name               = $request->input('last-name');
                $profile->gender                  = $request->input('gender');
                $profile->contact_number          = $request->input('contact-number');
                $profile->civil_status            = $request->input('civil-status');
                $profile->religion                = $request->input('religion');
                $profile->purok                   = $request->input('purok');
                $profile->sitio                   = $request->input('sitio');
                $profile->barangay                = $request->input('street-barangay');
                $profile->municipality            = $request->input('municipality');
                $profile->province                = $request->input('province');
                $profile->zipcode                 = $request->input('zip-code');
                $profile->emergency_contact_name  = $request->input('parent-guardian-name');
                $profile->emergency_contact_number= $request->input('parent-guardian-contact');
                $profile->school_graduated        = $request->input('school-graduated');
                $profile->school_address          = $request->input('school-address');
                $profile->year_graduated          = $request->input('year-graduated');
                $profile->lrn                     = $request->input('lrn');
                $profile->course                  = $request->input('course');
                $profile->year_level              = $request->input('year-level');
                $profile->complete_profile        = 0;
                $profile->save();

                $documents = new Document;
                $documents->report_card_front = $sf9_front;
                $documents->report_card_back = $sf9_back;
                $documents->good_moral = $gmc;
                $documents->psa_birth_cert = $psa_bc;
                $documents->med_cert = $med_cert;
                $documents->honorable_dismissal = $hd;
                $profile->documents()->save($documents);
                
                $admission = new Admission;
                $admission->profile_id = $profile->id;
                $admission->academic_year = '2020-2021'; // ########### make this dynamic ########## //
                $admission->semester = '1'; // ########### make this dynamic ########## //
                $admission->status = '0';
                $admission->save();

                $initialBalance = 0;
                if($profile->year_level == 1){
                    $initialBalance = 3500.00;
                } else {
                    $initialBalance = 3300.00;
                }
                $payment = new Payment;
                $payment->profile_id = $profile->id;
                $payment->type = 'Enrollment Fee';
                $payment->amount = 0;
                $payment->balance = $initialBalance;
                $payment->or_number = 'none';
                $payment->ref_number = 'none';
                $payment->others = 'Enrollment fee unpaid';
                $payment->save();

                $applicantDetails['first_name']             = $request->input('first-name');
                $applicantDetails['middle_name']            = $request->input('middle-name');
                $applicantDetails['last_name']              = $request->input('last-name');
                $applicantDetails['gender']                 = $request->input('gender');
                $applicantDetails['first_name']             = $request->input('first-name');
                $applicantDetails['contact_number']         = $request->input('contact-number');
                $applicantDetails['civil_status']           = $request->input('civil-status');
                $applicantDetails['religion']               = $request->input('religion');
                $applicantDetails['house_number']           = $request->input('house-number');
                $applicantDetails['sitio']                  = $request->input('sitio');
                $applicantDetails['street_barangay']        = $request->input('street-barangay');
                $applicantDetails['municipality']           = $request->input('municipality');
                $applicantDetails['province']               = $request->input('province');
                $applicantDetails['zip_code']               = $request->input('zip-code');
                $applicantDetails['parent_guardian_name']   = $request->input('parent-guardian-name');
                $applicantDetails['parent_guardian_contact']= $request->input('parent-guardian-contact');
                $applicantDetails['school_graduated']       = $request->input('school-graduated');
                $applicantDetails['school_address']         = $request->input('school-address');
                $applicantDetails['year_graduated']         = $request->input('year-graduated');
                $applicantDetails['lrn']                    = $request->input('lrn');
                $applicantDetails['course']                 = $request->input('course');
                $applicantDetails['year_level']             = $request->input('year-level');
                
                $noUploadedDoc = 'admin/img/no-document-uploaded.jpg';
                $filePath = 'storage/uploads/';
                $applicantDetails['applicant_img']          = $filePath.'applicant-img/'.$applicant_img;
                $applicantDetails['sf9_front']              = $sf9_front ? $filePath.'sf9-front/'.$sf9_front : $noUploadedDoc;
                $applicantDetails['sf9_back']               = $sf9_back ? $filePath.'sf9-back/'.$sf9_back : $noUploadedDoc;
                $applicantDetails['gmc']                    = $gmc ? $filePath.'gmc/'.$gmc : $noUploadedDoc;
                $applicantDetails['psa_bc']                 = $psa_bc ? $filePath.'psa-bc/'.$psa_bc : $noUploadedDoc;
                $applicantDetails['med_cert']               = $med_cert ? $filePath.'med-cert/'.$med_cert : $noUploadedDoc;
                $applicantDetails['hd']                     = $hd ? $filePath.'hd/'.$hd : $noUploadedDoc;
                $applicantDetails['courses']                = Course::select('id','code')->get();
            }

            if($error_array){
                return response()->json([
                    'error' => $error_array
                ], 400);
            }
            
        // }

        return response()->json([
            'success' => $applicantDetails
        ], 200);
    }

    public function fetchOldStudent($name)
    {
        $searchId = false;
        $error = 'Sorry, no record found!';
        if($name == ','){
            return response()->json([
                'error' => 'You did not enter your name!',
            ], 404);
        }
        $names = explode(',',$name);
        $lname = $names[0];
        if($lname == ''){
            return response()->json([
                'error' => 'You did not enter your last name!',
            ], 404);
        } else if($lname == 'id'){
            $searchId = true;
        }

        $fname = $names[1];
        if($fname == ''){
            return response()->json([
                'error' => 'You did not enter your first name!',
            ], 404);
        }
        
        if($searchId){
            $oldStudent = Profile::select('school_id','first_name', 'last_name','middle_name','courses.code as course')
                        ->where('school_id', $fname)
                        ->join('courses','courses.ied','=','profiles.course')
                        ->where('courses.id','profiles.course')
                        ->first();
        } else {
            // dd($fname,$lname);
            $oldStudent = Profile::select('school_id','first_name', 'last_name','middle_name','courses.code as course')
                        ->where('first_name', 'LIKE', '%'.$fname.'%')
                        ->orWhere('last_name', 'LIKE', '%'.$lname.'%')
                        ->join('courses','courses.id','=','profiles.course')
                        ->where('courses.id','profiles.course')
                        ->first();
        }
        if($oldStudent == null){
            return response()->json([
                'error' => $error,
            ], 404);
        }

        return response()->json([
            'success' => $oldStudent,
        ], 200);
    }
}
