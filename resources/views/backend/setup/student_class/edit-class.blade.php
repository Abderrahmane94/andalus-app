@extends('admin.adminBase')
@section('admin')



<div class="container-fluid">

    <div class="row">
        <div class="col-12">

            <h1>تعديل فئة تلاميذ</h1>
            <div class="separator mb-5"></div>

        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form class="needs-validation tooltip-label-right" novalidate="novalidate" method="post"
                  action="{{ route('update.student.class',$editData->id) }}">
                @csrf

                <div class="form-group position-relative error-l-50">
                    <label>الاسم</label>
                    <input type="text" class="form-control" name="name" value="{{ $editData->name }}" required>
                    <div class="invalid-tooltip">
                        مطلوب إدخال الاسم!
                    </div>
                </div>
                <div class="form-group position-relative error-l-50" >
                    <label>المستوى</label>
                    <select id="level_value" class="custom-select" name="level" required>
                        <option value="">اختر المستوى</option>
                        <option value="ابتدائي" {{ $editData->level == 'ابتدائي' ? 'selected' : '' }}>ابتدائي</option>
                        <option value="متوسط" {{ $editData->level == 'متوسط' ? 'selected' : '' }}>متوسط</option>
                        <option value="ثانوي" {{ $editData->level == 'ثانوي' ? 'selected' : '' }}>ثانوي</option>

                    </select>
                    <div class="invalid-tooltip">
                        مطلوب إدخال المستوى!
                    </div>
                </div>
                {{--<div class="form-group position-relative error-l-50">
                    <label>السنة</label>
                    <select id =selectList" class="custom-select" required name="year">

                    </select>
                    <div class="invalid-tooltip">
                        مطلوب إدخال السنة!
                    </div>
                </div>--}}


                <a href="{{ url()->previous() }}" class="btn btn-warning mb-0" style="float: left">عودة</a>
                <input type="submit" class="btn btn-primary mb-0 mr-2" style="float: left" value="تعديل">
            </form>
        </div>
    </div>

</div>


{{--  <script type="text/javascript">

      document.getElementById("level_value").onchange = function () {
          switch (document.getElementById("level_value").value) {
              case "1":
                  alert("begin");
                  var items = ["الأولى", "الثانية","الثالثة","الرابعة","الخامسة"];
                  alert("begin");

                  var str = ""
                  alert("begin");

                  for (var item of items) {
                      str += "<option>" + item + "</option>"
                  }
                  alert("begin");

                  document.getElementById("selectList").innerHTML = str;
                  alert(document.getElementById("selectList").value);
                  break;
              case "2":
                  var items = ["الأولى", "الثانية","الثالثة","الرابعة"];

                  var str = ""
                  for (var item of items) {
                      str += "<option>" + item + "</option>"
                  }
                  document.getElementById("selectList").innerHTML = str;
                  break;
              case "3":
                  var items = ["الأولى", "الثانية","الثالثة"];

                  var str = ""
                  for (var item of items) {
                      str += "<option>" + item + "</option>"
                  }
                  document.getElementById("selectList").innerHTML = str;
                  break;
          }
      };


  </script>--}}





@endsection
