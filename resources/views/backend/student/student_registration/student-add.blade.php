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
                        <h1 class="box-title"><b>إضافة تلميذ</b></h1>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">

                                <form method="post" action="{{ route('store.student.registration') }}"
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
                                                                <input type="text" name="first_name" class="form-control"
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
                                                            <h5>اسم الأم </h5>
                                                            <div class="controls">
                                                                <input type="text" name="mother_name" class="form-control"
                                                                       >
                                                            </div>
                                                        </div>

                                                    </div> <!-- End Col md 4 -->

                                                    <div class="col-md-4">

                                                        <div class="form-group">
                                                            <h5>اسم الأب </h5>
                                                            <div class="controls">
                                                                <input type="text" name="father_name" class="form-control"
                                                                       >
                                                            </div>
                                                        </div>

                                                    </div> <!-- End Col md 4 -->

                                                    <div class="col-md-4">

                                                        <div class="form-group">
                                                            <h5>العنوان </h5>
                                                            <div class="controls">
                                                                <input type="text" name="address" class="form-control"
                                                                       >
                                                            </div>
                                                        </div>

                                                    </div> <!-- End Col md 4 -->

                                                </div> <!-- End 2nd Row -->


                                                <div class="row"> <!-- 3rd Row -->
                                                    <div class="col-md-4">

                                                        <div class="form-group">
                                                            <h5>تاريخ الميلاد <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input  name="dob" class="form-control datepicker"
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


                                                    <div class="col-md-4">

                                                        <div class="form-group">
                                                            <h5>التخفيض </h5>
                                                            <div class="controls">
                                                                <input type="text" name="discount" class="form-control"
                                                                       >
                                                            </div>
                                                        </div>

                                                    </div> <!-- End Col md 4 -->


                                                </div> <!-- End 3rd Row -->


                                                <div class="row"> <!-- 4TH Row -->


                                                    <div class="col-md-4">

                                                        <div class="form-group">
                                                            <h5>السنة الدراسية <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="year_id" required="" class="form-control">
                                                                    <option value="" selected="" disabled="">اختر
                                                                        السنة...
                                                                    </option>
                                                                    @foreach($years as $year)
                                                                        <option
                                                                            value="{{ $year->id }}">{{ $year->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div> <!-- End Col md 4 -->


                                                    <div class="col-md-4">

                                                        <div class="form-group">
                                                            <h5>فئة الطلبة <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="class_id" required=""
                                                                        class="form-control">
                                                                    <option value="" selected="" disabled="">اختر الفئة
                                                                    </option>
                                                                    @foreach($classes as $class)
                                                                        <option
                                                                            value="{{ $class->id }}">{{ $class->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div> <!-- End Col md 4 -->

                                                </div> <!-- End 4TH Row -->


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


                                                {{--<div class="row">

                                                    <div class="col-md-5">

                                                        <div class="form-group">
                                                            <h5>الصفوف الدراسية <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="group_id[]"
                                                                        class="form-control">
                                                                    <option value="" selected="" disabled="">اختر الصف الدراسي...</option>
                                                                    @foreach($groups as $group)
                                                                        <option
                                                                            value="{{ $group->id }}">{{ $group->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div> <!-- // end form group -->


                                                    </div> <!-- End col-md-5 -->

                                                    <div class="col-md-2" style="padding-top: 25px;">
                                                    <span class="btn btn-success addeventmore"><i
                                                            class="fa fa-plus-circle"></i> </span>
                                                    </div><!-- End col-md-5 -->

                                                </div> <!-- end Row -->--}}
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

    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">

                    <div class="col-md-5">

                        <div class="form-group">
                            <h5>الصفوف الدراسية <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="group_id[]" required="" class="form-control">
                                    <option value="" selected="" disabled="">اختر الصف الدراسي...</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> <!-- // end form group -->
                    </div> <!-- End col-md-5 -->

                    <div class="col-md-2" style="padding-top: 25px;">
                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>
                    </div><!-- End col-md-2 -->


                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            var counter = 0;
            $(document).on("click", ".addeventmore", function () {
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", '.removeeventmore', function (event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1
            });

        });
    </script>

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
