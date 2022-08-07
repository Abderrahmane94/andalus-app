@extends('admin.adminBase')
@section('admin')

    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box bb-3 border-warning">
                            <div class="box-body">
                                <form method="GET" action="{{ route('student.fee.wise') }}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="row">
                                                    <h5>رقم تسجيل الطالب <span class="text-danger"> </span></h5>
                                                    <input type="text" name="code_student" required
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                        <div class="col-md-4" style="padding-top: 25px;">

                                            <input type="submit" class="btn btn-rounded btn-dark mb-5" name="search"
                                                   value="بحث">
                                        </div> <!-- End Col md 4 -->
                                    </div><!--  end row -->
                                </form>
                            </div>
                        </div>
                    </div> <!-- // end first col 12 -->

                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">قائمة رسوم الطلبة </h3>
                                <a href="{{ route('student.fee.add') }}" style="float: left;"
                                   class="btn btn-rounded btn-success mb-5"> إضافة / تعديل رسوم الطلبة</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">الرقم</th>
                                            <th>الاسم</th>
                                            <th>الرمز</th>
                                            <th>الفوج الدراسي</th>
                                            <th>نوع الرسوم</th>
                                            <th>المبلغ الواجب دفعه</th>
                                            <th>المبلغ المدفوع</th>
                                            <th>المبلغ المتبقي</th>
                                            <th>التاريخ</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($allData as $key => $value )
                                            <tr style="@if ($value['amount_to_be_paid']-$value['amount_paid'] > 0) color: red @endif">
                                                <td>{{ $key+1 }}</td>
                                                <td> {{ $value['student']['last_name'] }} {{ $value['student']['first_name'] }}</td>
                                                <td> {{ $value['student']['id_no'] }}</td>
                                                <td> @if ($value['group_id'] != null)
                                                        {{$value['group']['name'] }}
                                                    @endif</td>
                                                <td> {{ $value['fee_category']['name']}}</td>
                                                <td> {{ $value['amount_to_be_paid']}}</td>
                                                <td> {{ $value['amount_paid']}}</td>
                                                <td> {{ $value['amount_to_be_paid']-$value['amount_paid']}}</td>
                                                <td> {{ $value['paiement_date']}}</td>

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
