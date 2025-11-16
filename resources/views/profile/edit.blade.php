@extends('layouts.app')
@section('content')


<div class="container py-4">

    <h4 class="mb-4">Profile</h4>

    <div class="row">

        {{-- Update Profile --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        {{-- Update Password --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <!-- {{-- Delete User --}}
        <div class="col-md-12">
            <div class="card shadow-sm border-danger">
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div> -->

    </div>

</div>

@endsection
