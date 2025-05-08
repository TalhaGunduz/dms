<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        // Varsayılan olarak boş bir view döndür
        return view('admin.permissions.index');
    }
} 