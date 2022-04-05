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
                        <h2 class="box-title"><b>إضافة صف دراسي </b></h2>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">

                                <form method="post" action="{{ route('store.student.group') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>الاسم <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>المادة <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subject" required=""
                                                            class="form-control">
                                                        <option value="" selected="" disabled="">اختر المادة
                                                        </option>
                                                        @foreach($subjects as $subject)
                                                            <option
                                                                value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>الأستاذ(ة) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="teacher" required=""
                                                            class="form-control">
                                                        <option value="" selected="" disabled="">اختر الأستاذ(ة)
                                                        </option>
                                                        @foreach($teachers as $teacher)
                                                            <option
                                                                value="{{ $teacher->id }}">{{ $teacher->last_name }}   {{ $teacher->first_name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>فئة الطلبة <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="class" required=""
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>قاعة التدريس <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="room" required=""
                                                            class="form-control">
                                                        <option value="" selected="" disabled="">اختر القاعة
                                                        </option>
                                                        @foreach($rooms as $room)
                                                            <option
                                                                value="{{ $room->id }}">{{ $room->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>نوع الصف الدراسي <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="group_type" id="group_type" required=""
                                                            class="form-control">
                                                        <option value="" selected="" disabled="">اختر
                                                            نوع الصف...
                                                        </option>
                                                        <option value="فردي">فردي</option>
                                                        <option value="جماعي">جماعي</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                    <h5>ساعة بدء الدرس <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input style="font-size: 20px;" type="time" id="start_time" name="start_time"
                                                               required>
                                                    </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>ساعة انتهاء الدرس <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input style="font-size: 20px;" id="end_time" type="time" name="end_time"
                                                           required>

                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5> يوم الدرس <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="day"  required
                                                            class="form-control" multiple>
                                                        <option value="الأحد">الأحد</option>
                                                        <option value="الإثنين">الإثنين</option>
                                                        <option value="الثلاثاء">الثلاثاء</option>
                                                        <option value="الأربعاء">الأربعاء</option>
                                                        <option value="الخميس">الخميس</option>
                                                        <option value="الجمعة">الجمعة</option>
                                                        <option value="السبت">السبت</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>طريقة حساب الاشتراك <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="fee_type_id" id="fee_type_id" required=""
                                                            class="form-control">
                                                        <option value="" selected="" disabled="">اختر
                                                            النوع...
                                                        </option>
                                                        <option value="1">شهري</option>
                                                        <option value="2">عدد الحصص</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->

                                    </div>

                                    <div class="text-xs-left">
                                        <input type="submit" class="btn btn-rounded btn-info mb-5"
                                               value="إضافة" id="submit">
                                        <a href="{{ url()->previous() }}" class="btn btn-rounded btn-warning mb-5"
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
            $('#submit').click(function () {
                var startTime = document.getElementById("start_time").value;
                var endTime = document.getElementById("end_time").value;

                if (startTime >= endTime) {
                    Swal.fire({
                        title: 'لا يمكن لوقت انتهاء الدرس أن يسبق وقت البدء!',
                        icon: 'warning',
                        iconHtml: '!',
                        confirmButtonText: 'عودة',
                        cancelButtonText: 'لا',
                        showCancelButton: false,
                        showCloseButton: true
                    })
                    return false;
                }

            });
        });


    </script>

@endsection
