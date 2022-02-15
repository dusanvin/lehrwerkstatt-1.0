<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageFile;

use Illuminate\Support\Facades\Storage;
use App\Models\User;

use Intervention\Image\Facades\Image;

class ImageController extends Controller
{

    public function index() { 

    }

    public function store(Request $request) {
        $user = User::find(auth()->user()->id);
        if(isset($user->image->filename)) {
            Storage::delete($user->image->filename);
        }
            
        $image = $request->validate([
            'image' => 'required|image' // |mimes:jpg, jpeg, png, bmp
        ]);
        $filename = $request->file('image')->getClientOriginalName(); // contains filetype
        $filename = $request->file('image')->store('user'); 
        
        $img = Image::make($request->file('image'));

        $img->resize(150, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->save(storage_path('app/'.$filename));

        ImageFile::updateOrCreate(
            ['user_id' => $request->user()->id],
            ['filename' => $filename]
        );

        session()->flash('success', 'true');

        return redirect()->route('profile.edit');

    }

    public function show(Request $request, $user_id) {
        $user = User::find($user_id);
        //return Storage::download($user->image->filename); //FUNKTIONIERT
        $path = storage_path('app/'.$user->image->filename);
        return response()->file($path);
    }

    public function destroy($user_id) {
        $user = User::find($user_id);
        Storage::delete($user->image->filename);
        ImageFile::where('filename', $user->image->filename)->delete();
        session()->flash('success', 'true');
        return back();
    }
}
