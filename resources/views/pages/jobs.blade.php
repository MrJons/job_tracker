@extends('layouts.app')

@section('content')
    <div class="container">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newApplicationModal">
            New application
        </button>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="modal fade" id="newApplicationModal" tabindex="-1" role="dialog" aria-labelledby="newApplicationModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="post" action='{{ URL::to('/{user}/jobs') }}' class="col-md-10 offset-md-1 text-center" style="margin-top: 10px">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="company_name" value="{{ old('company_name', null) }}" placeholder="Company name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="url" class="form-control" name="company_url" value="{{ old('company_url', null) }}" placeholder="Company URL">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="contact_name" value="{{ old('contact_name', null) }}" placeholder="Contact name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" name="contact_email" value="{{ old('contact_email', null) }}" placeholder="Contact email">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <select class="form-control" name="role_interest">
                                    <option selected disabled>{{ old('role_interest', 'Interest') }}</option>
                                    @foreach(range(1,10) as $number)
                                        <option {{ old('role_interest') == $number ? "selected" : '' }}> {{$number}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select class="form-control" name="application_stage">
                                    <option selected disabled >{{ old('application_stage', 'Application stage') }}</option>
                                    <option {{ old('application_stage') == 'Not applied'  ? "selected" : '' }}>Not applied </option>
                                    <option {{ old('application_stage') == 'Applied'      ? "selected" : '' }}>Applied     </option>
                                    <option {{ old('application_stage') == 'Tech test'    ? "selected" : '' }}>Tech test   </option>
                                    <option {{ old('application_stage') == 'interview(s)' ? "selected" : '' }}>interview(s)</option>
                                    <option {{ old('application_stage') == 'Offer'        ? "selected" : '' }}>Offer       </option>
                                    <option {{ old('application_stage') == 'Accepted!'    ? "selected" : '' }}>Accepted!   </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="date" class="form-control" name="last_interaction" value="{{ old('last_interaction', null) }}" placeholder="Last interaction" data-toggle="tooltip" data-placement="right">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea class="form-control" name="extra_notes" rows="5" placeholder="Extra Notes">{{ old('extra_notes') }}</textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary col-md-12" id="submitApplicationRecord">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        @if($applications && count($applications) > 0)
            <div class="row">
                @foreach($applications as $application)
                    <div class="col-md-6">
                        <div class="card text-center" style="margin-top: 5%">
                            <div class="card-header">
                                <span class="badge badge-primary float-left">Interest: {{$application->role_interest}}</span>
                                <a href="{{$application->company_url}}" style="margin-left: -11%"> {{$application->company_name}} </a>
                            </div>
                            <div class="card-body">
                                Contact: <a href="mailto:{{$application->contact_email}}"> {{$application->contact_name ?? 'Not provided'}} </a>
                                <div>
                                    Application Stage: {{$application->application_stage}}
                                </div>
                                <div>
                                    <a class="text-dark font-weight-bold" data-toggle="collapse" href="#extranotes-{{$application->id}}" role="button" aria-expanded="false" aria-controls="extranotes-{{$application->id}}">
                                        View application notes
                                    </a>
                                </div>
                                <div class="collapse" id="extranotes-{{$application->id}}">
                                    <div>
                                        {{$application->extra_notes}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                Last interaction: {{$application->last_interaction}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else

            <div class="text-center font-weight-light" style="margin-top: 150px; font-size: 35px;">
                You currently have no open applications
            </div>
        @endif

    </div>

@endsection