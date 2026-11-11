<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Mail\GenericFormSubmissionMail;
use Illuminate\Support\Facades\Mail;

class Query extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'message'
    ];

    protected static function booted()
{
    static::created(function ($model) {
        Mail::to('info@odishavoyages.co.in')->send(
            new GenericFormSubmissionMail($model->toArray(), 'New Enquiry Submission')
        );
    });
}
}
