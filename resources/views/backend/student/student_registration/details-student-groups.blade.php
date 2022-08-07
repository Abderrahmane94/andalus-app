@extends('admin.adminBase')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="top-right-button-container">
                    <div class="btn-group">
                        <div class="row">
                            <a href="{{ route('student.registration.add') }}" style="float:left;"
                               class="btn btn-success btn-lg mr-2" data-toggle="modal"
                               data-target=".groups-modal">إضافة صف دراسي</a>
                        </div>
                    </div>
                </div>
                <h1><b>تفاصيل الصفوف الدراسية </b></h1>
                <h3>
                    <strong>التلميذ: </strong>{{ $detailStudent['student']['last_name']}} {{$detailStudent['student']['first_name']}}
                </h3>
                <h3><strong>الطور: </strong>{{ $detailStudent['student_class']['name'] }}</h3>

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
                            @foreach($detailGroups as $key => $value )
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td> {{ $value['group']['name'] }}</td>
                                    <td>
                                        <a title="حذف"
                                           href="{{ route('student.registration.groups.delete',[$detailStudent['student']['id'],$value['group']['id']]) }}"
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

    </div>

    <form method="post" action="{{ route('store.student.registrationGroups',$studentId) }}">
        @csrf
        <div class="modal fade groups-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title"><b>الصفوف الدراسية</b></h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="add_item">
                            <div class="form-row">

                                <div class="col-md-10">

                                    <div class="form-group">
                                        <h5>الصفوف الدراسية <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="group_id[]" required="" class="form-control">
                                                <option value="" selected="" disabled="">اختر الصف الدراسي...</option>
                                                @foreach($groups as $group)
                                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> <!-- // end form group -->
                                </div> <!-- End col-md-5 -->

                                <div class="col-md-2" style="padding-top: 25px;">
                                    <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
                                </div><!-- End col-md-2 -->
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary"
                                data-dismiss="modal">إلغاء
                        </button>
                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">

                    <div class="col-md-10">

                        <div class="form-group">
                            <h5>الصفوف الدراسية <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="group_id[]" required="" class="form-control">
                                    <option value="" selected="" disabled="">اختر الصف الدراسي...</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> <!-- // end form group -->
                    </div> <!-- End col-md-5 -->

                    <div class="col-md-2" style="padding-top: 25px;">
                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>
                    </div><!-- End col-md-2 -->
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            var counter = 0;
            $(document).on("click", ".addeventmore", function () {
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", '.removeeventmore', function (event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1
            });

        });
    </script>

@endsection
