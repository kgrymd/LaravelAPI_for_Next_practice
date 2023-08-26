<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Image;

use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        // $image = $request->file('image');
        // Log::debug($image); // 確認用
        // $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        // $store = $image->storeAs('images', $filename, 'public');
        // $path = '/storage/' . $store;
        // $data = [
        //     'path' => $path,
        //     'file_name' => $filename,
        // ];
        // $response = Image::create($data);
        // return response()->json($response);

        $image = $request->file('image');
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $store = $image->storeAs('images', $filename, 's3');
        // $url = Storage::disk('s3')->url($store);
        // $path = '/storage/' . $store;
        $data = [
            'path' => $store,
            'file_name' => $filename,
        ];
        $response = Image::create($data);
        return response()->json($response);
    }

    public function show(Request $request)
    {
        $data = Image::get();
        return response()->json($data);
    }

    // public function test()
    // {
    //     return response()->json('hoge');
    // }
}
