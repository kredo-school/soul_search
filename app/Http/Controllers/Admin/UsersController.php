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
        $this->user = $user;
    }

    public function index()
    {
        // $all_users = $this->user->where('name', 'like', '%' . $request->search . '%')->withTrashed()->latest()->paginate(3);
        return view('admin.users.index');
    }
}
