<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notice;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $notices = Notice::orderBy('updated_at' , 'desc')->paginate(20);

        return view('admin.notice.index' , compact('notices'));
    }

    public function create()
    {
        return view('admin.notice.create');
    }

    public function store(Request $request)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request)
    {

    }

    public function destory($id)
    {

    }
}
