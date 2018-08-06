<?php

namespace App\Http\Controllers;

use App\Job;
use DeepCopy\f007\FooDateTimeZone;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

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
        $validatedData = $this->validateJobsForm($request);

        if ($validatedData->fails()) {
            return redirect('/jobs')
                ->withErrors($validatedData)
                ->withInput($request->toArray());
        }

        DB::table('jobs')->insert([
            'user_id'           => Auth::id(),
            'company_name'      => $validatedData['companyName'],
            'company_url'       => $validatedData['companyURL'],
            'contact_name'      => $validatedData['contactName'],
            'contact_email'     => $validatedData['contactEmail'],
            'role_interest'     => $validatedData['companyInterest'],
            'application_stage' => $validatedData['applicationStage'],
            'last_interaction'  => $validatedData['lastInteraction'],
            'extra_notes'       => $validatedData['companyNotes'],
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        return redirect('/jobs');

    }


    public function validateJobsForm($request) {
        $validator = Validator::make($request->all(), [
            'companyName'      => 'Required',
            'companyURL'       => 'Nullable|URL',
            'contactName'      => 'Nullable',
            'contactEmail'     => 'Nullable|E-Mail',
            'companyInterest'  => 'Required',
            'applicationStage' => 'Required',
            'lastInteraction'  => 'Required',
            'companyNotes'     => 'Present'
        ]);

        return $validator;
    }
}
