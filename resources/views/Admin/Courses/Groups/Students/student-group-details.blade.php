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

                <table class="table table-striped table-bordered responsive " id="course-group-table" role="grid" aria-describedby="course-group-table_info">

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
                            <td class="text-center dtr-control">{{$value}}</td>
                            <?php $total += $value; ?>
                            @endforeach
                            <td class="text-center dtr-control">
                                {{ $total }}
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                <div id='calendar'></div>

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
            url: "{{ route('admin.attendance.getBy.group.student',[$group->id,$student->id]) }}",
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
        $.ajax({
            url: "{{ route('admin.attendance.getBy.group.student',[10,8]) }}",//$group->id $student->id
            success: function(result) {
                console.log(result.events);
                events = result.events;

                events.forEach(element => {
                    userEvents.push({
                        title: element.title,
                        start: element.date,
                        // end: '2020-09-13',
                        backgroundColor: (element.status == 'absent' ? '#ab1717' : (element.status == 'present' ? '#17ab3b' : (element.status == 'justified' ? '#dad943' : '#848484'))),
                    });
                });

                renderCalendar(userEvents);
            }
        });


        
    });

    function renderCalendar(userEvents) {
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
            // initialDate: '2020-09-12',
            navLinks: true, // can click day/week names to navigate views
            // editable: true,
            locale: 'ar',
            buttonIcons: true, // show the prev/next text
            dayMaxEvents: true, // allow "more" link when too many events
            events: userEvents
        });
        console.log(userEvents);

        calendar.render();
    }

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
<!-- <link rel="stylesheet" href="{{ url('design') }}/fullcalendar-3/core/main.min.css">
    <link rel="stylesheet" href="{{ url('design') }}/fullcalendar-3/daygrid/main.min.css">
    <link rel="stylesheet" href="{{ url('design') }}/fullcalendar-3/timegrid/main.min.css"> -->
    <!-- <link rel="stylesheet" href="{{ url('design') }}/fullcalendar-3/list/main.min.css"> -->
<style>
    a {
        color: #121317;
        text-decoration: none;
        background-color: transparent;
    }
</style>
@endpush
@endsection