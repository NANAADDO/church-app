<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Member;
use App\Helpers\UserAuth;
use App\Hometown;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Locality;
use App\Models\Education;
use App\Models\Employment;
use App\Models\Familymember;
use App\Models\Memberchurchgroups;
use App\Models\Memberdetail;
use App\Models\Religiousprofle;
use App\Profession;
use App\Qualification;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\DB;

class MemberdetailsController extends General
{
    protected $model = Memberdetail::class;
    protected $viewname = 'memberdetails';
    protected $view_custom = 'admin.';
    protected $path_custom = 'admin/';
    protected $searchparms = "";
    protected $Rolelevel;
    protected $roleaccess;
    protected $LogGeneral;
    protected $imgto = 'profiles';
    protected $vali;
    protected $questyes = 2;
    protected $questbool = 'false';
    protected $validationRules = [
        //'birth_place' => 'required','street_name' => 'required',
        'surname' => 'required', 'other_names' => 'required',  'nationality_id' => 'required',  'status_id' => 'required',
        'address' => 'required', 'house_number' => 'required',
         'locality_id' => 'required', 'hometown_id' => 'required',
        'title_id' => 'required', 'gender_id' => 'required', 'phone_numbers' => 'required'
        , 'profession_id' => 'required', 'are_you_a_literate' => 'required', 'are_you_employed' => 'required', 'does_member_have_kids' => 'required',
        'does_member_have_relation_in_accra' => 'required', 'marital_status_id' => 'required',
        'are_you_baptised' => 'required', 'date_joined' => 'required', 'have_you_been_confirm' => 'required', 'are_you_a_communicant' => 'required',
        'are_you_a_convert' => 'required','does_member_want_to_join_welfare' => 'required','is_member_part_of_church_groups' => 'required','does_member_have_any_emergency_contact' => 'required','does_member_have_identification_id' => 'required',
        'does_member_want_to_join_welfare'];
    protected $validation = [
        'hometown_others' => 'required'];
    protected $imgtostaff;
    protected $imgtoIDType;
    protected $validoptional = [];


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $data = Memberdetail::where('surname', 'LIKE', "%$keyword%")->where('status_id','!=',3)
                ->orWhere('other_names', 'LIKE', "%$keyword%")
                ->orWhere('birth_place', 'LIKE', "%$keyword%")
                ->orWhere('old_member_id', 'LIKE', "%$keyword%")
                ->orWhere('new_member_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = Memberdetail::with('Religious')->with('Education')->where('status_id','!=',3)->latest()->paginate($perPage);
        }
        //dd($data);

        return view('admin.memberdetails.index', compact('data'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $rules = array_merge($this->validationRules, $this->build_validation($request));
        if ($this->checkval_with_option($request, $rules) == 0) {
            session()->put('error', 'There were validation errors');
            return $this->validate_request_option_with_params($request, $rules);
        }
        DB::Begintransaction(); //(function () use ($data,$plot_c,$diagnostic_data,$observation_data,$baseline_data,$farm,$farmb,$farmers,$gps_point) {

        try {
            $data['branch_id'] = auth()->user()->branch_id;

            if ($request->img_path) {
                $staffpicpath = $this->upload_image($this->imgto, 'img_path', $request);
                $data['img_path'] = $staffpicpath;
                if ($staffpicpath == 1) {
                    return $this->redirect_error('Invalid Member picture format!!');
                }
            }

            $this->member_processor($request, 1, $data,null);

            DB::commit();
            '/'

            session()->put('success', 'Data Created Successful');

            return redirect($this->path_custom . $this->viewname);
        } catch (QueryException $ex) {
            DB::rollBack();
            return $this->redirect_error($ex->getMessage());

        }


    }


    public function member_action_trigger($eventtype, $data, $key, $model)
    {
        if ($eventtype == 1) {
            $model::create($data);
        } else {
            $response = $model::where('member_id', '=', $key)->first();
            if (empty($response)) {
                $model::create($data);

            } else {
                $response->update($data);

            }

        }
    }

    public function member_action_check_exist_family($eventtype,$key,$model,$type){
        if($eventtype==2) {
            $response = $model::where('member_id', '=', $key)->where('type', '=', $type)->count();

            if ($response > 0) {
                $model::where('member_id', '=', $key)->where('type', '=', $type)->delete();
            }
        }

    }

    public function member_action_trigger_family($eventtype,$data,$key,$model,$type){
        if($type !=3){

                $model::create($data);
            }
        if($type==3 && $eventtype==1) {
            $model::create($data);
        }
        if($type==3 && $eventtype==2) {
            $response = $model::where('member_id', '=', $key)->where('type', '=', $type)->first();
            if (!empty($response)) {
                $response->update($data);
            }
            else{
                $model::create($data);
            }
        }

}


    public function member_action_delete($eventtype,$model,$key){
        if($eventtype==2) {

            $response = $model::where('member_id', '=', $key)->count();
            if ($response > 0) {
                $model::where('member_id', '=', $key)->delete();


            }

        }
    }



    public function member_processor($request,$eventtype,$pass=[],$id){

        $data = $request->all();
        if(isset($pass['img_path'])){
            $data['img_path']=$pass['img_path'];
        }
        else{
            unset($data['img_path']);
        }
        $data['branch_id']=auth()->user()->branch_id;
        $res = $this->create_other_data($request->hometown_id,$request->hometown_others,Hometown::class);
        if($res  > 0 ){
            $data['hometown_id']=$res;
        }

        $res = $this->create_other_data($request->locality_id,$request->personal_locality_others,Locality::class);
        if($res  > 0 ){
            $data['locality_id']=$res;
        }
        if($request->profession_id == $this->questbool){
            $res = $this->create_other_data($request->profession_id, $request->profession_others, Profession::class);
            if($res  > 0 ) {
                $data['profession_id'] = $res;
                $prof = $res;
            }
        }
        else{
            $prof=$request->profession_id;
        }

          if($eventtype==1) {
              $member = $this->model::create($data);
              $memberID =$member->id;
              $data['member_id']=$memberID;
              /*********UPDATE NEW CHURCHID************/
              $newID = Member::generate_next_churchID($memberID,$request->date_joined);
              $new = $this->model::findOrFail($memberID);
              $chid['new_member_id']=$newID;
              $new->update($chid);
          }
          else{
              $mem = $this->model::findOrFail($id);

              $member= $mem->update($data);
              $memberID =$id;
              $data['member_id']=$memberID;

          }
        /**
         * CREATE CHURCH MEMBER EDUCATION PROFILE
         */

        if($request->are_you_a_literate == $this->questyes){

            $education['school_name']=$request->school_name;
            $education['member_id']=$memberID;
            if($request->qualification_id == $this->questbool) {
                $res = $this->create_other_data($request->qualification_id, $request->qualification_others, Qualification::class);
                $education['qualification_id'] = $res;
            }
            else{
                $education['qualification_id'] =$request->qualification_id;
            }

         $this->member_action_trigger($eventtype,$education,$memberID,Education::class);
        }

        else{

         $this->member_action_delete($eventtype,Education::class,$memberID);
        }

        /**
         * CREATE CHURCH MEMBER EMPLOYMENT PROFILE
         */
        if($request->are_you_employed == $this->questyes) {
            $employ['name']=$request->employer_name;
            $employ['phone_number'] = $request->employer_phone_number;
            $employ['address'] = $request->employer_address;
            $employ['member_id']=$memberID;
            $employ['profession_id'] =$prof;
            $this->member_action_trigger($eventtype,$employ,$memberID,Employment::class);
        }

        else{

            $this->member_action_delete($eventtype,Employment::class,$memberID);
        }

        /**
         * CREATE CHURCH MEMBER FAMILY CHILD  PROFILE
         */

        if($request->does_member_have_kids == $this->questyes) {
            $this->member_action_check_exist_family($eventtype,$memberID,Familymember::class,1);
            foreach ($request->child_name as $key => $value) {
                $kids['name'] = $value;
                $kids['relationship_id'] = $request->child_relationship_id[$key];
                $kids['church_id'] = $request->child_church_id[$key];
                $kids['member_id'] = $memberID;
                $kids['type'] = 1;
                $this->member_action_trigger_family($eventtype, $kids, $memberID, Familymember::class,1);
            }
        }
        else{

            $this->member_action_check_exist_family($eventtype,$memberID,Familymember::class,1);
            }



        /**
         * CREATE CHURCH MEMBER EMERGENCY CONTACT PROFILE
         */

        if($request->does_member_have_any_emergency_contact == $this->questyes) {
            $this->member_action_check_exist_family($eventtype,$memberID,Familymember::class,4);
            foreach ($request->emergency_contact_name as $key => $value) {
                $emergency['name'] = $value;
                $emergency['relationship_id'] = 22;
                $emergency['phone_number'] = $request->emergency_contact_number[$key];
                $emergency['member_id'] = $memberID;
                $emergency['type'] = 4;
                $this->member_action_trigger_family($eventtype, $emergency, $memberID, Familymember::class,4);
            }
        }
        else{

            $this->member_action_check_exist_family($eventtype,$memberID,Familymember::class,4);
        }


        /**
         * CREATE CHURCH MEMBER FAMILY RELATION  PROFILE
         */

        if($request->does_member_have_relation_in_accra == $this->questyes) {
            $this->member_action_check_exist_family($eventtype,$memberID,Familymember::class,2);
            foreach ($request->relation_name as $key => $value) {
                $relation['name']=$value;
                $relation['relationship_id']=$request->relation_relationship_id[$key];
                $relation['church_id']=$request->relation_church_id[$key];
                $relation['address']=$request->relation_address[$key];
                $relation['phone_number']=$request->relation_phone_number[$key];
                $relation['office']=$request->relation_office_name[$key];
                $relation['residence']=$request->relation_residence[$key];
                $relation['member_id']=$memberID;
                $relation['type']=2;
                if($request->relation_locality_id[$key] == $this->questbool) {
                        $res = $this->create_other_data($request->relation_locality_id[$key], $request->relation_locality_others[$key], Locality::class);
                        $relation['locality_id'] = $res;
                }
                else{
                    $relation['locality_id'] =$request->relation_locality_id[$key];
                }





                $this->member_action_trigger_family($eventtype, $relation, $memberID, Familymember::class,2);
            }
        }
        else{

            $this->member_action_check_exist_family($eventtype,$memberID,Familymember::class,2);
        }



        /**
         * CREATE MEMBER CHURCH GROUPS BELONGING TO  PROFILE
         */

        if($request->does_member_have_kids == $this->questyes) {
            $this->member_action_delete(2,Memberchurchgroups::class,$memberID);
            if($this->questyes && isset($request->churchgroups[0])){
            foreach ($request->churchgroups as $key => $value) {
                $memb['groups_id'] = $value;
                $memb['member_id'] = $memberID;

                Memberchurchgroups::create($memb);

            }

            }

        }



            /**
         * CREATE CHURCH MEMBER SPOUSE PROFILE
         */

        if($request->marital_status_id == $this->questyes) {
            $spouse['marital_status_id'] = $request->marital_status_id;
            $spouse['name'] = $request->spouse_name;
            $spouse['phone_number'] = $request->spouse_phone_number;
            $spouse['marriage_type_id'] = $request->marriage_type_id;
            $spouse['marriage_place'] = $request->marriage_place;
            $spouse['date'] = $request->marriage_date;
            $spouse['rev_minister'] = $request->marriage_rev_minister;
            $spouse['member_id']=$memberID;
            $spouse['type']=3;
            $spouse['relationship_id']=14;
            $this->member_action_trigger_family($eventtype, $spouse, $memberID, Familymember::class,3);
        }
        else{
            $this->member_action_check_exist_family($eventtype,$memberID,Familymember::class,3);

        }

        /**
         * CREATE CHURCH MEMBER RELIGIOUS PROFILE
         */

        if($request->are_you_baptised == $this->questyes) {
            $religious['baptism_place'] =$request->baptism_place;
            $religious['baptism_date'] = $request->baptism_date;
            $religious['baptism_rev_minister'] = $request->baptism_rev_minister;
        }
        if($request->have_you_been_confirm == $this->questyes) {
            $religious['confirmation_place'] =$request->confirmation_place;
            $religious['confirmation_date'] = $request->confirmation_date;
            $religious['confirmation_rev_minister'] = $request->confirmation_rev_minister;
        }

        if($request->are_you_a_communicant == 1) {
            $religious['reason_why_not_a_communicant'] = $request->reason_why_not_a_communicant;
        }

        if($request->are_you_a_convert == $this->questyes) {
            $religious['prev_religious_denomination'] = $request->prev_religious_denomination;
            $religious['date_converted'] = $request->date_converted;
            $religious['convert_rev_minister'] = $request->convert_rev_minister;
        }


        $religious['are_you_baptised'] = $request->are_you_baptised;
        $religious['have_you_been_confirm'] = $request->have_you_been_confirm;
        $religious['are_you_a_communicant'] = $request->are_you_a_communicant;
        $religious['are_you_a_convert'] = $request->are_you_a_convert;
        $religious['member_id'] = $memberID;
        $this->member_action_trigger($eventtype,$religious,$memberID,Religiousprofle::class);
    }




    public function update(Request $request, $id)
    {
        $data =[];

      // dd($request->all());
      // dd($request->all());
        $rules =array_merge($this->validationRules, $this->build_validation($request));
        if($this->checkval_with_option($request,$rules)==0) {
            session()->put('error','There were validation errors');
            return $this->validate_request_option_with_params($request,$rules);
        }

        DB::Begintransaction();

        try {



            if ($request->img_path!='') {
                $staffpicpath = $this->upload_image($this->imgto, 'img_path', $request);
                $data['img_path'] = $staffpicpath;
                if ($staffpicpath == 1) {
                    return $this->redirect_error('Invalid Member picture format!!');


                }

            }
            $this->member_processor($request, 2, $data,$id);

            DB::commit();
            session()->put('success', 'Data Updated Successful');

            return redirect($this->path_custom . $this->viewname);
        }
        catch(QueryException $ex){
            DB::rollBack();
            return $this->redirect_error($ex->getMessage());

        }
    }

    public function create_other_data($field,$getdata,$table){
        if($field==$this->questbool) {
            $locality_name = ucfirst($getdata);
            $locadata = $table::where('name', '=', $locality_name)->first();
            if (!empty($locadata)) {
                return $locadata->id;
            } else {
                $create['name'] = $getdata;
                $resp = $table::create($create);
                return $resp->id;
            }
        }
        else{
            return 0;
        }

    }



    public function build_validation($request)

    {
        if($request->does_member_have_relation_in_accra == $this->questyes){
            $count = 0;
            foreach ($request->relation_locality_id as $key=>$value){

                if($value==$this->questbool && $request->relation_locality_others[$key]==''){
                    $count+=1;
                }
            }
        }

        if($request->hometown_id == $this->questbool){$rules['hometown_others']='required';}

        if($request->locality_id == $this->questbool){$rules['personal_locality_others']='required';}

        if($request->are_you_a_literate == $this->questyes) {$rules['qualification_id'] = 'required';
           /* $rules['school_name'] = 'required';*/}

        if($request->are_you_a_literate == $this->questyes &&  $request->qualification_id == $this->questbool)
        {$rules['qualification_others'] = 'required';}

        if($request->profession_id == $this->questbool) {$rules['profession_others'] = 'required';}

        if($request->are_you_employed == $this->questyes) {$rules['employer_name'] = 'required';
        $rules['employer_phone_number'] = 'required';$rules['employer_address'] = 'required';}

        if($request->does_member_have_kids == $this->questyes) {$rules['child_name'] = 'required|array|min:1';
            $rules['child_name.*'] = 'required|string';}

        if($request->does_member_have_relation_in_accra == $this->questyes) {$rules['relation_name.*'] = 'required|array';
            $rules['relation_name.*'] = 'required|string';}
        if($request->does_member_have_relation_in_accra == $this->questyes &&  $count > 0)
        {$rules['relation_locality_others.*'] = 'required';}

        if($request->marital_status_id == $this->questyes) {$rules['spouse_name'] = 'required';$rules['spouse_phone_number'] = 'required';
            $rules['marriage_type_id'] = 'required';$rules['marriage_place'] = 'required';$rules['marriage_date'] = 'required';
            /*$rules['marriage_rev_minister'] = 'required';*/}

        if($request->are_you_baptised == $this->questyes) {$rules['baptism_place'] = 'required';/*$rules['baptism_date'] = 'required';
            $rules['baptism_rev_minister'] = 'required';*/}

        if($request->have_you_been_confirm == $this->questyes) {$rules['confirmation_place'] = 'required';/*$rules['confirmation_date'] = 'required';
            $rules['confirmation_rev_minister'] = 'required';*/}

        if($request->are_you_a_communicant == 1) {$rules['reason_why_not_a_communicant']= 'required';}

        if($request->are_you_a_convert == $this->questyes) {$rules['prev_religious_denomination'] = 'required';$rules['date_converted'] = 'required';
        $rules['convert_rev_minister'] = 'required';}

        if($request->does_member_have_any_emergency_contact == $this->questyes) {$rules['emergency_contact_number.*'] = 'required';$rules['emergency_contact_name.*'] = 'required';}

        if($request->does_member_have_identification_id == $this->questyes) {$rules['id_number'] = 'required';$rules['id_type_id'] = 'required';}

        if($request->does_member_want_to_join_welfare == $this->questyes) {$rules['date_joined_welfare'] = 'required';}

        if($request->status_id == 3){$rules['date_died']='required';}

        return $rules;

}
}
