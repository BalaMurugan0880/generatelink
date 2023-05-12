
@if ($errors->any())
@foreach ($errors->all() as $error)
<script>
        jQuery(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
                toastr.error('{{ $error }}');

        });
</script>
@endforeach
@endif


@if(session('success'))
<script>
     jQuery(document).ready(function() {
toastr.success('{{ session('success') }}');
});
</script>
@endif