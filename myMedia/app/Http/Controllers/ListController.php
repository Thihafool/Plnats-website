<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //direct admin list page
    public function index()
    {
        $userData = User::get();
        return view('admin.list.index', compact('userData'));
    }

    //delete account
    public function deleteAccount($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Account deleted ']);

    }
    //admin list search
    public function adminListSearch(Request $request)
    {
        $userData = User::when(request('adminSearchKey'), function ($query) {
            $query->orwhere('name', 'like', '%' . request('adminSearchKey') . '%')
                ->orwhere('email', 'like', '%' . request('adminSearchKey') . '%')
                ->orwhere('phone', 'like', '%' . request('adminSearchKey') . '%')
                ->orwhere('gender', 'like', '%' . request('adminSearchKey') . '%')
                ->orwhere('address', 'like', '%' . request('adminSearchKey') . '%');
        })->get();
        return view('admin.list.index', compact('userData'));

    }
}