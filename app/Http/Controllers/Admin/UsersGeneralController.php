<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permissions;
use App\Helpers\Roles;
use App\Http\Controllers\Controller;
use App\Http\Controllers\General;
use App\Invoke_revoke_permissions;
use App\Role;
use App\Traits\GeneralProcessTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersGeneralController extends Controller
{
    use GeneralProcessTrait;



    public function resetStaffPassword($id){

        $pswrd = User::find($id);

        $pswrd->password = $this->encryptpassword('password.123');
       $pswrd->update();

        session()->put('success', 'Password Reset Successfully');
        return redirect('admin/users');

    }

}
