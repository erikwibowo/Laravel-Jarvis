<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserIndexRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:user create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user read', ['only' => ['index', 'show']]);
        $this->middleware('permission:user update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user delete', ['only' => ['destroy', 'destroyBulk']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(UserIndexRequest $request)
    {
        $users = User::query();
        if ($request->has('search')) {
            $users->where('name', 'LIKE', "%" . $request->search . "%");
            $users->orWhere('email', 'LIKE', "%" . $request->search . "%");
        }
        if ($request->has(['field', 'order'])) {
            $users->orderBy($request->field, $request->order);
        }
        $perPage = $request->has('perPage') ? $request->perPage : 10;
        $role = auth()->user()->roles->pluck('name')[0];
        $roles = Role::get();
        if ($role != 'superadmin') {
            $users->whereHas('roles', function ($query) {
                return $query->where('name', '<>', 'superadmin');
            });
            $roles = Role::where('name', '<>', 'superadmin')->get();
        }
        return Inertia::render('User/Index', [
            'title'         => __('app.label.user'),
            'filters'       => $request->all(['search', 'field', 'order']),
            'perPage'       => (int) $perPage,
            'users'         => $users->with('roles')->with('roles.permissions', function($q){
                $q->orderBy('name');
            })->paginate($perPage)->onEachSide(0),
            'roles'         => $roles,
            'breadcrumbs'   => [['label' => __('app.label.user'), 'href' => route('user.index')]],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole($request->role);
            DB::commit();
            return back()->with('success', __('app.label.created_successfully', ['name' => $user->name]));
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', __('app.label.created_error', ['name' => __('app.label.user')]) . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => $request->password ? Hash::make($request->password) : $user->password,
            ]);
            $user->syncRoles($request->role);
            DB::commit();
            return back()->with('success', __('app.label.updated_successfully', ['name' => $user->name]));
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', __('app.label.updated_error', ['name' => $user->name]) . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => $user->name]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => $user->name]) . $th->getMessage());
        }
    }

    public function destroyBulk(Request $request)
    {
        try {
            $users = User::whereIn('id', $request->id);
            $users->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . __('app.label.user')]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . __('app.label.user')]) . $th->getMessage());
        }
    }
}
