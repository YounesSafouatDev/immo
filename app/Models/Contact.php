<?php

namespace App\Models;

use App\Mail\Contact as MailContact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    public $fillable = ['name', 'email', 'phone', 'subject', 'message'];

    public static function boot() {
        parent::boot();

        static::created(function ($item) {
            $adminEmail = "your_admin_email@gmail.com";
            Mail::to($adminEmail)->send(new MailContact($item));
        });
    }
}
