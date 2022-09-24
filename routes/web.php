<?php

use App\Http\Controllers\Backend\Account\StudentFeeController;
use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Setup\Backend\Account\AccountSalaryController;
use App\Http\Controllers\Backend\Setup\CalendarController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Student\StudentAttendanceController;
use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\Setup\SchoolClassesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


Route::group(['middleware' => 'auth'], function () {

    // Language Routes
    Route::get('locale/{locale}', function ($locale) {
        Session::put('locale', $locale);
        return redirect()->back();
    });

    // User Management All Routes
    Route::prefix('users')->group(function () {

        Route::get('/view', [UserController::class, 'UserView'])->name('users.view');

        Route::get('/add', [UserController::class, 'UserAdd'])->name('users.add');

        Route::post('/store', [UserController::class, 'UserStore'])->name('users.store');

        Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('users.edit');

        Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('users.update');

        Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');

    });

    /// User Profile and Change Password
    Route::prefix('profile')->group(function () {

        Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');

        Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');

        Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');

        Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');

        Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');

    });

    // Setup Routes
    Route::prefix('setup')->group(function () {

        // Student Class Routes

        Route::get('/class/view', [StudentClassController::class, 'ViewStudent'])->name('student.class.view');

        Route::get('/class/add', [StudentClassController::class, 'StudentClassAdd'])->name('student.class.add');

        Route::post('/class/store', [StudentClassController::class, 'StudentClassStore'])->name('store.student.class');

        Route::get('/class/edit/{id}', [StudentClassController::class, 'StudentClassEdit'])->name('student.class.edit');

        Route::post('/class/update/{id}', [StudentClassController::class, 'StudentClassUpdate'])->name('update.student.class');

        Route::get('/class/delete/{id}', [StudentClassController::class, 'StudentClassDelete'])->name('student.class.delete');


        // Student Year Routes

        Route::get('/year/view', [StudentYearController::class, 'ViewYear'])->name('student.year.view');

        Route::get('/year/add', [StudentYearController::class, 'StudentYearAdd'])->name('student.year.add');

        Route::post('/year/store', [StudentYearController::class, 'StudentYearStore'])->name('store.student.year');

        Route::get('/year/edit/{id}', [StudentYearController::class, 'StudentYearEdit'])->name('student.year.edit');

        Route::post('/year/update/{id}', [StudentYearController::class, 'StudentYearUpdate'])->name('update.student.year');

        Route::get('/year/update_status/{id}', [StudentYearController::class, 'StudentYearUpdateStatus'])->name('update.student.year.status');

        Route::get('/year/delete/{id}', [StudentYearController::class, 'StudentYearDelete'])->name('student.year.delete');


        // Fee Category Routes

        Route::get('fee/category/view', [FeeCategoryController::class, 'ViewFeeCat'])->name('fee.category.view');

        Route::get('fee/category/add', [FeeCategoryController::class, 'FeeCatAdd'])->name('fee.category.add');

        Route::post('fee/category/store', [FeeCategoryController::class, 'FeeCatStore'])->name('store.fee.category');

        Route::get('fee/category/edit/{id}', [FeeCategoryController::class, 'FeeCatEdit'])->name('fee.category.edit');

        Route::post('fee/category/update/{id}', [FeeCategoryController::class, 'FeeCategoryUpdate'])->name('update.fee.category');

        Route::get('fee/category/delete/{id}', [FeeCategoryController::class, 'FeeCategoryDelete'])->name('fee.category.delete');

        // Fee Category Amount Routes

        Route::get('fee/amount/view', [FeeAmountController::class, 'ViewFeeAmount'])->name('fee.amount.view');

        Route::get('fee/amount/add', [FeeAmountController::class, 'AddFeeAmount'])->name('fee.amount.add');

        Route::post('fee/amount/store', [FeeAmountController::class, 'StoreFeeAmount'])->name('store.fee.amount');

        Route::get('fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'EditFeeAmount'])->name('fee.amount.edit');

        Route::post('fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'UpdateFeeAmount'])->name('update.fee.amount');

        Route::get('fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'DetailsFeeAmount'])->name('fee.amount.details');


        // Subject routes

        Route::get('/subject/view', [SchoolSubjectController::class, 'ViewSubject'])->name('school.subject.view');

        Route::get('/subject/add', [SchoolSubjectController::class, 'SubjectAdd'])->name('school.subject.add');

        Route::post('/subject/store', [SchoolSubjectController::class, 'SubjectStore'])->name('store.school.subject');

        Route::get('/subject/edit/{id}', [SchoolSubjectController::class, 'SubjectEdit'])->name('school.subject.edit');

        Route::post('/subject/update/{id}', [SchoolSubjectController::class, 'SubjectUpdate'])->name('update.school.subject');

        Route::get('/subject/delete/{id}', [SchoolSubjectController::class, 'SubjectDelete'])->name('school.subject.delete');


        // School ِClasses Routes -- Rooms

        Route::get('/classes/view', [SchoolClassesController::class, 'ViewClasses'])->name('school.classes.view');

        Route::get('/classes/add', [SchoolClassesController::class, 'ClassesAdd'])->name('school.classes.add');

        Route::post('/classes/store', [SchoolClassesController::class, 'ClassesStore'])->name('store.school.classes');

        Route::get('/classes/edit/{id}', [SchoolClassesController::class, 'ClassesEdit'])->name('school.classes.edit');

        Route::post('/classes/update/{id}', [SchoolClassesController::class, 'ClassesUpdate'])->name('update.school.classes');

        Route::get('/classes/delete/{id}', [SchoolClassesController::class, 'ClassesDelete'])->name('school.classes.delete');


        // Student Group Routes

        Route::get('/group/view', [StudentGroupController::class, 'ViewGroup'])->name('student.group.view');

        Route::get('/group/detail/{id}', [StudentGroupController::class, 'ViewGroupDetails'])->name('student.group.detail');

        Route::get('/group/remove/{group_id}/{student_id}', [StudentGroupController::class, 'RemoveStudentFromGroup'])->name('student.group.detail.delete');

        Route::get('/group/add', [StudentGroupController::class, 'StudentGroupAdd'])->name('student.group.add');

        Route::post('/group/store', [StudentGroupController::class, 'StudentGroupStore'])->name('store.student.group');

        Route::get('/group/edit/{id}', [StudentGroupController::class, 'StudentGroupEdit'])->name('student.group.edit');

        Route::post('/group/update/{id}', [StudentGroupController::class, 'StudentGroupUpdate'])->name('update.student.group');

        Route::get('/group/delete/{id}', [StudentGroupController::class, 'StudentGroupDelete'])->name('student.group.delete');

        Route::get('/group/update_status/{id}', [StudentGroupController::class, 'StudentGroupUpdateStatus'])->name('student.group.update.status');

        // Calendar Routes

        Route::get('/calendar/view', [CalendarController::class, 'index'])->name('calendar.index');
    });

    /// Student Routes
    Route::prefix('students')->group(function () {

        // registration routes
        Route::get('/reg/view', [StudentRegController::class, 'StudentRegView'])->name('student.registration.view');

        Route::get('/reg/Add', [StudentRegController::class, 'StudentRegAdd'])->name('student.registration.add');

        Route::post('/reg/store', [StudentRegController::class, 'StudentRegStore'])->name('store.student.registration');

        Route::post('/reg/groups/store/{student_id}', [StudentRegController::class, 'StudentRegGroupsStore'])->name('store.student.registrationGroups');

        Route::get('/year/class/wise', [StudentRegController::class, 'StudentClassYearWise'])->name('student.year.class.wise');

        Route::get('/reg/edit/{student_id}', [StudentRegController::class, 'StudentRegEdit'])->name('student.registration.edit');

        Route::post('/reg/update/{student_id}', [StudentRegController::class, 'StudentRegUpdate'])->name('update.student.registration');

        Route::get('/reg/promotion/{student_id}', [StudentRegController::class, 'StudentRegPromotion'])->name('student.registration.promotion');

        Route::post('/reg/update/promotion/{student_id}', [StudentRegController::class, 'StudentUpdatePromotion'])->name('promotion.student.registration');

        Route::get('/reg/details/{student_id}', [StudentRegController::class, 'StudentRegDetails'])->name('student.registration.details');

        Route::get('/reg/groups/details/{student_id}', [StudentRegController::class, 'StudentRegGroupsDetails'])->name('student.registration.groups.details');

        Route::get('/reg/delete/{id}',[StudentRegController::class, 'StudentRegDelete'])->name('student.registration.delete');

        Route::get('/reg/group/delete/{student_id}/{group_id}',[StudentRegController::class, 'StudentRegGroupsDelete'])->name('student.registration.groups.delete');

        // Student Attendance Routes
        Route::get('attendance/student/view', [StudentAttendanceController::class, 'AttendanceStudentView'])->name('student.attendance.view');

        Route::post('attendance/student/add', [StudentAttendanceController::class, 'AttendanceStudentAdd'])->name('student.attendance.add');

        Route::post('attendance/student/store/{group_id}', [StudentAttendanceController::class, 'AttendanceStudentStore'])->name('store.student.attendance');

        Route::post('attendance/student/update/{group_attendance_id}', [StudentAttendanceController::class, 'AttendanceStudentUpdate'])->name('update.student.attendance');

        Route::get('attendance/student/edit/{group_attendance_id}', [StudentAttendanceController::class, 'AttendanceStudentEdit'])->name('student.attendance.edit');

        Route::get('attendance/student/details/{date}/{group}', [StudentAttendanceController::class, 'AttendanceStudentDetails'])->name('student.attendance.details');

        // Registration Fee Routes
        Route::get('/reg/fee/view', [RegistrationFeeController::class, 'RegFeeView'])->name('registration.fee.view');
        Route::get('/reg/fee/classwisedata', [RegistrationFeeController::class, 'RegFeeClassData'])->name('student.registration.fee.classwise.get');
        Route::get('/reg/fee/payslip', [RegistrationFeeController::class, 'RegFeePayslip'])->name('student.registration.fee.payslip');

        // Monthly Fee Routes
        Route::get('/monthly/fee/view', [MonthlyFeeController::class, 'MonthlyFeeView'])->name('monthly.fee.view');

        Route::get('/monthly/fee/classwisedata', [MonthlyFeeController::class, 'MonthlyFeeClassData'])->name('student.monthly.fee.classwise.get');

        Route::get('/monthly/fee/payslip', [MonthlyFeeController::class, 'MonthlyFeePayslip'])->name('student.monthly.fee.payslip');
    });

    /// Account Management Routes
    Route::prefix('accounts')->group(function () {

        Route::get('student/fee/view', [StudentFeeController::class, 'StudentFeeView'])->name('student.fee.view');

        Route::get('student/fee/add', [StudentFeeController::class, 'StudentFeeAdd'])->name('student.fee.add');

        Route::get('student/fee/getstudent', [StudentFeeController::class, 'StudentFeeGetStudent'])->name('account.fee.getstudent');

        Route::post('student/fee/store', [StudentFeeController::class, 'StudentFeeStore'])->name('account.fee.store');

        Route::get('/student/fee/wise', [StudentFeeController::class, 'StudentFeeWise'])->name('student.fee.wise');

        // Employee Salary Routes
        Route::get('account/salary/view', [AccountSalaryController::class, 'AccountSalaryView'])->name('account.salary.view');

        Route::get('account/salary/add', [AccountSalaryController::class, 'AccountSalaryAdd'])->name('account.salary.add');

        Route::get('account/salary/getEmployee', [AccountSalaryController::class, 'AccountSalaryGetEmployee'])->name('account.salary.getemployee');

        Route::post('account/salary/store', [AccountSalaryController::class, 'AccountSalaryStore'])->name('account.salary.store');

        // Other Cost Rotues
        Route::get('other/cost/view', [OtherCostController::class, 'OtherCostView'])->name('other.cost.view');

        Route::get('other/cost/add', [OtherCostController::class, 'OtherCostAdd'])->name('other.cost.add');

        Route::post('other/cost/store', [OtherCostController::class, 'OtherCostStore'])->name('store.other.cost');

        Route::get('other/cost/edit/{id}', [OtherCostController::class, 'OtherCostEdit'])->name('edit.other.cost');

        Route::post('other/cost/update/{id}', [OtherCostController::class, 'OtherCostUpdate'])->name('update.other.cost');

    });

    /// Employee Routes
    Route::prefix('employees')->group(function () {

        /// Registration
        Route::get('/reg/view', [EmployeeRegController::class, 'EmployeeView'])->name('employee.registration.view');

        Route::get('/reg/add', [EmployeeRegController::class, 'EmployeeAdd'])->name('employee.registration.add');

        Route::post('/reg/store', [EmployeeRegController::class, 'EmployeeStore'])->name('store.employee.registration');

        Route::get('/reg/edit/{id}', [EmployeeRegController::class, 'EmployeeEdit'])->name('employee.registration.edit');

        Route::post('/reg/update/{id}', [EmployeeRegController::class, 'EmployeeUpdate'])->name('update.employee.registration');

        Route::get('/reg/details/{id}', [EmployeeRegController::class, 'EmployeeDetails'])->name('employee.registration.details');

        Route::get('/reg/delete/{id}',[EmployeeRegController::class, 'DeleteEmployee'])->name('employee.registration.delete');


        // Employee Salary All Routes
        Route::get('salary/view/{employee_id}', [EmployeeSalaryController::class, 'SalaryView'])->name('employee.salary.view');

        Route::get('/salary/add/{id}', [EmployeeSalaryController::class, 'SalaryAdd'])->name('employee.salary.add');

        Route::get('salary/increment/{id}', [EmployeeSalaryController::class, 'SalaryIncrement'])->name('employee.salary.increment');

        Route::post('salary/store/{employee_id}', [EmployeeSalaryController::class, 'SalaryStore'])->name('employee.salary.store');

        Route::get('salary/details/{id}', [EmployeeSalaryController::class, 'SalaryDetails'])->name('employee.salary.details');

        // Employee Attendance All Routes
        Route::get('attendance/view', [EmployeeAttendanceController::class, 'AttendanceView'])->name('employee.attendance.view');

        Route::get('attendance/add', [EmployeeAttendanceController::class, 'AttendanceAdd'])->name('employee.attendance.add');

        Route::post('attendance/store', [EmployeeAttendanceController::class, 'AttendanceStore'])->name('store.employee.attendance');

        Route::get('attendance/edit/{date}', [EmployeeAttendanceController::class, 'AttendanceEdit'])->name('employee.attendance.edit');

        Route::get('attendance/details/{date}', [EmployeeAttendanceController::class, 'AttendanceDetails'])->name('employee.attendance.details');


        // Employee Monthly Salary All Routes
        Route::get('monthly/salary/view', [MonthlySalaryController::class, 'MonthlySalaryView'])->name('employee.monthly.salary');

        Route::get('monthly/salary/get', [MonthlySalaryController::class, 'MonthlySalaryGet'])->name('employee.monthly.salary.get');

        Route::get('monthly/salary/payslip/{employee_id}', [MonthlySalaryController::class, 'MonthlySalaryPayslip'])->name('employee.monthly.salary.payslip');


    });

});



