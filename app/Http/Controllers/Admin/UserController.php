<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Repositories\Eloquent\UserRepositoryEloquent as UserRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('CheckPermission:users');
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $fields = ['id' , 'name' , 'phone' , 'email' , 'updated_at' , 'coin' , 'hash' , 'inviter'];
        $users = $this->userRepository->getAll($fields);
        return view('admin.users.index' , compact('users'));
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id)->toArray();

        return view('admin.users.edit' , compact('user'));
    }

    public function update(Request $request , $id)
    {
        $res = $this->userRepository->update($request->all(),$id);
        if ($res){
            flash('用户保存成功','success');
        }else{
            flash('用户保存失败','error');
        }
        return redirect('admin/users');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $userRequest)
    {
        $this->userRepository->createUser($userRequest->all());
        return redirect('admin/users');
    }

    public function destroy($id)
    {
        $rst = $this->userRepository->delete($id);

        if ($rst){
            flash('用户删除成功','success');
        }else{
            flash('用户删除失败','error');
        }
        return redirect('admin/users');
    }
}
