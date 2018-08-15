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
                    <form method="post" action='{{ URL::to('/jobs') }}' class="col-md-10 offset-md-1 text-center" style="margin-top: 10px">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="companyName" value="{{ old('companyName', null) }}" placeholder="Company name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="url" class="form-control" name="companyURL" value="{{ old('companyURL', null) }}" placeholder="Company URL">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="contactName" value="{{ old('contactName', null) }}" placeholder="Contact name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" name="contactEmail" value="{{ old('contactEmail', null) }}" placeholder="Contact email">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <select class="form-control" name="companyInterest">
                                    <option selected disabled>{{ old('companyInterest', 'Interest') }}</option>
                                    @foreach(range(1,10) as $number)
                                        <option {{ old('companyInterest') == $number ? "selected" : '' }}> {{$number}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select class="form-control" name="applicationStage">
                                    <option selected disabled >{{ old('applicationStage', 'Application stage') }}</option>
                                    <option {{ old('applicationStage') == 'Not applied'  ? "selected" : '' }}>Not applied </option>
                                    <option {{ old('applicationStage') == 'Applied'      ? "selected" : '' }}>Applied     </option>
                                    <option {{ old('applicationStage') == 'Tech test'    ? "selected" : '' }}>Tech test   </option>
                                    <option {{ old('applicationStage') == 'interview(s)' ? "selected" : '' }}>interview(s)</option>
                                    <option {{ old('applicationStage') == 'Offer'        ? "selected" : '' }}>Offer       </option>
                                    <option {{ old('applicationStage') == 'Accepted!'    ? "selected" : '' }}>Accepted!   </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="date" class="form-control" name="lastInteraction" value="{{ old('lastInteraction', null) }}" placeholder="Last interaction" data-toggle="tooltip" data-placement="right">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea class="form-control" name="companyNotes" rows="5" placeholder="Extra Notes">{{ old('companyNotes') }}</textarea>
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

            <table class="table" >
                <thead class="thead-light">
                <tr>
                    <th scope="col">Company Name</th>
                    <th scope="col">Company URL</th>
                    <th scope="col">Contact Name</th>
                    <th scope="col">Contact Email</th>
                    <th scope="col">Role Interest</th>
                    <th scope="col">Application Stage</th>
                    <th scope="col">Last Interaction</th>
                </tr>
                </thead>
                <tbody>
                @foreach($applications as $application)
                    <tr>
                        <th scope="row">{{$application->company_name}}</th>
                        <td>{{$application->company_url}}</td>
                        <td>{{$application->contact_name}}</td>
                        <td>{{$application->contact_email}}</td>
                        <td>{{$application->role_interest}}</td>
                        <td>{{$application->application_stage}}</td>
                        <td>{{$application->last_interaction}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

    </div>

    <div>

    </div>
@endsection