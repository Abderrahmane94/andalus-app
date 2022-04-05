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
                        <h2 class="box-title">إضافة عامل</h2>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">

                                <form method="post" action="{{ route('store.employee.registration') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="add_item">


                                                <div class="row"> <!-- 1st Row -->

                                                    <div class="col-md-4">

                                                        <div class="form-group">
                                                            <h5>الاسم <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="last_name" class="form-control"
                                                                       required="">
                                                            </div>
                                                        </div>

                                                    </div> <!-- End Col md 4 -->

                                                    <div class="col-md-4">

                                                        <div class="form-group">
                                                            <h5>اللقب <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="first_name"
                                                                       class="form-control"
                                                                       required="">
                                                            </div>
                                                        </div>

                                                    </div> <!-- End Col md 4 -->

                                                    <div class="col-md-4">

                                                        <div class="form-group">
                                                            <h5>الجنس <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="gender" id="gender" required=""
                                                                        class="form-control">
                                                                    <option value="" selected="" disabled="">اختر
                                                                        الجنس...
                                                                    </option>
                                                                    <option value="ذكر">ذكر</option>
                                                                    <option value="أنثى">أنثى</option>

                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div> <!-- End Col md 4 -->


                                                </div> <!-- End 1stRow -->


                                                <div class="row"> <!-- 2nd Row -->
                                                    <div class="col-md-4">

                                                        <div class="form-group">
                                                            <h5>العنوان <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="address" class="form-control"
                                                                       required="">
                                                            </div>
                                                        </div>

                                                    </div> <!-- End Col md 4 -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <h5>تاريخ الميلاد <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input id="datePicker" name="dob" max="2021-02-01"
                                                                       min="2021-01-01" class="form-control datepicker "
                                                                       required>
                                                            </div>
                                                        </div>

                                                    </div> <!-- End Col md 4 -->
                                                    <div class="col-md-4">

                                                        <div class="form-group">
                                                            <h5>رقم الهاتف <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="mobile" class="form-control"
                                                                       required="">
                                                            </div>
                                                        </div>

                                                    </div> <!-- End Col md 4 -->

                                                </div> <!-- End 2nd Row -->
                                                <div class="row"> <!-- 5TH Row -->

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
                                                                     src="{{ url('upload/no_image.jpg') }}"
                                                                     style="width: 100px; width: 100px; border: 1px solid #000000;">

                                                            </div>
                                                        </div>

                                                    </div> <!-- End Col md 4 -->


                                                </div> <!-- End 5TH Row -->


                                            </div>    <!-- // End add_item -->


                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-info mb-5" value="إضافة"
                                                       style="float: left">
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



    <!--Script-->

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
