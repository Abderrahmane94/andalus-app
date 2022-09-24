@extends('admin.adminBase')
@section('admin')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1><b>تعديل كشف حضور الحصة {{ $group_attendance->num_lesson }}</b></h1>
                <form method="post" action="{{ route('store.student.attendance',$group_attendance->group->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>تاريخ الكشف <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input id="datePicker" class="form-control datepicker"
                                           type="date   "
                                           placeholder="أدخل تاريخ الحصة" name="date"
                                           value="{{$group_attendance->date}}"
                                           required>
                                </div>
                            </div>
                        </div>
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
                                </div>
                            </div>
                        </div>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                           role="button" aria-expanded="true" aria-controls="displayOptions">
                            Display Options
                            <i class="simple-icon-arrow-down align-middle"></i>
                        </a>
                        <div class="collapse dont-collapse-sm" id="displayOptions">
                            <div class="d-block d-md-inline-block">
                                <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                    <input class="form-control" placeholder="بحث ..." id="searchDatatable">
                                </div>
                            </div>
                            <div class="float-md-right dropdown-as-select" id="pageCountDatatable">
                                <span class="text-muted text-small m-2">Displaying 1-10 of 40 items </span>
                                <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    10
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">5</a>
                                    <a class="dropdown-item active" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator mb-3"></div>
                    <div class="row">
                        <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                            <table id="datatableRows" class="data-table responsive nowrap"
                                   data-order="[[ 1, &quot;desc&quot; ]]">
                                <thead>
                                <tr>
                                    <th style="text-align: center">اسم ولقب التلميذ</th>
                                    <th style="text-align: center">حالة التلميذ</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--<input type="hidden" name="group_id"
                                       value="{{ $group->id }}">--}}
                                @foreach($student_attendances as $key => $student_attendance)

                                    <tr id="div{{$student_attendance['student']->id}}" class="text-center">
                                        <input type="hidden" name="student_id[]"
                                               value="{{ $student_attendance['student']->id }}">
                                        <td style="text-align: center">{{ $student_attendance['student']->last_name }} {{ $student_attendance['student']->first_name }}</td>
                                        <td colspan="3" style="text-align: center">
                                            <div class="switch-toggle switch-3 switch-candy">
                                                <input name="attend_status{{$key}}" type="radio"
                                                       value="حاضر" id="present{{$key}}"
                                                       @if($student_attendance->attendance_status == 'حاضر') checked="checked" @endif>
                                                <label for="present{{$key}}">حاضر</label>
                                                <input name="attend_status{{$key}}"
                                                       value="غائب" type="radio"
                                                       id="absent{{$key}}" style="margin-right: 50px"
                                                       @if($student_attendance->attendance_status == 'غائب') checked="checked" @endif
                                                <label for="absent{{$key}}">غائب</label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-info mb-5"
                               style="float: left" value="تعديل">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
