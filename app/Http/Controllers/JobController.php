<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = \auth()->user()->jobs;
        return view('pages.jobs', compact('applications'));
    }

    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name'      => 'Required',
            'company_url'       => 'Nullable|URL',
            'contact_name'      => 'Nullable',
            'contact_email'     => 'Nullable|E-Mail',
            'role_interest'     => 'Required',
            'application_stage' => 'Required',
            'last_interaction'  => 'Required',
            'extra_notes'       => 'Present'
        ]);

        if ($validator->fails()) {
            return redirect('/{user}/jobs')
                ->withErrors($validator)
                ->withInput($request->toArray());
        }

        Job::create(array_merge($validator->attributes(), ['user_id' => \auth()->id()]));

        return redirect('/{user}/jobs');
    }

}
