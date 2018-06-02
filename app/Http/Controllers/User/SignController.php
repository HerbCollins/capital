<?php

namespace App\Http\Controllers\User;

use App\Repositories\Eloquent\SignRepositoryEloquent as SignRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Log;

class SignController extends Controller
{
    private $signRep;

    public function __construct(SignRepository $repositoryEloquent)
    {
        $this->middleware('auth:users');
        $this->signRep = $repositoryEloquent;
    }

    public function ajaxSign(Request $request)
    {
        try{
            $user_id = Auth::id();

            $this->signRep->sign($user_id);

            return response()->json([
                'code' => 0,
                'message' => 'success'
            ]);
        }catch (\Exception $e){

            Log::error("[SignController@ajaxSign] error message :" .$e->getMessage());
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
}
