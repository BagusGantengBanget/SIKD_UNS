@extends('layouts.master_layout')

@section('title', 'Kinerja Varietas')
@section('content')
<head>
    <style>


    strong {
	font-weight: bold; 
}

em {
	font-style: italic; 
}

table {
	background: #f5f5f5;
	border-collapse: separate;
	box-shadow: inset 0 1px 0 #fff;
	font-size: 12px;
	line-height: 24px;
	margin: 30px auto;
	text-align: left;
	width: 100%;
}	

th {
	background: url(https://jackrugile.com/images/misc/noise-diagonal.png), linear-gradient(#777, #444);
	border-left: 1px solid #555;
	border-right: 1px solid #777;
	border-top: 1px solid #555;
	border-bottom: 1px solid #333;
	box-shadow: inset 0 1px 0 #999;
	color: #fff;
  font-weight: bold;
	padding: 10px 15px;
	position: relative;
	text-shadow: 0 1px 0 #000;	
}

th:after {
	background: linear-gradient(rgba(255,255,255,0), rgba(255,255,255,.08));
	content: '';
	display: block;
	height: 25%;
	left: 0;
	margin: 1px 0 0 0;
	position: absolute;
	top: 25%;
	width: 100%;
}

th:first-child {
	border-left: 1px solid #777;	
	box-shadow: inset 1px 1px 0 #999;
}

th:last-child {
	box-shadow: inset -1px 1px 0 #999;
}

td {
	border-right: 1px solid #fff;
	border-left: 1px solid #e8e8e8;
	border-top: 1px solid #fff;
	border-bottom: 1px solid #e8e8e8;
	padding: 10px 15px;
	position: relative;
	transition: all 300ms;
}

td:first-child {
	box-shadow: inset 1px 0 0 #fff;
}	

td:last-child {
	border-right: 1px solid #e8e8e8;
	box-shadow: inset -1px 0 0 #fff;
}	

tr {
	background: url(https://jackrugile.com/images/misc/noise-diagonal.png);	
}

tr:nth-child(odd) td {
	background: #f1f1f1 url(https://jackrugile.com/images/misc/noise-diagonal.png);	
}

tr:last-of-type td {
	box-shadow: inset 0 -1px 0 #fff; 
}

tr:last-of-type td:first-child {
	box-shadow: inset 1px -1px 0 #fff;
}	

tr:last-of-type td:last-child {
	box-shadow: inset -1px -1px 0 #fff;
}	
li.page-item {
  padding : 0px ;
  margin-top: 17px;
  margin-left: 10px;
  margin-right: 10px;
}

li.page-link {
  background-color: white;
  
}
/* tbody:hover td {
	color: transparent;
	text-shadow: 0 0 3px #aaa;
}

tbody:hover tr:hover td {
	color: #444;
	text-shadow: 0 1px 0 #fff;
} */
    </style>
    </head>

{{-- <div class="container">
    <h4>Data Kinerja Varietas</h4>
</div> --}}
<br/>
<div class="container">
    <div id="chartVarietas">

   
    @section('graph')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
    Highcharts.chart('chartVarietas', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Status Kinerja Varietas'
    },
    xAxis: {
        categories: [
            '2014 <br/>',
            '2015 <br/>',
            '2016 <br/>',
            '2017 <br/>',
            '2018 <br/>',
            '2019 <br/>',
            '2020 <br/>',
            '2021 <br/>'
            
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Ditolak',
        data: [{{ $ditolak14 }}, {{ $ditolak15 }}, {{ $ditolak16 }}, {{ $ditolak17 }},  {{ $ditolak18 }}, {{ $ditolak19 }}, {{ $ditolak20 }}, {{ $ditolak21 }}]

    }, {
        name: 'Menunggu',
        data: [{{ $menunggu14 }}, {{ $menunggu15 }}, {{ $menunggu16 }}, {{ $menunggu17 }}, {{ $menunggu18 }}, {{ $menunggu19 }}, {{ $menunggu20 }}, {{ $menunggu21 }}, ]

    }, {
        name: 'Tervalidasi',
        data: [{{ $tervalidasi14 }}, {{ $tervalidasi15 }}, {{ $tervalidasi16 }}, {{ $tervalidasi17 }},  {{ $tervalidasi18 }}, {{ $tervalidasi19 }}, {{ $tervalidasi20 }}, {{ $tervalidasi21 }},]

    }, {
        name: 'Perbaiki',
        data: [{{ $perbaiki14 }}, {{ $perbaiki15 }}, {{ $perbaiki16 }}, {{ $perbaiki17 }}, {{ $perbaiki18 }}, {{ $perbaiki19 }}, {{ $perbaiki20 }}, {{ $perbaiki21 }},]

    }]
});
</script>
@stop
</div>
</div>

<br/>
<br/>

<div class="container">
    <a href="/varietas_ex" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
<div id="table-datatables">
      <div class="col s12 m8 l9">
        <table class="responsive-table" cellspacing="0">
          <thead>
              <tr>
                <th  width="200px" >Nama Varietas</th>
                <th  width="400px" >Keterangan varietas</th>
                <th>Tahun</th>
                <th>Status Varietas</th>
                <th>Bidang Ilmu</th>
                <th>Bidang kajian</th>
                <th>Tag</th>
                <th>Status Bayar</th>
                
              </tr>
          </thead>
       
          <tbody>
            @foreach ($data as $dt)
              <tr>
                <td>{{$dt->nama_varietas}}</td>
                <td>{{$dt->ket_varietas}}</td>
                <td>{{$dt->tahun}}</td>
                <td>{{$dt->status_varietas}}</td>
                <td>{{$dt->id_bidangilmu}}</td>
                <td>{{$dt->id_bidangkajian}}</td>
                <td>{{$dt->tag}}</td>
                <td>{{$dt->status_bayar}}</td>
                
              </tr>
            @endforeach
              
          </tbody>
        </table>
      </div>
      <div id="data-table-simple_paginate" class="dataTables_paginate paging_simple_numbers">
          {{ $data->links() }}
      </div>
  </div> 
</div>
  <br>
  <div class="divider"></div>

@endsection


{{-- <div id="morris-bar-chart" class="section">

    <h4 class="header">Bar Chart</h4>
    <div class="row">
      <div class="col s12 m4 l3">
            <p>Grafik Status Kinerja Varietas Per tahun</p>
    </div>
      <div class="col s12 m8 l9">
        <div class="sample-chart-wrapper">
          <div id="morris-bar" class="graph" style="position: relative">
              <svg height="342" version="1.1" width="923" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; left: -0.56665px; top: -0.25px;"><desc>Created with Raphaël 2.1.4</desc><defs></defs><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="21.300000190734863" y="309.3999996185303" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4.400017738342285">0</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M33.80000019073486,309.5H898" stroke-width="0.5"></path><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="21.300000190734863" y="238.2999997138977" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4.399993419647217">1</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M33.80000019073486,238.5H898" stroke-width="0.5"></path><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="21.300000190734863" y="167.19999980926514" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4.399999618530273">2</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M33.80000019073486,167.5H898" stroke-width="0.5"></path><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="21.300000190734863" y="96.09999990463257" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4.399998188018799">3</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M33.80000019073486,96.5H898" stroke-width="0.5"></path><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="21.300000190734863" y="25" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4.399999618530273">4</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M33.80000019073486,25.5H898" stroke-width="0.5"></path><text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="789.9750000238419" y="321.8999996185303" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)">
                <tspan dy="4.400017738342285">2018</tspan></text><text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="573.9250000715256" y="321.8999996185303" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)">
                <tspan dy="4.400017738342285">2011 Q3</tspan></text><text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="357.8750001192093" y="321.8999996185303" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)">
                <tspan dy="4.400017738342285">2011 Q2</tspan></text><text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="141.825000166893" y="321.8999996185303" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)">
                <tspan dy="4.400017738342285">2011 Q1</tspan></text><rect x="60.8062501847744" y="96.09999990463257" width="52.01249998807907" height="213.2999997138977" rx="0" ry="0" fill="#0b62a4" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="115.81875017285347" y="167.19999980926514" width="52.01249998807907" height="142.19999980926514" rx="0" ry="0" fill="#7a92a3" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="170.83125016093254" y="96.09999990463257" width="52.01249998807907" height="213.2999997138977" rx="0" ry="0" fill="#4da74d" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="276.8562501370907" y="167.19999980926514" width="52.01249998807907" height="142.19999980926514" rx="0" ry="0" fill="#0b62a4" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="386.8812501132488" y="238.2999997138977" width="52.01249998807907" height="71.09999990463257" rx="0" ry="0" fill="#4da74d" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="492.90625008940697" y="309.3999996185303" width="52.01249998807907" height="0" rx="0" ry="0" fill="#0b62a4" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="547.918750077486" y="167.19999980926514" width="52.01249998807907" height="142.19999980926514" rx="0" ry="0" fill="#7a92a3" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="602.9312500655651" y="25" width="52.01249998807907" height="284.3999996185303" rx="0" ry="0" fill="#4da74d" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="708.9562500417233" y="167.19999980926514" width="52.01249998807907" height="142.19999980926514" rx="0" ry="0" fill="#0b62a4" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="763.9687500298023" y="25" width="52.01249998807907" height="284.3999996185303" rx="0" ry="0" fill="#7a92a3" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="818.9812500178814" y="96.09999990463257" width="52.01249998807907" height="213.2999997138977" rx="0" ry="0" fill="#4da74d" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect></svg><div class="morris-hover morris-default-style" style="left: 112.325px; top: 125px;">
                <div class="morris-hover-row-label">Keterangan : </div>
                
                <div class="morris-hover-point" style="color: #0b62a4">
                Y : 3
                </div>
                <div class="morris-hover-point" style="color: #7a92a3">
                Z : 2
                </div>
                <div class="morris-hover-point" style="color: #4da74d">
                A : 3
                </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
    

    {{-- <div class="container">
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Tahun', 'Ditolak', 'Menunggu', 'Perbaiki', 'Tervalidasi'],
          ['2014', {{ $ditolak }}, {{ $menunggu }}, {{ $perbaiki }}, {{ $tervalidasi }}],
          ['2015', {{ $ditolak }}, {{ $menunggu }}, {{ $perbaiki }}, {{ $tervalidasi }}],
          ['2016', {{ $ditolak }}, {{ $menunggu }}, {{ $perbaiki }}, {{ $tervalidasi }}],
          ['2017', {{ $ditolak }}, {{ $menunggu }}, {{ $perbaiki }}, {{ $tervalidasi }}],
          
        ]);

        var options = {
          chart: {
            title: 'Grafik Kinerja Varietas',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
</div> --}}