<?php

namespace App\Http\Controllers\Admin;

use App\Churchgiven;
use App\Helpers\Given;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Othercollection;
use App\Models\payment_history;
use App\Traits\PaymentHistoryTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\DB;

class OthercollectionsController extends General
{
    use PaymentHistoryTrait;
   protected $model = payment_history::class;
      protected $viewname = 'othercollections';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [
			'name' => 'required',
			'description' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];
    protected $pointID = 3;

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (\Request::ajax()) {
            $type = $request->type;
            $tempname = 'othereesearch' . $this->getuserid();

            $table = "CREATE TEMPORARY TABLE IF NOT EXISTS " . $tempname . " (rname varchar(100),ryear year,date_joined date,
        pimgpath varchar(300),point_sub_id integer ,amount  decimal(18,2),tpaid  decimal(18,2),pmember_id integer,pmember_ch_id varchar(100), totalm integer,date_paid date)";
            $sql = "select CONCAT( surname, ' ', other_names) name, date_joined,id as memid,new_member_id ,img_path from  memberdetails where  status_id !=3 and (new_member_id like '%$keyword%' or 
 CONCAT( surname, ' ', other_names)  like '%$keyword%')";

            $db = DB::select($sql);
            $sqltrunc = "TRUNCATE TABLE " . $tempname;
            DB::statement($table);
            DB::statement($sqltrunc);
            $eyear = $this->currentyear();
            $clause = '';
            $arr = [];
            foreach ($db as $row) {
                $myear = $this->convert_date_to_year($row->date_joined);
                $splitdate = $this->explodearray('-', $row->date_joined);
                ($myear <= 2016 ? $syear = 2017 : $syear = $myear);
                for ($j = $syear; $j <= $eyear; $j++) {
                    $arr[] = $j;
                    if ($eyear == $myear) {

                    }

                    $fetch = " INSERT INTO " . $tempname . "(date_joined,point_sub_id,rname,pimgpath,pmember_ch_id,amount,tpaid,date_paid,ryear,pmember_id) select '$row->date_joined', t1.id,'$row->name','$row->img_path','$row->new_member_id',IFNULL(t1.amount,0.00),
                   sum(IFNULL(t1.amount_paid,0)) as amp ,max(t1.date_paid) as dpaid,IFNULL(t1.year,'$j'),IFNULL(t1.member_id,'$row->memid')
 from (select pa.amount,p.date_paid,p.point_id,pa.id,p.amount_paid, p.year,p.member_id from 
   churchcustompayments pa left join  payment_histories p  on  pa.year=p.year  and p.collection_id =? and p.member_id = ? and p.payment_state=0 where ? = pa.year and pa.collection_id =?) as t1  group by t1.year";

                    DB::select($fetch, [$type, $row->memid, $j, $type]);


                }

            }


            $data = DB::table($tempname)->where('tpaid', '<', DB::raw('amount'))->paginate(5);

        return view($this->view_custom . $this->viewname . "." . 'searchmember')->with(compact('arr', 'data', 'type'))->render();
        //return response()->json($data);

    }
       $arrayid = Given::get_church_given_based_on_group(5);
        if (!empty($keyword)) {
            $data = payment_history::whereIn('collection_id',$arrayid)->where('payment_state',0)->where('user_id',$this->getuserid())->whereHas('member',function ($q)
            use ($keyword){
                return $q->where('surname', 'LIKE', "%$keyword%")->orwhere('other_names', 'LIKE', "%$keyword%")
                    ->orwhere('new_member_id', 'LIKE', "%$keyword%");
            })->paginate($perPage);

        } else {
            $data = payment_history::whereIn('collection_id',$arrayid)->where('payment_state',0)->where('user_id',$this->getuserid())->latest()->paginate($perPage);
        }


        return view('admin.othercollections.index', compact('data'));
    }

    public function store(Request $request)
    {

        $pdetails = explode('_',$request->p_details);
        $pledeID=0;
        $datesplit = $this->explodearray('-',$pdetails[4]);
        $year_joined = $this->convert_date_to_year($pdetails[4]);
        $year_pledge = $pdetails[2];
        $col_type = $pdetails[6];



        $this->create_payment_history(0, $pdetails[0], $request->amount_paid, $year_pledge,$pdetails[5], $col_type, $this->pointID);

        $resp='<p class="text-center text-success"><b>Transaction successful!!!.</b></p>';

        return response()->json(['data'=>$resp]);
    }




    }
