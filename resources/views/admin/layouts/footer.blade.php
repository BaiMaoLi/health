<footer class="main-footer">
    {{--<div class="pull-right hidden-xs">--}}
        {{--<b>Version</b> 2.4.0--}}
    {{--</div>--}}
    {{--<strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights--}}
    {{--reserved.--}}
    {{--<strong>Copyright &copy; 2018 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights--}}
    {{--reserved.--}}

    <!-- jQuery 3 -->
    <script src="{{asset('public/admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('public/admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('public/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('public/admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('public/admin/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('public/admin/dist/js/demo.js')}}"></script>

        <script>
            $(document).ready(function(){
                $('.appear').css('opacity','0')
                setTimeout(function() {

                    $('.appear').css('display','none');
                }, 5000);
            });


        </script>
    <!-- page script -->
    @section('footerSection')
    @show
</footer>