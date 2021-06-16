<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:web');
  }

  public function index()
  {
    return view('dashboard.index');
  }
}
