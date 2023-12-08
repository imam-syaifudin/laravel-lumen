<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $user = $this->userService->index();
        return response()->json(['data' => $user], 200);
    }

    public function create(Request $request)
    {


        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(),[
                'nama' => 'required',
                'umur' => 'required',
                'kelamin' => 'required',
                'alamat' => 'required',
                'password' => 'required',
            ]);

            if( $validator->fails() ){
                throw new Exception;
            }

            $user = $this->userService->create($request->all());

            DB::commit();
            return response()->json([
                'message' => 'Success Add User',
                'data' => $user
            ], 200);
        } catch (Exception $error) {
            DB::rollBack();
            return response()->json(['message'=> 'Failed Create User', 'error' => $validator->message()], 422);
        }
    }

    public function show($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userService->show($id);

            DB::commit();
            return response()->json(['data' => $user], 200);
        } catch (Exception $error) {
            DB::rollBack();
            return response()->json(['message' => 'User Not Found'], 404);
        }
    }

    public function update(Request $request, $id)
    {


        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(),[
                'nama' => 'required',
                'umur' => 'required',
                'kelamin' => 'required',
                'alamat' => 'required',
            ]);

            if( $validator->fails() ){
                throw new Exception;
            }

            $user = $this->userService->update($id, $request->all());

            DB::commit();
            return response()->json([
                'message' => 'Success Edit User',
                'data' => $user
            ], 200);
        } catch (Exception $error) {
            DB::rollBack();
            return response()->json(['message'=> 'Failed Edit User', 'error' => $error->getMessage()], 422);
        }
    }

    public function delete($id){

        DB::beginTransaction();
        try {

            $user = $this->userService->delete($id);

            DB::commit();
            return response()->json([
                'message' => 'Success Delete User',
                'data' => $user
            ], 200);
        } catch (Exception $error) {
            DB::rollBack();
            return response()->json(['message'=> 'Failed Delete User', 'error' => $error->getMessage()], 422);
        }

    }

    
}
