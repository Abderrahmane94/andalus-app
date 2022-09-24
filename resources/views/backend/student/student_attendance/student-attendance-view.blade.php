@extends('admin.adminBase')
@section('admin')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1><b>كشف حضور التلاميذ</b></h1>
                <div class="top-right-button-container">
                    <div class="btn-group">
                        <div class="row">
                            <form method="post" action="{{ route('student.attendance.add') }}">
                                @csrf
                                <div class="row" style="float: left;">
                                    <div class="form-group mr-2">
                                        <div class="controls">
                                            <select name="group_id"
                                                    class="form-control" required
                                                    oninvalid="this.setCustomValidity('الرجاء اختيار الفوج')"
                                                    oninput="this.setCustomValidity('')"
                                                    style="width: 100%">
                                                <option value="" selected="" disabled="">اختر الصف الدراسي ...
                                                </option>
                                                @foreach($groups as $group)
                                                    <option
                                                        value="{{ $group->id }}">{{ $group->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-rounded btn-info mb-5"
                                           value="إضافة كشف الحضور"
                                           style="float: left">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="separator mb-5"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                <table id="datatableRows" class="data-table responsive nowrap"
                       data-order="[[ 1, &quot;desc&quot; ]]">
                    <thead>
                    <tr>
                        <th style="text-align: center">الصف الدراسي</th>
                        <th style="text-align: center">الأستاذ</th>
                        <th style="text-align: center">القاعة</th>
                        <th style="text-align: center">التاريخ</th>
                        <th style="text-align: center">بدء الحصة</th>
                        <th style="text-align: center">نهاية الحصة</th>
                        <th style="text-align: center">عمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groupsAttendances as $key => $value )
                        <tr>
                            <td style="text-align: center">{{ $value['group']['name'] }}</td>
                            <td style="text-align: center">{{ $value['teacher']['first_name'].' '.$value['teacher']['last_name'] }}</td>
                            <td style="text-align: center">{{ $value['room']['name'] }}</td>
                            <td style="text-align: center"> {{ date('Y-m-d', strtotime($value->date)) }}</td>
                            <td style="text-align: center"> {{ $value->start_time  }}</td>
                            <td style="text-align: center"> {{ $value->end_time }}</td>
                            <td style="text-align: center">
                                <a href="{{ route('student.attendance.edit',$value->id) }}"
                                   class="btn btn-info">تعديل</a>
                                <a href="{{ route('student.attendance.details',[$value->date,$value['group']['id']]) }}"
                                   class="btn btn-danger">تفاصيل</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
