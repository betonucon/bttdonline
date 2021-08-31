<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>BTTD Online | Krakatau Steel</title>
	<link rel="icon" href="https://sso.krakatausteel.com/public/fav.png" type="image/x-icon">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{url('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" />
	<link href="{{url('assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{url('assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css')}}" rel="stylesheet" />
	<link href="{{url('assets/plugins/animate/animate.min.css')}}" rel="stylesheet" />
	<link href="{{url('assets/css/default/style.min.css')}}" rel="stylesheet" />
	<link href="{{url('assets/css/default/style-responsive.min.css')}}" rel="stylesheet" />
	<link href="{{url('assets/css/default/theme/default.css')}}" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	<link href="{{url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
	<link href="{{url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
	<link href="{{url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet" />
	<link href="{{url('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" />
	<link href="{{url('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
    <link href="{{url('assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" />	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{url('assets/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	<link href="{{url('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{url('assets/plugins/DataTables/extensions/FixedHeader/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css')}}" rel="stylesheet" />
	<!-- ================== BEGIN BASE JS ================== -->
	@stack('css')
	<script src="{{url('assets/plugins/pace/pace.min.js')}}"></script>
	<!-- ================== END BASE JS ================== -->
    <style>
    .ttd{
        padding:3px 3px 3px 5px !important;
    }
	th{
		background:#ffffff !important;
		font-size:11px !important;
		color:#000 !important;
	}
	.modal-header{
		background: #cfd0b7;
	}
	.modal-footer{
		background: #cfd0b7;
	}
	.text-grey-darker {
		color: #ea551b!important;
		font-style: italic;
	}
	.sidebar .nav>li.active>a{
		background:none !important;
	}
	td{
		background:#fff !important;
		font-size:11px !important;
		color:#000 !important;
	}
	.panel-inverse>.panel-heading {
		background: #0d3e6f;
	}
	
	.pagination li{
		float: left;
		list-style-type: none;
		margin:1px !important;
	}
	
    .pagination li{
        float: left;
        list-style-type: none;
        margin:5px;
    }
    .loadnya {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1070;
        top: 0;
        left: 0;
        background-color: rgb(0,0,0);
        background-color: rgb(0 0 0 / 55%);
        overflow-x: hidden;
        transition: transform .9s;
    }

    .loadnya-content {
        position: relative;
        top: 25%;
        width: 100%;
        text-align: center;
        margin-top: 30px;
        color:#fff;
        font-size:20px;
    }
    @media only screen and (min-width: 600px) {
        #modalbesar{
			max-width: 90% !important;
			margin-top:0px;
		}
		.fomrnya{
			display:flex;
		}
        #modalmedium{
			max-width: 70% !important;
			margin-top:0px;
		}
		.form-group{
			margin-bottom:1%;
		}
    }
    @media only screen and (max-width: 590px) {
        #tampilkan{
            width:100%;
            overflow-x:scroll;
            width:100%
        }
    }
    
    </style>
</head>
<body>
    <div id="loadnya" class="loadnya">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="loadnya-content">
            <i class="fas fa-spinner fa-pulse"></i> Proses...........
        </div>
    </div>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="index.html" class="navbar-brand"><img src="{{url('img/logo.png')}}" width="100%"></a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header -->
			
			<!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				<li>
					<form class="navbar-form">
						<div class="form-group">
							
							
						</div>
					</form>
				</li>
				
				<li class="dropdown navbar-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{url('img/akun.png')}}" alt="" /> 
						<span class="d-none d-md-inline">{{Auth::user()['name']}}</span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
					
						<a href="javascript:;" class="dropdown-item">Setting</a>
						<div class="dropdown-divider"></div>
						@if(Auth::user()['role_id']==7)
						<a href="#" onclick="poling()" class="dropdown-item">Log Out</a>
						
						@else
						<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">Log Out</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>

						@endif
						
					</div>
				</li>
			</ul>
			<!-- end header navigation right -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar" style="background: #fff;"> 
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image">
								<img src="{{url('img/akun.png')}}" alt="" />
							</div>
							<div class="info">
								<b class="caret pull-right"></b>
									{{rolepengguna()}}
								<small>{{Auth::user()['username']}}<br>{{Auth::user()['name']}}</small>
							</div>
						</a>
					</li>
					<li>
						<ul class="nav nav-profile">
                            <li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
                            <li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
                        </ul>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				@include('layouts.side')
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		@yield('content')
		<!-- end #content -->
		
        <!-- begin theme-panel -->
        <div class="theme-panel">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
            <div class="theme-panel-content">
                <h5 class="m-t-0">Color Theme</h5>
                <ul class="theme-list clearfix">
                    <li class="active"><a href="javascript:;" class="bg-green" data-theme="default" data-theme-file="../assets/css/default/theme/default.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-theme-file="../assets/css/default/theme/red.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-theme-file="../assets/css/default/theme/blue.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-theme-file="../assets/css/default/theme/purple.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-theme-file="../assets/css/default/theme/orange.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-black" data-theme="black" data-theme-file="../assets/css/default/theme/black.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
                </ul>
                <div class="divider"></div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Header Styling</div>
                    <div class="col-md-7">
                        <select name="header-styling" class="form-control form-control-sm">
                            <option value="1">default</option>
                            <option value="2">inverse</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">Header</div>
                    <div class="col-md-7">
                        <select name="header-fixed" class="form-control form-control-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar Styling</div>
                    <div class="col-md-7">
                        <select name="sidebar-styling" class="form-control form-control-sm">
                            <option value="1">default</option>
                            <option value="2">grid</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">Sidebar</div>
                    <div class="col-md-7">
                        <select name="sidebar-fixed" class="form-control form-control-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar Gradient</div>
                    <div class="col-md-7">
                        <select name="content-gradient" class="form-control form-control-sm">
                            <option value="1">disabled</option>
                            <option value="2">enabled</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Content Styling</div>
                    <div class="col-md-7">
                        <select name="content-styling" class="form-control form-control-sm">
                            <option value="1">default</option>
                            <option value="2">black</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-12">
                        <a href="javascript:;" class="btn btn-inverse btn-block btn-sm" data-click="reset-local-storage">Reset Local Storage</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end theme-panel -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{url('assets/plugins/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{url('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
	<script src="{{url('assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{url('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{url('assets/plugins/js-cookie/js.cookie.js')}}"></script>
	<script src="{{url('assets/js/theme/default.min.js')}}"></script>
	<script src="{{url('assets/js/apps.min.js')}}"></script>
	<!-- ================== END BASE JS ================== -->
	<script src="{{url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
	<script src="{{url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
	<script src="{{url('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
	<script src="{{url('assets/plugins/bootstrap-daterangepicker/moment.js')}}"></script>
    <script src="{{url('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{url('assets/plugins/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{url('assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="{{url('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
	<script src="{{url('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
	<script src="{{url('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script src="{{url('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
	<script src="{{url('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js')}}"></script>
	<script src="{{url('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{url('assets/js/demo/table-manage-responsive.demo.min.js')}}"></script>
	<script>
		$(document).ready(function() {
			App.init();
			Notification.init();
			ChartJs.init();
			TableManageDefault.init();
			FormPlugins.init();
			TableManageResponsive.init();
		});
		function poling(){
			$('#modal-poling').modal('show');
		}
		function lihatfilegd(file){
			var file='<iframe src="_file_tagihan/'+file+'" height="550" width="100%"></iframe>';
			$('#modal-lihat-file').modal('show');
			$('#lihat-file').html(file);
		}
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
		$(document).ready(function() {
			$('#example').dataTable( {
				"paging":   false,
				"responsive": true,
				"ordering": true,
				"info":     false
			} );
			@if(Auth::user()['role_id']==1 || Auth::user()['role_id']==2 || Auth::user()['role_id']==3)
				@if(cek_password()>0)
					$('#modal-password').modal({backdrop: 'static', keyboard: false});
					
					
				@endif

			@endif
			@if(Auth::user()['role_id']==7)
				@if(cek_password()>0)
					$('#modal-password').modal({backdrop: 'static', keyboard: false});
				@else
					@if(npwp()=='')
						$('#modal-npwp').modal({backdrop: 'static', keyboard: false});
					@endif
				@endif
				
			@endif
		} );

		function simpan_npwp(){
			var form=document.getElementById('my_data_npwp');
			$.ajax({
					type: 'POST',
					url: "{{url('vendor/simpan_npwp')}}",
					data: new FormData(form),
					contentType: false,
					cache: false,
					processData:false,
					beforeSend: function() {
						document.getElementById("loadnya").style.width = "100%";
					},
					success: function(msg){
						
						if(msg=='ok'){
							location.reload();
						}else{
							document.getElementById("loadnya").style.width = "0px";
							$('#modal-notif').modal('show');
							$('#notif').html(msg);
						}
								
						
					}
			});
		
		}
		function pilih_poling(a){
			location.assign("{{url('poling')}}?sts="+a);
		}
		function simpan_ubah_vendor(){
			var form=document.getElementById('my_data_ubah_vendor');
			$.ajax({
					type: 'POST',
					url: "{{url('vendor/simpan_ubah_vendor')}}",
					data: new FormData(form),
					contentType: false,
					cache: false,
					processData:false,
					beforeSend: function() {
						document.getElementById("loadnya").style.width = "100%";
					},
					success: function(msg){
						
						if(msg=='ok'){
							location.reload();
						}else{
							document.getElementById("loadnya").style.width = "0px";
							$('#modal-notif').modal('show');
							$('#notif').html(msg);
						}
								
						
					}
			});
		
		}
		function simpan_password(){
			var form=document.getElementById('my_data_password');
			$.ajax({
					type: 'POST',
					url: "{{url('vendor/simpan_password')}}",
					data: new FormData(form),
					contentType: false,
					cache: false,
					processData:false,
					beforeSend: function() {
						document.getElementById("loadnya").style.width = "100%";
					},
					success: function(msg){
						
						if(msg=='ok'){
							location.reload();
						}else{
							document.getElementById("loadnya").style.width = "0px";
							$('#modal-notif').modal('show');
							$('#notif').html(msg);
						}
								
						
					}
			});
		
		}
		function pilihsemua(e) {
			var checkboxes = document.getElementsByName('id[]');
		
			if (e.checked) {
			for (var i = 0; i < checkboxes.length; i++) { 
				checkboxes[i].checked = true;
			}
			} else {
			for (var i = 0; i < checkboxes.length; i++) {
				checkboxes[i].checked = false;
			}
			}
		}
	</script>
    @stack('ajax')
</body>
</html>
