<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class UserRepository
{

    public function getUsers($status, $iso2) 
    {
        $results = DB::table('users')
        ->join('user_details', 'users.id', '=', 'user_details.user_id')
        ->join('countries', 'countries.id', '=', 'user_details.citizenship_country_id')
        ->where('countries.iso2', $iso2)
        ->where('users.active', $status)
        ->get();
    
        return $results;
    }

    public function update($request, $id)
    {
        $inputs = $request->all();

        $result = DB::table('user_details')
        ->where('user_id', $id)
        ->update([
            'first_name' => $inputs['first_name'],
            'last_name' => $inputs['last_name'],
            'phone_number' => $inputs['phone_number'],
        ]);

        if(!$result) {
            $message = 'Update failed!';
        } else {
            $message = 'Update success!';
        }
        return [
            'status' => $result,
            'message' => $message
        ];
    }

    public function delete($request, $id)
    {
        $inputs = $request->all();

        $user = DB::table('users')
        ->select('users.id')
        ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
        ->where('users.id', $id)
        ->where('user_details.user_id', null)
        ->first();
        
        if(!$user) {
            $message = 'Delete failed!';
            $result = 0;
        } else {
            $result = DB::table('users')
            ->where('users.id', $user->id)
            ->delete();
            if($result) {
                $message = 'Delete success!';
            } else {
                $message = 'Delete failed!';
            }
            
        }
        return [
            'status' => $result,
            'message' => $message
        ];
    }

}
