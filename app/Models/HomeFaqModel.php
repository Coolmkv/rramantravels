<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeFaqModel extends Model
{
    use HasFactory;
    protected $table = "home_faq";
    protected $fillable = ['id','faq_question','faq_answer','created_at'];
}
