@extends('Admin.index')
@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-10 mx-auto ">
        <div class="row">

            <div class="col-sm-9">
                <div class="h3  page-title ">{{ trans('app.announcement.edit-announcements')}}</div>
            </div>
            <div class="col-sm-3 ">
                <div style="margin-top: 5px;">
                    <label for="">{{ trans('app.announcement.preview')}} </label>
                    <input type="checkbox" onchange="showPreview()" class="checkbox" style="display: none;" id="announcement-preview" data-bootstrap-switch="">
                </div>
            </div>
        </div>

        <hr class="mt-4">
        <div class="my-4">
            <div class="form-row">
                <!-- Date and time range -->
                <div class="form-group col">
                    <label>{{trans('app.announcement.date-range')}}</label>

                    <div class="input-group">
                        {{ $announcement->announcementDatetimeRange }}
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <div class="form-group col">
                    <label for="audience">{{ trans('app.announcement.audience')}}</label>
                    <div class="input-group">

                        @foreach($audience as $audi)
                        @if(($announcement->audience == $audi->_id))
                        {{ $audi->name }}
                        @endif
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col ">
                    <label for="description">{{ trans('app.announcement.description')}}</label>
                    <div class="input-group">{{ $announcement->description }}</div>
                </div>
            </div>

            <div class="form-row">
                <!-- Color Picker -->
                <div class="form-group col">
                    <label>{{ trans('app.announcement.announcement-background')}}</label>
                    <div class="input-group">
                        {{$announcement->getAttribute('announcement-background-color')}}
                        <i id="" class="fas fa-square " style=" margin: 4px; color: {{$announcement->getAttribute('announcement-background-color')}};"></i>
                    </div>
                    <div style="display: none;" class="input-group my-colorpicker2 colorpicker-element" data-colorpicker-id="2">
                        <input disabled type="text" id="color-picker" value="{{$announcement->getAttribute('announcement-background-color')}}" class="form-control" data-original-title="" title="">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i id="" class="fas fa-square" style="color: {{$announcement->getAttribute('announcement-background-color')}};"></i>
                            </span>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <div class="form-group margin col">
                    <label>{{ trans('app.announcement.border-radius')}}</label>
                    <div class="input-group">

                        {{ $announcement->getAttribute('border-radius') }} PX
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-row">
                <div class="form-group col" style="margin-bottom: 0rem;">
                    <div class="custom-control custom-checkbox" style="padding-left: 0rem;">
                        <input disabled name="closeable" {{ $announcement->closeable? 'checked' : '' }} class="inp-cbx" type="checkbox" style="display: none;" id="can-closed" />
                        <label class="cbx" style="margin-left: 0px;" for="can-closed">
                            <span>
                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
                            <span class="text-secondary">{{ trans('app.announcement.can-closed')}}</span>
                        </label>
                        <span for="">{{ trans('app.announcement.can-closed-hint')}}</label>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-row">
                <div class="form-group col ">
                    <label for="description">{{ trans('app.announcement.text')}}</label>
                    <div rows="5" class="input-group"><?php echo $announcement->getAttribute("announcement-text") ?></div>
                </div>
            </div>

            <hr class="my-4">

            <div class="card card-default collapsed-card">
                <div class="card-header" style="justify-content: center;">
                    <h3 class="card-title" style="line-height: 1.5;">{{ trans('app.announcement.timer.title')}}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                        <input type="checkbox" onchange="checkTimer()" style="display: none;" class="checkbox" name="hasTimer" id="timer" data-bootstrap-switch="" {{ $announcement->hasTimer? 'checked' :''}}>

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('app.announcement.timer.background')}}</label>
                                <div class="input-group my-colorpicker1 colorpicker-element" data-colorpicker-id="2">
                                    <input disabled type="text" id="timer-background-color-picker" name="timer-background-color" value="{{ $announcement->getAttribute('timer-background-color') }}" class="form-control" data-original-title="" title="">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i id="" class="fas fa-square" style="color: rgb(221, 86, 86);"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>{{ trans('app.announcement.timer.font-color')}}</label>
                                <div class="input-group my-colorpicker3 colorpicker-element" data-colorpicker-id="2">
                                    <input disabled type="text" id="timer-font-color-picker" name="timer-font-color" value="{{ $announcement->getAttribute('timer-font-color') }}" class="form-control" data-original-title="" title="">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i id="" class="fas fa-square" style="color: {{ $announcement->getAttribute('timer-font-color') }};"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>{{ trans('app.announcement.timer.elements')}}</label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="custom-control" style="padding-left: 0rem;">
                                            <input disabled class="inp-cbx" type="checkbox" style="display: none;" id="with-seconds" name="with-seconds" {{$announcement->getAttribute('with-seconds')? 'checked' :''}} />
                                            <label class="cbx" for="with-seconds">
                                                <span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg>
                                                </span>
                                                <span class="text-secondary">{{ trans('app.announcement.timer.seconds')}}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="custom-control" style="padding-left: 0rem;">
                                            <input disabled class="inp-cbx" type="checkbox" style="display: none;" id="with-minutes" name="with-minutes" {{$announcement->getAttribute('with-minutes')? 'checked' :''}} />
                                            <label class="cbx" for="with-minutes">
                                                <span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg>
                                                </span>
                                                <span class="text-secondary">{{ trans('app.announcement.timer.minutes')}}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="custom-control" style="padding-left: 0rem;">
                                            <input disabled class="inp-cbx" type="checkbox" style="display: none;" id="with-hours" name="with-hours" {{$announcement->getAttribute('with-hours')? 'checked' :''}} />
                                            <label class="cbx" for="with-hours">
                                                <span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg>
                                                </span>
                                                <span class="text-secondary">{{ trans('app.announcement.timer.hours')}}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="custom-control" style="padding-left: 0rem;">
                                            <input disabled class="inp-cbx" type="checkbox" style="display: none;" id="with-days" name="with-days" {{$announcement->getAttribute('with-days')? 'checked' :''}} />
                                            <label class="cbx" for="with-days">
                                                <span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg>
                                                </span>
                                                <span class="text-secondary">{{ trans('app.announcement.timer.days')}}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="display: none;">
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')

<script src="{{ url('/design/AdminLTE') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
    $("#body").prepend('<div id="announcement-alerts" class="fixed-top" style="z-index:100000; position: sticky; "></div>');
    $('#announcement-alerts').css('display', 'none');

    $("#announcement-alerts").prepend('<div class="row flex-fill flex-column flex-md-row centerlize-elements" id="announcement-row"><div id="announcement-view" class="announcement-view col-md"></div></div>');
    $("#announcement-row").css("background-color", $('#color-picker').val());

    $("#announcement-view").append('<?php echo $announcement->getAttribute("announcement-text") ?>');

    var TimerBackgroundStyle;
    var TimerFontStyle = ' color: ' + $("#timer-font-color-picker").val() + '; ';
    var withSeconds = true;
    var withMinutes = true;
    var withHours = true;
    var withDays = true;
</script>
<script>
    $(function() {

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

    })

    $(function() {

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

    })
</script>

<script>
    function submitAnnouncement() {
        $('#announcement-alerts').removeClass('fixed-top');
        document.getElementById('announcement-toSubmit').value = $('#announcement-row').get(0).outerHTML;
        return true;
    };

    function checkTimer() {
        if (document.getElementById('timer').checked) {
            $("#down-timer").remove();
            $("#announcement-row").prepend('<div id="down-timer" class="col-md-3 countdown"><div id="timer-clock"></div></div>');
            $("#down-timer").css("background-color", $('#timer-background-color-picker').val());
        } else {
            $("#down-timer").remove();
        }
    };

    function showPreview() {
        if (document.getElementById('announcement-preview').checked) {
            $('#announcement-alerts').css('display', '');
        } else {
            $('#announcement-alerts').css('display', 'none');
        }

    }



    $("#with-seconds").change(function() {
        if (this.checked) {
            withSeconds = true;
        } else {
            withSeconds = false;
        }
    });
    $("#with-minutes").change(function() {
        if (this.checked) {
            withMinutes = true;
        } else {
            withMinutes = false;
        }
    });
    $("#with-hours").change(function() {
        if (this.checked) {
            withHours = true;
        } else {
            withHours = false;
        }
    });
    $("#with-days").change(function() {
        if (this.checked) {
            withDays = true;
        } else {
            withDays = false;
        }
    });

    var announcementStartDate = <?php echo $announcement->announcementStartDate ?>;
    var announcementEndDate = <?php echo $announcement->announcementEndDate ?>;
    $("#announcement-datetime-range").change(function() {
        if (data = $('#announcement-datetime-range').data('daterangepicker')) {
            announcementStartDate = data.startDate._d.getTime();
            announcementEndDate = data.endDate._d.getTime();
            $('#announcementStartDate').val(announcementStartDate);
            $('#announcementEndDate').val(announcementEndDate);
        }
    });
</script>



<script>
    // Update the count down every 1 second
    var x = setInterval(function() {

        // get the element with id="timer-clock"
        var timerElement = document.getElementById("timer-clock");
        if (timerElement) {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = announcementEndDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);


            // Output the result in an element
            timerElement.innerHTML =
                '<div class="timer-content"><div class="timer-box"><div style="' + TimerFontStyle + '" class="timer-box-div">' +
                (withDays ? (days + "D") : '') + ((withHours || withMinutes || withSeconds) && withDays ? (" : ") : '') +
                (withHours ? (hours + "H") : '') + ((withMinutes || withSeconds) && withHours ? (" : ") : '') +
                (withMinutes ? (minutes + "M") : '') + ((withSeconds) && withMinutes ? (" : ") : '') +
                (withSeconds ? (seconds + "S") : '') + '</div></div></div>';

            // If the count down is over, write some text
            if (distance < 0) {
                // clearInterval(x);
                timerElement.innerHTML = "EXPIRED";
            }
        }

    }, 1000);
</script>

<script>
    $(function() {
        var range = $('#range');

        /* ION SLIDER */
        range.ionRangeSlider({
            min: 0,
            max: 15,
            type: 'single',
            step: 0.1,
            postfix: ' px',
            prettify: false,
            hasGrid: true,

        })
    })
</script>
@endpush

@push('style')

<style>
    body {
        color: #8e9194;
        background-color: #f4f6f9;
    }

    .text-muted {
        color: #ce1123 !important;
    }

    .text-muted {
        font-weight: 100;
    }

    .mb-8 {
        margin-bottom: 5rem !important
    }

    .mt-8 {
        margin-top: 5rem !important
    }

    .mt-4 {
        margin-top: 2.5rem !important
    }

    .ml-4 {
        margin-left: 1.5rem !important
    }

    /* The alert message box */
    .announcement-view {
        padding: 20px;
        font-size: 2.0416666666666667vw;
        /* margin-bottom: 15px; */
        justify-content: center;

    }

    .announcement-view>h1 {
        font-size: 2.833333333333335vw;
        /* justify-content: center; */
    }

    .announcement-view>h2 {
        font-size: 2.1625vw;
        /* justify-content: center; */
    }

    .announcement-view>h3 {
        font-size: 1.21875vw;
        /* justify-content: center; */
    }

    .announcement-view>h4 {
        font-size: 1.0416666666666667vw;
        /* justify-content: center; */
    }

    .announcement-view>h5 {
        font-size: 0.8645833333333334vw;
        /* justify-content: center; */
    }

    .announcement-view>h6 {
        font-size: 0.6979166666666666vw;
        /* justify-content: center; */
    }

    .announcement-view>p {
        font-size: 1.0416666666666667vw;
        /* justify-content: center; */
    }

    .centerlize-elements {
        align-items: center;
        justify-content: center;
    }


    .timer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, 25.6041666666666665vw);
        grid-gap: 5px;
        justify-content: center;

    }

    .timer-box>div {
        height: 3.6041666666666665vw;
        /* background: rgb(221, 86, 86);
        border-radius: 0.5208333333333334vw;
        border: 0.06510416666666667vw solid #fff; */
        color: #fff;
        font-family: Exo, arial, sans-serif;
        font-size: 2.0416666666666667vw;
        display: flex;
        align-items: center;
        justify-content: center;
        /* margin-bottom: 20px; */
    }


    p {
        margin-top: 0.0vw;
        margin-bottom: 0.0vw !important;
    }

    .bootstrap-switch-id-timer {
        margin-left: 10px;
        margin-right: 10px;
    }


    /* .form-control {
        display: block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5;
        color: #4d5154;
        background-color: #ffffff;
        background-clip: padding-box;
        border: 1px solid #eef0f3;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    } */
</style>
<style>
    .cbx {
        margin: auto;
        margin-left: 10px;
        -webkit-user-select: none;
        user-select: none;
        cursor: pointer;
    }

    .cbx span {
        display: inline-block;
        vertical-align: middle;
        transform: translate3d(0, 0, 0);
    }

    .cbx span:first-child {
        position: relative;
        width: 18px;
        height: 18px;
        border-radius: 3px;
        transform: scale(1);
        vertical-align: middle;
        border: 1px solid #9098A9;
        transition: all 0.2s ease;
    }

    .cbx span:first-child svg {
        position: absolute;
        top: 3px;
        left: 2px;
        fill: none;
        stroke: #FFFFFF;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 16px;
        stroke-dashoffset: 16px;
        transition: all 0.3s ease;
        transition-delay: 0.1s;
        transform: translate3d(0, 0, 0);
    }

    .cbx span:first-child:before {
        content: "";
        width: 100%;
        height: 100%;
        background: #506EEC;
        display: block;
        transform: scale(0);
        opacity: 1;
        border-radius: 50%;
    }

    .cbx span:last-child {
        padding-left: 8px;
    }

    .cbx:hover span:first-child {
        border-color: #506EEC;
    }

    .inp-cbx:checked+.cbx span:first-child {
        background: #3c8dbc;
        border-color: #3c8dbc;
        animation: wave 0.4s ease;
    }

    .inp-cbx:checked+.cbx span:first-child svg {
        stroke-dashoffset: 0;
    }

    .inp-cbx:checked+.cbx span:first-child:before {
        transform: scale(1.5);
        opacity: 0;
        transition: all 0.6s ease;
    }

    @keyframes wave {
        50% {
            transform: scale(0.9);
        }
    }
</style>

@endpush
@endsection
