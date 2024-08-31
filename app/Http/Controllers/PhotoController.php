<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        // Ambil data gambar dari input
        $imageData = $request->input('image');

        $time = date('d-m-Y');

        if ($request->name==null || Photo::where('name', $request->name)->exists()){
            $name = Str::random(10);
        } else {
            $name=$request->name . '_' . Str::random(10);
        }

        // Cek apakah data gambar ada
        if ($imageData) {
            // Decode data base64
            $image = str_replace('data:image/png;base64,', '', $imageData);
            $image = str_replace(' ', '+', $image);
            // $imageName = Str::random(10).'.png';
            $imageName = $name. '_'. $time. '.png';

            // Simpan file ke folder public/images
            $imagePath = public_path('images') . '/' . $imageName;
            File::put($imagePath, base64_decode($image));

            // Simpan data gambar ke database
            $photo = new Photo();
            $photo->name = $imageName;
            $photo->image = $imageData; // Simpan base64 di database (optional)
            $photo->save();

            return redirect('/camera')->with('success', 'Gambar berhasil disimpan');
        } else {
            return redirect('/camera')->with('error', 'Tidak ada gambar yang diambil');
        }
    }

    public function index()
    {
        $total= Photo::all()->count();
        $photos = Photo::all();
        return view('photos', [
            'total' => $total,
            'photos' => $photos
        ]);
    }
}
