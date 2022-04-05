@extends('admin.adminBase')
@section('admin')


    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <!-- Main content -->
            <div class="row">
                <div class="col-12">
                    <h1>الصفوف الدراسية</h1>

                    <div class="top-right-button-container">

                        <div class="btn-group">
                            <div class="row">
                                <a href="{{ route('student.group.add') }}" style="float:left;"
                                   class="btn btn-success btn-lg mr-2"> إضافة صف</a>
                            </div>

                        </div>
                    </div>

                    <div class="separator mb-5"></div>

                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12 mb-4">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">الرقم</th>
                                    <th>الاسم</th>
                                    <th>المادة</th>
                                    <th>الأستاذ</th>
                                    <th>القاعة</th>
                                    <th>يوم الدرس</th>
                                    <th>بداية الدرس</th>
                                    <th>نهاية الدرس</th>
                                    <th>نوع الدرس</th>
                                    <th width="25%">عمليات</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allData as $key => $group )
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ $group->name }}</td>
                                        <td> {{ $group['subject']['name'] }}</td>
                                        <td> {{ $group['teacher']['last_name'] }} {{ $group['teacher']['first_name'] }}</td>
                                        <td> {{ $group['room']['name'] }}</td>
                                        <td> {{ $group->day }}</td>
                                        <td> {{ $group->start_time }}</td>
                                        <td> {{ $group->end_time }}</td>
                                        <td> {{ $group->group_type }}</td>

                                        <td>
                                            <a title="تعديل" href="{{ route('student.group.edit',$group->id) }}"
                                               class="btn btn-outline-secondary icon-button">
                                                <i class="fa fa-pencil-square-o">
                                                </i>
                                            </a>
                                            <a title="حذف" href="{{ route('student.group.delete',$group->id) }}"
                                               class="btn btn-outline-danger icon-button" id="delete">
                                                <i class="simple-icon-trash">
                                                </i>
                                            </a>
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
            <!-- /.row -->
        </div>
    </div>



@endsection
