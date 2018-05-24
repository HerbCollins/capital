<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\MinerRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\MinerRepositoryEloquent as MinerRepository;

class MinerController extends Controller
{
    private $miner;

    public function __construct(MinerRepository $minerRepositoryEloquent)
    {
        $this->middleware('CheckPermission:miners');
        $this->miner = $minerRepositoryEloquent;
    }

    public function index()
    {
        $attrs = [
            'id' ,
            'title' ,
            'img' ,
            'price' ,
            'max' ,
            'day_max' ,
            'exist_max' ,
            'income' ,
            'timelong' ,
            'cycle',
            'updated_at'
        ];

        $miners = $this->miner->getAll($attrs);

        return view('admin.miners.index' , compact('miners'));
    }

    public function create()
    {
        return view('admin.miners.create');
    }

    public function store(MinerRequest $minerRequest)
    {
        $this->miner->createMiner($minerRequest->all());
        return redirect('admin/miners');
    }

    public function edit($id)
    {
        $miner = $this->miner->find($id)->toArray();

        return view('admin.miners.edit' , compact('miner'));
    }

    public function update(Request $request , $id)
    {
        $rst = $this->miner->update($request->all() , $id);

        if($rst)
            flash('编辑成功' , 'success');
        else
            flash('编辑失败' , 'error');

        return redirect('admin/miners');
    }

    public function destroy($id)
    {
        $rst = $this->miner->delete($id);
        if($rst)
            flash('删除成功' , 'success');
        else
            flash('删除失败' , 'error');

        return redirect('admin/miners');
    }
}
