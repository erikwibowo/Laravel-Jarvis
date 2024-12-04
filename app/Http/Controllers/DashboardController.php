<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){
        return Inertia::render('Dashboard',[
            'userCount'         => User::count(),
            'roleCount'         => Role::count(),
            'permissionCount'   => Permission::count()
        ]);
    }
}
