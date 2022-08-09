<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Laravue\Models\User;
use \App\Laravue\JsonResponse;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Hash;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id'
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            array_merge(
                [
                    'current_password' => ['required', 'min:6', function ($attribute, $value, $fail) {
                        if (!\Hash::check($value, Auth::user()->password)) {
                            return $fail(__('The current password is incorrect.'));
                        }
                    }],
                    'new_password' => ['required', 'min:6'],
                    'confirm_password' => 'same:new_password'
                ]
            )
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->first()], 403);
        } else {
            $userId = auth()->user()->id;

            $user = User::find($userId);
            $user->password = Hash::make($request->new_password);

            if($user->save()){
                return response()->json(new JsonResponse(['Change password is successfully.']));
            }else{
                return response()->json(['error' => 'There is an error while saving.'], 403);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
