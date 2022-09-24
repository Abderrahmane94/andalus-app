<?php

namespace App\Console\Commands;

use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Models\StudentGroup;
use App\Services\StudentService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MonthlyPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add fee amount for all student in groups that have monthly payment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(StudentService $studentService)
    {
        $student_groups = StudentGroup::where('fee_type_id', 1)->where('active', true)->get();
        $current_month = date('m');
        $days_in_current_month = date('t');

        foreach ($student_groups as $student_group) {
            $amount_to_be_paid = FeeCategoryAmount::where('fee_category_id', 2)
                ->where('class_id', $student_group->class_id)->first();
            $assign_students = AssignStudent::where('group_id', $student_group->id)->get();

            foreach ($assign_students as $assign_student) {
                $studentService->addAccountStudentFee($assign_student->student_id,$assign_student->group_id,2,$amount_to_be_paid->amount,0,0,$current_month,$days_in_current_month,false,false);
            }
        }
        Log::info('Monthly payment, Month: '.$current_month.' added successfully.');
    }
}
