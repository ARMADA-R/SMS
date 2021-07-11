@extends('Admin.index')
@section('content')

<div class="row justify-content-center">
    <div class="col-11 /*col-lg-10*/ /*col-xl-8*/ mx-auto">
        <h2 class="h3 mb-4 page-title">{{trans('app.teachers.teachers')}}</h2>
        <div class="my-4">
            <!-- <hr class="my-4" /> -->
            <div class="card">
                <div class="card-header">

                <h5 class="card-title" style="line-height: 2;">{{trans('app.teachers.create-teacher')}}</h5> 
                                        
                </div>
                <div class="card-body">
                    <form role="form" action="{{ route('admin.teacher.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id">
                        <!-- <hr class="my-4" /> -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">{{trans('app.teachers.name')}}</label>
                                <input required type="text" name="name" id="name" class="form-control" placeholder="Brown John" />
                            </div>

                            <div class="form-group col-md">
                                <label for="degree">{{trans('app.teachers.degree')}}</label>
                                <input required type="text" name="degree" class="form-control" id="degree" placeholder="BS." />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info">{{trans('app.save')}}</button>
                        <button type="reset" class="btn btn-outline-secondary">{{trans('app.reset')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




@push('scripts')
<!-- excel library JavaScript -->
<script src="{{ url('') }}/js/EXCEL/parseTable.js"></script>
<script src="{{ url('') }}/js/EXCEL/shim.js"></script>
<script src="{{ url('') }}/js/EXCEL/xlsx.full.min.js"></script>
<script src="{{ url('') }}/js/EXCEL/jquery-ui.min.js"></script>
<script src="{{ url('') }}/js/EXCEL/jquery.dragtable.js"></script>
<script src="{{ url('') }}/js/EXCEL/FileSaver.min.js"></script>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script> -->
<!-- <script src="{{ url('') }}/js/DragDrop/jquery.dragtable.js"></script> -->

<script>
    function ExcelSubmit() {

        getdata();
        document.getElementById('excel-form-submit').click();
    };

    var columns = {
        'fname': '<?php echo trans('app.students.fname'); ?>',
        'lname': '<?php echo trans('app.students.lname'); ?>',
        'father_name': '<?php echo trans('app.students.father-name'); ?>',
        'mother_name': '<?php echo trans('app.students.mother-name'); ?>',
    };

    $('.custom-file input').change(function(e) {
        if (e.target.files.length) {
            $(this).next('.custom-file-label').html(e.target.files[0].name);
        }
    });
</script>


<script>
    function getdata() {
        //rename and get data from table as js array 
        var index = 0;
        var thArray = [];

        $('#excel-table > thead > tr > th > select').each(function() {
            thArray.push($(this).val());
        });

        $('#excel-table > thead > tr > th').each(function() {
            $(this).text(thArray[index++]);
        });

        var table = document.getElementById("excel-table");
        var data = parseTable(table);

        //convert js array to JSON and passing it to php by html input
        document.getElementById('jstable').value = JSON.stringify(data);
    };

    function uniqueSelects() {
        $('select').on('change', function() {
            var selectedValues = [];
            $('select').each(function() {
                var thisValue = this.value;
                if (thisValue !== '')
                    selectedValues.push(thisValue);
            }).each(function() {
                $(this).find('option:not(:selected)').each(function() {
                    if ($.inArray(this.value, selectedValues) === -1) {
                        $(this).removeAttr('hidden');
                    } else {
                        if (this.value !== '')
                            $(this).attr('hidden', 'hidden');
                    }
                });
            });
        });
    }
</script>




<script>
    var X = XLSX;
    var XW = {
        /* worker message */
        msg: 'xlsx',
        /* worker scripts */
        worker: '<?php url(''); ?>/js/EXCEL/xlsxworker.js'
    };
    var global_wb;

    var process_wb = (function() {
        var OUT = document.getElementById('out');
        var HTMLOUT = document.getElementById('htmlout');

        var to_html = function to_html(workbook) {
            HTMLOUT.innerHTML = "";

            workbook.SheetNames.forEach(function(sheetName) {

                var htmlstr = X.write(workbook, {
                    id: "excel-table",
                    editable: true,
                    sheet: sheetName,
                    type: 'string',
                    bookType: 'html'
                });
                var counter = 0;
                for (var index = 1; index < htmlstr.length - 3; index++) {
                    if (htmlstr[index - 1] == '<' && htmlstr[index] == 't' && htmlstr[index + 1] == 'd') {
                        counter++;
                    }
                    if (htmlstr[index] == '/' && htmlstr[index + 1] == 't' && htmlstr[index + 2] == 'r')
                        break;
                }

                var head = "<thead><tr>";
                for (let index = 0; index < counter; index++) {
                    let options = '';
                    Object.keys(columns).forEach(function(key) {
                        // do something with obj[key]
                        options += '<option value="' + key + '"> ' + columns[key] + ' </option>'
                    });

                    head += "<th>" +
                        ' <select required name="column_' + index + '" id="column_' + index + '" class="form-control">' +
                        '<option value="" selected> -- </option>' +
                        options +
                        '</select>' +
                        "</th>"

                }
                head += "</tr></thead>";
                HTMLOUT.innerHTML += htmlstr;
                document.getElementById('excel-table').innerHTML += head;
                document.getElementById('excel-table').className += "draggable table table-striped table-bordered table-hover";
                uniqueSelects();
                // drag();


            });
            return "";
        };
        return function process_wb(wb) {
            global_wb = wb;
            var output = "";
            output = to_html(wb);


            if (typeof console !== 'undefined') console.log("output", new Date());
        };
    })();

    var do_file = (function() {
        var rABS = typeof FileReader !== "undefined" && (FileReader.prototype || {}).readAsBinaryString;
        var use_worker = typeof Worker !== 'undefined';
        var xw = function xw(data, cb) {
            var worker = new Worker(XW.worker);
            worker.onmessage = function(e) {
                switch (e.data.t) {
                    case 'ready':
                        break;
                    case 'e':
                        console.error(e.data.d);
                        break;
                    case XW.msg:
                        cb(JSON.parse(e.data.d));
                        break;
                }
            };
            worker.postMessage({
                d: data,
                b: rABS ? 'binary' : 'array'
            });
        };

        return function do_file(files) {
            var f = files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                if (typeof console !== 'undefined') console.log("onload", new Date(), rABS, use_worker);
                var data = e.target.result;
                if (!rABS) data = new Uint8Array(data);
                if (use_worker) xw(data, process_wb);
                else process_wb(X.read(data, {
                    type: rABS ? 'binary' : 'array'
                }));
            };
            if (rABS) reader.readAsBinaryString(f);
            else reader.readAsArrayBuffer(f);

        };

    })();

    (function() {
        var xlf = document.getElementById('xlf');
        if (!xlf.addEventListener) return;

        function handleFile(e) {
            do_file(e.target.files);
        }
        xlf.addEventListener('change', handleFile, false);
    })();
</script>

@endpush
@push('style')

<!-- <link rel="stylesheet" href="{{ url('') }}/css/DragDrop/dragtable.css"> -->

@endpush
@endsection