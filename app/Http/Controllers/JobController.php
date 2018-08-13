<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        return view('pages.jobs', ['applications' => $this->get_applications()]);
    }

    public function get_applications() {
        $applications = DB::table('jobs')->where('user_id', Auth::id())->get();
        return $applications->toArray();
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
            'company_name'      => $validatedData->getData()['companyName'],
            'company_url'       => $validatedData->getData()['companyURL'],
            'contact_name'      => $validatedData->getData()['contactName'],
            'contact_email'     => $validatedData->getData()['contactEmail'],
            'role_interest'     => $validatedData->getData()['companyInterest'],
            'application_stage' => $validatedData->getData()['applicationStage'],
            'last_interaction'  => $validatedData->getData()['lastInteraction'],
            'extra_notes'       => $validatedData->getData()['companyNotes'],
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
