<!-- jQuery 3 -->
<script src="{{asset('template/backend/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('template/backend/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('template/backend/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- datepicker -->
<script src="{{asset('template/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<!-- DataTables -->
<script src="{{asset('template/backend/bower_components/underscore/underscore-min.js')}}" type="text/javascript"></script>
<script src="{{asset('template/backend/bower_components/numeral/min/numeral.min.js')}}" type="text/javascript"></script>
<script src="{{asset('template/backend/bower_components/waitMe/waitMe.min.js')}}" type="text/javascript"></script>
<script src="{{asset('template/backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('template/backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('template/backend/bower_components/bootstrap-table/dist/bootstrap-table.min.js')}}"></script>
<script src="{{asset('template/backend/bower_components/bootstrap-table/src/extensions/export/bootstrap-table-export.js')}}"></script>
<script src="{{asset('js/tableExport.js')}}"></script>
<script src="{{asset('js/FileSaver.min.js')}}"></script>
<script src="{{asset('js/jspdf.min.js')}}"></script>
<script src="{{asset('js/jspdf.plugin.autotable.js')}}"></script>
<script src="{{asset('template/backend/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('template/backend/dist/js/demo.js')}}"></script>
@yield('pagescript')
<script>


  
  function moneyFormatter(value){
      return numeral(value).format('0,0.00');
  }

  $(function () {

    // fungsi untuk input type number disable string
    $('.number').on('change keyup', function() {
      var sanitized = $(this).val().replace(/[^0-9]/g, '');
      $(this).val(sanitized);
    });

    $( ".select2" ).select2({
        theme: "bootstrap",
        placeholder: "Pilih"
    });

    $(".select2").width("100%");

      $('.datepicker').datepicker({
        format:"yyyy-mm-dd",
        autoclose: true
      })

      $('.datepicker').datepicker('setDate', new Date());

    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });
</script>