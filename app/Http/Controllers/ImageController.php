<?php

namespace App\Http\Controllers;
use App\Image;
use App\User;
use Validator;
use Illuminate\Http\Request;

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
 				'image.*' => 'image|mimes:jpeg,png,jpg|max:10048'
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
		// $images = Image::select('path')->where('user_id', $id)->get();
		return view('show')->with('images', $images);
	}
}
