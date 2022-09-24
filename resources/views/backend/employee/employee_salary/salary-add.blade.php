@extends('admin.adminBase')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1><b>إضافة راتب للعامل(ة): {{ $employee->first_name.' '.$employee->last_name }}</b></h1>
                <div class="separator mb-5"></div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <form method="post" action="{{ route('employee.salary.store',$employee->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="add_item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>البيان <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="description" class="form-control"
                                                       required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>المبلغ الأصلي (دج) <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="number"
                                                       value="{{$principal_amount}}"
                                                       name="principal_amount"
                                                       id="principal_amount"
                                                       class="form-control"
                                                       required=""
                                                       readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>المنحة الإضافية (دج) <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="number"
                                                       value="0"
                                                       onchange="onChangeInput()"
                                                       name="grant_amount"
                                                       id="grant_amount"
                                                       class="form-control"
                                                       required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>المبلغ المدفوع (دج)<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="number" valeur="" name="paid_amount" id="paid_amount" class="form-control"
                                                       disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach($group_attendances as $group_Attendance)
                                <input type="hidden" name="group_Attendance_id[]"
                                       value="{{ $group_Attendance->id }}">
                            @endforeach
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info mb-5" value="إضافة"
                                       style="float: left">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card h-100">
            <div class="card-body"><h1 class="card-title"><b>تفصيل الراتب</b></h1>
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                    <div class="row view-filter">
                        <div class="col-sm-12">
                            <div class="float-left"></div>
                            <div class="float-right"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <table class="data-table data-table-standard responsive nowrap dataTable no-footer dtr-inline"
                           data-order="[[ 1, &quot;desc&quot; ]]" id="DataTables_Table_0" role="grid"
                           style="width: 449px;">
                        <thead>
                        <tr role="row">
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                style="width: 146px; text-align: center"
                                aria-label="Name: activate to sort column ascending">الصف الدراسي
                            </th>
                            <th class="sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 50px; text-align: center" aria-sort="descending"
                                aria-label="Sales: activate to sort column ascending">عدد الحضور
                            </th>
                            <th class="sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 50px; text-align: center" aria-sort="descending"
                                aria-label="Sales: activate to sort column ascending">عدد الحصص
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                style="width: 51px; text-align: center"
                                aria-label="Stock: activate to sort column ascending"> الحصص
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                style="width: 51px; text-align: center"
                                aria-label="Stock: activate to sort column ascending">تاريخ أول حصة
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                style="width: 51px; text-align: center"
                                aria-label="Stock: activate to sort column ascending">تاريخ آخر حصة
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                style="width: 78px; text-align: center"
                                aria-label="Category: activate to sort column ascending">مبلغ الحصص
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                style="width: 78px; text-align: center"
                                aria-label="Category: activate to sort column ascending">المبلغ الثابت
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student_groups as $key => $student_group)
                            <tr role="row">
                                <td tabindex="0"><p class="list-item-heading" style="text-align: center">{{$student_group['group_name']}}</p></td>
                                <td class="sorting_1"><p class="text-muted" style="text-align: center">{{$student_group['nb_student']}}</p></td>
                                <td><p class="text-muted" style="text-align: center">{{$student_group['seances']->count()}}</p></td>
                                <td><p class="text-muted" style="text-align: center">{{$student_group['seances']}}</p></td>
                                <td><p class="text-muted" style="text-align: center">{{$student_group['first_date']}}</p></td>
                                <td><p class="text-muted" style="text-align: center">{{$student_group['last_date']}}</p></td>
                                <td><p class="text-muted" style="text-align: center">{{$student_group['amount']}}</p></td>
                                <td><p class="text-muted" style="text-align: center">{{($student_group['fee_type'] == 'شهري') ? $student_group['fix_salary']:'-'}}</p></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        function onChangeInput() {
            document.getElementById("paid_amount").value = parseInt(document.getElementById("grant_amount").value,10) + parseInt(document.getElementById("principal_amount").value,10);
        }

        $(document).ready(function () {
            document.getElementById("paid_amount").value = parseInt(document.getElementById("grant_amount").value,10) + parseInt(document.getElementById("principal_amount").value,10);
        });
    </script>

@endsection
