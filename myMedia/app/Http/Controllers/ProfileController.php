<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct admin home page
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::select('id', 'name', 'email', 'address', 'phone', 'gender')->where('id', $id)->first();
        return view('admin.profile.index', compact('user'));
    }
    //update admin account
    public function updateAdminAccount(Request $request)
    {
        $this->validationCheck($request);
        $userData = $this->getUserInfo($request);
        User::where('id', Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess' => 'Account Updated Successfully']);
    }
    //direct change password page
    public function changePasswordPage()
    {
        return view('admin.profile.changePassword');
    }
    //change password
    public function adminChangePassword(Request $request)
    {
        $this->passwordValidationCheck($request);

        $dbData = User::where('id', Auth::user()->id)->first();
        $dbPassword = $dbData->password;

        if (Hash::check($request->oldPassword, $dbPassword)) {
            $data = [
                'password' => Hash::make($request->newPassword),
            ];
            User::where('id', Auth::user()->id)->update($data);

            return redirect()->route('dashboard');

        }
        return back()->with(['fail' => 'password do not match ']);

    }

    //get user info
    private function getUserInfo($request)
    {
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'phone' => $request->adminPhone,
            'address' => $request->adminAddress,
            'gender' => $request->adminGender,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
    //account validation check
    private function validationCheck($request)
    {
        Validator::make($request->all(), [
            'adminName' => 'required|min:4',
            'adminEmail' => 'required',
            'adminGender' => 'required',
            'adminPhone' => 'required',
            'adminAddress' => 'required',
        ])->validate();
    }
    //password validation check
    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ])->validate();
    }
}