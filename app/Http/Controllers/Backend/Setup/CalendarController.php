<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\SetupService;
use App\Services\UserService;

class CalendarController extends Controller
{
    protected $setupService;

    public function __construct(SetupService $setupService)
    {
        $this->setupService = $setupService;
    }

    public function index()
    {
        $student_groups = $this->setupService->getActiveStudentGroup();

        $events = [];

        foreach ($student_groups as $student_group) {
            if ($student_group->group_type == 'جماعي') {
                foreach  ($student_group->learningseances as $learning_seance) {
                    $events[] = [
                        'title' => $student_group->name,
                        'startTime' => $learning_seance->start_time,
                        'endTime' => $learning_seance->end_time,
                        'startRecur' => $student_group->start_date,
                        'endRecur' => $student_group->end_date,
                        'color' => $learning_seance->room->color,
                        'description' => $student_group->name,
                        'daysOfWeek' => [$learning_seance->day]
                    ];
                }
            } elseif ($student_group->group_type == 'فردي') {
                $events[] = [
                    'title' => $student_group->name,
                    'start' => $student_group->alone_date.'T'.$student_group->start_time,
                    'end' => $student_group->alone_date.'T'.$student_group->end_time,
                    'color' => $student_group->room->color,
                    'description' => $student_group->name,
                ];
            }
        }
        return view('backend.setup.calendar.view-calendar', ['events' => $events]);
    }
}
