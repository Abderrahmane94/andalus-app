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
                        <h1 class="box-title"><b>تعديل صف دراسي </b></h1>
                        <div class="separator mb-5"></div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">

                                        <form method="post" action="{{ route('update.student.group',$group->id) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>الاسم <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="name" class="form-control"
                                                                   value="{{ $group->name }}" required>
                                                            <div class="invalid-tooltip">
                                                                مطلوب إدخال الاسم!
                                                            </div>
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
                                                                        value="{{ $subject->id }}" {{ ($group->subject_id == $subject->id)? "selected":"" }}>{{ $subject->name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Col md 4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>الأستاذ(ة) </h5>
                                                        <div class="controls">
                                                            <select name="teacher"
                                                                    class="form-control">
                                                                <option value="" selected="" disabled="">اختر الأستاذ(ة)
                                                                </option>
                                                                @foreach($teachers as $teacher)
                                                                    <option
                                                                        value="{{ $teacher->id }}" {{ ($group->teacher_id == $teacher->id)? "selected":"" }}>{{ $teacher->last_name }}   {{ $teacher->first_name }}</option>
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
                                                                        value="{{ $class->id }}" {{ ($group->class_id == $class->id)? "selected":"" }}>{{ $class->name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Col md 4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>قاعة التدريس </h5>
                                                        <div class="controls">
                                                            <select name="room"
                                                                    class="form-control">
                                                                <option value="" selected="" disabled="">اختر القاعة
                                                                </option>
                                                                @foreach($rooms as $room)
                                                                    <option
                                                                        value="{{ $room->id }}" {{ ($group->classes_id == $room->id)? "selected":"" }}>{{ $room->name }}</option>
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
                                                                <option
                                                                    value="فردي" {{ ($group->group_type == 'فردي')? "selected":"" }}>
                                                                    فردي
                                                                </option>
                                                                <option
                                                                    value="جماعي" {{ ($group->group_type == 'جماعي')? "selected":"" }}>
                                                                    جماعي
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Col md 4 -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>ساعة بدء الدرس </h5>
                                                        <div class="controls">
                                                            <input style="font-size: 20px;" type="time" id="start_time"
                                                                   name="start_time"
                                                                   value="{{$group->start_time}}">
                                                        </div>
                                                    </div>
                                                </div> <!-- End Col md 4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>ساعة انتهاء الدرس </h5>
                                                        <div class="controls">
                                                            <input style="font-size: 20px;" id="end_time" type="time"
                                                                   name="end_time"
                                                                   value="{{$group->end_time}}">

                                                        </div>
                                                    </div>
                                                </div> <!-- End Col md 4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5> يوم الدرس </h5>
                                                        <div class="controls">
                                                            <select name="day"
                                                                    class="form-control" multiple>
                                                                <option
                                                                    value="الأحد" {{ ($group->day == 'الأحد')? "selected":"" }}>
                                                                    الأحد
                                                                </option>
                                                                <option
                                                                    value="الإثنين" {{ ($group->day == 'الإثنين')? "selected":"" }}>
                                                                    الإثنين
                                                                </option>
                                                                <option
                                                                    value="الثلاثاء" {{ ($group->day == 'الثلاثاء')? "selected":"" }}>
                                                                    الثلاثاء
                                                                </option>
                                                                <option
                                                                    value="الأربعاء" {{ ($group->day == 'الأربعاء')? "selected":"" }}>
                                                                    الأربعاء
                                                                </option>
                                                                <option
                                                                    value="الخميس" {{ ($group->day == 'الخميس')? "selected":"" }}>
                                                                    الخميس
                                                                </option>
                                                                <option
                                                                    value="الجمعة" {{ ($group->day == 'الجمعة')? "selected":"" }}>
                                                                    الجمعة
                                                                </option>
                                                                <option
                                                                    value="السبت" {{ ($group->day == 'السبت')? "selected":"" }}>
                                                                    السبت
                                                                </option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div> <!-- End Col md 4 -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>طريقة حساب اشتراك التلاميذ <span
                                                                class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="fee_type_id" id="fee_type_id" required=""
                                                                    class="form-control">
                                                                <option value="" selected="" disabled="">اختر
                                                                    النوع...
                                                                </option>
                                                                <option
                                                                    value="1" {{ ($group->fee_type_id == 1)? "selected":"" }}>
                                                                    شهري
                                                                </option>
                                                                <option
                                                                    value="2" {{ ($group->fee_type_id == 2)? "selected":"" }}>
                                                                    عدد الحصص
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Col md 4 -->
                                                <div class="col-md-4" id="nb_cycle_lesson">
                                                    <div class="form-group">
                                                        <h5>عدد الحصص <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="number" name="nb_cycle_lesson"
                                                                   class="form-control"
                                                                   value="{{ $group->nb_lesson_cycle}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="fix_input">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>المبلغ الثابت </h5>
                                                        <div class="controls">
                                                            <input type="number" name="fix_salary"
                                                                   id="fix_salary"
                                                                   class="form-control" value="{{ $group->fix_salary}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>منحة الأستاذ عن كل تلميذ </h5>
                                                        <div class="controls">
                                                            <input type="number" name="amount_per_student"
                                                                   id="amount_per_student"
                                                                   class="form-control"
                                                                   value="{{ $group->amount_per_student}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-xs-left">
                                                <input type="submit" class="btn btn-rounded btn-info mb-5"
                                                       value="تعديل" id="submit">
                                                <a href="{{ url()->previous() }}"
                                                   class="btn btn-rounded btn-warning mb-5"
                                                >عودة</a>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </div>
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

            // verify input time consistency
            $('#submit').click(function () {
                var startTime = document.getElementById("start_time").value;
                var endTime = document.getElementById("end_time").value;

                if (startTime != "" && startTime >= endTime) {
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

            // type fee input on changes
            $("#fee_type_id").change(function () {
                if ($(this).val() == 2) {
                    $("#nb_cycle_lesson").show();
                    $("#fix_input").hide();
                } else {
                    $("#nb_cycle_lesson").hide();
                    $("#fix_input").show();
                }
            });

            // type fee input on load page
            if ($(fee_type_id).val() == 2) {
                $("#nb_cycle_lesson").show();
                $("#fix_input").hide();
            } else {
                $("#nb_cycle_lesson").hide();
                $("#fix_input").show();
            }
        });


    </script>

@endsection
