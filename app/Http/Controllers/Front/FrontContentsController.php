<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Admission;
use DateTime;

class FrontContentsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAdmission()
    {
        return view('front.online-admission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAdmission(Request $request)
    {
        // dd($request->all());
        $applicantDetails[] = '';

        $validation = Validator::make($request->all(),[
            'applicant-img'           => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'first-name'              => 'required',
            'middle-name'             => 'required',
            'last-name'               => 'required',
            'gender'                  => 'required',
            'civil-status'            => 'required',
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
            'gwa'                     => 'image|nullable|mimes:jpeg,png,jpg,gif,svg',
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
                $sf9_back_extension = $request->file('sf9_back')->getClientOriginalExtension();
                $sf9_back = $sf9_back.'-'.$date.'.'.$sf9_back_extension;
                $path_sf9_back = $request->file('sf9_back')->storeAs('public/uploads/sf9-back', $sf9_back);
            } else {
                $sf9_back = '';
            }

            if($request->has('gwa')){
                $gwa_WithExt = $request->file('gwa')->getClientOriginalName();
                $gwa_filename = pathinfo($gwa_WithExt, PATHINFO_FILENAME);
                $gwa_extension = $request->file('gwa')->getClientOriginalExtension();
                $gwa = $gwa_filename.'-'.$date.'.'.$gwa_extension;
                $path_gwa = $request->file('gwa')->storeAs('public/uploads/gwa', $gwa);
            } else {
                $gwa = '';
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
        

            // create admission
            $admission = new Admission;
            $admission->applicant_img           = $applicant_img;
            $admission->first_name              = $request->input('first-name');
            $admission->middle_name             = $request->input('middle-name');
            $admission->last_name               = $request->input('last-name');
            $admission->gender                  = $request->input('gender');
            $admission->first_name              = $request->input('first-name');
            $admission->gender                  = $request->input('gender');
            $admission->civil_status            = $request->input('civil-status');
            $admission->religion                = $request->input('religion');
            $admission->house_number            = $request->input('house-number');
            $admission->sitio                   = $request->input('sitio');
            $admission->street_barangay         = $request->input('street-barangay');
            $admission->municipality            = $request->input('municipality');
            $admission->province                = $request->input('province');
            $admission->zip_code                = $request->input('zip-code');
            $admission->parent_guardian_name    = $request->input('parent-guardian-name');
            $admission->parent_guardian_contact = $request->input('parent-guardian-contact');
            $admission->school_graduated        = $request->input('school-graduated');
            $admission->school_address          = $request->input('school-address');
            $admission->year_graduated          = $request->input('year-graduated');
            $admission->lrn                     = $request->input('lrn');
            $admission->course                  = $request->input('course');
            $admission->year_level              = $request->input('year-level');
            $admission->sf9_front               = $sf9_front;
            $admission->sf9_back                = $sf9_back;
            $admission->gwa                     = $gwa;
            $admission->gmc                     = $gmc;
            $admission->psa_bc                  = $psa_bc;
            $admission->med_cert                = $med_cert;
            $admission->hd                      = $hd;
            $admission->status                  = 0;

            $admission->save();

            $applicantDetails['id']                     = $admission->id;
            $applicantDetails['applicant_img']          = $applicant_img;
            $applicantDetails['first_name']             = $request->input('first-name');
            $applicantDetails['middle_name']            = $request->input('middle-name');
            $applicantDetails['last_name']              = $request->input('last-name');
            $applicantDetails['gender']                 = $request->input('gender');
            $applicantDetails['first_name']             = $request->input('first-name');
            $applicantDetails['gender']                 = $request->input('gender');
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
            $applicantDetails['sf9_front']              = $sf9_front ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>';
            $applicantDetails['sf9_back']               = $sf9_back ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>';
            $applicantDetails['gwa']                    = $gwa ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>';
            $applicantDetails['gmc']                    = $gmc ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>';
            $applicantDetails['psa_bc']                 = $psa_bc ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>';
            $applicantDetails['med_cert']               = $med_cert ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>';
            $applicantDetails['hd']                     = $hd ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>';
        }

        $output = array(
            'error'             => $error_array,
            'success'           => $applicantDetails,
        );

        return response()->json($output);
    }
}
