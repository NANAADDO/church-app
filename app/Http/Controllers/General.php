<?php

namespace App\Http\Controllers;

use App\Helpers\Permissions;
use App\Traits\GeneralProcessTrait;
use App\Traits\GeneralReportTrait;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Helpers\UserAuth;
use Auth;
use App\User;
use Illuminate\Support\Facades\Config;

class General extends Controller
{
    use GeneralProcessTrait;
    use GeneralReportTrait;

    protected  $viewname ;
    protected $vali;
    protected $validationRules = [];
    protected $model;
    protected  $searchparms;
    protected $imgtostaff ;
    protected $imgtoIDType;
    protected $validoptional = [];
    protected $roleaccess ;
    protected $Rolelevel ;
    protected $path_custom = '' ;
    protected $view_custom = '' ;
    protected $right ;


    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            /*************CHECK ALL ROLE PERMISSION ON USER**********/
       $this->right = Permissions::confirm_user_permission('/'.$this->path_custom.$this->viewname);

            if(!\Request::ajax()) {
                if ($this->get_access_type($this->viewname, $this->right, Route::currentRouteName()) == 0) {
                    session()->put('info','Oops!! permission Denied..');
                    return redirect('home');
                }
            }
       return $next($request);
        });

    }


    protected function redirect_with_input()
    {



            return redirect()->back()
                ->withInput();
        }


    protected function validateRequest($request)
    {

        $validation = Validator::make($request->all(), $this->validationRules);  //third param: , $this->messages
        if ($validation->passes()) {

        } else {

        return redirect()->back()
            ->withInput()
            ->withErrors($validation);
    }
    }

    protected function validateRequestOption($request)
    {

        $validation = Validator::make($request->all(), array_merge($this->validationRules,$this->validoptional));  //third param: , $this->messages
        if ($validation->passes()) {

        } else {

            return redirect()->back()
                ->withInput()
                ->withErrors($validation);
        }
    }

    protected function validate_request_option_with_params($request,$fields)
    {

        $validation = Validator::make($request->all(), $fields);  //third param: , $this->messages
        if ($validation->passes()) {

        } else {

            return redirect()->back()
                ->withInput()
                ->withErrors($validation);
        }
    }
    protected function checkvalsingle($request)
    {

        $validation = Validator::make($request->all(), $this->validationRules);  //third param: , $this->messages
        if ($validation->passes()) {
           return 1;
        } else {

           return 0;
        }
    }
    protected function checkval($request)
    {

        $validation = Validator::make($request->all(), array_merge($this->validationRules,$this->validoptional));  //third param: , $this->messages
        if ($validation->passes()) {
            return 1;
        } else {

            return 0;
        }
    }

    protected function checkval_with_option($request,$rules)
    {

        $validation = Validator::make($request->all(), $rules);  //third param: , $this->messages
        if ($validation->passes()) {
            return 1;
        } else {

            return 0;
        }
    }

    public function displayview($varn,$type){

          $data =$varn;

        return view($this->view_custom.$this->viewname.".".$type)->with(compact('data'));

}


    public function index(Request $request)
    {

        $data = $this->model::paginate(20);

        $type = 'list';
        return $this->displayview($data,$type);
    }



    public function create()
    {

        $data = array();
        $type = 'create';
        return $this->displayview($data, $type);
    }

    public function store(Request $request)
    {

        if($this->checkval($request)==0) {
            session()->put('error','There were validation errors');
            return $this->validateRequest($request);
        }

        $data = $request->all();
        $data['branch_id']=$this->getuserspec('branch_id');
        $data['user_id']=$this->getuserid();
        $this->model::create($data);
        session()->put('success','Data Created Successful');
        return redirect($this->path_custom.$this->viewname);
    }


    public function show($id)
    {

        $data = $this->model::findOrFail($id);
        $type = 'show';
        if(\Request::ajax()) {

            $mian= 'true';
            return view($this->view_custom.$this->viewname.".".$type)->with(compact('data','mian'))->render();

        }
        return $this->displayview($data,$type);
    }
    public function edit($id)
    {
        $data = $this->model::findOrFail($id);
        $type = 'edit';
        return $this->displayview($data,$type);


    }


    public function update(Request $request, $id)
    {

        if($this->checkval($request)==0) {
            session()->put('error','There were validation errors');
            return $this->validateRequest($request);
        }

        $data = $this->model::findOrFail($id);
        $data->update($request->all());
        session()->put('success','Data Updated Successful');

        return redirect($this->path_custom.$this->viewname);


    }


    public function destroy($id)
    {
        $data = $this->model::findOrFail($id);
        $data->delete();

        session()->put('success','Data Deleted Successful');

        return redirect($this->viewname);
        }

    public function search(){
        $search =Input::get('searchString');
        $data =$this->model::orderBY('id','desc')->where("".$this->searchparms."",'LIKE',"%$search%")->paginate(10);
        $type = 'list';
        return $this->displayview($data,$type);



    }

    public function upload_image($path,$imgpth,$request){
        if($imgpth != ''){
            if ($request->file($imgpth)->isValid()) {
                $newname = time();
                $destinationPath = public_path() . '/uploads/'.$path;
                $fileName=$request->$imgpth->getClientOriginalName();
                $imgname = $newname.$fileName;
                $request->file($imgpth)->move($destinationPath,$imgname);
                return $imgname;

            }
            return  0;
        }
        return 1;

    }

    public function  redirect_error($message){
        session()->put('error',$message);
        return redirect()->back()
            ->withInput();
    }

    public function  encryptpassword($pass){
        return  bcrypt($pass);

    }



    public function  checkviewaccessed($role){
        if($role == $this->roleaccess){
            return redirect('home');
            }

    }

    public function getuserdetails(Request $request)
{

    return $request->user();
}

    public function getuserid()
    {

        return auth()->user()->id;
    }
    public function getuserspec($type)
    {

        return auth()->user()->$type;
    }



    public function get_access_type($path,$array,$route)
    {
  $res = 0;
       if (in_array($route,[$path.'.create',$path.'.store'])  && in_array(1, $array)) {

               $resp = 1;
           }

        else if (in_array($route,[$path.'.index',$path.'.show']) && in_array(2, $array)) {

            $resp = 1;
        }

        else if (in_array($route,[$path.'.edit',$path.'.update']) && in_array(3, $array)) {

            $resp = 1;
        }

        else if ($route ==$path.'.destroy' && in_array(4, $array)) {

            $resp = 1;
        }
        else{
            $resp = 0;

        }
        return $resp;

    }





}
