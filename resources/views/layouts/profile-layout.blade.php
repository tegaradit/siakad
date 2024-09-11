@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Profile</h2>
    
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $dataProfile->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $dataProfile->email }}" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $dataProfile->phone_number }}" required>
        </div>

        <div class="form-group">
            <label for="profile_photo">Profile Photo</label><br>
            @if($dataProfile->profile_photo)
                <img src="{{ asset('storage/' . $dataProfile->profile_photo) }}" alt="Profile Photo" width="150">
            @else
                <img src="{{ asset('default-avatar.png') }}" alt="Profile Photo" width="150">
            @endif
            <input type="file" name="profile_photo" id="profile_photo" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" class="form-control">
            <small>Leave blank if you don't want to change the password</small>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <div class="form-group">
            <label for="request-del-profile">Delete Current Profile Picture?</label>
            <select name="request-del-profile" id="request-del-profile" class="form-control">
                <option value="false">No</option>
                <option value="true">Yes</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
