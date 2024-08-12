<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function indexrole() {
        return view('backend/role.index');
    }
    public function createrole() {
        return view('backend/role.create');
    }
    public function editrole() {
        return view('backend/role.edit');
    }
}
