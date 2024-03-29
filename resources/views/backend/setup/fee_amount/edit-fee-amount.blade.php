@extends('admin.adminBase')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title"><b>تعديل مبالغ الرسوم</b></h1>
                        <div class="separator mb-5"></div>
                    </div>
                    <!-- /.box-header -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <form method="post"
                                          action="{{ route('update.fee.amount',$editData[0]->fee_category_id) }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="add_item">
                                                    <div class="form-group">
                                                        <h5>فئة الرسوم<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="fee_category_id" required=""
                                                                    class="form-control">
                                                                <option value="" selected="" disabled="">اختر فئة الرسوم
                                                                </option>
                                                                @foreach($fee_categories as $category)
                                                                    <option
                                                                        value="{{ $category->id }}" {{ ($editData['0']->fee_category_id == $category->id)? "selected":"" }}>{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div> <!-- // end form group -->
                                                    @foreach($editData as $edit)
                                                        <div class="delete_whole_extra_item_add"
                                                             id="delete_whole_extra_item_add">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <h5>فئة الطلاب<span class="text-danger">*</span>
                                                                        </h5>
                                                                        <div class="controls">
                                                                            <select name="class_id[]" required=""
                                                                                    class="form-control">
                                                                                <option value="" selected=""
                                                                                        disabled="">
                                                                                    اختر فئة الطلاب
                                                                                </option>
                                                                                @foreach($classes as $class)
                                                                                    <option
                                                                                        value="{{ $class->id }}" {{ ($edit->class_id == $class->id)? "selected": ""  }} >{{ $class->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div> <!-- // end form group -->
                                                                </div> <!-- End col-md-5 -->
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <h5>المبلغ <span class="text-danger">*</span>
                                                                        </h5>
                                                                        <div class="controls">
                                                                            <input type="text" name="amount[]"
                                                                                   value="{{ $edit->amount }}"
                                                                                   class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div><!-- End col-md-5 -->
                                                                <div class="col-md-2" style="padding-top: 25px;">
                                                                <span class="btn btn-success addeventmore"><i
                                                                        class="fa fa-plus-circle"></i> </span>
                                                                    <span class="btn btn-danger removeeventmore"><i
                                                                            class="fa fa-minus-circle"></i> </span>
                                                                </div><!-- End col-md-5 -->
                                                            </div> <!-- end Row -->
                                                        </div> <!-- // End Remove Delete  -->
                                                    @endforeach
                                                </div>    <!-- // End add_item -->
                                                <div class="text-xs-right">
                                                    <input type="submit" class="btn btn-rounded btn-info mb-5 mt-5"
                                                           value="تعديل"
                                                           style="float: left">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
        </div>
    </div>

    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <h5>فئة الطلاب<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="class_id[]" required="" class="form-control">
                                    <option value="" selected="" disabled="">اختر فئة الطلاب</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> <!-- // end form group -->
                    </div> <!-- End col-md-5 -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <h5>المبلغ<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="amount[]" class="form-control">
                            </div>
                        </div>
                    </div><!-- End col-md-5 -->
                    <div class="col-md-2" style="padding-top: 25px;">
                        <span class="btn btn-success addeventmore "><i class="fa fa-plus-circle"></i> </span>
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
