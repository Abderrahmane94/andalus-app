@extends('admin.adminBase')
@section('admin')


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>تفاصيل الصفوف الدراسية</h1>
                <h4><strong>التلميذ: </strong>{{ $detail['student']['last_name']}} {{$detail['student']['first_name']}}</h4>
                <h4><strong>الطور: </strong>{{ $detail['student_class']['name'] }}</h4>

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
                                <th>الصف الدراسي</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($detailsData as $key => $detail )
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td> {{ $detail['group']['name'] }}</td>
                                    <td>
                                        <a title="تعديل" href="{{ route('student.registration.edit',$detail['student']['id']) }}"
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
