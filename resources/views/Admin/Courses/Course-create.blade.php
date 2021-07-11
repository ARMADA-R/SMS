@extends('Admin.index')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('app.title.new-course')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form role="form" action="{{ route('admin.courses.create') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="name">{{ trans('app.courses.name')}}</label>
                                    <input required type="text" name="name" id="name" class="form-control" placeholder="Math" />
                                </div>

                                <div class="form-group col-md">
                                    <label for="code">{{ trans('app.courses.code')}}</label>
                                    <input required type="text" name="code" id="code" class="form-control" placeholder="MT-IT-20" />
                                </div>

                                <div class="form-group col-md">
                                    <label for="level">{{ trans('app.courses.level')}}</label>
                                    <select required class="form-control" name="level" id="level">
                                        <option value="">--</option>
                                        @foreach($levels as $level)
                                        <option value="{{ $level->id }}">{{$level->name .' : '. $level->code }}</option>
                                        @endforeach
                                    </select>
                                    <!-- <input required type="text" name="level" id="level" class="form-control" placeholder="Brown" /> -->
                                </div>
                            </div>
                            <hr class="mt-4">
                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="final_mark">{{ trans('app.courses.total-marks')}}</label>
                                    <input required type="number" name="final_mark" id="final_mark" value="100" class="form-control" min="0" placeholder="100" />
                                </div>
                                <div class="form-group col-md">
                                    <label for="sections_num">{{ trans('app.courses.marks-section-num')}}</label>
                                    <input required type="number" value="1" name="sections_num" id="sections_num" class="form-control" min="1" placeholder="1" />
                                </div>
                            </div>
                            <hr class="mt-4">
                            <div id="mark-sections">
                                <div class="form-row">
                                    <div class="form-group col-md">
                                        <label for="section-1-name">{{ trans('app.courses.section-name')}}</label>
                                        <input required type="text" name="sections_names[]" id="section-1-name" class="form-control" min="0" placeholder="Quiz-1" />
                                    </div>
                                    <div class="form-group col-md">
                                        <label for="section-1-mark">{{ trans('app.courses.section-degres')}}</label>
                                        <div class="form-row text-center">
                                            <div class="col-10">
                                                <input required type="number" name="sections_marks[]" id="section-1-mark" class="form-control" min="1" step="1" placeholder="50" />
                                            </div>
                                            <div class="col-1 text-center" style="padding-bottom: .5rem; padding-top: .5rem; font-weight: bolder;">/</div>
                                            <div class="col-1"><label class="mark-from-total" style="padding-top: .5rem; padding-bottom: .5rem;">100</label></div>
                                        </div>
                                    </div>
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
<script>
    $('#sections_num').change(function() {

        let final_mark = $('#final_mark').val();
        let n = $('#sections_num').val();
        $('#mark-sections').empty();

        for (let i = 0; i < n; i++) {
            $('#mark-sections').append(`<div class="form-row">
                                    <div class="form-group col-md">
                                        <label for="section-` + (i + 1) + `-name">{{ trans('app.courses.section-name')}}</label>
                                        <input required type="text" name="sections_names[]" id="section-` + (i + 1) + `-name" class="form-control" min="0" placeholder="Quiz-` + (i + 1) + `" />
                                    </div>
                                    <div class="form-group col-md">
                                        <label for="section-` + (i + 1) + `-mark">{{ trans('app.courses.section-degres')}}</label>
                                        <div class="form-row text-center">
                                            <div class="col-10">
                                                <input required type="number" name="sections_marks[]" id="section-` + (i + 1) + `-mark" class="form-control" min="1" step="1" placeholder="` + parseInt(final_mark / n) + `" />
                                            </div>
                                            <div class="col-1 text-center" style="padding-bottom: .5rem; padding-top: .5rem; font-weight: bolder;">/</div>
                                            <div class="col-1"><label class="mark-from-total" style="padding-top: .5rem; padding-bottom: .5rem;">` + final_mark + `</label></div>
                                        </div>
                                    </div>
                                </div>`);
        }
    });

    $('#final_mark').change(function() {
        let final_mark = $('#final_mark').val();
        $(".mark-from-total").each(function() {
            $(this).empty();;
            $(this).html(final_mark);
        });
    });


    $('#final_mark').change(function() {
        let final_mark = $('#final_mark').val();
        $(".mark-from-total").each(function() {
            $(this).empty();;
            $(this).html(final_mark);
        });
    });


    $('input[name^="sections_names"]').change(function() {

        var $current = $(this);

        $('input[name^="sections_names"]').each(function() {
            if ($(this).val() == $current.val() && $(this).attr('id') != $current.attr('id')) {
                alert('duplicate found!');
            }

        });
    });
</script>

@endpush
@push('style')


@endpush
@endsection