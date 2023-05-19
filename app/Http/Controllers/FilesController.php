<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('files')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload_student_image(Request $request)
    {
        // Move the uploaded file to the public/images directory using the updated file name
        $uploadedFileName = $request->file('file')->getClientOriginalName();
        $fileExtension = $request->file('file')->getClientOriginalExtension();
        $updatedFileName = $uploadedFileName;
        $request->file('file')->move(public_path('images/'), $updatedFileName);
    
        // Set the image path to the path in the public/images directory
        $imagePath = 'images/' . $updatedFileName;
    
        // Create a new File record with the provided name, generated image path, and the authenticated user's ID
        $file = File::create([
            'user_id' => $request->input('account_id'),
            'name' => $uploadedFileName,
            'type' => $fileExtension,
            'size' => $request->input('file_size'),
            'path' => $imagePath
        ]);
    }
    public function create(Request $request)
    {
        // Move the uploaded file to the public/images directory using the updated file name
        $uploadedFileName = $request->file('file')->getClientOriginalName();
        $fileExtension = $request->file('file')->getClientOriginalExtension();
        $updatedFileName = $uploadedFileName;
        $request->file('file')->move(public_path('images/'), $updatedFileName);

        // Set the image path to the path in the public/images directory
        $imagePath = 'images/' . $updatedFileName;

        // Create a new File record with the provided name, generated image path, and the authenticated user's ID
        $file = File::create([
            'user_id' => $request->input('account_id'),
            'name' => $uploadedFileName,
            'type' => $fileExtension,
            'size' => $request->input('file_size'),
            'path' => $imagePath
        ]);
    }


    



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }
}
