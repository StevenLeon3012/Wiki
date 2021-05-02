<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Auth;

class RecordController extends Controller {
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = Record::orderBy('created_at', 'DESC')->get();
        if(Auth::user()->hasRole('Admin')){
            return view('records.index', compact('data'));
        }else{
            return redirect()->route('blogs.index');
        }
    }

}
