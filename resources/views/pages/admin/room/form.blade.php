@extends('layouts.home-layout')

@section('home-content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Tambah Ruangan</h4>
                </div>

                <!-- Form to create a new room -->
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('room.store') }}" method="POST">
                            @csrf

                            <!-- Code field -->
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" name="code" class="form-control" value="{{ old('code') }}"
                                    required>
                                @error('code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Name field -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Floor Position field -->
                            <div class="form-group">
                                <label for="floor_position">Floor Position</label>
                                <input type="number" name="floor_position" class="form-control"
                                    value="{{ old('floor_position') }}" required>
                                @error('floor_position')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Building ID field -->
                            <div class="form-group">
                                <label for="building_id">Building</label>
                                <select name="building_id" class="form-control" required>
                                    <option value="">Select Building</option>
                                    @foreach ($buildings as $building)
                                        <option value="{{ $building->id }}"
                                            {{ old('building_id') == $building->id ? 'selected' : '' }}>
                                            {{ $building->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('building_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Capacity field -->
                            <div class="form-group">
                                <label for="capacity">Capacity</label>
                                <input type="number" name="capacity" class="form-control" value="{{ old('capacity', 1) }}"
                                    required>
                                @error('capacity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection