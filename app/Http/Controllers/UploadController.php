<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Problems;
use App\Solutions;
use App\Http\Controllers\ProblemController;
use Illuminate\Support\Facades\Storage;



class UploadController extends Controller
{

    public function upload($id,$filename){
        $ticket=Problems::findOrFail($id);
        return Storage::download($filename);


    }


}

