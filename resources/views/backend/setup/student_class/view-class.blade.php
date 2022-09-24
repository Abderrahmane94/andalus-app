@extends('admin.adminBase')
@section('admin')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1><b>فئات التلاميذ</b></h1>
                <div class="top-right-button-container">
                    {{--<div class="btn-group">
                        <div class="row">
                            <a href="{{ route('student.class.add') }}" style="float:left;"
                               class="btn btn-success btn-lg mr-2"><b>إضافة فئة</b></a>
                        </div>
                    </div>--}}
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
                            <span class="text-muted text-small m-2"> Displaying 1-10 of 40 items </span>
                            <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                10
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">5</a>
                                <a class="dropdown-item active" href="#">10</a>
                                <a class="dropdown-item" href="#">20</a>
                                <a class="dropdown-item" href="#">50</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="separator"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                <table id="datatableRows" class="data-table responsive nowrap"
                       data-order="[[ 1, &quot;desc&quot; ]]">
                    <thead>
                    <tr>
                        <th style="text-align: center">الاسم</th>
                        <th style="text-align: center">المستوى</th>
                        <th style="text-align: center">السنة</th>
                        <th style="text-align: center">الشعبة</th>
{{--
                        <th style="text-align: center">عمليات</th>
--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allData as $key => $student )
                        <tr>
                            <td>
                                <p class="list-item-heading" style="text-align: center">{{$student->name}}</p>
                            </td>
                            <td>
                                <p class="text-muted" style="text-align: center">{{$student->level}}</p>
                            </td>
                            <td>
                                <p class="text-muted" style="text-align: center">{{$student->year}}</p>
                            </td>
                            <td>
                                <p class="text-muted" style="text-align: center">{{$student->section}}</p>
                            </td>
                            {{--<td style="text-align: center">
                                <a title="تعديل" href="{{ route('student.class.edit',$student->id) }}"
                                   class="btn btn-outline-secondary icon-button">
                                    <i class="fa fa-pencil-square-o">
                                    </i>
                                </a>
                                <a title="حذف" href="{{ route('student.class.delete',$student->id) }}"
                                   class="btn btn-outline-danger icon-button" id="delete">
                                    <i class="simple-icon-trash">
                                    </i>
                                </a>
                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
