@extends('layouts.app')
@section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12  profile-box profile-res">
                <div class="form-panel profile-content view-border">
                    <div class="form-group row no-pad">
                        <div class="col-sm-6 col-md-4 tb-space">
                            <label for="email" class="col-form-label text-md-right">{{ __('Employee Id') }}</label>
                        </div>
                        <div class="col-sm-6 col-md-8 tb-space">
                            <label>{{ $employee->id }}</label>
                        </div>
                    </div>
                    <div class="form-group row no-pad">
                        <div class="col-sm-6 col-md-4 tb-space">
                            <label for="email" class="col-form-label text-md-right">{{ __('Employee Name') }}</label>
                        </div>
                        <div class="col-sm-6 col-md-8 tb-space">
                            <label>{{ $employee->name }}</label>
                        </div>
                    </div>
                    <div class="line"></div>
                    <h2>Punch In Histories</h2>
                    <div class="form-group row no-pad">
                        <div class="col-sm-6 col-md-4 tb-space">
                            <label for="email" class="col-form-label text-md-right">{{ __('Punchin Id') }}</label>
                        </div>
                        <div class="col-sm-6 col-md-8 tb-space">
                            <label for="email" class="col-form-label text-md-right">{{ __('Punchin Date Time') }}</label>
                        </div>
                    </div>
                    @if($employee->histories()->count() > 0)
                    @foreach($employee->histories as $histories)
                    <div class="form-group row no-pad">
                        <div class="col-sm-6 col-md-4 tb-space">
                            <label>{{ $histories->id }}</label>
                        </div>
                        <div class="col-sm-6 col-md-8 tb-space">
                            <label>{{ $histories->created_at->format('Y-m-d H:i:s') }}</label>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div class="line"></div>

                    <div class="form-group row no-pad">
                        <div class="col-sm-6 col-md-4 tb-space">
                            <button type="button" class="btn btn-primary" onclick="location.href='{{ route('employee.index') }}';"> Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
