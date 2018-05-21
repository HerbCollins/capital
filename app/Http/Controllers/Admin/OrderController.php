<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Repositories\Eloquent\OrderRepositoryEloquent as OrderRepository;

class OrderController extends Controller
{
    private $order;

    public function __construct(OrderRepository $orderRepositoryEloquent)
    {
        $this->middleware('CheckPermission:orders');

        $this->order = $orderRepositoryEloquent;
    }

    public function index()
    {
        $attr = ['id' , 'price' , 'hash_no' , 'user_id' , 'coins' , 'status' , 'type' , 'updated_at'];

        $orders = $this->order->findWithPaginate([],$attr);

        return view('admin.orders.index' , compact('orders'));
    }


    public function create()
    {
        return view('admin.orders.create');
    }

    public function store(OrderRequest $orderRequest)
    {
        return redirect('admin/orders');
    }

    public function edit($id)
    {
        $order = $this->order->find($id);
        return view('admin.orders.edit' , compact('order'));
    }

    public function update(Request $request , $id)
    {
        $rst = $this->order->update($request->all() , $id);
        if($rst)
            flash('编辑成功' , 'success');
        else
            flash('编辑失败' , 'error');
        return redirect('admin/orders');
    }

    public function destroy($id)
    {
        $rst = $this->order->delete($id);

        if ($rst){
            flash('删除成功','success');
        }else{
            flash('删除失败','error');
        }
        return redirect('admin/orders');
    }

    public function lists($type)
    {
        $attr = ['id' , 'price' , 'hash_no' , 'user_id' , 'coins' , 'status' , 'type' , 'updated_at'];

        $orders = $this->order->findWithPaginate(['type' => $type] ,$attr);
        return view('admin.orders.index' , compact('orders'));
    }
}
