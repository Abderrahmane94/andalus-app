@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();


@endphp

<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="{{ ($route == 'dashboard' or $prefix =='/users')?'active':'' }}">
                    <a href="#dashboard">
                        <i class="simple-icon-speedometer"></i> لوحة القيادة
                    </a>
                </li>
                <li class="{{ ($prefix =='/setup')?'active':'' }}">
                    <a href="#setups">
                        <i class="simple-icon-settings"></i> إعدادات المدرسة
                    </a>
                </li>
                <li class="{{ ($prefix =='/setups')?'active':'' }}">
                    <a href="#students">
                        <i class="simple-icon-graduation"></i> إدارة التلاميذ
                    </a>
                </li>
                <li class="{{ ($prefix =='/setups')?'active':'' }}">
                    <a href="#employee">
                        <i class="simple-icon-people"></i> إدارة العمال
                    </a>
                </li>
                <li class="{{ ($prefix =='/setups')?'active':'' }}">
                    <a href="#account">
                        <i class="iconsminds-money-bag"></i> إدارة الحسابات
                    </a>
                </li>
                <li class="{{ ($prefix =='/setups')?'active':'' }}">
                    <a href="#users">
                        <i class="iconsminds-network"></i> إدارة المستخدمين
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="dashboard">
                <li class="{{ ($route == 'dashboard')?'active':'' }}">
                    <a href=" {{ Route('dashboard') }} ">
                        <i class="iconsminds-dashboard"></i> <span class="d-inline-block">مؤشرات تقييم الأداء KPI</span>
                    </a>
                </li>
                <li class="">
                    <a href=" {{ Route('dashboard') }} ">
                        <i class="iconsminds-line-chart-3"></i> <span class="d-inline-block">تفاصيل المداخيل</span>
                    </a>
                </li>
                <li class="{{ ($prefix == '/users')?'active':'' }}">
                    <a href=" {{ Route('users.view') }}">
                        <i class="iconsminds-line-chart-1"></i> <span class="d-inline-block">تفاصيل المصاريف</span>
                    </a>
                </li>

            </ul>
            <ul class="list-unstyled" data-link="setups">
                <li class="{{ ($route == 'student.class.view')?'active':'' }}">
                    <a href=" {{ Route('student.class.view') }} ">
                        <i class="iconsminds-students"></i> <span class="d-inline-block">فئات الطلاب</span>
                    </a>
                </li>
                <li class="{{ ($route == 'student.year.view')?'active':'' }}">
                    <a href=" {{ Route('student.year.view') }}">
                        <i class="iconsminds-calendar-4"></i> <span class="d-inline-block">السنوات الدراسية</span>
                    </a>
                </li>
                <li class="{{ ($route == 'school.subject.view')?'active':'' }}">
                    <a href=" {{ Route('school.subject.view') }}">
                        <i class="iconsminds-books"></i> <span class="d-inline-block">المواد الدراسية</span>
                    </a>
                </li>
                <li class="{{ ($route == 'school.classes.view')?'active':'' }}">
                    <a href=" {{ Route('school.classes.view') }}">
                        <i class="iconsminds-home-4"></i> <span class="d-inline-block">قاعات التدريس</span>
                    </a>
                </li>
                <li class="{{ ($route == 'fee.category.view')?'active':'' }}">
                    <a href=" {{ Route('fee.category.view') }}">
                        <i class="iconsminds-basket-coins"></i> <span class="d-inline-block">فئات الرسوم</span>
                    </a>
                </li>
                <li class="{{ ($route == 'fee.amount.view')?'active':'' }}">
                    <a href=" {{ Route('fee.amount.view') }}">
                        <i class="iconsminds-coins"></i> <span class="d-inline-block">مبالغ فئات الرسوم</span>
                    </a>
                </li>
                <li class="{{ ($route == 'student.group.view')?'active':'' }}">
                    <a href=" {{ Route('student.group.view') }}">
                        <i class="iconsminds-students"></i> <span class="d-inline-block">تعيين الصفوف الدراسية</span>
                    </a>
                </li>

            </ul>
            <ul class="list-unstyled" data-link="students">
                <li class="{{ ($route == 'student.registration.view')?'active':'' }}">
                    <a href="{{ Route('student.registration.view') }}">
                        <i class="iconsminds-students"></i> <span class="d-inline-block">تسجيل الطلبة</span>
                    </a>
                </li>
                <li class="{{ ($route == 'student.attendance.view')?'active':'' }}">
                    <a href="{{ Route('student.attendance.view') }}">
                        <i class="iconsminds-check"></i> <span class="d-inline-block">حضور الطلبة</span>
                    </a>
                </li>
                <li>
                    <a href="Apps.Todo.List.html">
                        <i class="iconsminds-cash-register-2"></i> <span class="d-inline-block">رسوم التسجيل</span>
                    </a>
                </li>

                <li>
                    <a href="Apps.Survey.List.html">
                        <i class="iconsminds-cash-register-2"></i> <span class="d-inline-block">الرسوم الشهرية</span>
                    </a>
                </li>
                <li>
                    <a href="Apps.Chat.html">
                        <i class="iconsminds-cash-register-2"></i> <span class="d-inline-block">رسوم أخرى</span>
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled" data-link="employee">
                <li class="{{ ($prefix == '/employees')?'active':'' }}">
                    <a href="{{ Route('employee.registration.view') }}">
                        <i class="simple-icon-list"></i> <span class="d-inline-block">تسجيل العمال</span>
                    </a>
                </li>
                <li class="{{ ($prefix == '/users')?'active':'' }}">
                    <a href="{{ Route('users.view') }}">
                        <i class="iconsminds-check"></i> <span class="d-inline-block">حضور العمال</span>
                    </a>
                </li>
                <li class="{{ ($prefix == '/users')?'active':'' }}">
                    <a href="{{ Route('users.view') }}">
                        <i class="iconsminds-money-bag"></i> <span class="d-inline-block">إعداد الرواتب</span>
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled" data-link="users">
                <li class="{{ ($prefix == '/users')?'active':'' }}">
                    <a href="{{ Route('users.view') }}">
                        <i class="iconsminds-mens"></i> <span class="d-inline-block">عرض المستخدمين</span>
                    </a>
                </li>
                <li class="{{ ($prefix == '/users')?'active':'' }}">
                    <a href="{{ Route('users.view') }}">
                        <i class="iconsminds-male"></i> <span class="d-inline-block">إضافة مستخدم</span>
                    </a>
                </li>

            </ul>
            <ul class="list-unstyled" data-link="account">
                <li class="{{ ($route == 'student.fee.view')?'active':'' }}">
                    <a href="{{ Route('student.fee.view') }}">
                        <i class="iconsminds-coins"></i> <span class="d-inline-block">إشتراكات الطلبة</span>
                    </a>
                </li>
                <li class="{{ ($prefix == '/users')?'active':'' }}">
                    <a href="{{ Route('users.view') }}">
                        <i class="iconsminds-financial"></i> <span class="d-inline-block">رواتب العمال</span>
                    </a>
                </li>
                <li class="{{ ($prefix == '/users')?'active':'' }}">
                    <a href="{{ Route('users.view') }}">
                        <i class="iconsminds-wallet"></i> <span class="d-inline-block">مصاريف أخرى</span>
                    </a>
                </li>

            </ul>

        </div>
    </div>
</div>
