<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'appname' => 'required|string',
            'whatsapp_key' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $existingRecord = AppSetting::latest()->first();
        
        if ($existingRecord) {
            $existingRecord->delete();
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Downloads'), $fileName);
            $featured_image = 'Downloads/' . $fileName;
        } else {
            $featured_image = null;
        }

        $appSetting = AppSetting::create([
            'appname' => $request->appname,
            'whatsapp_key' => $request->whatsapp_key,
            'logo' => $featured_image,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Added Successfully');
    }

// // API ROUTER:
// // POST METHOD:

// public function apistore(Request $request)
//     {
//         $request->validate([
//             'appname' => 'required|string',
//             'whatsapp_key' => 'required|string',
//             'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//         ]);

//         if ($request->hasFile('logo')) {
//             $file = $request->file('logo');
//             $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
//             $file->move(public_path('Downloads'), $fileName);
//             $featured_image = 'Downloads/' . $fileName;
//         } else {
//             $featured_image = null;
//         }

//         $appSetting = AppSetting::create([
//             'appname' => $request->appname,
//             'whatsapp_key' => $request->whatsapp_key,
//             'logo' => $featured_image,
//         ]);

//         return response()->json([
//             'message' => 'App setting added successfully',
//             'data' => $appSetting], 200);
//     }
  
}