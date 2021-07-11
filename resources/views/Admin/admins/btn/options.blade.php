<button type="button" class="btn btn-info " id="btn_{{ $id }}" data-toggle="modal" onclick="AdminModdal()" data-target="#myModal"><i class="fa fa-list"></i></button>


@push('script')
<script>
var table = $('#userdatatable-table').DataTable();

 $('#userdatatable-table tbody').on( 'click', 'tr', function () {
     console.log( table.row( this ).data() );
 } );

    // function AdminModdal(id , name , email , status, rules  ) {
    //     var buf = new ArrayBuffer(s.length);
    //     var view = new Uint8Array(buf);
    //     for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
    //     return buf;
    // }


//     var id = <?php echo $id; ?>;
// var table = $('#userdatatable-table').DataTable();
// $('#btn_'.id).on('click',function(){

//     var rowData = table.row('#row_'.id).data();

//     document.getElementById("MEmail").innerHTML = rowData;

// });
</script>
@endpush
