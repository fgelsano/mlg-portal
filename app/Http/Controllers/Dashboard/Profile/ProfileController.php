<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Use App\Models\Profile;
Use App\Models\Document;
use Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::where('id',$id)->with('documents')->first();
        // dd($profile);
        return view('admin.profile.index')->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::where('id',$id)->with('documents')->first();
        return response()->json(
            $profile
        ,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all(), $id);
        $validation = Validator::make($request->all(),[
            'profile-pic'             => 'image|mimes:jpeg,png,jpg,gif,svg',
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
            'emergency-contact-name'  => 'required',
            'emergency-contact-number'=> 'required',
            'school-graduated'        => 'required',
            'year-graduated'          => 'required',
            'school-address'          => 'required',
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
            return response()->json(
                $validation->getMessageBag()->toArray()
            ,414);
        } else {
            // file upload
            $now = new \DateTime('NOW');
            $date = $now->format('m-d-Y_H.i.s');

            if($request->has('profile-pic')){
                $profile_pic_WithExt = $request->file('profile-pic')->getClientOriginalName();
                $profile_pic_filename = str_replace(' ','_',pathinfo($profile_pic_WithExt, PATHINFO_FILENAME));
                $profile_pic_extension = $request->file('profile-pic')->getClientOriginalExtension();
                $profile_pic = $profile_pic_filename.'-'.$date.'.'.$profile_pic_extension;
                $path_profile_pic_img = $request->file('profile-pic')->storeAs('public/uploads/applicant-img', $profile_pic);
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
        

            $profile = Profile::where('id',$request->input('profile-id'))->first();
            if($profile->profile_pic == 'No Data'){
                return response()->json(
                    'Profile Pic is required'
                , 400);
            }
            // dd($profile);
            if($request->has('profile-pic')){
                $profile->profile_pic             = $profile_pic;
            }
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
            $profile->emergency_contact_name  = $request->input('emergency-contact-name');
            $profile->emergency_contact_number= $request->input('emergency-contact-number');
            $profile->school_graduated        = $request->input('school-graduated');
            $profile->school_address          = $request->input('school-address');
            $profile->year_graduated          = $request->input('year-graduated');
            $profile->lrn                     = $request->input('lrn') ? $request->input('lrn') : 0;
            $profile->course                  = $request->input('course');
            $profile->year_level              = $request->input('year_level');
            $profile->complete_profile        = 1;
            $profile->dpa_agreement           = $request->input('dpa-agreement-date');
            $profile->role                    = $request->input('role');
            $profile->save();

            if($request->input('role') == 3){
                $documents = Document::where('profile_id',$id)->first();
                $documents = [
                    'report_card_front' => $sf9_front,
                    'report_card_back' => $sf9_back,
                    'good_moral' => $gmc,
                    'psa_birth_cert' => $psa_bc,
                    'med_cert' => $med_cert,
                    'honorable_dismissal' => $hd
                ];
                $profile->documents()->save($documents);
            }

            return response()->json(
                $profile
            , 200);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
