<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Churchcustompayment;
use Illuminate\Http\Request;
use App\Http\Controllers\General;

class ChurchcustompaymentController extends General
{
   protected $model = Churchcustompayment::class;
      protected $viewname = 'churchcustompayment';
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
			'collection_id' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $data = Churchcustompayment::where('amount', 'LIKE', "%$keyword%")
                ->orWhere('year', 'LIKE', "%$keyword%")
                ->orWhere('start_end', 'LIKE', "%$keyword%")
                ->orWhere('collection_id', 'LIKE', "%$keyword%")
                ->orWhere('end_date', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = Churchcustompayment::latest()->paginate($perPage);
        }

        return view('admin.churchcustompayment.index', compact('data'));
    }



    public function store(Request $request)
    {
        if($this->checkval($request)==0) {
            session()->put('error','There were validation errors');
            return $this->validateRequest($request);
        }
        if($this->validate_year_capturing($request->year,$request->collection_id) ==1){

            session()->put('error','Year of payment contribution already exist..');
            return $this->redirect_with_input();
        }

        $data = $request->all();
        $data['branch_id']=$this->getuserspec('branch_id');
        $data['user_id']=$this->getuserid();
        $this->model::create($data);
        session()->put('success','Data Created Successful');
        return redirect($this->path_custom.$this->viewname);
    }




    public function validate_year_capturing($year,$colID)

    {
        if(Churchcustompayment::where([['year','=',$year],['collection_id','=',$colID]])->count() > 0){

            return 1;
        }
        else{

            return 0;
        }


    }
}
