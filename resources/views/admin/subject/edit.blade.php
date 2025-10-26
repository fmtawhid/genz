@extends('layouts.admin_master')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="page-title">Edit Subject</h4>
                    <form id="editSubjectForm" method="POST" action="{{ route('subjects.update', $subject->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Subject Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Subject Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $subject->name) }}" required>
                            @error('name')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Class (Sreni) -->
                        <div class="mb-3">
                            <label for="sreni_id" class="form-label">Class (Sreni)</label>
                            <select class="form-control" id="sreni_id" name="sreni_id" required>
                                <option value="">Select Class</option>
                                @foreach ($srenis as $sreni)
                                    <option value="{{ $sreni->id }}" {{ $subject->sreni_id == $sreni->id ? 'selected' : '' }}>
                                        {{ $sreni->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sreni_id')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bibag Dropdown -->
                        <div class="mb-3">
                            <label for="bibag_id" class="form-label">Bibag</label>
                            <select class="form-control" id="bibag_id" name="bibag_id" required>
                                <option value="">Select Bibag</option>
                                @foreach ($bibags as $bibag)
                                    <option value="{{ $bibag->id }}" {{ $subject->bibag_id == $bibag->id ? 'selected' : '' }}>
                                        {{ $bibag->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bibag_id')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success">Update Subject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    </script>
@endsection
