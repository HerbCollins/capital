<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notice;
use App\Repositories\Eloquent\NoticeRepositoryEloquent;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class NoticeController extends Controller
{
    public $noticeRep;

    public function __construct(NoticeRepositoryEloquent $repositoryEloquent)
    {
        $this->middleware('CheckPermission:notices');

        $this->noticeRep = $repositoryEloquent;
    }

    public function index()
    {
        $notices = $this->noticeRep->getAll();

        return view('admin.notices.index' , compact('notices'));
    }

    public function create()
    {
        return view('admin.notices.create');
    }

    public function store(Request $request)
    {
        $attrs = $request->all();

        if($attrs['is_publish']){
            $attrs['published_at'] = Carbon::now()->toDateTimeString();
        }

        $this->noticeRep->createNotice($attrs);
        return redirect('admin/notices');
    }

    public function edit($id)
    {
        $notice = $this->noticeRep->find($id)->toArray();

        return view('admin.notices.edit' , compact('notice'));
    }

    public function update(Request $request , $id)
    {
        $attrs = $request->all();

        if($attrs['is_publish']){
            $attrs['published_at'] = Carbon::now()->toDateTimeString();
        }

        $rst = $this->noticeRep->update($attrs , $id);

        if($rst)
            flash('编辑成功' , 'success');
        else
            flash('编辑失败' , 'error');

        return redirect('admin/notices');
    }

    public function destroy($id)
    {
        $rst = $this->noticeRep->delete($id);
        if($rst)
            flash('删除成功' , 'success');
        else
            flash('删除失败' , 'error');

        return redirect('admin/notices');
    }
}
