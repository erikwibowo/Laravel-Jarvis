<?php

namespace App\Http\Controllers;

use App\Http\Requests\Activity\ActivityIndexRequest;
use App\Models\Activity;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:activity read', ['only' => ['index', 'show']]);
        $this->middleware('permission:activity delete', ['only' => ['destroy', 'destroyBulk']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(ActivityIndexRequest $request)
    {
        $activities = Activity::query();
        if ($request->has('search')) {
            $activities->where('log_name', 'LIKE', "%" . $request->search . "%");
            $activities->orWhere('description', 'LIKE', "%" . $request->search . "%");
            $activities->orWhere('event', 'LIKE', "%" . $request->search . "%");
            $activities->orWhere('properties', 'LIKE', "%" . $request->search . "%");
        }
        if ($request->has(['field', 'order'])) {
            $activities->orderBy($request->field, $request->order);
        }
        $perPage = $request->has('perPage') ? $request->perPage : 10;
        return Inertia::render('Activity/Index', [
            'title'         => __('app.label.activity'),
            'filters'       => $request->all(['search', 'field', 'order']),
            'perPage'       => (int) $perPage,
            'activities'    => $activities->paginate($perPage)->onEachSide(0),
            'breadcrumbs'   => [['label' => __('app.label.activity'), 'href' => route('activity.index')]],
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        try {
            $activity->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => $activity->description]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => $activity->description]) . $th->getMessage());
        }
    }

    public function destroyBulk(Request $request)
    {
        try {
            $activities = Activity::whereIn('id', $request->id);
            $activities->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . __('app.label.activity')]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . __('app.label.activity')]) . $th->getMessage());
        }
    }
}
