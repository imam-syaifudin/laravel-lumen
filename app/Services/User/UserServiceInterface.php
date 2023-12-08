<?php

namespace App\Services\User;

interface UserServiceInterface
{
    public function index();
    public function show($id);
    public function update($id, $data);
    public function delete($id);
}
