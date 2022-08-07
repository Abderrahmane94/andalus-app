@extends('admin.adminBase')
@section('admin')


    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <div class="row">
                <div class="col-12">
                    <h1>قائمة الموظفين</h1>

                    <div class="top-right-button-container">

                        <div class="btn-group">
                            <div class="row">
                                <a href="{{ route('employee.registration.add') }}" style="float:left;"
                                   class="btn btn-success btn-lg mr-2">إضافة موظف</a>
                            </div>

                        </div>
                    </div>

                    <div class="separator mb-5"></div>

                </div>
            </div>
                <div class="row">
{{--
                    <div class="col-12">
                        <div class="box bb-3 border-warning">
                            <div class="box-body">
                                <form method="GET" action="{{ route('student.year.class.wise') }}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>السنة الدراسية <span class="text-danger"> </span></h5>
                                                <div class="controls">
                                                    <select name="year_id" required="" class="form-control">
                                                        <option value="" selected="" disabled="">اختر السنة الدراسية</option>
                                                        @foreach($years as $year)
                                                            <option
                                                                value="{{ $year->id }}" {{ (@$year_id == $year->id)? "selected":"" }} >{{ $year->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>فئة الطلبة <span class="text-danger"> </span></h5>
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
--}}


                    <div class="col-12">

                        <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">

                                    @if(!@search)
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th width="5%">الرقم</th>
                                                <th>الاسم</th>
                                                <th>الصورة</th>
                                                <th width="25%">عمليات</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($allData as $key => $value )
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td> {{ $value->last_name  }}  {{ $value->first_name  }}</td>
                                                    <td>
                                                        <img
                                                            src="{{ (!empty($value->image))? url('upload/student_images/'.$value->image):url('upload/no_image.jpg') }}"
                                                            style="width: 60px; width: 60px;">
                                                    </td>
                                                    <td>

                                                        {{--<a title="تعديل" href="{{ route('student.registration.edit',$value->student_id) }}"
                                                           class="btn btn-outline-secondary icon-button">
                                                            <i class="fa fa-pencil-square-o">
                                                            </i>
                                                        </a>--}}
                                                        <a title="حذف" href="{{ route('student.class.delete',$value->id) }}"
                                                           class="btn btn-outline-danger icon-button" id="delete">
                                                            <i class="simple-icon-trash">
                                                            </i>
                                                        </a>

                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td><h3>لا توجد بيانات</h3></td>
                                                </tr>
                                            @endforelse

                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>

                                    @else

                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th width="5%">الرقم</th>
                                                <th>الاسم</th>
                                                <th>الصورة</th>
                                                <th>نوع التوظيف</th>
                                                <th width="25%">عمليات</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($allData as $key => $value )
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td> {{ $value->last_name  }}  {{ $value->first_name  }}</td>
                                                    <td>
                                                        <img
                                                            src="{{ (!empty($value->profile_photo_path))? url($value->profile_photo_path):url('upload/no_image.jpg') }}"
                                                            style="width: 60px; width: 60px;">
                                                    </td>
                                                    <td> {{ $value->user_type }} </td>
                                                    <td>

                                                        <a title="تعديل" href="{{ route('employee.registration.edit',$value->id) }}"
                                                           class="btn btn-outline-secondary icon-button">
                                                            <i class="fa fa-pencil-square-o">
                                                            </i>
                                                        </a>

                                                    </td>

                                                </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" align="left"><h3>لا توجد بيانات</h3></td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>


                                    @endif


                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->


                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

        </div>
    </div>



@endsection
