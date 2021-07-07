@extends('layouts.app_web')

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{$menu}}</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">{{$menu}}<small>{{$menu_detail}}</small></h1>
    <!-- end page-header -->
    
    <!-- begin row -->
    <div class="row">
				<!-- begin col-6 -->
			    <div class="col-lg-8">
			    	<!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="chart-js-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Line Chart</h4>
                        </div>
                        <div class="panel-body" style="min-height: 500px;">
                            <p>
                                Daftar Tagihan tahun {{$tahun}}
                                <select class="form-control" onchange="pilih_tahun(this.value)" style="width:20%">
                                    @for($th=2020;$th<=date('Y');$th++)
                                        <option value="{{$th}}" @if($tahun==$th) selected @endif>{{$th}}</option>
                                    @endfor
                                </select>
                            </p>
                            <div>
                                <canvas id="line-chart" data-render="chart-js"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <div class="col-lg-4">
           
                    <div class="panel panel-inverse" data-sortable-id="ui-modal-notification-2">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon  btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon  btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon  btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon  btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Daftar Tagihan SAP {{$tahun}}</h4>
                        </div>
                        <div class="panel-body" >
                            <div class="list-group">
                                @for($x=1;$x<13;$x++)
                                    
                                    <a href="javascript:;" style="background: #0d3e6f;" class="list-group-item list-group-item-inverse d-flex justify-content-between align-items-center text-ellipsis">
                                        {{bulan(bulnya($x))}} 
                                        <span class="badge f-w-500 bg-gradient-green f-s-10">{{uang(keuangan_sap(bulnya($x),$tahun))}}</span>
                                    </a> 
                                @endfor
                                
                                
                            </div>       
                            <div class="modal" id="modal-ubah">
                                <div class="modal-dialog" id="modalmedium">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ubah Data</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post"  style="display: flex;" enctype="multipart/form-data" id="my_data_ubah">
                                                @csrf
                                                <div id="tampilkan_ubah" style="display: contents;"></div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                            <a href="javascript:;" class="btn btn-success" onclick="simpan_ubah()">Simpan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @include('layouts.notif')
                        </div>
                    </div>
                    <!-- end panel -->
                    
                </div>
                <div class="col-lg-8">
			    	<!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="chart-js-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Poling</h4>
                        </div>
                        <div class="panel-body" style="min-height: 500px;">
                            
                            <div>
                            <canvas id="bar-chart" data-render="chart-js"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <div class="col-lg-4">
           
                    <div class="panel panel-inverse" data-sortable-id="ui-modal-notification-2">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon  btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon  btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon  btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon  btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Rekap Poling {{$tahun}}</h4>
                        </div>
                        <div class="panel-body" >
                            <div class="list-group">
                                
                                <div class="table-responsive">
                                    <table class="table table-striped m-b-0">
                                        <thead>
                                            <tr>
                                                <th width="10%">No</th>
                                                <th >Bulan</th>
                                                <th>SP</th>
                                                <th>PS</th>
                                                <th>TP</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for($x=1;$x<13;$x++)
                                            <tr>
                                              <td>{{$x}}</td>
                                              <td>{{bulan(bulnya($x))}}</td>
                                              <td>{{persen_nilai_poling(bulnya($x),$tahun,1)}}%</td>
                                              <td>{{persen_nilai_poling(bulnya($x),$tahun,2)}}%</td>
                                              <td>{{persen_nilai_poling(bulnya($x),$tahun,3)}}%</td>
                                            </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                                     
                                
                                
                                
                            </div>       
                            <div class="modal" id="modal-ubah">
                                <div class="modal-dialog" id="modalmedium">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ubah Data</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post"  style="display: flex;" enctype="multipart/form-data" id="my_data_ubah">
                                                @csrf
                                                <div id="tampilkan_ubah" style="display: contents;"></div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                            <a href="javascript:;" class="btn btn-success" onclick="simpan_ubah()">Simpan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @include('layouts.notif')
                        </div>
                    </div>
                    <!-- end panel -->
                    
                </div>
                <div class="col-lg-12">
            <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="ui-modal-notification-2">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon  btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon  btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon  btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon  btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Tabel Tagihan</h4>
                        </div>
                        <div class="panel-body" style="background:#ddfbcd" >
                        
                        <ul class="nav nav-tabs">
                         @for($blan=1;$blan<13;$blan++)
                            <li class="nav-items">
                                <a href="#default-tab-{{$blan}}" data-toggle="tab" class="nav-link @if($blan==1)active show @endif">
                                    <span class="d-sm-none">{{bulnya($blan)}}</span>
                                    <span class="d-sm-block d-none">{{bulan(bulnya($blan))}}</span>
                                </a>
                            </li>
                         @endfor   
                        </ul>
                        <!-- end nav-tabs -->
                        <!-- begin tab-content -->
                        <div class="tab-content">
                            <!-- begin tab-pane -->
                            @for($blan=1;$blan<13;$blan++)
                            <div class="tab-pane fade @if($blan==1)active show @endif" id="default-tab-{{$blan}}">
                                <h4 class="m-t-7"><i class="fa fa-clone"></i> {{bulan(bulnya($blan))}} {{$tahun}}</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped m-b-0">
                                        <thead>
                                            <tr>
                                                <th width="10%">No</th>
                                                <th width="15%">Tanggal</th>
                                                <th width="25%">Total Dokumen</th>
                                                <th >Total Tagihan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(get_data_bttd(bulnya($blan),$tahun) as $no=>$bttdget)
                                            <tr>
                                                <td>{{$no+1}}</td>
                                                <td>{{$bttdget['diterima']}}</td>
                                                <td>{{total_dokumen_pertanggal($bttdget['diterima'])}}</td>
                                                <td>{{uang(total_tagihan_pertanggal($bttdget['diterima']))}}</td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endfor
                            
                            <!-- end tab-pane -->
                        </div>





                        </div>
                    </div>
                    
                </div>





                
                <!-- end col-6 -->
                <!-- begin col-6 -->
                <!-- <div class="col-lg-6">
			    	<div class="panel panel-inverse" data-sortable-id="chart-js-2">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Bar Chart</h4>
                        </div>
                        <div class="panel-body">
                            <p>
                                A bar chart is a way of showing data as bars.
                                It is sometimes used to show trend data, and the comparison of multiple data sets side by side.
                            </p>
                            <div>
                                <canvas id="bar-chart" data-render="chart-js"></canvas>
                            </div>
                        </div>
                    </div>
                   
                </div> -->
                <!-- end col-6 -->
            </div>
		    <!-- end row -->
		    
		    <!-- begin row -->
		    
    <!-- end row -->
</div>
@endsection


@push('ajax')
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{url('assets/plugins/chart-js/Chart.min.js')}}"></script>
<!-- <script src="{{url('assets/js/demo/chart-js.demo.min.js')}}"></script> -->
	<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    

    function pilih_tahun(a){
        location.assign("{{url('home')}}?tahun="+a);
    }
    /*
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3 & 4
Version: 4.0.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v4.0/admin/
*/

Chart.defaults.global.defaultFontColor = COLOR_BLACK;
Chart.defaults.global.defaultFontFamily = FONT_FAMILY;
Chart.defaults.global.defaultFontStyle = FONT_WEIGHT;

var randomScalingFactor = function() { 
    return Math.round(Math.random()*100)
};

var lineChartData = {
    labels: [
        @for($x=1;$x<13;$x++)
            '{{bulan(bulnya($x))}}',
        @endfor
    ],
    datasets: [{
        label: 'Nilai Tagihan',
        borderColor: COLOR_BLUE,
        pointBackgroundColor: COLOR_BLUE,
        pointRadius: 2,
        borderWidth: 2,
        backgroundColor: COLOR_BLUE_TRANSPARENT_3,
        data: [
            @for($x=1;$x<13;$x++)
                '{{keuangan(bulnya($x),$tahun)}}',
            @endfor
        ]
    },{
        label: 'Masuk SAP ',
        borderColor: COLOR_BLACK,
        pointBackgroundColor: COLOR_BLACK,
        pointRadius: 2,
        borderWidth: 2,
        backgroundColor: COLOR_BLACK_TRANSPARENT_3,
        data: [
            @for($x=1;$x<13;$x++)
            '{{keuangan_sap(bulnya($x),$tahun)}}',
            @endfor
        ]
    }]
};

var barChartData = {
    labels: [
        @for($x=1;$x<13;$x++)
            '{{bulan(bulnya($x))}}',
        @endfor
    ],
    datasets: [{
        label: 'Sangat Puas',
        borderWidth: 2,
        borderColor: COLOR_PURPLE,
        backgroundColor: 'blue',
        data: [
            @for($x=1;$x<13;$x++)
            '{{nilai_poling(bulnya($x),$tahun,1)}}',
            @endfor
        ]
    }, {
        label: 'Puas',
        borderWidth: 2,
        borderColor: COLOR_BLACK,
        backgroundColor: 'aqua',
        data: [
            @for($x=1;$x<13;$x++)
                '{{nilai_poling(bulnya($x),$tahun,2)}}',
            @endfor
        ]
    },{
        label: 'Tidak Puas',
        borderWidth: 2,
        borderColor: COLOR_BLACK,
        backgroundColor: 'red',
        data: [
            @for($x=1;$x<13;$x++)
                '{{nilai_poling(bulnya($x),$tahun,3)}}',
            @endfor
        ]
    }]
};

var radarChartData = {
    labels: ['Eating', 'Drinking', 'Sleeping', 'Designing', 'Coding', 'Cycling', 'Running'],
    datasets: [{
        label: 'Dataset 1',
        borderWidth: 2,
        borderColor: COLOR_RED,
        pointBackgroundColor: COLOR_RED,
        pointRadius: 2,
        backgroundColor: COLOR_RED_TRANSPARENT_2,
        data: [65,59,90,81,56,55,40]
    }, {
        label: 'Dataset 2',
        borderWidth: 2,
        borderColor: COLOR_BLACK,
        pointBackgroundColor: COLOR_BLACK,
        pointRadius: 2,
        backgroundColor: COLOR_BLACK_TRANSPARENT_2,
        data: [28,48,40,19,96,27,100]
    }]
};

var polarAreaData = {
    labels: ['Dataset 1', 'Dataset 2', 'Dataset 3', 'Dataset 4', 'Dataset 5'],
    datasets: [{
        data: [300, 160, 100, 200, 120],
        backgroundColor: [COLOR_PURPLE_TRANSPARENT_7, COLOR_BLUE_TRANSPARENT_7, COLOR_GREEN_TRANSPARENT_7, COLOR_GREY_TRANSPARENT_7, COLOR_BLACK_TRANSPARENT_7],
        borderColor: [COLOR_PURPLE, COLOR_BLUE, COLOR_GREEN, COLOR_GREY, COLOR_BLACK],
        borderWidth: 2,
        label: 'My dataset'
    }]
};

var pieChartData = {
    labels: ['Dataset 1', 'Dataset 2', 'Dataset 3', 'Dataset 4', 'Dataset 5'],
    datasets: [{
        data: [300, 50, 100, 40, 120],
        backgroundColor: [COLOR_RED_TRANSPARENT_7, COLOR_ORANGE_TRANSPARENT_7, COLOR_SILVER_TRANSPARENT_7, COLOR_GREY_TRANSPARENT_7, COLOR_BLACK_TRANSPARENT_7],
        borderColor: [COLOR_RED, COLOR_ORANGE, COLOR_SILVER_DARKER, COLOR_GREY, COLOR_BLACK],
        borderWidth: 2,
        label: 'My dataset'
    }]
};

var doughnutChartData = {
    labels: ['Dataset 1', 'Dataset 2', 'Dataset 3', 'Dataset 4', 'Dataset 5'],
    datasets: [{
        data: [300, 50, 100, 40, 120],
        backgroundColor: [COLOR_PURPLE_TRANSPARENT_7, COLOR_BLUE_TRANSPARENT_7, COLOR_GREEN_TRANSPARENT_7, COLOR_GREY_TRANSPARENT_7, COLOR_BLACK_TRANSPARENT_7],
        borderColor: [COLOR_PURPLE, COLOR_BLUE, COLOR_GREEN, COLOR_GREY, COLOR_BLACK],
        borderWidth: 2,
        label: 'My dataset'
    }]
};

var handleChartJs = function() {
    var ctx = document.getElementById('line-chart').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: lineChartData
    });
    
    
    
};
var barChartJs = function() {
    var ctx = document.getElementById('bar-chart').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'bar',
        data: barChartData
    });
    
    
    
};

var ChartJs = function () {
	"use strict";
    return {
        //main function
        init: function () {
            handleChartJs();
            barChartJs();
        }
    };
}();
</script>

@endpush