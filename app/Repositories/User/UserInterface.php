<?php

namespace App\Repositories\User;

interface UserInterface
{
    public function getAll();
    public function getById($id);
    public function createuser($data);
    public function updateUser($user,$data);
    public function deleteUser($user);
}
