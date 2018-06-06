<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Auth\AuthController as Controller;
use App\Models\User;
use App\Repositories\SMSRepository;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use Auth;

class AuthController extends Controller
{
    protected $guard = 'users';
    protected $redirectTo = '/';
    protected $sms;

    public function __construct(SMSRepository $repository)
    {
        parent::__construct();
        $this->sms = $repository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'phone' => 'required|min:11|max:11|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'password' => $data['password'],
            'hash' => generateOrderId()
        ]);
    }

    public function index()
    {
        return view('users.auth.auth');
    }

    public function getRegister($code = null)
    {
        return view('users.auth.register' , compact('code'));
    }

    public function postRegister(Request $request)
    {
        try{
            $code = $request['code'];
            $phone = $request['phone'];


            if(!$this->sms->check($phone , $code)){
                return response()->json([
                    'code' => '10001',
                    'message' => "验证码错误"
                ]);
            }

            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                $errors = $validator->getMessageBag()->toArray();

                if($errors['password']){

                    return response()->json([
                        'code' => '10002',
                        'message' => $errors['password']
                    ]);
                }

                if($errors['phone']){
                    return response()->json([
                        'code' => '10003',
                        'message' => $errors['phone']
                    ]);
                }

                if($errors['name']){
                    return response()->json([
                        'code' => '10004',
                        'message' => $errors['name']
                    ]);
                }

            }

            Auth::guard($this->getGuard())->login($this->create($request->all()));

            return response()->json([
                'code' => '0',
                'message' => 'success'
            ]);
        }catch (\Exception $e){

            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }

    }
}
