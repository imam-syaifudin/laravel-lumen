<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface {

    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        
        return $this->userRepository->getAll();

    }

    public function show($id){
        
        return $this->userRepository->getById($id);
    }

    public function create($data){
        
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->createUser($data);
        
    }
    
    public function update($id, $data){
        
        $user = $this->userRepository->getById($id);
        $data['password'] = $data['password'] != null ? Hash::make($data['password']) : $user->password;

        return $this->userRepository->updateUser($user, $data);
    }
    
    public function delete($id){
            
        $user = $this->userRepository->getById($id);
        return $this->userRepository->deleteUser($user);
    }

}