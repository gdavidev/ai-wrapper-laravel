<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CodeController extends Controller
{
    public function saveFile(Request $request)
    {
        $content = $request->input("content");
        Storage::disk('public')->put('documents/index.html', $content);

        return response()->json(['message' => 'File saved successfully!']);
    }

    public function getFile(Request $request)
    {
        $path = $request->input("path");

        if (Storage::disk('public')->exists($path)) {
            return response()->file(Storage::disk('public')->path($path));
        }
        return response()->json(['message' => 'error, file not found.'], 404);
    }
}
