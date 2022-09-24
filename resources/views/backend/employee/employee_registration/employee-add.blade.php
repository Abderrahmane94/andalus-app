@extends('admin.adminBase')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1><b>إضافة عامل</b></h1>
                <div class="separator mb-5"></div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form method="post" action="{{ route('store.employee.registration') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="add_item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>الاسم <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="last_name" class="form-control"
                                                       required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>اللقب <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="first_name"
                                                       class="form-control"
                                                       required="">
                                            </div>
                                        </div>
                                    </div>
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
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>العنوان <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="address" class="form-control"
                                                       required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>تاريخ الميلاد <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input id="datePicker" name="dob" max="2021-02-01"
                                                       min="2021-01-01" class="form-control datepicker "
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>رقم الهاتف <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="mobile" class="form-control"
                                                       required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                     style="width: 200px; width: 200px; border: 1px solid #000000;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type=button value="أخذ صورة"
                                               onClick="take_snapshot()"
                                               class="btn btn-outline-primary mb-2">
                                        <br/>
                                        <input type="hidden" name="image_captured" class="image-tag">
                                        <div id="my_camera"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="results" class="m-5"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info mb-5" value="إضافة"
                                       style="float: left">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--Script-->

    {{--Take picture from web cam --}}
    <script type="text/javascript">
        Webcam.set({
            width: 490,
            height: 350,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function (data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            });
        }
    </script>

    {{-- Take picture from PC --}}
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
