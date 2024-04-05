<?php

use App\Http\Requests\RegisterValidation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

function register(RegisterValidation $request){
    $user = new User();
    $user->fname = $request->fname;
    $user->lname = $request->lname;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->role_id = $request->role;
    $user->password = Hash::make($request->password);
    $user->save();
    return $user;
}

?>