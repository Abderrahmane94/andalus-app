@extends('admin.adminBase')
@section('admin')


    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
                <div class="row">


                    <div class="col-12">

                        <div class="box">
                            <div class="box-header with-border">
                                <h1 class="box-title"><b>كشف حضور التلاميذ</b></h1>

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
                                                    <option value="" selected="" disabled="" >اختر الصف الدراسي ...
                                                    </option>
                                                    @foreach($groups as $group)
                                                        <option
                                                            value="{{ $group->id }}">{{ $group->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> <!-- // end form group -->
                                        <input type="submit" class="btn btn-rounded btn-info mb-5" value="إضافة كشف الحضور"
                                               style="float: left">
                                    </div>
                                </form>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">الرقم</th>
                                            <th>الصف الدراسي</th>
                                            <th>التاريخ</th>
                                            <th width="20%">عمليات</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($groupsAttendances as $key => $value )
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $value['group']['name'] }}</td>
                                                <td> {{ date('Y-m-d', strtotime($value->date)) }}</td>

                                                <td>
                                                    <a href="{{ route('student.attendance.edit',$value->id) }}"
                                                       class="btn btn-info">تعديل</a>
                                                    <a href="{{ route('student.attendance.details',[$value->date,$value['group']['id']]) }}"
                                                       class="btn btn-danger">تفاصيل</a>

                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->


                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
    </div>





@endsection
