 <script src="{{ url('/assets/js/jquery-3.3.1.min.js')}}"></script>
<!--  {{ url('adminlte/bootstrap/css/bootstrap.min.css') }} --> <!-- Common jquery plugin -->
    <!--bootstrap working-->
    <script src="{{ url('/assets/js/bootstrap.min.js')}}"</script>
    <!-- //bootstrap working-->
<!-- disable body scroll which navbar is in active -->
<script>
    $(function () {
      $('.navbar-toggler').click(function () {
        $('body').toggleClass('noscroll');
      })
    });
  </script>