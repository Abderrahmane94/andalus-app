@extends('admin.adminBase')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title"><b>إضافة صف دراسي </b></h1>
                        <div class="separator mb-5"></div>
                    </div>
                    <div class="box-body">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <form method="post" action="{{ route('store.student.group') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>فئة الطلبة <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="class" required
                                                                    oninvalid="this.setCustomValidity('خانة إجبارية')"
                                                                    oninput="this.setCustomValidity('')"
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
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>المادة <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="subject" required
                                                                    oninvalid="this.setCustomValidity('خانة إجبارية')"
                                                                    oninput="this.setCustomValidity('')"
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
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>الأستاذ(ة) </h5>
                                                        <div class="controls">
                                                            <select name="teacher"
                                                                    oninvalid="this.setCustomValidity('خانة إجبارية')"
                                                                    oninput="this.setCustomValidity('')"
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
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>نوع الصف الدراسي <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="group_type" id="group_type" required
                                                                    oninvalid="this.setCustomValidity('خانة إجبارية')"
                                                                    oninput="this.setCustomValidity('')"
                                                                    class="form-control">
                                                                <option value="" selected="" disabled="">اختر
                                                                    نوع الصف...
                                                                </option>
                                                                <option value="فردي">فردي</option>
                                                                <option value="جماعي" selected="">جماعي</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add_item">
                                                <div class="row">
                                                    <div class="col-md-4" id="group_date_input">
                                                        <div class="form-group">
                                                            <h5> يوم الدرس </h5>
                                                            <div class="controls">
                                                                <select name="group_date_input[]"
                                                                        class="form-control select2-single"
                                                                        data-width="100%"
                                                                        oninvalid="this.setCustomValidity('خانة إجبارية')"
                                                                        oninput="this.setCustomValidity('')">
                                                                    <option value="" selected="" disabled="">اختر يوم من
                                                                        أيام الأسبوع
                                                                    </option>
                                                                    <option value="0">الأحد</option>
                                                                    <option value="1">الإثنين</option>
                                                                    <option value="2">الثلاثاء</option>
                                                                    <option value="3">الأربعاء</option>
                                                                    <option value="4">الخميس</option>
                                                                    <option value="5">الجمعة</option>
                                                                    <option value="6">السبت</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" id="alone_date_input">
                                                        <div class="form-group">
                                                            <h5> يوم الدرس </h5>
                                                            <input class="form-control"
                                                                   name="alone_date_input" type="date"
                                                                   placeholder="اختر تاريخ الحصة">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <h5>قاعة التدريس </h5>
                                                            <div class="controls">
                                                                <select name="room[]"
                                                                        oninvalid="this.setCustomValidity('خانة إجبارية')"
                                                                        oninput="this.setCustomValidity('')"
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
                                                    </div>
                                                    <div class="col-md-4 row">
                                                        <div class="form-group pr-3">
                                                            <h5>ساعة بدء الدرس </h5>
                                                            <div class="controls">
                                                                <input style="font-size: 20px;" type="time"
                                                                       id="start_time"
                                                                       name="start_time[]"
                                                                       oninvalid="this.setCustomValidity('خانة إجبارية')"
                                                                       oninput="this.setCustomValidity('')">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <h5>ساعة انتهاء الدرس </h5>
                                                            <div class="controls">
                                                                <input style="font-size: 20px;" id="end_time"
                                                                       type="time"
                                                                       name="end_time[]"
                                                                       oninvalid="this.setCustomValidity('خانة إجبارية')"
                                                                       oninput="this.setCustomValidity('')">
                                                            </div>
                                                        </div>
                                                        <div style="padding-top: 25px;">
                                                        <span class="btn btn-success addeventmore" id="add_more_item"><i
                                                                class="fa fa-plus-circle"></i> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>طريقة حساب اشتراك التلاميذ <span
                                                                class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="fee_type_id" id="fee_type_id" required
                                                                    oninvalid="this.setCustomValidity('خانة إجبارية')"
                                                                    oninput="this.setCustomValidity('')"
                                                                    class="form-control">
                                                                <option value="" disabled="">اختر
                                                                    النوع...
                                                                </option>
                                                                <option value="2" selected="">عدد الحصص</option>
                                                                <option value="1">شهري</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="nb_cycle_lesson">
                                                    <div class="form-group">
                                                        <h5>عدد الحصص <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="number" name="nb_cycle_lesson"
                                                                   class="form-control" value="4">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="fix_input">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>منحة الأستاذ الثابتة </h5>
                                                        <div class="controls">
                                                            <input type="number" name="fix_salary"
                                                                   id="fix_salary"
                                                                   class="form-control" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>منحة الأستاذ عن كل تلميذ </h5>
                                                        <div class="controls">
                                                            <input type="number" name="amount_per_student"
                                                                   id="amount_per_student"
                                                                   class="form-control" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-xs-left">
                                                <input type="submit" class="btn btn-rounded btn-info mb-5"
                                                       value="إضافة" id="submit">
                                                <a href="{{ url()->previous() }}"
                                                   class="btn btn-rounded btn-warning mb-5"
                                                >عودة</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="row">
                    <div class="col-md-4" id="group_date_input">
                        <div class="form-group">
                            <h5> يوم الدرس </h5>
                            <div class="controls">
                                <select name="group_date_input[]"
                                        class="form-control" style="width: 100%"
                                        oninvalid="this.setCustomValidity('خانة إجبارية')"
                                        oninput="this.setCustomValidity('')">
                                    <option value="" selected="" disabled="">اختر يوم من
                                        أيام الأسبوع
                                    </option>
                                    <option value="1">الأحد</option>
                                    <option value="2">الإثنين</option>
                                    <option value="3">الثلاثاء</option>
                                    <option value="4">الأربعاء</option>
                                    <option value="5">الخميس</option>
                                    <option value="6">الجمعة</option>
                                    <option value="7">السبت</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>قاعة التدريس </h5>
                            <div class="controls">
                                <select name="room[]" style="width: 100%"
                                        oninvalid="this.setCustomValidity('خانة إجبارية')"
                                        oninput="this.setCustomValidity('')"
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
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="form-group pr-3">
                                <h5>ساعة بدء الدرس </h5>
                                <div class="controls">
                                    <input style="font-size: 20px;" type="time"
                                           id="start_time"
                                           name="start_time[]"
                                           oninvalid="this.setCustomValidity('خانة إجبارية')"
                                           oninput="this.setCustomValidity('')">
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>ساعة انتهاء الدرس </h5>
                                <div class="controls">
                                    <input style="font-size: 20px;" id="end_time"
                                           type="time"
                                           name="end_time[]"
                                           oninvalid="this.setCustomValidity('خانة إجبارية')"
                                           oninput="this.setCustomValidity('')">
                                </div>
                            </div>
                            <div style="padding-top: 25px;">
                                <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
                                <span class="btn btn-danger removeeventmore"><i
                                        class="fa fa-minus-circle"></i> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            var counter = 0;
            var learningSeances = @json($learning_seances);

            alert(learningSeances);


            // check before submit
            $('#submit').click(function () {

                var startTime = document.getElementsByName("start_time[]");
                var endTime = document.getElementsByName("end_time[]");
                var room = document.getElementsByName("room[]");
                alert(startTime.length);
                /// time consistency check
                for (var i = 0; i < startTime.length; i++) {

                    if (startTime[i].value != "" && startTime[i].value >= endTime[i].value) {
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
                }

                /// overlap check
                for (var i = 0; i < startTime.length; i++) {
                    for (var j = 0; j < learningSeances[j].room_id; j++) {
                        if (room[i].value == learningSeances[j].room_id
                            && ((startTime[i] >= learningSeances[j].start_time && learningSeances[j].end_time >= startTime[i])
                                || (endTime[i] >= learningSeances[j].start_time && learningSeances[j].end_time >= endTime[i]))
                            && endTime[i] <= learningSeances[j].start_time) {
                            Swal.fire({
                                title: 'القاعة غير متوفرة أو الأستاذ منشغل، يرجى مراجعة البرنامج الأسبوعي!',
                                icon: 'warning',
                                iconHtml: '!',
                                confirmButtonText: 'عودة',
                                cancelButtonText: 'لا',
                                showCancelButton: false,
                                showCloseButton: true
                            })
                            return false;
                        }
                    }
                }
            });

            // type fee input on changes
            $("#fix_input").hide();
            $("#fee_type_id").change(function () {
                if ($(this).val() == 2) {
                    $("#nb_cycle_lesson").show();
                    $("#fix_input").hide();
                } else {
                    $("#nb_cycle_lesson").hide();
                    $("#fix_input").show();
                }
            });

            // group type - group / alone
            $("#alone_date_input").hide();
            $("#group_type").change(function () {
                if ($(this).val() == 'فردي') {
                    $("#alone_date_input").show();
                    $("#group_date_input").hide();
                    $("#add_more_item").hide();
                    $("#delete_whole_extra_item_add").hide();
                    $("#whole_extra_item_add").hide();
                } else {
                    $("#alone_date_input").hide();
                    $("#group_date_input").show();
                    $("#add_more_item").show();
                }
            });


            // add day
            $(document).on("click", ".addeventmore", function () {
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", '.removeeventmore', function (event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter--;
            });

        });

    </script>

@endsection
