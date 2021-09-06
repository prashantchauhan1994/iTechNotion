@extends('layouts.app')
@section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="frmEmployee" method="post" action="{{ route('employee.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Employee</label>
                                <div class="col-sm-8">
                                    <select id="employee_id" name="employee_id" class="form-control">
                                        <option value="">Select</option>
                                        @if($employees->count() > 0)
                                        @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('employee_id')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-3">
                                    <button type="submit" class="btn btn-primary">Punch In</button>
                                </div>
                            </div>
                        </form>
                        <!-- <table class="table text-center" id="data-table">
                            <thead>
                                <th>Id</th>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Punch In Date</th>
                                <th>Punch In Time</th>
                                <th>Punch Out Date</th>
                                <th>Punch Out Time</th>
                                <th>Actions</th>
                            </thead>
                        </table> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script src="{{ asset('js/pages/employee.js')}}"></script>
@endsection
