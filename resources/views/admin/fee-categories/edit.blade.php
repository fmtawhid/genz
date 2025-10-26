@extends('layouts.admin_master')

@section('content')
    <div class="row">
        <div class="col-12">
            <h4>Edit Fee Category</h4>
            <form action="{{ route('fee-categories.update', $feeCategory->id) }}" method="POST">
                @csrf
                @method('PUT')  <!-- To indicate that this is an UPDATE request -->
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" id="category_name" name="category_name" class="form-control" value="{{ old('category_name', $feeCategory->category_name) }}" required>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" id="amount" name="amount" class="form-control" value="{{ old('amount', $feeCategory->amount) }}" required>
                </div>
                <div class="form-group">
                    <label for="is_recurring">Fee Type</label><br>
                    <!-- Radio buttons for selecting Monthly or Yearly -->
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_recurring" id="monthly" value="0" {{ old('is_recurring', $feeCategory->is_recurring) === 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="monthly">Monthly</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_recurring" id="yearly" value="1" {{ old('is_recurring', $feeCategory->is_recurring) === 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="yearly">Yearly</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sreni_id">Sreni</label>
                    <select id="sreni_id" name="sreni_id" class="form-control">
                        @foreach($srenis as $sreni)
                            <option value="{{ $sreni->id }}" {{ old('sreni_id', $feeCategory->sreni_id) == $sreni->id ? 'selected' : '' }}>{{ $sreni->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="bibag_id">Bibag</label>
                    <select id="bibag_id" name="bibag_id" class="form-control">
                        @foreach($bibags as $bibag)
                            <option value="{{ $bibag->id }}" {{ old('bibag_id', $feeCategory->bibag_id) == $bibag->id ? 'selected' : '' }}>{{ $bibag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
