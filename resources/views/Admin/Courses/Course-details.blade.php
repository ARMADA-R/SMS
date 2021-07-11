@extends('Admin.index')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header ">
                <h3 class="card-title">{{ trans('app.title.course-details')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- checkbox -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <h3>{{ $course->name }}</h3>
                                    <p>{{ $course->code }}</p>
                                </div>
                                <div class="col">
                                    <p>{{ $course->level }}</p>
                                    <p>
                                        {{ trans('app.courses.grades-schema') }} :
                                        @foreach($course->Grades_schema['grade_sections'] as $section_name => $section_mark)
                                        {{ $section_mark }} &nbsp;
                                        @endforeach
                                    </p>

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ trans('app.created-at')}}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{(new Carbon\Carbon( $course->created_at ))->format('Y-m-d H:i')                                    }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ trans('app.updated-at')}}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{(new Carbon\Carbon( $course->updated_at ))->format('Y-m-d H:i')                                     }}
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
                <h3 class="card-title">{{ trans('app.courses.groups')}}</h3>
                <div class="ml-auto">
                    <a href="{{ route('admin.course.group.create',$course->id ) }}" class="btn btn-info float-left"><i class="fas fa-plus-circle"></i> {{ trans('app.courses.new-group')}}</a>
                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped datatable table-hover responsive dataTable no-footer dtr-inline" id="courses-table" role="grid" aria-describedby="courses-table_info">
                        <thead>
                            <tr role="row">
                                <th class="text-center" title="Name">Name</th>
                                <th class="text-center" title="Teacher">Teacher</th>
                                <th class="text-center" title="Season">Season</th>
                                <th class="text-center" title="day">day</th>
                                <th class="text-center" title="start">start</th>
                                <th class="text-center" title="end">end</th>
                                <th class="text-center" title="end">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                            <tr role="row" class="odd">
                                <td class="text-center">{{ $group->name }}</td>
                                <td class="text-center">{{ $group->teacher }}</td>
                                <td class="text-center">{{ $group->seasons }}</td>
                                <td class="text-center">{{ $group->day }}</td>
                                <td class="text-center">{{ $group->start }}</td>
                                <td class="text-center">{{ $group->end }}</td>
                                <td class="text-center" class=" text-center">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-4">
                                            <a type="button" class="btn btn-sm btn-info " title="Students" style="margin: 0px;" id="group_{{ $group->id }}" href="{{ route('admin.course.group.details', $group->id) }}">
                                                <i class="fas fa-users"></i>
                                            </a>
                                        </div>
                                        <div class="col-lg-4">
                                            <a type="button" class="btn btn-sm btn-info " title="Edit" style="margin: 0px;" id="edit_{{ $group->id }}" href="{{ route('admin.course.group.edit', $group->id) }}">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </div>
                                        <div class="col-lg-4">
                                            <a type="button" class="btn btn-sm btn-danger " title="Delete" style="margin: 0px;" data-toggle="modal" onclick="{
                                                    if (confirm('Are you sure you want to delete this group?')) {
                                                        document.getElementById('{{ $group->id }}').submit();
                                                    }
                                                }">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <form role="form" id="{{ $group->id }}" action="{{ route('admin.course.group.delete') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $group->id }}">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

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




@push('style')

@endpush
@endsection