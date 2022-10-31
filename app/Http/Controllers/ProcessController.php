<?php

namespace App\Http\Controllers;

use App\Models\Process;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
//    for condition
    public function __construct()
    {
       //put middlwware
    }

    public function index()
    {
        $processes = Process::get();
        return view('processes.index', ['processes' => $processes]);
    }

    public function show($id)
    {
        $process = Process::where('name', $id)->firstOrFail();
        return view('processes.show', ['process' => $process]);
    }

}
