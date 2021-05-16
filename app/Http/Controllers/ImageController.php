<?php

namespace App\Http\Controllers;
use App\Image;
use App\User;
use App\Demande;
use Validator;
use Response;
use Illuminate\Http\Request;
use ZipArchive;
use File;

class ImageController extends Controller
{
    public function select_images(){
    	return view('select_images');
    }

    // mothod to upload images
    public function store(request $request) {
    	$input=$request->all();
    	$id = auth()->user()->id;
    	$validator = Validator::make($request->all(),[
	            'image' => 'required',
 				'image.*' => 'image|mimes:jpeg,png,jpg,pdf'
	        ]);
    	if ($validator->fails()) {
    		return "select valid image";
    	}
    	$files = $request->file('image');
        foreach($files as $file){
            $extension = $file->extension();
            $name = uniqid().'.'.$extension;
            // dd($name);
            // $name=$file->getClientOriginalName();
            $file->move('image',$name);
            // $images[]=$name;
            $image = new Image;
	        $image->user_id = $id;
            $image->demande_id = $request->session()->get('demande_id',$id);;
	        $image->path = $name;
	        $image->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Success! :Images was successfully uploaded!');        
        }
    	// /*Insert your data*/
	    return redirect('/');
	    // return redirect('redirecting page');
	}

	public function getImage(){
		$id = auth()->user()->id;
		$images = Image::all()->where('user_id', $id);
        $demandes = Demande::all()->where('user_id', $id);
		// $images = Image::select('path')->where('user_id', $id)->get();
		// return view('show')->with('images', $images);
        return view('show', ['images'=>$images, 'demandes'=>$demandes]);
	}


    // Download images 



    public function get(Request $request){
        $filename = 'myzip.zip';
        if (File::exists(public_path($filename))) {
            File::delete($filename);
        }
        
        $zip = new ZipArchive;

        if (!File::exists(public_path('folder').auth()->user()->id)) {
            $user_folder_images = public_path('folder').auth()->user()->id;
            File::makeDirectory($user_folder_images);
        }
        $user_folder_images = public_path('folder').auth()->user()->id;
        
        
        $images = $request->input('path');
        
        foreach ($images as $image) {
            $img = Image::find($image);
            $image_path = $img['path'];
            $imagepath = public_path('image/').$image_path;
            File::copy($imagepath, $user_folder_images.'/'.$image_path);
            // echo $test['path'];
        }

        $filename = 'myzip.zip';

        if ($zip->open(public_path($filename), ZipArchive::CREATE) ==TRUE) {
            $files = File::files(public_path('folder').auth()->user()->id);
            foreach ($files as $key => $value) {
                $relativename = basename($value);
                $zip->addFile($value, $relativename);
            }
            $zip->close();
        }

        $files = File::files(public_path('folder').auth()->user()->id);
        foreach ($files as $file) {
                File::delete($file);
            }

        return response()->download(public_path($filename));

    }
}



// $id = auth()->user()->id;
//         $images = Image::all()->where('user_id', $id);
//         foreach($images as $image){
//             $imagepath = public_path('image/').$image['path'];
//             Response::download($imagepath);     
//         }