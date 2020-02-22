<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Given;
use App\Helpers\ProcessFunctions;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\payment_history;
use App\Models\Welfare;
use App\Traits\GeneralProcessTrait;
use App\Traits\GeneralVariables;
use App\Traits\PaymentHistoryTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class WelfareController extends General
{
   
    use GeneralVariables;
    use PaymentHistoryTrait;

   protected $model = payment_history::class;
      protected $viewname = 'welfare';
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


        if(\Request::ajax()) {
            $include_welfare ='';
            $type = $request->type;
            $tempname='welfareesearch'.$this->getuserid();
            $date_j = 'date_joined';

             if($type==5){
                 $include_welfare ='does_member_want_to_join_welfare= 2 and ';
                 $date_j = 'date_joined_welfare as date_joined';
             }
            $table = "CREATE TEMPORARY TABLE IF NOT EXISTS ".$tempname." (rname varchar(100),ryear year,date_joined date,mleft integer,
        pimgpath varchar(300),point_sub_id integer ,amount  decimal(18,2),tpaid  decimal(18,2),pmember_id integer,pmember_ch_id varchar(100), totalm integer,date_paid date)";
            if($type==5) {
                $sql = "select CONCAT( surname, ' ', other_names) name, date_joined_welfare as date_joined ,id as memid,new_member_id ,img_path from  memberdetails where " . $include_welfare . "  (new_member_id like '%$keyword%' or 
 CONCAT( surname, ' ', other_names)  like '%$keyword%')  ";
            }
            else{
                $sql = "select CONCAT( surname, ' ', other_names) name, date_joined ,id as memid,new_member_id ,img_path from  memberdetails where " . $include_welfare . "  (new_member_id like '%$keyword%' or 
 CONCAT( surname, ' ', other_names)  like '%$keyword%')  ";
            }
            $db = DB::select($sql);
            $sqltrunc = "TRUNCATE TABLE ".$tempname;
            $month = DB::table('months')->get();
            DB::statement($table);
            DB::statement($sqltrunc);
            $eyear = $this->currentyear();
            $clause = '';
            $arr=[];
            foreach ($db as $row){
                $myear = $this->convert_date_to_year($row->date_joined);
                $splitdate = $this->explodearray('-',$row->date_joined);
                ( $myear<= 2016 ? $syear = 2017 : $syear = $myear);
                for($j=$syear; $j<=$eyear;$j++) {
                    $arr[] = $j;
                    if ($myear == $j) {
                        $splitdate = $this->explodearray('-',$row->date_joined);
                        $clause = ProcessFunctions::get_month_to_begin_collection_calculation_from_date_joined($splitdate[1],$splitdate[2]) ;
                    }
                    else{
                        $clause=12;

                    }
                    if ($type == 5) {
                        $fetch = " INSERT INTO " . $tempname . "(mleft,date_joined,point_sub_id,rname,pimgpath,pmember_ch_id,amount,tpaid,date_paid,totalm,ryear,pmember_id) select '$clause','$row->date_joined', t1.id,'$row->name','$row->img_path','$row->new_member_id',IFNULL(t1.amount,0.00),
                   sum(IFNULL(t1.amount_paid,0)) as amp ,max(t1.date_paid) as dpaid,count(distinct(t1.month_paid)) as total,IFNULL(t1.year,'$j'),IFNULL(t1.member_id,'$row->memid')
 from (select pa.amount,pa.id,p.date_paid,m.ident,p.point_id,p.point_sub_id,p.amount_paid, pa.year,p.member_id,p.month_paid from months m left join payment_histories p on m.ident = p.month_paid and p.member_id = '$row->memid' 
 and p.collection_id=5   and p.year ='$j'  and  p.payment_state=0  join churchcustompayments pa  on  '$j' = pa.year where pa.collection_id = 5) as t1  group by t1.year";

                        DB::select($fetch);
                    }
                    else{
                        $fetch = " INSERT INTO " . $tempname . "(date_joined,point_sub_id,rname,pimgpath,pmember_ch_id,amount,tpaid,date_paid,ryear,pmember_id) select '$row->date_joined', t1.id,'$row->name','$row->img_path','$row->new_member_id',IFNULL(t1.amount,0.00),
                   sum(IFNULL(t1.amount_paid,0)) as amp ,max(t1.date_paid) as dpaid,IFNULL(t1.year,'$j'),IFNULL(t1.member_id,'$row->memid')
 from (select pa.amount,p.date_paid,p.point_id,pa.id,p.amount_paid, p.year,p.member_id from 
   churchcustompayments pa left join  payment_histories p  on  pa.year=p.year  and p.collection_id =6 and p.member_id = '$row->memid' and  p.payment_state=0 where '$j' = pa.year and pa.collection_id =6) as t1  group by t1.year";

                       DB::select($fetch);

                    }

                }

            }


            if($type==5) {
                $data = DB::table($tempname)->where('totalm','<',DB::raw('mleft'))->paginate(5);
            }
            else{
                $data = DB::table($tempname)->where('tpaid', '<',DB::raw('amount'))->paginate(5);
            }
            return view($this->view_custom.$this->viewname.".".'searchmember')->with(compact('arr','data','type'))->render();
             //return response()->json($data);


        }


        $arrayid = Given::get_church_given_based_on_group(2);
        if (!empty($keyword)) {
            $data = payment_history::whereIn('collection_id',$arrayid)->where('payment_state',0)->where('user_id',$this->getuserid())->whereHas('member',function ($q)
            use ($keyword){
                return $q->where('surname', 'LIKE', "%$keyword%")->orwhere('other_names', 'LIKE', "%$keyword%")
                    ->orwhere('new_member_id', 'LIKE', "%$keyword%");
            })->paginate($perPage);

        } else {
            $data = payment_history::whereIn('collection_id',$arrayid)->where('payment_state',0)->where('user_id',$this->getuserid())->latest()->paginate($perPage);
        }



        return view('admin.welfare.index', compact('data'));
    }

    public function  getwelfareyeardetails(Request $request)
    {

        $clause='';
        $vars = explode('_',$request->id);

        $myear = $this->convert_date_to_year($vars[4]);
        $splitdate = $this->explodearray('-',$vars[4]);
        $syear = $this->currentyear();

        if ($vars[2] == $myear) {
            $clause= ProcessFunctions::get_month_to_begin_collection_calculation_from_date_joined_on_show($splitdate[1],$splitdate[2]) ;


            $clause = 'where m.ident >=' . $clause;
        }


        $fetch =  "select t1.point_sub_id,sum(IFNULL(t1.amount_paid,0)) as amp ,t1.month_paid,t1.ident,t1.name
,max(t1.date_paid) as dpaid,t1.year from (select  p.date_paid,m.ident,m.name,
p.point_sub_id,p.amount_paid, p.year,p.month_paid from months m left join payment_histories p on m.ident = p.month_paid and p.member_id = ? 
 and p.collection_id=? and p.year =? and p.payment_state=0  ".$clause." ) as t1 where (t1.year =? OR (t1.year  IS NULL)) and t1.month_paid is null group by t1.ident";

        return response()->json(['data'  =>DB::select($fetch,[$vars[0],5,$vars[2],$vars[2]])]);


    }

    public function store(Request $request)
    {

        $pdetails = explode('_',$request->p_details);
        $pledeID=0;
        $datesplit = $this->explodearray('-',$pdetails[4]);
        $year_joined = $this->convert_date_to_year($pdetails[4]);
        $year_pledge = $pdetails[2];
        $col_type = $pdetails[6];
if($col_type==5) {
    $allm = $this->implodearray($request->m_selected);
    foreach ($this->explodearray(',', $allm) as $mont) {
        $this->create_payment_history($mont, $pdetails[0], $pdetails[1], $year_pledge,$pdetails[5],  $col_type,$this->pointID);
    }
}
else{

   $this->create_payment_history(0, $pdetails[0], $request->amount_paid, $year_pledge,$pdetails[5],  $col_type,$this->pointID);
    }
        $resp='<p class="text-center text-success"><b>Transaction successful!!!.</b></p>';

        return response()->json(['data'=>$resp]);
    }




}
