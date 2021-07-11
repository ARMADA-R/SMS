<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use DB;

class AppSettings extends Controller
{
    //
    public function showSettingsForm()
    {
        $this->authorize('viewAny', Settings::class);
        $this->authorize('view', Settings::class);

        $settings = Settings::latest()->first();
        $settings->payload = json_decode($settings->payload, true);

        // dd($settings);
        return view('admin.settings.settings', ['settings' => $settings]);
    }



    public function updateBasics(Request $request)
    {

        $this->authorize('update', Settings::class);

        $new_settings = (DB::table('settings')->select(['payload'])->latest()->first());
        $new_settings = json_decode($new_settings->payload, true);


        $request->validate([
            'appName' => 'required|max:20',
        ]);

        if (isset($request->logo)) {
            $request->validate([
                'logo' => 'required|max:512|file|mimes:icon,svg,png,gif,jpg',
            ]);
        }

        if (isset($request->icon)) {
            $request->validate([
                'icon' => 'required|max:10|file|mimes:icon,svg,png,gif,jpg',
            ]);
        }

        try {


            $new_settings['app_name']  = $request->appName;

            if (isset($request->logo)) {
                $logo_path = $request->file('logo')->store('logo');

                $new_settings['logo']  = $logo_path;
            }

            if (isset($request->icon)) {
                $icon_path = $request->file('icon')->store('icons');
                $new_settings['icon']  = $icon_path;
            }

            Settings::create([
                'payload' => json_encode($new_settings)
            ]);

            // clear settings cache to apply new settings immediately
            Cache::forget('settings');

            return back()->with('success', trans('app.settings.basics-updated-successfuly'));
        } catch (\Throwable $th) {
            Log::error($th . '\n' . $request);
            return back()->withErrors(trans('app.settings.basics-update-error'));
        }
    }


    public function updateMaintenance(Request $request)
    {
        $this->authorize('update', Settings::class);

        $request->validate([
            'maintenanceMessage' => 'required|string',
            'maintenanceMode' => 'required|in:true,false',
        ]);

        try {
            $new_settings = (DB::table('settings')->select(['payload'])->latest()->first());
            $new_settings = json_decode($new_settings->payload, true);

            $new_settings['maintenance_message']  = $request->maintenanceMessage;
            $new_settings['maintenance_status']  = $request->maintenanceMode;

            Settings::create([
                'payload' => json_encode($new_settings)
            ]);

            // clear settings cache to apply new settings immediately
            Cache::forget('settings');

            return back()->with('success', trans('app.settings.maintenance-mode-updated-successfuly'));
        } catch (\Throwable $th) {

            Log::error($th  . '\n' . $request);
            return back()->withErrors(trans('app.settings.maintenance-mode-update-error'));
        }
    }


    public function showMaintenancePage()
    {
        // dd(filter_var(settings('maintenance_status'), FILTER_VALIDATE_BOOLEAN));
        if (filter_var(settings('maintenance_status'), FILTER_VALIDATE_BOOLEAN)) {
            return view('app.maintenance');
        } else {
            return abort(404);
        }
    }


    public function updateOptions(Request $request)
    {
        // dd($request->all());
        $this->authorize('update', Settings::class);

        try {
            if (isset($request->scheduling_attendance)) {
                $request->validate([
                    'scheduling_attendance' => 'required|in:true,false',
                ]);
                $new_settings = (DB::table('settings')->select(['payload'])->latest()->first());
                $new_settings = json_decode($new_settings->payload, true);

                $new_settings['scheduling_attendance']  = $request->scheduling_attendance;

                Settings::create([
                    'payload' => json_encode($new_settings)
                ]);

                // clear settings cache to apply new settings immediately
                Cache::forget('settings');

                return back()->with('success', trans('app.settings.system-options-updated-successfuly'));
            } else {
                $new_settings = (DB::table('settings')->select(['payload'])->latest()->first());
                $new_settings = json_decode($new_settings->payload, true);

                $new_settings['scheduling_attendance']  = false;

                Settings::create([
                    'payload' => json_encode($new_settings)
                ]);

                // clear settings cache to apply new settings immediately
                Cache::forget('settings');

                return back()->with('success', trans('app.settings.system-options-updated-successfuly'));
            }
        } catch (\Throwable $th) {

            Log::error($th  . '\n' . $request);
            return back()->withErrors(trans('app.settings.system-options-update-error'));
        }
    }
}
