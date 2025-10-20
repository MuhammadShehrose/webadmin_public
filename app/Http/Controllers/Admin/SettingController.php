<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\SettingService;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:setting.view')->only('index');
        $this->middleware('permission:setting.create')->only('store');
    }

    public function index($section)
    {
        $sections = [
            'general',
            'smtp',
        ];

        if (!in_array($section, $sections)) {
            return redirect()->back()->with('error', 'Invalid Request!');
        }

        $settings = SettingService::all();

        return view("admin.settings.{$section}", compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $width = null;
                $height = null;
                $imageKeys = ['desktop_logo', 'mobile_logo', 'favicon'];

                if ($key == 'desktop_logo') {
                    // $width = 240; // dont add width, let image scale according to height
                    $height = 68;
                } elseif ($key == 'mobile_logo') {
                    // $width = 64; // dont add width, let image scale according to height
                    $height = 68;
                } elseif ($key == 'favicon') {
                    $width = 48;
                    $height = 48;
                }

                $value = file_upload($request->file($key), 'settings', 'public', $width, $height);

                if (in_array($key, $imageKeys, true) && setting($key)) {
                    file_remove(setting($key), 'public');
                }
            }

            update_setting($key, $value);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    // Helper method
    protected function authorizePermission($permission)
    {
        if (!auth()->user()->can($permission)) {
            abort(403, 'You do not have permission to access this settings section.');
        }
    }
}
