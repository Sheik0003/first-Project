<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\MessageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Exception;

class MessageController extends Controller
{
    public function index()
    {
        $appSetting = AppSetting::orderBy('id', 'desc')->first();
        return view('dashboard.message', compact('appSetting'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg',
                'file' => 'required|mimes:xlsx,xls,csv|max:2048',
                'text' => 'nullable|string|max:255'
            ]);
    
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('Downloads'), $fileName);
                $featured_image = 'Downloads/' . $fileName;
            }
    
            $filePath = $request->file('file')->store('temp');
    
            $spreadsheet = IOFactory::load(storage_path("app/" . $filePath));
            $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    
            $formattedData = [];
            foreach ($data as $index => $row) {
                $formattedData[] = [$index => $row['A']];
            }
    
            $jsonData = json_encode($formattedData);
    
            MessageModel::create([
                'image' => $featured_image,
                'json' => $jsonData,
                'text' => $request->input('text', ''),
            ]);
    
            Storage::delete($filePath);
    
            return back()->with('success', 'Message Created Successfully!');
        } catch (Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
         
}