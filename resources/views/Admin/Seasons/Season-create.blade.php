@extends('Admin.index')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('app.title.new-season')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form role="form" action="{{ route('admin.seasons.create') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="name">{{ trans('app.seasons.name')}}</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Brown" />
                                </div>
                                
                                <div class="form-group col">
                                    <label for="year">{{ trans('app.seasons.year')}}</label>
                                    <input type="number" name="year" id="year" class="form-control" placeholder="2021" />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="start_date">{{ trans('app.seasons.start-date')}}</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Brown" />
                                </div>
                                
                                <div class="form-group col">
                                    <label for="end_date">{{ trans('app.seasons.end-date')}}</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="2021" />
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