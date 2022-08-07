@extends('admin.adminBase')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->


            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">تعديل العامل </h4>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">

                                <form method="post" action="{{ route('update.employee.registration',$editData->id) }}"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-12">


                                            <div class="row"> <!-- 1st Row -->

                                                <div class="col-md-4">

                                                    <div class="form-group">
                                                        <h5>اسم العامل <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="last_name" class="form-control"
                                                                   required="" value="{{ $editData['last_name'] }}">
                                                        </div>
                                                    </div>
                                                </div> <!-- End Col md 4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>لقب العامل <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="first_name" class="form-control"
                                                                   required="" value="{{ $editData['first_name'] }}">
                                                        </div>
                                                    </div>
                                                </div> <!-- End Col md 4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>الجنس <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="gender" id="gender" required=""
                                                                    class="form-control">
                                                                <option value="" selected="" disabled="">اختر الجنس
                                                                </option>
                                                                <option
                                                                    value="ذكر" {{ ($editData['gender'] == 'ذكر')? 'selected':'' }}>
                                                                    ذكر
                                                                </option>
                                                                <option
                                                                    value="أنثى" {{ ($editData['gender'] == 'أنثى')? 'selected':'' }}>
                                                                    أنثى
                                                                </option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Col md 4 -->
                                            </div> <!-- End 1stRow -->


                                            <div class="row"> <!-- 2nd Row -->
                                                <div class="col-md-4">

                                                    <div class="form-group">
                                                        <h5>تاريخ الميلاد <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input id="datePicker" name="dob"
                                                                   class="form-control datepicker"
                                                                   required="" autocomplete="off"
                                                                   value="{{ $editData['dob'] }}">
                                                        </div>
                                                    </div>

                                                </div> <!-- End Col md 4 -->
                                                <div class="col-md-4">

                                                    <div class="form-group">
                                                        <h5>رقم الهاتف <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="mobile" class="form-control"
                                                                   required=""
                                                                   value="{{ $editData['mobile'] }}">
                                                        </div>
                                                    </div>

                                                </div> <!-- End Col md 4 -->


                                                <div class="col-md-4">

                                                    <div class="form-group">
                                                        <h5>العنوان <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="address" class="form-control"
                                                                   required=""
                                                                   value="{{ $editData['address'] }}">
                                                        </div>
                                                    </div>

                                                </div> <!-- End Col md 4 -->

                                            </div> <!-- End 2nd Row -->

                                            <div class="row"> <!-- 5TH Row -->
                                                <div class="col-md-4">

                                                    <div class="form-group">
                                                        <h5>نوع العامل <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select id="user_type" class="custom-select" name="user_type" required>
                                                                <option value="Teacher"  {{ ($editData->user_type == 'Employee')? "selected":"" }}>أستاذ</option>
                                                                <option value="Direction" {{ ($editData->user_type == 'Direction')? "selected":"" }}>إدارة</option>
                                                                <option value="Student" {{ ($editData->user_type == 'Student')? "selected":"" }}>تلميذ</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Col md 4 -->
                                                <div class="col-md-4">

                                                    <div class="form-group">
                                                        <h5>الصورة الشخصية <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="file" name="image" class="form-control"
                                                                   id="image"></div>
                                                    </div>

                                                </div> <!-- End Col md 4 -->


                                                <div class="col-md-4">

                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <img id="showImage"
                                                                 src="{{ (!empty($editData['profile_photo_path']))? url($editData['profile_photo_path']):url('upload/no_image.jpg') }}"
                                                                 style="width: 100px; width: 100px; border: 1px solid #000000;">

                                                        </div>
                                                    </div>

                                                </div> <!-- End Col md 4 -->


                                            </div> <!-- End 5TH Row -->


                                            <div class="text-xs-left">
                                                <input type="submit" class="btn btn-rounded btn-info mb-5"
                                                       value="تعديل">
                                                <a href="{{ url()->previous() }}"
                                                   class="btn btn-rounded btn-warning mb-5"
                                                >عودة</a>
                                            </div>
                                </form>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>


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

    <script type="text/javascript">
        $(document).ready(function () {
            $('#datePicker').datepicker({
                orientation: 'bottom',
                startDate: '-70y',
                endDate: '-18y'
            })

        });
    </script>



@endsection
