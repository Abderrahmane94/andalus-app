@extends('admin.adminBase')
@section('admin')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="container-fluid">

        <div class="row">
            <div class="col-12">

                <h1>إضافة فئة تلاميذ جديدة</h1>
                <div class="separator mb-5"></div>

            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form class="needs-validation tooltip-label-right" novalidate="novalidate" method="post"
                      action="{{ route('store.student.class') }}">
                    @csrf

                    <div class="form-group position-relative error-l-50">
                        <label>المستوى</label>
                        <select id="level_value" class="custom-select" name="level" required>
                            <option value="levelOne">قبل التمدرس</option>
                            <option value="levelTwo">ابتدائي</option>
                            <option value="levelThree">متوسط</option>
                            <option value="levelFour">ثانوي</option>
                        </select>
                        <div class="invalid-tooltip">
                            مطلوب إدخال المستوى!
                        </div>
                    </div>
                    <div class="form-group position-relative error-l-50">
                        <label>السنة</label>
                        <select id=year_list" class="custom-select" required name="year">
                            <option value="">اختر من القائمة</option>
                        </select>
                        <div class="invalid-tooltip">
                            مطلوب إدخال السنة!
                        </div>
                    </div>


                    <a href="{{ url()->previous() }}" class="btn btn-warning mb-0" style="float: left">عودة</a>
                    <input type="submit" class="btn btn-primary mb-0 mr-2" style="float: left" value="إضافة">
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

    <script type="text/javascript">
        $(document).ready(function () {

            $("#level_value").change(function () {
                var val = $(this).val();
                if (val == "levelOne") {
                    $("#year_list").html(
                        "<option value='تمهيدي'>item1: test 1</option>" +
                        "<option value='تحضيري'>item1: test 2</option>");
                } else if (val == "levelTwo") {
                    $("#year_list").html(
                        "<option value='test'>item2: test 1</option>" +
                        "<option value='test2'>item2: test 2</option>");

                } else if (val == "levelThree") {
                    $("#year_list").html(
                        "<option value='test'>item3: test 1</option>" +
                        "<option value='test2'>item3: test 2</option>");

                } else if (val == "levelFour") {
                    $("#year_list").html(
                        "<option value='test'>item3: test 1</option>" +
                        "<option value='test2'>item3: test 2</option>");

                }
            });
        });

    </script>

@endsection
