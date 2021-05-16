<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Demande;

class DemandeController extends Controller
{
    public function newdemande(request $req){
    	$id = auth()->user()->id;
    	$demande = new Demande;
    	$demande->user_id = $id;
    	$demande->save();
    	$id = $demande->id;
    	$req->session()->put('demande_id',$id);
    	return redirect('/select_images');
    }
}
