<?php

namespace App\Repositories\User;

use App\Repositories\User\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface {
    
    public function getAll(){
        return User::all();
    }

    public function getById($id){
        return User::findOrFail($id);
    }

    public function createUser($data){
        return User::create($data);
    }

    public function updateUser($user, $data){
        $user->update($data);
        return $user;
    }

    public function deleteUser($user){
        $user->delete($user);
        return $user;
    }

}