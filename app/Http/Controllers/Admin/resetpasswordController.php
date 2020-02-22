<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\resetpassword;
use App\Traits\GeneralProcessTrait;
use App\Traits\GeneralVariables;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class resetpasswordController extends Controller
{
    use GeneralProcessTrait;
   protected $model = User::class;
      protected $viewname = 'resetpassword';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [
           'oldpassword'=> 'required|string|min:8',
           'password'=>'required|string|min:8',
           'password_confirmation'=>'required|same:password'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];



    public function create()
    {

        $data = array();
        $type = 'create';
       return  view('admin.resetpassword.'.$type, compact('data'));
    }


    public function store(Request $request)
    {
        $path = 'admin/resetpassword/create';
        $data = $request->all();
        $validation = Validator::make($data, $this->validationRules);
        if ($validation->passes()) {
            $id = Auth::user()->id;
            $dat = User::find($id);
            $data['password']=$this->encryptpassword($request->password);
            if (Hash::check($request->oldpassword, $dat->password)) {
                if ($dat->update($data) == true) {
                    session()->put('success', 'Password Changed Successfully!');
                    return redirect($path);
                } else {

                    session()->put('error', 'Password Could not be changed,Please Try Again!!');
                    return redirect($path);

                }
            } else {

                session()->put('error', 'Current Password Is Incorrect');
                return redirect($path);
            }
        } else {
            session()->put('error', 'validation Errors');
            return redirect($path)->withErrors($validation)->withInput();
        }
    }

    }
