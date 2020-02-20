<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\payment_history;
use App\Models\Transport;
use App\Models\Transportcollection;
use App\Traits\PaymentHistoryTrait;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\DB;

class TransportcollectionController extends General
{
    use PaymentHistoryTrait;
   protected $model = payment_history::class;
      protected $viewname = 'transportcollection';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [
			'amount' => 'required',
			'year' => 'required',
			'start_date' => 'required',
			'end_date' => 'required',
			'collection_id' => 'required',
			'member_id' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];
       protected $pointID =3;


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        //sum(IFNULL(pi.PaymentAmount,0))
        if(\Request::ajax()) {
            $tempname='transportsearched'.$this->getuserid();

            $table = "CREATE TEMPORARY TABLE IF NOT EXISTS ".$tempname." (rname varchar(100) ,psurname varchar(100) , rimgpath varchar(300) ,
        pimgpath varchar(300),transid integer ,amount  decimal(18,2),tpaid  decimal(18,2),pmember_id integer, rmember_id integer,date_paid date)";


            $sql = "select surname, date_joined,id as memid,new_member_id ,img_path from  memberdetails where (new_member_id like '%$keyword%' or 
 CONCAT( surname, ' ', other_names)  like '%$keyword%')";

            $db = DB::select($sql);
            $sqltrunc = "TRUNCATE TABLE ".$tempname;
            DB::statement($table);
            DB::statement($sqltrunc);
      $arr=[];
            foreach ($db as $row){

                $unirec="INSERT INTO ".$tempname."(rmember_id,psurname,amount,rname,transid,rimgpath,pimgpath,pmember_id,tpaid,date_paid)
 select IFNULL(t1.member_id,'$row->memid') as pmid, IFNULL(t2.surname,'$row->surname') as surname ,t1.amount,t1.rname ,t1.trans_id,t1.rimg_path,IFNULL(t2.mimg_path,'$row->img_path') as mimg,IFNULL(t2.memid,'$row->memid') as mid,sum(IFNULL(t2.amount_paid,0)) as totalpaid,
max(t2.date_paid) as date_paid  from ((select t.amount,t.id as trans_id,t.member_id,m.img_path as rimg_path,CONCAT( m.surname, ' ', m.other_names) rname from transports t join  memberdetails m on t.member_id = m.id 
where t.date >='$row->date_joined' and t.txt_state_id = 2 ) as t1 left join
(select  p.amount_paid,p.date_paid,m.img_path as mimg_path,m.surname,p.point_sub_id,IFNULL(p.member_id,'$row->memid') as memid from 
 payment_histories p join  memberdetails m on p.member_id = m.id where p.member_id='$row->memid' and p.collection_id=3 and p.payment_state=0) as t2 on t1.trans_id=t2.point_sub_id )  group by t1.trans_id,t2.memid";
    DB::select($unirec);

            }


            $data = DB::table($tempname)->where('rmember_id','<>',DB::raw('pmember_id'))->where('amount','<>',DB::raw('tpaid'))->paginate(5);
            return view($this->view_custom.$this->viewname.".".'searchmember')->with(compact('data'))->render();

            //return response()->json($data);
        }
        if (!empty($keyword)) {
            $data = payment_history::where('payment_state',0)->where('collection_id',3)->where('user_id',$this->getuserid())->whereHas('member',function ($q)
            use ($keyword){
                return $q->where('surname', 'LIKE', "%$keyword%")->orwhere('other_names', 'LIKE', "%$keyword%")
                    ->orwhere('new_member_id', 'LIKE', "%$keyword%");
            })->paginate($perPage);


        } else {
            $data = payment_history::where('payment_state',0)->where('collection_id',3)->where('user_id',$this->getuserid())->latest()->paginate($perPage);
        }

        return view('admin.transportcollection.index', compact('data'));
    }

    public function store(Request $request)
    {
        $res =  Transport::find($request->point_sub_id);
        if(!$res){

            $resp= '<p class="text-center text-danger"><b>Oops!! Transport Details could not be retrieved.</b></p>';
        }
        else {
            if($request->amount_paid > $res->amount || $request->amount_paid <=0){
                $resp='<p class="text-center text-danger"><b>Oops!! Error in Amount paying figures.</b></p>';
            }
            else {

                $this->create_payment_history(0,$request->member_id,$request->amount_paid,$this->currentyear(),$request->point_sub_id,$request->collection_id,$this->pointID);

                $resp='<p class="text-center text-success"><b>Transaction successful!!!.</b></p>';
            }
        }
        return response()->json(['data'=>$resp]);
    }


    }
