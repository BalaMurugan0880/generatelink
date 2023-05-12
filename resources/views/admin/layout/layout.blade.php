<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Appointment System</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ url('admin/plugins/fontawesome-free/css/all.min.css')}}">
   <!-- DataTables -->
   <link rel="stylesheet" href="{{ url('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
   <link rel="stylesheet" href="{{ url('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
   {{-- Toastr --}}
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
   <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('admin/css/adminlte.min.css')}}">
  <!-- Custom style -->
  <link rel="stylesheet" href="{{ url('admin/css/custom.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- jQuery -->
<script src="{{ url('admin/plugins/jquery/jquery.min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMpiwwB9YcMoY8fKN_RZqruGkiEUr0E9o&callback=initMap" async defer></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    @include('admin.layout.header')

    @include('admin.layout.sidebar')

    @include('admin.layout.toastr')

    @yield('content')


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

    @include('admin.layout.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap -->
<script src="{{ url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- InputMask -->
<script src="{{ url('admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{ url('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ url('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ url('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ url('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ url('admin/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
{{-- <script src="{{ url('admin/js/demo.js')}}"></script> --}}
 {{-- Toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- jQuery Mapael -->
<script src="{{ url('admin/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{ url('admin/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{ url('admin/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{ url('admin/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>




<!-- ChartJS -->
{{-- <script src="{{ url('admin/plugins/chart.js/Chart.min.js')}}"></script> --}}

<!-- PAGE SCRIPTS -->
{{-- <script src="{{ url('admin/js/pages/dashboard2.js')}}"></script> --}}

{{-- Delete Modal --}}
<script>
  jQuery(document).ready(function() {
      jQuery('#deleteButton').on('click', function(e) {
          e.preventDefault();
          if (confirm('Are you sure you want to delete this record?')) {
              jQuery(this).closest('form').submit();
          }
      });
  });
</script>

{{-- Data Table --}}
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

{{-- Input Mask --}}
<script>
  $('[data-mask]').inputmask();
</script>




</body>
</html>
