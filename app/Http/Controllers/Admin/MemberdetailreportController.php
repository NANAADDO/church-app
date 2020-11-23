<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Memberdetail;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class MemberdetailreportController extends General
{
    protected $model = Memberdetail::class;
    protected $viewname = 'memberdetailreport';
    protected $path_custom = 'admin/';
    protected $view_custom = 'admin.';
    protected $searchparms = "";
    protected $Rolelevel;
    protected $roleaccess;
    protected $LogGeneral;
    protected $vali;
    protected $validationRules = [];
    protected $imgtostaff;
    protected $imgtoIDType;
    protected $validoptional = [];


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;


        if (!empty($keyword)) {
            $data = Memberdetail::where('message_id', 'LIKE', "%$keyword%")
                ->orWhere('tag_id', 'LIKE', "%$keyword%")
                ->orWhere('state_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = Memberdetail::latest()->get();
        }

        return view('admin.memberdetailreport.index', compact('data'));
    }




    public function store(Request $request)
    {


        if (\Request::ajax()) {
            $baseQuery = "Select  m.id, m.date_joined,m.new_member_id,m.old_member_id as oldID, CONCAT( m.surname, ' ', m.other_names) as name ,m.phone_numbers,m.address,
            c.name as country, h.name as home_town , g.name as gender_name,ms.name as marital_status, l.name as locality, p.name as profession  from  
             memberdetails m left join countries c  on m.nationality_id = c.id left join hometown h on m.hometown_id = h.id left join gender g on m.gender_id  
            = g.id  left join  marital_status ms  on m.marital_status_id = ms.id left join locality l on m.locality_id = l.id 
            left join profession p on m.profession_id = p.id ";
            $whereArray = array();

            if ($request->locality != [""])

                $whereArray[] = " FIND_IN_SET (l.id,"."'".$this->implodearray($request->locality)."')";

            if ($request->hometown != [""])
                $whereArray[] = " FIND_IN_SET (h.id,"."'".$this->implodearray($request->hometown)."')";
            if ($request->profession != [""])
                $whereArray[] = " FIND_IN_SET (p.id,"."'".$this->implodearray($request->profession)."')";

            if ($request->start_date != null)
                $whereArray[] = " m.date_joined between '{$request->start_date}' and '{$request->end_date }' ";

            if ($request->by_age != null) {
                $newyear = $this->currentyear() - $request->by_age;
                $newddate = $newyear . '-01-01';
                $whereArray[] = " m.date_of_birth  >= '$newddate'";
            }

            if ($request->gender != null)
                $whereArray[] = " m.gender_id={$request->gender}";

            if ($request->member_status != null)
                $whereArray[] = " m.status_id={$request->member_status}";

            if ($request->welfare_state!= null)
                $whereArray[] = " m.does_member_want_to_join_welfare={$request->welfare_state}";

            if ($request->marital_status!= null)
                $whereArray[] = " m.marital_status_id={$request->marital_status}";

            $whereClause= implode(" and ", $whereArray);
            if ($whereClause!=null){
                $baseQuery=$baseQuery." where ".$whereClause;
            }

            $data = DB::select($baseQuery);

            return DataTables::of($data)->make(true);

        }
    }




}



