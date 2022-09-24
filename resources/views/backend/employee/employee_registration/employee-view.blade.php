@extends('admin.adminBase')
@section('admin')

    <div class="content-wrapper">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <h1><b>قائمة الموظفين</b></h1>
                    <div class="top-right-button-container">
                        <div class="btn-group">
                            <div class="row">
                                <a href="{{ route('employee.registration.add') }}" style="float:left;"
                                   class="btn btn-success btn-lg mr-2">إضافة موظف</a>
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
                <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                    <table id="datatableRows" class="data-table responsive nowrap"
                           data-order="[[ 1, &quot;desc&quot; ]]">
                        <thead>
                        <tr>
                            <th style="text-align: center">الاسم</th>
                            <th style="text-align: center">الصورة</th>
                            <th style="text-align: center">نوع التوظيف</th>
                            <th style="text-align: center">عمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allData as $key => $value )
                            <tr>
                                <td style="text-align: center"> {{ $value->last_name  }}  {{ $value->first_name  }}</td>
                                <td style="text-align: center">
                                    <img
                                        src="{{ (!empty($value->profile_photo_path))? url($value->profile_photo_path):url('upload/no_image.jpg') }}"
                                        style="width: 60px; width: 60px;">
                                </td>
                                <td style="text-align: center"> {{ $value->user_type }} </td>
                                <td style="text-align: center">
                                    <a title="رواتب العامل" href="{{ route('employee.salary.view',$value->id) }}"
                                       class="btn btn-outline-secondary icon-button">
                                        <i class="iconsminds-mail-money">
                                        </i>
                                    </a>
                                    <a title="تعديل" href="{{ route('employee.registration.edit',$value->id) }}"
                                       class="btn btn-outline-secondary icon-button">
                                        <i class="fa fa-pencil-square-o">
                                        </i>
                                    </a>
                                    <a title="حذف" href="{{ route('employee.registration.delete',$value->id) }}"
                                       class="btn btn-outline-danger icon-button" id="delete">
                                        <i class="simple-icon-trash">
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

@endsection
