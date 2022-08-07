@extends('admin.adminBase')

@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="col-12">
        <h5 class="mb-4">{{__('تعديل المستخدم')}}</h5>

        <div class="card mb-4">
            <div class="card-body">
                <form class="needs-validation tooltip-label-right" novalidate="novalidate" method="post"
                      action="{{ route('users.update',$editData->id) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group position-relative error-l-50">
                        <label>الاسم</label><span class="text-danger">*</span>
                        <input type="text" name="first_name" class="form-control" value="{{ $editData->first_name }}"
                               required="">
                        <div class="invalid-tooltip">
                            {{__('يجب إدخال الاسم')}}
                        </div>

                    </div>
                    <div class="form-group position-relative error-l-50">
                        <label>اللقب</label><span class="text-danger">*</span>
                        <input type="text" name="last_name" class="form-control" value="{{ $editData->last_name }}"
                               required="">
                        <div class="invalid-tooltip">
                            {{__('يجب إدخال اللقب')}}
                        </div>

                    </div>

                    <div class="form-group position-relative error-l-50">
                        <label>البريد الإلكتروني</label><span class="text-danger">*</span>
                        <input type="email" name="email" class="form-control" value=" {{ $editData->email }}"
                               required="">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="invalid-tooltip">
                            {{__('يجب إدخال البريد الإلكتروني')}}
                        </div>
                    </div>

                    <div class="form-group position-relative error-l-50">
                        <label>نوع المستخدم</label>
                        <select id="user_type" class="custom-select" name="user_type" required>
                            <option value="Teacher"  {{ ($editData->user_type == 'Employee')? "selected":"" }}>أستاذ</option>
                            <option value="Direction" {{ ($editData->user_type == 'Direction')? "selected":"" }}>إدارة</option>
                            <option value="Student" {{ ($editData->user_type == 'Student')? "selected":"" }}>تلميذ</option>
                        </select>
                    </div>

                    <div class="form-group position-relative error-l-50">
                        <label>الصورة الشخصية</label><span class="text-danger">*</span>
                        <div class="controls">
                            <input type="file" name="image" class="form-control" id="image"></div>
                    </div>

                    <div class="form-group position-relative error-l-50">
                        <div class="controls">
                            <img id="showImage"
                                 src="{{ (!empty($editData->profile_photo_path))? $editData->profile_photo_path:asset('img/profiles/no image.png') }}"
                                 style="width: 100px; width: 100px; border: 1px solid #000000;">

                        </div>
                    </div>


                    <input type="submit" class="btn btn-primary mb-0" style="float: left" value="{{__('تعديل')}}">

                </form>
            </div>
        </div>
    </div>







    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>





@endsection

