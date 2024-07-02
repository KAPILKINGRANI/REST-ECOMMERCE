<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationToken();
        $data['admin'] = User::REGULAR_USER;

        $user = User::create($data);
        return response()->json(['data' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //status code 201
        //The request succeeded, and a new resource was created as a result. This is typically the response sent after POST requests, or some PUT requests.
        return response()->json(['data' => $user], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->has('name')) {
            $user->name = $request->name;
        }

        //now if email is updated we need to generate a verification token again for the updated email
        if ($request->has('email')) {
            $user->email = $request->validated('email');
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationToken();
            $user->admin = User::REGULAR_USER;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->validated('password'));
        }

        if ($request->has('admin')) {
            //409 Conflict
            //This response is sent when a request conflicts with the current state of the server.
            if (!$user->isVerified()) {
                return response()->json(['error' => 'Verified Users Can Modify The Admin Field'], 409);
            }
            $user->admin = $request->validated('admin');
        }

        if (!$user->isDirty()) {
            //422 Unprocessable Content
            //The request was well-formed but was unable to be followed due to semantic errors.
            return response()->json(['error' => 'You Need to update at least a single field'], 422);
        }

        $user->save();
        return response()->json(['data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['data' => $user], 200);
    }
}
