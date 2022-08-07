@extends('admin.adminBase')
@section('admin')

    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">تعديل كشف الحضور </h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('update.student.attendance',$group_attendance->id) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>تاريخ الكشف <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input id="datePicker" class="form-control datepicker"
                                                                   type="text"
                                                                   placeholder="أدخل تاريخ الحصة" name="date"
                                                                   value="{{$group_attendance->date}}" required>

                                                        </div>
                                                    </div>
                                                </div>  <!-- // End Col md 4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>الأستاذ(ة) <span class="text-danger">*</span></h5>
                                                        <div class="form-group mr-2">
                                                            <div class="controls">
                                                                <select name="teacher_id"
                                                                        class="form-control" required>
                                                                    <option value="{{ $group_attendance->teacher_id }}"
                                                                            selected="">{{ $group_attendance['teacher']['last_name'] }} {{ $group_attendance['teacher']['first_name'] }}
                                                                    </option>
                                                                    @foreach($teachers as $teacher)
                                                                        <option
                                                                            value="{{ $teacher->id }}">{{ $teacher->last_name }} {{ $teacher->first_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div> <!-- // end form group -->
                                                    </div>
                                                </div> <!-- End Col md 4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>القاعة <span class="text-danger">*</span></h5>
                                                        <div class="form-group mr-2">
                                                            <div class="controls">
                                                                <select name="classes_id"
                                                                        class="form-control" required>
                                                                    <option value="{{ $group_attendance->classes_id }}"
                                                                            selected="">{{ $group_attendance['room']['name'] }}
                                                                    </option>
                                                                    @foreach($rooms as $room)
                                                                        <option
                                                                            value="{{ $room->id }}">{{ $room->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div> <!-- // end form group -->
                                                    </div>
                                                </div> <!-- End Col md 4 -->
                                            </div> <!-- // end Row  -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered table-striped"
                                                           style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th rowspan="2" class="text-center"
                                                                style="vertical-align: middle;">الرقم
                                                            </th>
                                                            <th rowspan="2" class="text-center"
                                                                style="vertical-align: middle;">قائمة التلاميذ
                                                            </th>
                                                            <th colspan="3" class="text-center"
                                                                style="vertical-align: middle; width: 30%">حالة التلميذ
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        {{--<input type="hidden" name="group_id"
                                                               value="{{ $group->id }}">--}}
                                                        @foreach($student_attendances as $key => $student_attendance)
                                                            <tr id="div{{$student_attendance['student']->id}}"
                                                                class="text-center">
                                                                <input type="hidden" name="student_id[]"
                                                                       value="{{ $student_attendance['student']->id }}">
                                                                <td>{{ $key+1  }}</td>
                                                                <td>{{ $student_attendance['student']->last_name }} {{ $student_attendance['student']->first_name }}</td>
                                                                <td colspan="3">
                                                                    <div class="switch-toggle switch-3 switch-candy">
                                                                        <input name="attend_status{{$key}}" type="radio"
                                                                               value="حاضر" id="present{{$key}}"
                                                                               @if($student_attendance->attendance_status == 'حاضر') checked="checked" @endif>
                                                                        <label for="present{{$key}}">حاضر</label>
                                                                        <input name="attend_status{{$key}}"
                                                                               value="متأخر" type="radio"
                                                                               id="leave{{$key}}"
                                                                               @if($student_attendance->attendance_status == 'متأخر') checked="checked" @endif>
                                                                        <label for="leave{{$key}}">متأخر</label>
                                                                        <input name="attend_status{{$key}}"
                                                                               value="غائب" type="radio"
                                                                               id="absent{{$key}}"
                                                                               @if($student_attendance->attendance_status == 'غائب') checked="checked" @endif>
                                                                        <label for="absent{{$key}}">غائب</label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>   <!-- // End Col md 12 -->
                                            </div> <!-- // end Row  -->
                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-info mb-5"
                                                       style="float: left" value="تعديل">
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
@endsection
