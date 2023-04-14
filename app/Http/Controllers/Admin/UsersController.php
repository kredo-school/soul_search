<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{

    public function index(Request $request, User $user)
    {
        $all_users = $user->where('username','like', '%' . $request->search . '%')->withTrashed()->latest()->paginate(5);
        return view('admin.users.index')->with('all_users', $all_users)->with('search', $request->search);
    }

    public function deactivate(User $user, $id){
        $user->destroy($id);
        return redirect()->back();
    }

    public function activate(User $user, $id){
        $user->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
