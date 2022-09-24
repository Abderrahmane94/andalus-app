@extends('admin.adminBase')
@section('admin')

    <div class="content-wrapper">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <h1><b>قائمة التلاميذ</b></h1>
                    <div class="top-right-button-container">
                        <div class="btn-group">
                            <div class="row">
                                <a href="{{ route('student.registration.add') }}" style="float:left;"
                                   class="btn btn-success btn-lg mr-2">إضافة تلميذ</a>
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
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="box bb-3 border-warning">
                        <div class="box-body">
                            <form method="GET" action="{{ route('student.year.class.wise') }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5><b>فئة الطلبة</b> <span class="text-danger"> </span></h5>
                                            <div class="controls">
                                                <select name="class_id" required="" class="form-control">
                                                    <option value="" selected="" disabled="">اختر الفئة</option>
                                                    @foreach($classes as $class)
                                                        <option
                                                            value="{{ $class->id }}" {{ (@$class_id == $class->id)? "selected":"" }}>{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="padding-top: 25px;">
                                        <input type="submit" class="btn btn-rounded btn-dark mb-5" name="search"
                                               value="بحث">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                                @if(!@search)
                                    <table id="datatableRows" class="data-table responsive nowrap"
                                           data-order="[[ 1, &quot;desc&quot; ]]">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center">الصورة</th>
                                            <th style="text-align: center">الاسم</th>
                                            <th style="text-align: center">الرمز</th>
                                            <th style="text-align: center">الفئة</th>
                                            <th style="text-align: center">عمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($allData as $key => $value)
                                            <tr>
                                                <td style="text-align: center">
                                                    <img
                                                        src="{{ (!empty($value['student']['image']))? url('upload/student_images/'.$value['student']['image']):url('upload/no_image.jpg') }}"
                                                        style="width: 60px; width: 60px;">
                                                </td>
                                                <td style="text-align: center"> {{ $value['student']['last_name'] }} {{ $value['student']['first_name'] }}</td>
                                                <td style="text-align: center"> {{ $value['student']['id_no']}}</td>
                                                <td style="text-align: center"> {{ $value['student']['id_no']}}</td>
                                                <td style="text-align: center">
                                                    <a title="تفاصيل الصفوف الدراسية"
                                                       href="{{ route('student.registration.groups.details',$value->student_id) }}"
                                                       class="btn btn-outline-info icon-button">
                                                        <i class="simple-icon-info">
                                                        </i>
                                                    </a>
                                                    <a title="تعديل"
                                                       href="{{ route('student.registration.edit',$value->student_id) }}"
                                                       class="btn btn-outline-secondary icon-button">
                                                        <i class="fa fa-pencil-square-o">
                                                        </i>
                                                    </a>
                                                    <a title="حذف"
                                                       href="{{ route('student.class.delete',$student->id) }}"
                                                       class="btn btn-outline-danger icon-button" id="delete">
                                                        <i class="simple-icon-trash">
                                                        </i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <table id="datatableRows" class="data-table responsive nowrap"
                                           data-order="[[ 1, &quot;desc&quot; ]]">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center">الصورة</th>
                                            <th style="text-align: center">الاسم</th>
                                            <th style="text-align: center">الرمز</th>
                                            <th style="text-align: center">الفئة</th>
                                            <th style="text-align: center">عمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($allData as $key => $value)
                                            <tr>
                                                <td style="text-align: center">
                                                    <img
                                                        src="{{ (!empty($value['student']['image']))? url('upload/student_images/'.$value['student']['image']):url('upload/no_image.jpg') }}"
                                                        style="width: 60px; width: 60px;">
                                                </td>
                                                <td style="text-align: center">{{ $value['student']['last_name'] }} {{ $value['student']['first_name'] }}</td>
                                                <td style="text-align: center"> {{ $value['student']['id_no']}}</td>
                                                <td style="text-align: center"> {{ $value['student_class']['name']}}</td>
                                                <td style="text-align: center">
                                                    <a title="تفاصيل الصفوف الدراسية"
                                                       href="{{ route('student.registration.groups.details',$value->student_id) }}"
                                                       class="btn btn-outline-info icon-button">
                                                        <i class="simple-icon-info">
                                                        </i>
                                                    </a>
                                                    <a title="تعديل"
                                                       href="{{ route('student.registration.edit',$value->student_id) }}"
                                                       class="btn btn-outline-secondary icon-button">
                                                        <i class="fa fa-pencil-square-o">
                                                        </i>
                                                    </a>
                                                    <a title="حذف"
                                                       href="{{ route('student.registration.delete',$value->student_id) }}"
                                                       class="btn btn-outline-danger icon-button" id="delete">
                                                        <i class="simple-icon-trash">
                                                        </i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
