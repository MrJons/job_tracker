@extends('layouts.app')

@section('content')
    <div class="container">

        <form class="col-md-8 offset-md-2 text-center">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="companyName" placeholder="Company name">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <select class="form-control" id="companyInterest">
                        <option value="" selected disabled>Interest</option>
                        @foreach(range(1,10) as $number)
                            <option> {{$number}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <select class="form-control" id="applicationStage">
                        <option value="" selected disabled>Application stage</option>
                        <option>Not applied</option>
                        <option>Applied</option>
                        <option>Tech test</option>
                        <option>interview(s)</option>
                        <option>Offer</option>
                        <option>Accepted!</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <input type="date" class="form-control" id="lastInteraction" placeholder="Last interaction" data-toggle="tooltip" data-placement="right">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="contactName" placeholder="Contact name">
                </div>
                <div class="form-group col-md-6">
                    <input type="email" class="form-control" id="contactEmail" placeholder="Contact email">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="url" class="form-control" id="companyURL" placeholder="Company URL">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <textarea class="form-control" id="companyNotes" rows="5" placeholder="Extra Notes"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary col-md-12" id="submitApplicationRecord">Submit</button>
                </div>
            </div>

        </form>

    </div>
@endsection