@extends('admin.adminBase')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1><b>إضافة قاعة</b></h1>
                <div class="separator mb-5"></div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <form class="needs-validation tooltip-label-right" novalidate="novalidate" method="post"
                      action="{{ route('store.school.classes') }}">
                    @csrf

                    <div class="form-group position-relative error-l-50">
                        <label>الاسم</label>
                        <input type="text" class="form-control" name="name" required>
                        <div class="invalid-tooltip">
                            مطلوب إدخال الاسم!
                        </div>
                    </div>
                    <div class="form-group position-relative error-l-50">
                        <label>طاقة الاستعاب</label>
                        <input type="number" class="form-control" name="nb_student" required>
                        <div class="invalid-tooltip">
                            مطلوب إدخال طاقة الاستعاب!
                        </div>
                    </div>
                    <div class="form-group position-relative error-l-50">
                        <label>المساحة</label>
                        <input type="number" step="0.01" class="form-control" name="surface" required>
                        <div class="invalid-tooltip">
                            مطلوب إدخال المساحة!
                        </div>
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-warning mb-0" style="float: left">عودة</a>
                    <input type="submit" class="btn btn-primary mb-0 mr-2" style="float: left" value="إضافة">
                </form>
            </div>
        </div>
    </div>

@endsection
