<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    protected $table = 'contact_forms';

    protected $fillable = ['f_name', 'email', 'mobile_number', 'postcode', 'subject', 'message','user_type','l_phone'];
}
