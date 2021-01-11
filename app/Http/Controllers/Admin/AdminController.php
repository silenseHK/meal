<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function lists()
    {
        return 'lists';
    }

    public function first($id)
    {
        return $id;
    }

    public function add()
    {
        return 'add';
    }

    public function edit($id)
    {
        return $id;
    }

    public function update($id)
    {
        return $id;
    }

    public function delete($id)
    {
        return $id;
    }
}
