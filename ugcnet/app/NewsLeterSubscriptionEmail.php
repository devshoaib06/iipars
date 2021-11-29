<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsLeterSubscriptionEmail extends Model
{
    protected $table="newsletter_subscription_emails";
    protected $fillable = [
    	'email'
    ];
}
