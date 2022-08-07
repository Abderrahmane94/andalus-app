@extends('admin.adminBase')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                    </div>
                    <!-- // end first col 12 -->
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"> قائمة رسومات الطالب
                                    <strong> {{ $last_name }} {{ $first_name }} </strong></h3>
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
                                            <th>تفصيل الرسوم</th>
                                            <th>المبلغ الواجب دفعه</th>
                                            <th>المبلغ المدفوع</th>
                                            <th>المبلغ المتبقي</th>
                                            <th>تاريخ الدفع</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($allData as $key => $value )
                                            <tr style="@if ($value['amount_to_be_paid']-$value['amount_paid'] > 0) color: red @endif">
                                                <td>{{ $key+1 }}</td>
                                                <td> {{ $value['student']['last_name'] }} {{ $value['student']['first_name'] }}</td>
                                                <td> {{ $value['student']['id_no'] }}</td>
                                                <td> @if ($value['group_id'] != null) {{$value['group']['name'] }} @endif</td>
                                                <td> {{ $value['fee_category']['name']}}</td>
                                                @if($value['fee_category_id'] == 2 ) <td> من الحصة {{$value['num_lesson_start']}}  إلى الحصة {{$value['num_lesson_end']}} </td> @else <td>-</td> @endif
                                                <td> {{ $value['amount_to_be_paid']}}</td>
                                                <td> {{ $value['amount_paid']}}</td>
                                                <td> {{ $value['amount_to_be_paid']-$value['amount_paid']}}</td>
                                                <td> {{ $value['paiement_date']}}</td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-primary mb-2" data-toggle="modal"
                                            data-target=".bd-example-modal-lg" style="float: left">
                                        تسديد المستحقات
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <form method="POST" action="{{ route('account.fee.store') }}">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">تسديد
                                                            المستحقات</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if($remaining_fee->isNotEmpty())
                                                            <table id="example1"
                                                                   class="table table-bordered table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th>اختيار</th>
                                                                    <th width="5%">الرقم</th>
                                                                    <th>الفوج الدراسي</th>
                                                                    <th>نوع الرسوم</th>
                                                                    <th>المبلغ الواجب دفعه</th>
                                                                    <th>المبلغ المدفوع</th>
                                                                    <th>المبلغ المتبقي</th>

                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($remaining_fee as $key => $value )
                                                                    <tr>
                                                                        <td><input type="checkbox"
                                                                                   value="{{$value['id']}}"
                                                                                   name="checkBox[{{$value['id']}}]"
                                                                                   class="checkIt custom-switch-input"/>
                                                                        </td>
                                                                        <td> {{ $key+1 }} </td>
                                                                        <td><input type="text" name="group[]" disabled size="10"
                                                                                   value="@if ($value['group_id'] != null) {{$value['group']['name'] }} @else - @endif">
                                                                        </td>
                                                                        <td><input type="text" name="feeCategory[]" size="20"
                                                                                   readonly
                                                                                   value="{{ $value['fee_category']['name']}}">
                                                                        </td>
                                                                        <td><input
                                                                                name="amountToBePaid[{{$value['id']}}]"readonly size="10"
                                                                                id="amountToBePaid[{{$value['id']}}]"
                                                                                onchange="onChangeInput()"
                                                                                value="{{ $value['amount_to_be_paid']}}">
                                                                        </td>
                                                                        <td><input name="amountPaid[{{$value['id']}}]"readonly size="10"
                                                                                   id="amountPaid[{{$value['id']}}]"
                                                                                   onchange="onChangeInput()"
                                                                                   value="{{ $value['amount_paid']}}">
                                                                        </td>
                                                                        <td><input
                                                                                name="remainingAmount[{{$value['id']}}]"readonly size="10"
                                                                                id="remainingAmount[{{$value['id']}}]"
                                                                                onchange="onChangeInput()"
                                                                                value="{{ $value['amount_to_be_paid']-$value['amount_paid']}}">
                                                                        </td>

                                                                    </tr>
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                        @else
                                                            <h1 style="color: green">كل اشتراكات الطالب مدفوعة</h1>
                                                        @endif

                                                    </div>
                                                    <div class="modal-footer">

                                                        <div class="container-fluid">
                                                            @if($remaining_fee->isNotEmpty())
                                                                <div class="col-12 col-sm-6">
                                                                    <h1 class="mb-0 "
                                                                        style="padding-left: 10px;padding-right: 10px">
                                                                        المبلغ الواجب دفعه:</h1>
                                                                    <h1 id="sum" style="color: green">0.00</h1>
                                                                    <input type="hidden" name="globalAmountToBePaid" id="globalAmountToBePaid">
                                                                    <h1 class="mb-0 "
                                                                        style="padding-left: 10px;padding-right: 10px">
                                                                        المبلغ المدفوع:</h1>
                                                                    <input name="globalAmountPaid" required type="number">

                                                                </div>
                                                            @endif
                                                                <div class="col-sm-6 d-none d-sm-block float-right">
                                                                    <button type="button"  class="btn btn-secondary float-right"
                                                                            data-dismiss="modal" >إغلاق
                                                                    </button>
                                                                    @if($remaining_fee->isNotEmpty())
                                                                    <button type="submit"  class="btn btn-success float-right"
                                                                            id="payFees" style="margin-left: 5px;">تسديد
                                                                    </button>
                                                                    @endif

                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- .Modal -->


                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->


                    </div>
                    <!-- /.col -->
            </section>
            <!-- /.content -->
        </div>
    </div>


    <script type="text/javascript">

        function sumCalculate() {
            var remainingValues = [];

            $("input[type=checkbox]:checked").each(function () {
                var amountToBePaidInput = "amountToBePaid";
                var amountPaidInput = "amountPaid";
                amountToBePaidInput = amountToBePaidInput.concat('[', $(this).val(), ']');
                amountPaidInput = amountPaidInput.concat('[', $(this).val(), ']');
                remainingValues.push(parseInt(document.getElementById(amountToBePaidInput).value, 10)-parseInt(document.getElementById(amountPaidInput).value, 10));
            });

            var total = 0;

            const iterator = remainingValues.values();
            for (const value of iterator) {
                total += value;
            }
            return total;
        }


        $('.checkIt').bind('click', function () {
            if ($(this).is(":checked")) {
                document.getElementById("sum").innerHTML = sumCalculate();
                document.getElementById("globalAmountToBePaid").value = sumCalculate();
            } else {
                document.getElementById("sum").innerHTML = sumCalculate();
                document.getElementById("globalAmountToBePaid").value  = sumCalculate();
            }
        });

        function onChangeInput() {
            document.getElementById("sum").innerHTML = sumCalculate();
            document.getElementById("globalAmountToBePaid").value = sumCalculate();
        }

        $(document).ready(function () {
            $('#payFees').click(function () {
                checked = $("input[type=checkbox]:checked").length;

                if (!checked) {
                    Swal.fire({
                        title: 'يرجى اختيار اشتراك واحد على الأقل!',
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
