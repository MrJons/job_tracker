<?php

namespace App\Http\Controllers;

use App\Job;
use DeepCopy\f007\FooDateTimeZone;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class JobController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('pages.jobs');
    }


    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $validatedData = $this->validate($request, [
            'companyName'      => 'required',
            'companyURL'       => 'URL',
            'contactName'      => 'present',
            'contactEmail'     => 'present|E-Mail',
            'companyInterest'  => 'required',
            'applicationStage' => 'required',
            'lastInteraction'  => 'required',
            'companyNotes'     => 'present'
        ]);

        DB::insert('insert into jobs (user_id, company_name, company_url, contact_name, contact_email, role_interest,
               application_stage, last_interaction, extra_notes, created_at, updated_at)
               values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                   Auth::id(),
                   $validatedData['companyName'],
                   $validatedData['companyURL'],
                   $validatedData['contactName'],
                   $validatedData['contactEmail'],
                   $validatedData['companyInterest'],
                   $validatedData['applicationStage'],
                   $validatedData['lastInteraction'],
                   $validatedData['companyNotes'],
                   now(),
                   now()
                ]);

        return redirect('/jobs');

    }
}
