<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Setting', [
            'title'     => __('app.label.setting'),
            'setting'   => Setting::first()
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
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        try {
            if ($request->favicon != null) {
                Storage::delete('public/image/setting/' . $setting->favicon);
                $favicon = time() . "." . $request->favicon->extension();
                Storage::put('public/image/setting/' . $favicon, File::get($request->favicon), 'public');
            } else {
                $favicon = $setting->favicon;
            }
            if ($request->logo != null) {
                Storage::delete('public/image/setting/' . $setting->logo);
                $logo = time() . "." . $request->logo->extension();
                Storage::put('public/image/setting/' . $logo, File::get($request->logo), 'public');
            } else {
                $logo = $setting->logo;
            }
            $setting->update([
                'user_id'       => auth()->user()->id,
                'favicon'       => $favicon,
                'logo'          => $logo,
                'name'          => $request->name,
                'short_name'    => $request->short_name,
                'description'   => $request->description,
            ]);
            return back();
        } catch (\Throwable $th) {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
