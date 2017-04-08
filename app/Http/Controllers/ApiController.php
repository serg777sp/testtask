<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Models\Doc2\User;

class ApiController extends Controller
{
    //
    public function getInfo($name) {
        $user = EntityManager::getRepository(User::class)->findOneBy(['name' => $name]);

        if(!$user) return "User with name - '" . $name . "' not found.";

        return $user->getInfo();
    }
}
