<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TentangLaporController extends Controller
{
    public function index()
	{
		return view('tentangKami');
	}

}
