<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->users = $user;
    }

    public function index(Request $request)
    {
        $all_users = $this->users->where('username','like', '%' . $request->search . '%')->withTrashed()->latest()->paginate(5);
        return view('admin.users.index')->with('all_users', $all_users)->with('search', $request->search);
    }

    public function deactivate($id){
        $this->users->destroy($id);
        return redirect()->back();
    }

    public function activate($id){
        $this->users->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
