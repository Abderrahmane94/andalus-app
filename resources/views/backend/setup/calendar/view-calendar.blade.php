@extends('admin.adminBase')
@section('admin')

    <link href='{{ asset('/calendar-lib/main.css') }}' rel='stylesheet' />
    <script src='{{ asset('/calendar-lib/main.js') }}'></script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var groups = @json($events);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },

                locale: 'ar-dz',

                buttonText: {
                    prev: 'السابق',
                    next: 'التالي',
                    today: 'اليوم',
                    month: 'شهر',
                    week: 'أسبوع',
                    day: 'يوم',
                    list: 'أجندة',
                },
                weekText: 'أسبوع',
                allDayText: 'اليوم كله',
                moreLinkText: 'أخرى',
                noEventsText: 'أي أحداث لعرض',
                direction: 'rtl',
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                editable: false,
                selectable: false,
                firstDay: 5,

                events: groups,
            });

            calendar.render();
        });

    </script>
    <style>

        #calendar {
            max-width: 1100px;
            margin: 0 auto;
            border-right: 1px solid #ddd;
            border-left: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }

    </style>
    <div class="container">
        <div class="card mb-4">
            <div class="card-body">
                <div id="calendar">

                </div>
            </div>
        </div>
    </div>



@endsection
