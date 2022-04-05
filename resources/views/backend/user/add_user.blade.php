@extends('admin.adminBase')

@section('admin')


    <div class="col-12">
        <h5 class="mb-4">{{__('Information Utilisateur')}}</h5>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4">Basic</h5>
                <form class="needs-validation tooltip-label-right" novalidate="novalidate" method="post"
                      action="{{ route('users.store') }}">
                    @csrf

                    <div class="form-group position-relative error-l-50">
                        <label>Name</label><span class="text-danger">*</span>
                        <input type="text" name="name" class="form-control" required="">
                        <div class="invalid-tooltip">
                            {{__('Name is required')}}
                        </div>
                    </div>

                    <div class="form-group position-relative error-l-50">
                        <label>E-mail</label><span class="text-danger">*</span>
                        <input type="email" name="email" class="form-control" required="">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="invalid-tooltip">
                            {{__('email is required')}}
                        </div>
                    </div>

                    <div class="form-group position-relative error-l-50">
                        <label>Password</label><span class="text-danger">*</span>
                        <input type="password" name="password" class="form-control" required="">
                        <div class="invalid-tooltip">
                            {{__('email is required')}}
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary mb-0" value="{{__('Submit')}}">
                </form>
            </div>
        </div>
    </div>













@endsection
