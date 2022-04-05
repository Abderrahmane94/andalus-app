@extends('admin.adminBase')
@section('admin')


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>مبالغ فئات الرسوم</h1>

                <div class="top-right-button-container">

                    <div class="btn-group">
                        <div class="row">
                            <a href="{{ route('fee.amount.add') }}" style="float:left;"
                               class="btn btn-success btn-lg mr-2">إضافة مبلغ الرسوم</a>
                        </div>

                    </div>
                </div>

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
                                <th>فئة الرسوم</th>
                                <th>عمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allData as $key => $amount )
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $amount['fee_cateogry']['name'] }}</td>
                                    <td>
                                        <a title="تفاصيل" href="{{ route('fee.amount.details',$amount->fee_category_id) }}"
                                           class="btn btn-outline-info icon-button">
                                            <i class="simple-icon-info">
                                            </i>
                                        </a>
                                        <a title="تعديل" href="{{ route('fee.amount.edit',$amount->fee_category_id) }}"
                                           class="btn btn-outline-secondary icon-button">
                                            <i class="fa fa-pencil-square-o">
                                            </i>
                                        </a>
                                    </td>

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
