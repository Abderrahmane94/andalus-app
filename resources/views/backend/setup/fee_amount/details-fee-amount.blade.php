@extends('admin.adminBase')
@section('admin')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1><b>تفاصيل مبالغ فئات الرسوم</b></h1>
                <h2> فئة الرسوم: <b>{{ $detailsData['0']['fee_cateogry']['name'] }} </b></h2>

                <div class="separator mb-5"></div>

            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <table class="data-table data-table-feature">
                            <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>الطور</th>
                                <th>المبلغ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($detailsData as $key => $detail )
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td> {{ $detail['student_class']['name'] }}</td>
                                    <td> {{ $detail->amount }}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
