@extends('doreViews.admin.adminBase')

@section('admin')


    <div class="col-12">
        <h5 class="mb-4">{{__('Information Utilisateur')}}</h5>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4">Basic</h5>


                <form class="needs-validation tooltip-label-right" novalidate="novalidate" method="post"
                      action="{{ route('profile.edit') }}">
                    @csrf
                    <a  class="lightbox">
                        <img alt="Profile" src="{{ (!empty($user->profile_photo_path))? $user->profile_photo_path:asset('img/profiles/no image.png') }} " class="img-thumbnail card-img social-profile-img">
                    </a>
                    <div class="form-group position-relative error-l-50">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                               disabled="true">

                    </div>

                    <div class="form-group position-relative error-l-50">
                        <label>E-mail</label>
                        <input type="email" name="email" class="form-control" value=" {{ $user->email }}"
                               disabled="true">

                    </div>


                    <a href="{{ route('profile.edit') }}" style="float: left;"
                       class="btn btn-primary mb-0">{{__('Edit Profile')}}</a>

                </form>
            </div>
        </div>
    </div>






@endsection
