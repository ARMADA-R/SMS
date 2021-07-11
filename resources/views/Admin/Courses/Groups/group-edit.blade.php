@extends('Admin.index')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header  d-flex align-items-center">
                <h3 class="card-title">{{ trans('app.title.new-course-group')}}</h3>
                <div class="ml-auto">
                    <h5 class="card-title">{{ $study_group->course_name }} : {{ $study_group->course_code }}</h5>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form role="form" action="{{ route('admin.course.group.edit', $study_group->course_id) }}" method="POST">
                            @csrf
                            <input required type="hidden" value="{{ $study_group->id }}" name="study_group_id" id="study_group_id"/>
                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="name">{{ trans('app.courses.group.name')}}</label>
                                    <input required value="{{ $study_group->name }}" type="text" name="name" id="name" class="form-control" placeholder="Math-1" />
                                </div>

                                <div class="form-group col-md">
                                    <label for="code">{{ trans('app.courses.group.teacher')}}</label>
                                    <select name="teacher" id="teacher" class="form-control" required>
                                        <option value=""> -- </option>
                                        @foreach($teachers as $teacher)
                                        <option value="{{$teacher->id}}" {{ $study_group->teacher_id == $teacher->id ? 'selected':'' }}> {{ $teacher->name }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md">
                                    <label for="level">{{ trans('app.courses.group.season')}}</label>
                                    <select name="season" id="season" class="form-control" required>
                                        <option value=""> -- </option>
                                        @foreach($seasons as $season)
                                        <option value="{{$season->id}}" {{ $study_group->season_id == $season->id ? 'selected':'' }}> {{ $season->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- <hr class="mt-4"> -->
                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="final_mark">{{ trans('app.courses.group.day')}}</label>
                                    <select name="day" id="day" class="form-control" required>
                                        <option value=""> -- </option>
                                        <option value="sat" {{ $study_group->day == 'sat' ? 'selected':'' }} > {{ trans('app.days.saturday') }} </option>
                                        <option value="sun" {{ $study_group->day == 'sun' ? 'selected':'' }} > {{ trans('app.days.sunday') }} </option>
                                        <option value="mon" {{ $study_group->day == 'mon' ? 'selected':'' }} > {{ trans('app.days.monday') }} </option>
                                        <option value="tue" {{ $study_group->day == 'tue' ? 'selected':'' }} > {{ trans('app.days.tuesday') }} </option>
                                        <option value="wed" {{ $study_group->day == 'wed' ? 'selected':'' }} > {{ trans('app.days.wedneday') }} </option>
                                        <option value="thu" {{ $study_group->day == 'thu' ? 'selected':'' }} > {{ trans('app.days.thursday') }} </option>
                                        <option value="fri" {{ $study_group->day == 'fri' ? 'selected':'' }} > {{ trans('app.days.friday') }} </option>
                                    </select>
                                </div>
                                <div class="form-group col-md">
                                    <label for="start">{{ trans('app.courses.group.start')}}</label>
                                    <input required type="time" value="{{ date('H:i', strtotime($study_group->start))  }}" name="start" id="start" class="form-control"/>
                                </div>
                                <div class="form-group col-md">
                                    <label for="end">{{ trans('app.courses.group.end')}}</label>
                                    <input required type="time" value="{{ date('H:i', strtotime($study_group->end)) }}" name="end" id="end" class="form-control"/>
                                </div>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-info">{{ trans('app.save')}}</button>
                                <button type="reset" class="btn  btn-outline-secondary ">{{ trans('app.reset')}}</button>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                    <!-- /.col-sm-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
    <!-- /.col -->
</div>
<!-- /.row -->




@push('scripts')

@endpush
@push('style')


@endpush
@endsection