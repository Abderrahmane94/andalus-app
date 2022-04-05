@extends('doreViews.admin.adminBase')

@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="col-12">
        <h5 class="mb-4">{{__('Change Password')}}</h5>

        <div class="card mb-4">
            <div class="card-body">
                <form class="needs-validation tooltip-label-right" novalidate="novalidate" method="post"
                      action="{{ route('password.update') }}">
                    @csrf

                    <div class="form-group">
                        <h5>Current Password <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="password" name="oldpassword" id="current_password"
                                   class="form-control">
                            @error('oldpassword')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>


                    <div class="form-group">
                        <h5>New Password <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="password" name="password" id="password"
                                   class="form-control">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group">
                        <h5>Confirm Password <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="password" name="password_confirmation"
                                   id="password_confirmation" class="form-control">
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                    </div>


                    <input type="submit" class="btn btn-primary mb-0" value="{{__('Submit')}}">

                </form>
            </div>
        </div>
    </div>








@endsection
