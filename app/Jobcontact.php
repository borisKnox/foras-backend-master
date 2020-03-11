<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobcontact extends Model
{
    protected $table = 'job_contact';
    
    public function job() {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
