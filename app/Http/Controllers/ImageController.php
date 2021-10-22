<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Image;
class ImageController extends Controller
{
    public function index() {
        return view('image');
    }
 
    public function save(Request $request)
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        if ($files = $request->file('image')) {
            
            $fileName =  "image-".time().'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('image', $fileName);
            
            $image = new Image;
            $image->image = $fileName;
            $image->save();

            return Response()->json([
                "image" => $fileName
            ], Response::HTTP_OK);
 
        }
 
    }
}
