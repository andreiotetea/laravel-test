<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends Controller
{

    protected $userRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserRepository $userRepository 
    )
    {
        //$this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    // get active users and citizenship
    public function getUsers($status, $iso2) 
    {
        $users = $this->userRepository->getUsers($status, $iso2);
        return response()->json($users);
    }

    /**
     * Update the specified user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $result = $this->userRepository->update($request, $id);
        return response()->json($result);
    }

    /**
     * Delete the specified user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function delete(Request $request, $id)
    {
        $result = $this->userRepository->delete($request, $id);
        return response()->json($result);
    }

}
