<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\GeneralSmartMessages;
use App\Models\Memberdetail;
use App\Models\Smsgroup;
use App\Traits\SMSTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\DB;

class GeneralSmartMessagesController extends General
{
    use SMSTraits;
    protected $model = GeneralSmartMessages::class;
    protected $viewname = 'generalsmartmessages';
    protected $path_custom = 'admin/';
    protected $view_custom = 'admin.';
    protected $searchparms = "";
    protected $Rolelevel;
    protected $roleaccess;
    protected $LogGeneral;
    protected $vali;
    protected $validationRules = [
    ];
    protected $imgtostaff;
    protected $imgtoIDType;
    protected $validoptional = [];


    public function index(Request $request)
    {


        $data = $this->model::where('branch_id', '=', auth()->user()->branch_id)->paginate(25);
        return view($this->view_custom . $this->viewname . "." . "index")->with(compact('data'));
    }

    public function create()
    {

        $count = 0;

        $baseQuery = "Select  m.id, m.surname, m.other_names,m.phone_numbers,
        h.name as home_town , g.name as gender_name,ms.name as marital_status, l.name as locality, p.name as profession  from  
             memberdetails m  left join hometown h on m.hometown_id = h.id left join gender g on m.gender_id  
            = g.id  left join  marital_status ms  on m.marital_status_id = ms.id left join locality l on m.locality_id = l.id 
            left join profession p on m.profession_id = p.id  where m.branch_id =? and m.status_id= ? limit ?,?";
        $data = DB::select($baseQuery, [auth()->user()->branch_id,1, 0, 50]);

        foreach (DB::select($baseQuery, [auth()->user()->branch_id,1,0, 2000000]) as $row) {
            $count += count(explode('/', $row->phone_numbers));

        }

        ///dd($count);
        $type = 'create';

        return view($this->view_custom . $this->viewname . "." . $type)->with(compact('data', 'count'));
    }


    public function getSMSContactFilterList(Request $request)
    {


        if (\Request::ajax()) {
            $response = $this->filtrfetch($request);

            $data = $response[0];
            $count = $response[1];

            return view($this->view_custom . $this->viewname . "." . 'data')->with(compact('data', 'count'))->render();


        }

    }

    public function processSMSContactFilterList(Request $request)
    {


        if (\Request::ajax()) {
            $response = $this->filtrfetch($request);

            $arraycontact=[];
            foreach($response[0] as $row) {

                $numbers = $this->explodearray('/', $row->phone_numbers);
               foreach($numbers as $item){

                   $arraycontact[]=$item;

                }

                }

           $res = $this->sendbulksms($arraycontact,$request->tag,$request->message,
                false,'');
            $response=$res[0];

            if($response=='false'){
                return response()->json(['status'=>'error','message'=>'oops!! Server could not be reached.Kindly check your internet connection and try again !!']);

            }
            else {

      $response=$res[1];


   if($response['status']=="error"){
       return response()->json(['status' => $response['status'], 'message' => $response['message']]);
   }

   else {
       return response()->json(['status' => $response['status'], 'message' => $response['message'],
           'total_sent' => $response['summary']['total_sent'], 'total_rejected' => $response['summary']['total_rejected'],
           'credit_used' => $response['summary']['credit_used']
       ]);
   }
            }


        }

    }


    public function filtrfetch($request)
    {

        $count = 0;
        $lim = 'm.branch_id =? and m.status_id= ? limit ?,? ';
        $baseQuery = "Select  m.surname, m.other_names,m.phone_numbers,m.id,
        h.name as home_town , g.name as gender_name,ms.name as marital_status, l.name as locality, p.name as profession  from  
             memberdetails m   left join hometown h on m.hometown_id = h.id  left join gender g on m.gender_id  
            = g.id   left join  marital_status ms  on m.marital_status_id = ms.id left join locality l on m.locality_id = l.id 
            left join profession p on m.profession_id = p.id left join memberchurchgroups c on  c.member_id = m.id   ";
        $whereArray = array();

        if ($request->locality != null)
            $whereArray[] = " l.id={$request->locality}";
        if ($request->hometown != null)
            $whereArray[] = " h.id={$request->hometown}";
        if ($request->profession != null)
            $whereArray[] = " p.id={$request->profession}";

        if ($request->churchgroup != null)
            $whereArray[] = " c.groups_id={$request->churchgroup}";

        if ($request->by_age != null) {
            $newyear = $this->currentyear() - $request->by_age;
            $newddate = $newyear . '-01-01';
            $whereArray[] = " m.date_of_birth  >= '$newddate'";
        }

        if ($request->gender != null)
            $whereArray[] = " m.gender_id={$request->gender}";

        if ($request->member_status != null)
            $whereArray[] = " m.status_id={$request->member_status}";

        if ($request->welfare_state != null)
            $whereArray[] = " m.does_member_want_to_join_welfare={$request->welfare_state}";

        if ($request->marital_status != null)
            $whereArray[] = " m.marital_status_id={$request->marital_status}";

        $whereClause = implode(" and ", $whereArray);
        if ($whereClause != null) {
            $baseQuery = $baseQuery . " where " . $whereClause . ' and ' . $lim;
        } else {
            $baseQuery = $baseQuery . " where " . $lim;
        }

        $data = DB::select($baseQuery, [auth()->user()->branch_id,1, 0, 50]);

        foreach (DB::select($baseQuery, [auth()->user()->branch_id,1, 0, 2000000]) as $row) {
            $count += count(explode('/', $row->phone_numbers));


        }


        return [$data,$count];


    }

}
