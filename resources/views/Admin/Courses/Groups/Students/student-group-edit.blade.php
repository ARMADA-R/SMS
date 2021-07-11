@extends('Admin.index')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header ">
                <h3 class="card-title">{{ trans('app.title.student-group-details')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- checkbox -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <h3>{{ $group->name }}</h3>
                                    <p>{{ $group->season }}</p>
                                </div>
                                <div class="col">
                                    <p>{{ $group->teacher }}</p>

                                    <p>
                                        {{ $group->day .' : '.  $group->start .' - '. $group->end }}
                                    </p>

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ trans('app.created-at')}}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{(new Carbon\Carbon( $group->created_at ))->format('Y-m-d H:i')}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ trans('app.updated-at')}}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{(new Carbon\Carbon( $group->updated_at ))->format('Y-m-d H:i')}}
                                </div>
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-sm-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title">{{ $student->first_name.' '. $student->last_name }}</h3>
                <div class="ml-auto">
                    <div href="" class=" float-left">{{ $student->id }}</div>
                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form" action="{{ route('admin.course.group.student.edit', [ $group->id, $student->id]) }}" method="POST">
                    @csrf
                    <table class="table table-striped table-bordered responsive rounded-lg" id="course-group-table" role="grid" aria-describedby="course-group-table_info">
                        <thead>
                            <tr role="row">
                                @foreach(json_decode($student_grades->grades, true) as $key => $value)
                                <th class="text-center" title="{{$key}}">{{$key}}</th>
                                @endforeach
                                <th class="text-center" title="Total">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr role="row" class="odd">
                                <?php $total = 0; ?>
                                @foreach(json_decode($student_grades->grades, true) as $key => $value)
                                <td class="text-center dtr-control">
                                    <input required value="{{ $value }}" type="number" min="0" max="{{ isset($group->grades_schema)?(json_decode($group->grades_schema, true)['grade_sections'][$key]) : '' }}" name="{{$key}}"class="text-center form-control"/>
                                    <?php $total += $value; ?>
                                </td>
                                @endforeach
                                <td class="text-center dtr-control">
                                    {{ $total }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">{{ trans('app.save')}}</button>
                        <button type="reset" class="btn  btn-outline-secondary float-right">{{ trans('app.reset')}}</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title">{{ $student->first_name.' '. $student->last_name }}</h3>
                <div class="ml-auto">
                    <div href="" class=" float-left">{{ $student->id }}</div>
                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body" id="calendar-card">
                <button onclick="ajaxs()">👍</button>
                <div onresize="reSize()" id='calendar'></div>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->




@push('scripts')
<script src="{{ url('design') }}/fullcalendar/lib/main.js"></script>
<script src="{{ url('design') }}/CSSElementQuery/src/ResizeSensor.js"></script>
<script src="{{ url('design') }}/CSSElementQuery/src/ElementQueries.js"></script>
<script>
    function ajaxs() {

        $.ajax({
            url: "{{ route('admin.attendance.getBy.group.student.edit',[$group->id,$student->id]) }}",
            success: function(result) {
                console.log((result[0]['status']));
                // $("#div1").html(result);
            }
        });

    }
</script>

<script>
    var calendar = null;
    document.addEventListener('DOMContentLoaded', function() {

        var events;
        var userEvents = [];
        // $.ajax({
        //     url: "{{ route('admin.attendance.getBy.group.student',[$group->id,$student->id]) }}",
        //     success: function(result) {
        //         console.log(result);
        //         events = result;
        //     }
        // });

        // events.forEach(element => {
        //     userEvents.push({
        //         title: 'Conference',
        //         start: '2020-09-11',
        //         end: '2020-09-13',
        //         backgroundColor: '#abcdef',
        //     });
        // });

        var calendarEl = document.getElementById('calendar');

        calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prevYear,prev,next,nextYear today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },
            // plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
            // height: 300,
            // expandRows: true,
            initialDate: '2020-09-12',
            navLinks: true, // can click day/week names to navigate views
            // editable: true,
            locale: 'ar',
            buttonIcons: true, // show the prev/next text
            dayMaxEvents: true, // allow "more" link when too many events
            events: [{
                    title: 'All Day Event',
                    start: '2020-09-01'
                },
                {
                    title: 'Long Event',
                    start: '2020-09-07',
                    end: '2020-09-10'
                },
                {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2020-09-09T16:00:00'
                },
                {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2020-09-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2020-09-11',
                    end: '2020-09-13'
                },
                {
                    title: 'Meeting',
                    start: '2020-09-12',
                    end: '2020-09-12'
                },
                {
                    title: 'mMeeting',
                    start: '2020-09-14T10:30:00',
                    end: '2020-09-14T12:30:00',
                    eventColor: '#000000',
                    backgroundColor : '#000000',
                    // displayEventTime  : 'false',
                },
                {
                    title: 'Lunch',
                    start: '2020-09-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2020-09-12T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2020-09-12T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2020-09-12T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2020-09-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2020-09-28'
                }
            ]
        });

        calendar.render();
    });

    var element = document.getElementById("calendar-card");
    var last = Date.now();
    new ResizeSensor(element, function() {
        if ((Date.now() - last) >= 500) {
            console.log(Date.now() - last);
            last = Date.now();
            setTimeout(function() {
                calendar.updateSize();
            }, 500);
        }
    });
</script>
@endpush

@push('style')
<link href="{{ url('design') }}/fullcalendar/lib/main.css" rel='stylesheet' />
<style>
    a {
        color: #121317;
        text-decoration: none;
        background-color: transparent;
    }
</style>
@endpush
@endsection