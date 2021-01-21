<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Admission;
use App\Models\Clearance;
use DateTime;
use App\Models\Profile;
use App\Models\Document;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Payment;
use App\Models\Option;
use App\Models\Subject;

class FrontContentsController extends Controller
{
    public function index(){
        return view('front.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAdmission()
    {
        $courses = Course::where('id','!=','5')->get();
        return view('front.online-admission')->with('courses', $courses);
        // return view('front.closed-online-admission');
    }

    public function registrarAdmission()
    {
        $courses = Course::where('id','!=','5')->get();
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
        $applicantDetails[] = '';
        // dd($request->all());
        $validation = Validator::make($request->all(),[
            'applicant-img'           => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'first-name'              => 'required',
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
            'hd'                      => 'image|nullable|mimes:jpeg,png,jpg,gif,svg',
            'dpa-agreement-date'      => 'required'
        ]);

        $error_array = array();

        // dd($validation);
        if($validation->fails()){
            $errors = $validation->errors();
            return response()->json([
                'errors' => $validation->getMessageBag()->toArray()
            ],414);
        } else {

            // file upload
            $now = new \DateTime('NOW');
            $date = $now->format('m-d-Y_H.i.s');

            if($request->has('applicant-img')){
                $applicant_Img_WithExt = $request->file('applicant-img')->getClientOriginalName();
                $applicant_Img_filename = str_replace(' ','_',pathinfo($applicant_Img_WithExt, PATHINFO_FILENAME));
                $applicant_Img_extension = $request->file('applicant-img')->getClientOriginalExtension();
                $applicant_img = $applicant_Img_filename.'-'.$date.'.'.$applicant_Img_extension;
                $path_applicant_img = $request->file('applicant-img')->storeAs('public/uploads/applicant-img', $applicant_img);
            } else {
                $applicant_img = 'No Data';
            }
            
            // DOCUMENTS BLOCK
            if($request->has('sf9-front')){
                $sf9_front_WithExt = $request->file('sf9-front')->getClientOriginalName();
                $sf9_front_filename = str_replace(' ','_',pathinfo($sf9_front_WithExt, PATHINFO_FILENAME));
                $sf9_front_extension = $request->file('sf9-front')->getClientOriginalExtension();
                $sf9_front = $sf9_front_filename.'-'.$date.'.'.$sf9_front_extension;
                $path_sf9_front = $request->file('sf9-front')->storeAs('public/uploads/sf9-front', $sf9_front);
            } else {
                $sf9_front = 'No Data';
            }

            if($request->has('sf9-back')){
                $sf9_back = $request->file('sf9-back')->getClientOriginalName();
                $sf9_back = str_replace(' ','_',pathinfo($sf9_back, PATHINFO_FILENAME));
                $sf9_back_extension = $request->file('sf9-back')->getClientOriginalExtension();
                $sf9_back = $sf9_back.'-'.$date.'.'.$sf9_back_extension;
                $path_sf9_back = $request->file('sf9-back')->storeAs('public/uploads/sf9-back', $sf9_back);
            } else {
                $sf9_back = 'No Data';
            }

            if($request->has('gmc')){
                $gmc_WithExt = $request->file('gmc')->getClientOriginalName();
                $gmc_filename = str_replace(' ','_',pathinfo($gmc_WithExt, PATHINFO_FILENAME));
                $gmc_extension = $request->file('gmc')->getClientOriginalExtension();
                $gmc = $gmc_filename.'-'.$date.'.'.$gmc_extension;
                $path_gmc = $request->file('gmc')->storeAs('public/uploads/gmc', $gmc);
            } else {
                $gmc = 'No Data';
            }

            if($request->has('psa-bc')){
                $psa_bc_WithExt = $request->file('psa-bc')->getClientOriginalName();
                $psa_bc_filename = str_replace(' ','_',pathinfo($psa_bc_WithExt, PATHINFO_FILENAME));
                $psa_bc_extension = $request->file('psa-bc')->getClientOriginalExtension();
                $psa_bc = $psa_bc_filename.'-'.$date.'.'.$psa_bc_extension;
                $path_psa_bc = $request->file('psa-bc')->storeAs('public/uploads/psa-bc', $psa_bc);
            } else {
                $psa_bc = 'No Data';
            }

            if($request->has('med-cert')){
                $med_cert_WithExt = $request->file('med-cert')->getClientOriginalName();
                $med_cert_filename = str_replace(' ','_',pathinfo($med_cert_WithExt, PATHINFO_FILENAME));
                $med_cert_extension = $request->file('med-cert')->getClientOriginalExtension();
                $med_cert = $med_cert_filename.'-'.$date.'.'.$med_cert_extension;
                $path_med_cert = $request->file('med-cert')->storeAs('public/uploads/med-cert', $med_cert);
            } else {
                $med_cert = 'No Data';
            }

            if($request->has('hd')){
                $hd_WithExt = $request->file('hd')->getClientOriginalName();
                $hd_filename = str_replace(' ','_',pathinfo($hd_WithExt, PATHINFO_FILENAME));
                $hd_extension = $request->file('hd')->getClientOriginalExtension();
                $hd = $hd_filename.'-'.$date.'.'.$hd_extension;
                $path_hd = $request->file('hd')->storeAs('public/uploads/hd', $hd);
            } else {
                $hd = 'No Data';
            }
            // END OF DOCUMENTS BLOCK
            
            // dd($request->all());
            // create admission
            $studentType = $request->input('studentType');
            $profileId = $request->input('profileId');

            // dd($studentType,$profileId);
            if($studentType === 'old'){
                $profile = Profile::where('id',$profileId)->first();
                // dd($profile);
            } else {
                $profile = new Profile;
                $profile->school_id               = 'No Data';
            }
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
                $profile->complete_profile        = 1;
                $profile->dpa_agreement           = $request->input('dpa-agreement-date');
                $profile->role                    = 3;
                $profile->save();

                $checkDocs = Document::where('profile_id',$profile->id)->first();
                if(empty($checkDocs)){
                    $documents = new Document;
                    $documents->report_card_front = $sf9_front;
                    $documents->report_card_back = $sf9_back;
                    $documents->good_moral = $gmc;
                    $documents->psa_birth_cert = $psa_bc;
                    $documents->med_cert = $med_cert;
                    $documents->honorable_dismissal = $hd;
                    $profile->documents()->save($documents);
                }
                
                $admission = new Admission;
                $admission->profile_id = $profile->id;
                $admission->academic_year = $this->globalAySem('ay'); // ########### make this dynamic ########## //
                $admission->semester = $this->globalAySem('sem'); // ########### make this dynamic ########## //
                $admission->course = $profile->course;
                $admission->status = '0';
                $admission->save();

                $checkPayment = Payment::where('profile_id',$profile->id)
                                            ->where('ay',$this->globalAySem('ay'))
                                            ->where('sem',$this->globalAySem('sem'))
                                            ->first();
                $initialEnrollFee = Option::where('type','initial-enrollment-fee')->first();
                if(empty($checkPayment)){
                    $initialBalance = 0;
                    if($profile->year_level == 1 && $studentType != 'old'){
                        $initialBalance = 3500.00;
                    } else {
                        $initialBalance = $initialEnrollFee->name;
                    }
                
                    $payment = new Payment;
                    $payment->profile_id = $profile->id;
                    $payment->type = 'Enrollment Fee';
                    $payment->amount = 0;
                    $payment->balance = $initialBalance;
                    $payment->or_number = 'none';
                    $payment->ref_number = 'none';
                    $payment->others = 'Enrollment fee unpaid';
                    $payment->ay = $this->globalAySem('ay');
                    $payment->sem = $this->globalAySem('sem');
                    $payment->save();
                }

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

                return response()->json([
                    'success' => $applicantDetails
                ], 200);            
        }     
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
        // dd($searchId);
        $courses = Course::where('id','!=','5')->get();
        if($searchId){
            $oldStudent = Profile::where('profiles.school_id', $fname)->select('id')->first();
            if($oldStudent){
                $enrollment = Enrollment::where('profile_id',$oldStudent->id)->get();
            }
            // dd($oldStudent);
            $notClearedYet = [];
            $noGradeYet = [];
            $clearanceStatus = true;
            $gradeStatus = true;
            // dd($oldStudent);
            foreach($enrollment as $subject){
                $clearance = Clearance::where('subjectId',$subject->subject_id)
                                        ->where('studentId',$oldStudent->id)
                                        ->get();
                if($clearance->count() == 0){
                    $notCleared = Subject::where('id',$subject->subject_id)->first();
                    array_push($notClearedYet,[$notCleared->code => $notCleared->description]);
                    $clearanceStatus = false;
                }

                $grade = Grade::where('subjectId',$subject->subject_id)
                                ->where('profileId',$oldStudent->id)
                                ->get();
                
                if($grade->count() == 0){
                    $noGrade = Subject::where('id',$subject->subject_id)->first();
                    array_push($noGradeYet,[$noGrade->code => $noGrade->description]);
                    $gradeStatus = false;
                }
            }
            // dd($clearanceStatus, $gradeStatus);
            $profile = Profile::where('id',$oldStudent->id)->get();
            if($clearanceStatus == false || $gradeStatus == false){
                return response()->json([
                    'notCleared' => $notClearedYet,
                    'noGrade' => $noGradeYet
                ], 400);
            } else {
                return response()->json([
                    'profiles' => $profile,
                    'courses' => $courses
                ], 200);
            }
        } else {
            $oldStudent = Profile::where('last_name',$lname)->where('first_name',$fname)->select('id')->first();
            if($oldStudent){
                $enrollment = Enrollment::where('profile_id',$oldStudent->id)->select('subject_id')->get();
            }

            // dd($oldStudent);
            $notClearedYet = [];
            $noGradeYet = [];
            $clearanceStatus = true;
            $gradeStatus = true;
            // dd($oldStudent);
            foreach($enrollment as $subject){
                $clearance = Clearance::where('subjectId',$subject->subject_id)
                                        ->where('studentId',$oldStudent->id)
                                        ->get();
                if($clearance->count() == 0){
                    $notCleared = Subject::where('id',$subject->subject_id)->first();
                    array_push($notClearedYet,[$notCleared->code => $notCleared->description]);
                    $clearanceStatus = false;
                }

                $grade = Grade::where('subjectId',$subject->subject_id)
                                ->where('profileId',$oldStudent->id)
                                ->get();
                
                if($grade->count() == 0){
                    $noGrade = Subject::where('id',$subject->subject_id)->first();
                    array_push($noGradeYet,[$noGrade->code => $noGrade->description]);
                    $gradeStatus = false;
                }
            }
            // dd($clearanceStatus, $gradeStatus);
            $profile = Profile::where('id',$oldStudent->id)->get();
            if($clearanceStatus == false || $gradeStatus == false){
                return response()->json([
                    'notCleared' => $notClearedYet,
                    'noGrade' => $noGradeYet
                ], 400);
            } else {
                return response()->json([
                    'profiles' => $profile,
                    'courses' => $courses
                ], 200);
            }
        }
        
        if($oldStudent == null){
            return response()->json([
                'error' => $error
            ], 404);
        }
        
    }

    public function checkIfAdmissionExists($id)
    {
        $profile = Profile::where('id',$id)->select('id')->first();
        $checkIfAdmissionExists = Admission::where('profile_id',$profile->id)
                                            ->where('academic_year',$this->globalAySem('ay'))
                                            ->where('semester',$this->globalAySem('sem'))
                                            ->first();
        $courses = Course::all();
        // dd($profile,$checkIfAdmissionExists);
        if($checkIfAdmissionExists){
            return response()->json([
                'error' => 'Admission request already exists!',
            ], 400);
        } else {
            return response()->json([
                'profile' => $profile,
                'courses' => $courses
            ], 200);
        }
    }

    public function admitOldStudent(Request $request, $id)
    {
        // dd($request->all(), $id);
        $admission = new Admission;
        $admission->profile_id = $id;
        $admission->academic_year = $this->globalAySem('ay');
        $admission->semester = $this->globalAySem('sem');
        $admission->course = $request->course;
        $admission->status = '0';
        $admission->save();

        $checkPayment = Payment::where('profile_id',$id)
                                    ->where('ay',$this->globalAySem('ay'))
                                    ->where('sem',$this->globalAySem('sem'))
                                    ->first();
        $initialEnrollFee = Option::where('type','initial-enrollment-fee')->first();
        if(empty($checkPayment)){
            $payment = new Payment;
            $payment->profile_id = $id;
            $payment->type = 'Enrollment Fee';
            $payment->amount = 0;
            $payment->balance = $initialEnrollFee->name;
            $payment->or_number = 'none';
            $payment->ref_number = 'none';
            $payment->others = 'Enrollment fee unpaid';
            $payment->ay = $this->globalAySem('ay');
            $payment->sem = $this->globalAySem('sem');
            $payment->save();
        }

        $profile = Profile::where('id',$id)->first();
        $profile->course = $request->course;
        $profile->year_level = $request->year;
        $profile->save();

        return response()->json([
            'id' => $id
        ], 200);
    }

    public function show($id)
    {
        $profile = Profile::where('profiles.id',$id)
                            ->join('courses','profiles.course','=','courses.id')
                            ->select('profiles.*','courses.code','courses.name')
                            ->first();
        $initialEnrollFee = Option::where('type','initial-enrollment-fee')->first();
        $enrollmentFee = $initialEnrollFee->name;
        return view ('front.partials._old-student-confirmation',compact('profile','enrollmentFee'));
    }
}
