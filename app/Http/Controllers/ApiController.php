<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Models\Doc2\User;
use Cache;

class ApiController extends Controller
{
    //
    public function getInfo($name) {

        if(Cache::has('info_'. $name)){
            return Cache::get('info_'. $name);
        } else {
            $user = EntityManager::getRepository(User::class)->findOneBy(['name' => $name]);
            if(!$user) return "User with name - '" . $name . "' not found.";

            Cache::add('info_'.$name, $user->getInfo(), 1);
            return $user->getInfo();
        }
    }
}
