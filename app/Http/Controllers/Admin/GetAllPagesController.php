<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetAllPagesController extends Controller
{
    public function category()
    {
        return view('admin.category.index');
    }

    public function article()
    {
        return view('admin.product.index');
    }
    public function admin()
    {
        return view('admin.dashboard');
    }
}
