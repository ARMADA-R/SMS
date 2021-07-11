@extends('Admin.index')
@section('content')

<div class="row justify-content-center">
    <div class="col-11 /*col-lg-10*/ /*col-xl-8*/ mx-auto">
        <h2 class="h3 mb-4 page-title">{{trans('app.students.students')}}</h2>
        <div class="my-4">
            <!-- <hr class="my-4" /> -->
            <div class="card">
                <div class="card-header">

                    <h5 class="card-title" style="line-height: 2;">{{trans('app.students.edit-student')}}</h5>

                </div>
                <div class="card-body">
                    <form role="form" action="{{ route('admin.student.edit', $student->id ) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $student->id }}">
                        <!-- <hr class="my-4" /> -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fname">{{trans('app.students.fname')}}</label>
                                <input value="{{ (null != old('fname')) ? old('fname') :  $student->first_name }}" required type="text" name="fname" id="fname" class="form-control" placeholder="Brown" />
                            </div>

                            <div class="form-group col-md">
                                <label for="lname">{{trans('app.students.lname')}}</label>
                                <input value="{{ (null != old('lname')) ? old('lname') :  $student->last_name }}" required type="text" name="lname" class="form-control" id="lname" placeholder="John" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label for="father_name">{{trans('app.students.father-name')}}</label>
                                <input value="{{ (null != old('father_name')) ? old('father_name') :  $student->father_name }}" required type="text" class="form-control" name="father_name" id="father_name" placeholder="Bard John" />
                            </div>
                            <div class="form-group col-md">
                                <label for="mother_name">{{trans('app.students.mother-name')}}</label>
                                <input value="{{ (null != old('mother_name')) ? old('mother_name') :  $student->mother_name }}" required type="text" class="form-control" name="mother_name" id="mother_name" placeholder="Maria John" />
                            </div>
                            <div class="form-group col-md">
                                <label for="level">{{trans('app.levels.level')}}</label>
                                <select required name="level" id="level" class="form-control">
                                    <option value="" selected> -- </option>
                                    @foreach($levels as $level)
                                    <option value="{{$level->id}}" {{ (null != old('level')) ? (old('level') ==  $level->id ? 'selected' : '' ): (($student->level_id == $level->id)? 'selected' : '') }}> {{ $level->name .' : '. $level->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info">{{trans('app.save')}}</button>
                        <button type="reset" class="btn btn-outline-secondary">{{trans('app.reset')}}</button>
                    </form>

                    <form role="form" id="form2" name="form2" method="post" action="http://secondary2021.moed.gov.sy/scientific/result.php" onsubmit="return numberValidateForm()">
                        <div class="form-group margintop-10">
                            <select name="city" class="form-control chosen-select chosen-rtl" id="city">
                                <option value="1" selected="">دمشق</option>
                                <option value="2">ريف دمشق</option>
                                <option value="3">القنيطرة</option>
                                <option value="4">درعا</option>
                                <option value="5">السويداء</option>
                                <option value="6">حمص</option>
                                <option value="7">حماه</option>
                                <option value="8">حلب</option>
                                <option value="9">إدلب</option>
                                <option value="10">اللاذقية</option>
                                <option value="11">طرطوس</option>
                                <option value="12">دير الزور</option>
                                <option value="13">الحسكة</option>
                                <option value="14">الرقة</option>
                            </select>
                        </div>
                        <div class="form-group margintop-10">
                            <input name="stdnum" id="stdnum" type="text" class="form-control" placeholder="أدخل رقم الإكتتاب">
                        </div>
                        <div class="form-group margintop-30 equal-height-co">
                            <div class="col-md-6 equal-height text-center hide-mobile" style="height: 97px;">
                                <button name="Submit" type="submit" id="Submit" class="btn btn-default transparent-btn">ابدأ البحث</button>
                            </div>
                            <div class="col-md-6 equal-height text-center" style="height: 97px;">
                                <button name="Submit" type="submit" id="Submit" class="btn btn-default main-btn" onclick="allnumericplusminus(document.form1.text1)"><i class="glyphicon glyphicon-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" id="close-cropper" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>
                    <!-- Below are a series of inputs which allow file selection and interaction with the cropper api -->
                    <input class="btn btn-sm" type="file" id="fileInput" accept="image/*" />
                    <button class="btn float-right m-1 btn-outline-secondary btn-sm" id="btnRestore">Restore</button>
                    <button class="btn float-right m-1 btn-info btn-sm" id="btnCrop">Crop</button>
                </p>
                <div>
                    <canvas style="width: 100%; height: 100%;" id="canvas">
                        Your browser does not support the HTML5 canvas element.
                    </canvas>
                </div>

                <div id="result"></div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="text-danger"> you sould save change after crooping!</div>
                <!-- <button type="button" class="btn float-left btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>




@push('scripts')
<script type="text/javascript">
function numberValidateForm() {
  var xNum = document.forms["form2"]["stdnum"].value;
  if(!/^[0-9]+$/.test(xNum)){
    alert("يجب ملىء رقم الاكتتاب برقم والّا يترك فارغاً");
    return false;
  }
}

function sValidate(input){
  if(/^\s/.test(input.value))
    input.value = '';
}


function name_validate() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=name_validate.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('جميع الحقول مطلوبة، ويكفي كتابة جزء منها');
    document.MM_returnValue = (errors == '');
} }
function school_validate() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=school_validate.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('اسم المدرسة يجب ألا يترك فارغاً، ويكفي كتابة جزء منه');
    document.MM_returnValue = (errors == '');
} }

function validateform(){  
var name=document.myform.name.value;  

}


function goBack(){window.history.back()}

var maxHeight = 0;
$(".equal-height-co .equal-height").each(function(){
   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
});
$(".equal-height-co .equal-height").height(maxHeight);
$(".a-cell .subject").each(function(){
   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
});
$(".a-cell .subject").height(maxHeight);
$(".user-row").each(function(){
   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
});
$(".user-row .user-info, .user-row .glyphicon").height(maxHeight);


var config = {
  '.chosen-select'           : {},
  '.chosen-select-deselect'  : {allow_single_deselect:true},
  '.chosen-select-no-single' : {disable_search_threshold:10},
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}
$(".chosen-search").hide();

$(window).bind("resize", function () {
	console.log($(this).width())
	if ($(this).width() > 768) {
		$('.large-screen .dropdown').hover(function() {
		  $(this).find('.dropdown-menu').first().stop(true, true).delay(125).slideDown(200);
		}, function() {
		  $(this).find('.dropdown-menu').first().stop(true, true).delay(50).slideUp(500)
		});
	} else {
		$('.large-screen .dropdown').hover(function() {
		  $(this).find('.dropdown-menu').stop(true, true);
		}, function() {
		  $(this).find('.dropdown-menu').stop(true, true)
		});
	}
}).trigger('resize');
</script>

<script>
if ($("body").hasClass("result-page")) {
	$(".branch-title").addClass("col-sm-10"),
	$(".branch-print").addClass("col-sm-2");
}
else {
	$(".branch-title").addClass("col-sm-12"),
	$(".branch-print").addClass("hide-permanent");
}
</script>

<script>
    function closeAccount() {
        if (confirm('Are you sure you want to close this account? \nif you press Ok user will not be able to access to the system!')) {
            event.preventDefault();
            document.getElementById('close-account-form').submit();
        }
    }

    function activateAccount() {
        if (confirm('Are you sure you want to activate this account?')) {
            event.preventDefault();
            document.getElementById('activate-account-form').submit();
        }
    }
</script>



@endpush
@push('style')
<style>
    body {
        color: #8e9194;
        background-color: #f4f6f9;
    }

    .rounded-circle {
        border-radius: 50% !important;
    }

    .text-muted {
        color: #aeb0b4 !important;
        font-weight: 300;
    }

    .form-control {
        display: block;
        width: 100%;
        /* height: calc(1.5em + 0.75rem + 2px); */
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
    }
</style>


@endpush
@endsection