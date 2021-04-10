<?php

namespace App\Http\Controllers\Admin;

use App\Churchgiven;
use App\Helpers\ProcessFunctions;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Membercustompayment;
use App\Models\Memberdetail;
use App\Models\payment_history;
use App\Models\Tithe;
use App\Traits\PaymentHistoryTrait;
use App\Traits\SMSTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TithesController extends General
{
    use PaymentHistoryTrait;
    use SMSTraits;
   protected $model = payment_history::class;
      protected $viewname = 'tithes';
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
       protected $titheID = 1;


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if(\Request::ajax()) {
            $clause='';
            $tempname='tithesearch'.$this->getuserid();

            $table = "CREATE TEMPORARY TABLE IF NOT EXISTS ".$tempname." (rname varchar(100),ryear year,date_joined date,mleft integer,
        pimgpath varchar(300),point_sub_id integer ,amount  decimal(18,2),tpaid  decimal(18,2),pmember_id integer,pmember_ch_id varchar(100), totalm integer,date_paid date)";
            $sql = "select CONCAT( surname, ' ', other_names) name, date_joined,id as memid,new_member_id ,img_path from  memberdetails where status_id =1 and (new_member_id like '%$keyword%' or 
 CONCAT( surname, ' ', other_names)  like '%$keyword%')";

            $db = DB::select($sql);

            $sqltrunc = "TRUNCATE TABLE ".$tempname;
            DB::statement($table);
            DB::statement($sqltrunc);
            $arr=[];
            $eyear = $this->currentyear();
            foreach ($db as $row){
                $myear = $this->convert_date_to_year($row->date_joined);
                ( $myear<= 2017 ? $syear = 2019 : $syear = $myear);
                for($j=$syear; $j<=$eyear;$j++){
                    if ($myear == $j) {
                        $splitdate = $this->explodearray('-',$row->date_joined);
                        $clause = ProcessFunctions::get_month_to_begin_collection_calculation_from_date_joined($splitdate[1],$splitdate[2]) ;
                    }
                    else{
                        $clause=12;

                    }


                    $fetch =  "INSERT INTO ".$tempname."(mleft,date_joined,point_sub_id,rname,pimgpath,pmember_ch_id,amount,tpaid,date_paid,totalm,ryear,pmember_id) select '$clause','$row->date_joined', t1.id,'$row->name','$row->img_path','$row->new_member_id',IFNULL(t1.amount,0.00),
                   sum(IFNULL(t1.amount_paid,0)) as amp ,max(t1.date_paid) as dpaid,count(distinct(t1.month_paid)) as total,IFNULL(t1.year,'$j'),IFNULL(t1.member_id,'$row->memid')
 from (select pa.amount,p.date_paid,m.ident,p.point_id,pa.id,p.amount_paid, p.year,p.member_id,p.month_paid from months m left join payment_histories p on m.ident = p.month_paid and p.member_id = ? 
 and p.collection_id=?   and p.year =? and p.payment_state=0 left join membercustompayments pa  on ?= pa.member_id and ? = pa.year and pa.collection_id =? ) as t1";
                    DB::select($fetch,[$row->memid,$this->titheID,$j,$row->memid,$j,$this->titheID,$j]);
                }



            }
            $data = DB::table($tempname)->where('totalm','<',DB::raw('mleft'))->paginate(5);
            return view($this->view_custom.$this->viewname.".".'searchmember')->with(compact('arr','data'))->render();


        }

        if (!empty($keyword)) {
            $data = payment_history::where('collection_id',$this->titheID)->where('payment_state',0)->where('user_id',$this->getuserid())->whereHas('member',function ($q)
                use ($keyword){
                return $q->where('surname', 'LIKE', "%$keyword%")->orwhere('other_names', 'LIKE', "%$keyword%")
                ->orwhere('new_member_id', 'LIKE', "%$keyword%");
            })->paginate($perPage);


        } else {
            $data = payment_history::where('collection_id',$this->titheID)->where('payment_state',0)->where('user_id',$this->getuserid())->latest()->paginate($perPage);
        }

        return view('admin.tithes.index', compact('data'));
    }




    public function  gettitheyeardetails(Request $request)
    {
        $clause='';
        $tempname='titheesearch'.$this->getuserid();
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
 and p.collection_id=? and p.year =? and p.payment_state=0 ".$clause." ) as t1 where (t1.year =? OR (t1.year  IS NULL)) and t1.month_paid is null group by t1.ident";

        return response()->json(['data'  =>DB::select($fetch,[$vars[0],$this->titheID,$vars[2],$vars[2]])]);



    }

    public function store(Request $request)
    {
        $month = [];
        $newpledgeamount = $request->defined_amount;

        $pdetails = explode('_',$request->p_details);
        $pledeID=0;
        $datesplit = $this->explodearray('-',$pdetails[4]);
        $year_joined = $this->convert_date_to_year($pdetails[4]);
        $year_pledge = $pdetails[2];
        $allm = $this->implodearray($request->m_selected);
        if ($pdetails[2] == $year_joined) {
            $clause = ProcessFunctions::get_month_to_begin_collection_calculation_from_date_joined($datesplit[1],$datesplit[2]) ;
        }
        else{
            $clause=12;
        }

        if($pdetails[3] ==0){
            if(isset($newpledgeamount)) {

                if ($newpledgeamount <= 0) {
                    $resp = '<p class="text-center text-danger"><b>Oops!! Annual Tithe amount should be greater than 0 .</b></p>';
                } else {
                    $data = $request->all();
                    $data['member_id'] = $pdetails[0];
                    $data['collection_id'] = $this->titheID;
                    $data['amount'] = $request->defined_amount * $clause;
                    $data['year'] = $year_pledge;
                    $data['user_id'] = $this->getuserid();
                    $mod = Membercustompayment::create($data);
                    $pledgeID = $mod->id;
                    foreach($this->explodearray(',',$allm) as $mont) {
                        $month[] =$this->getmonthname($mont);

                        $this->create_payment_history($mont, $pdetails[0], $newpledgeamount, $year_pledge, $pledgeID, $this->titheID, $this->titheID);
                    }
                    $resp='<p class="text-center text-success"><b>Transaction successful!!!.</b></p>';
                }

            }
            else{
                foreach($this->explodearray(',',$allm) as $mont) {
                    $month[] =$this->getmonthname($mont);
                    $this->create_payment_history($mont, $pdetails[0], $request->amount_paid / count($this->explodearray(',', $allm)), $year_pledge, 0, $this->titheID,$this->titheID);
                }
                $resp='<p class="text-center text-success"><b>Transaction successful!!!.</b></p>';
            }
        }
        else{

            if($pdetails[1]> 0){
                foreach($this->explodearray(',',$allm) as $mont) {
                    $month[] =$this->getmonthname($mont);
                    $this->create_payment_history($mont, $pdetails[0], $pdetails[1] / $clause, $year_pledge, $pdetails[5], $this->titheID, $this->titheID);
                }
                $resp='<p class="text-center text-success"><b>Transaction successful!!!.</b></p>';
            }

            else{
                foreach($this->explodearray(',',$allm) as $mont) {
                    $month[] =$this->getmonthname($mont);

                    $this->create_payment_history($mont, $pdetails[0], $request->amount_paid / count($this->explodearray(',', $allm)), $year_pledge, 0, $this->titheID,$this->titheID);
                }
                $resp='<p class="text-center text-success"><b>Transaction successful!!!.</b></p>';



            }



        }

        $custom_data = Churchgiven::where('id',$this->titheID)->first();
        $contact = Memberdetail::where('id',$pdetails[0])->first();

        $numbers = $this->explodearray('/', $contact->phone_numbers);
        foreach($numbers as $item){

            $arraycontact[]=$item;

        }
        $mess = 'An amount of GHC'.number_format($request->amount_paid,2).' has been paid for '.$this->implodearray($month). ' ' .$year_pledge.' '.$custom_data->name.' contribution ';
        $this->sendbulksms($arraycontact,'NewAbossEPC',$mess,false,'');



        return response()->json(['data'=>$resp]);
    }




    }
