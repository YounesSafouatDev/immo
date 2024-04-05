<?php

use App\Mail\Contact;
use App\Mail\RecoveryPassword;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;

function send ($email,$link,$nomComplet){
    Mail::to($email)->send(new VerifyEmail($link,$nomComplet));
}

function recovery($email,$password,$nomComplet){
    Mail::to($email)->send(new RecoveryPassword($password,$nomComplet));
}

function contactezNous($nomComplet,$sujet,$telephone,$email,$message){
    Mail::to('hi@gmail.com')->send(new Contact($nomComplet,$sujet,$telephone,$email,$message));
}

?>