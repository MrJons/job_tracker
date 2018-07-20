<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'company_url',
        'contact_name',
        'contact_email',
        'role_interest',
        'application_stage',
        'last_interaction',
        'extra_notes'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];

}
