@extends('layouts.master_layout')

@section('title', 'Kinerja Reviewer')
@section('content')
<head>
  <link href="js\plugins\prism\prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js\plugins\perfect-scrollbar\perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js\plugins\data-tables\css\jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js\plugins\chartist-js\chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">

  <style>
    /* strong {
      font-weight: bold; 
    }

    em {
      font-style: italic; 
    } */

    table {
      /* background: #f5f5f5;
      border-collapse: separate;
      box-shadow: inset 0 1px 0 #fff; */
      font-size: 12px;
      /* line-height: 24px;
      margin: 30px auto;
      text-align: left;
      width: 100%; */
    }	

    th {
      /* background-color: grey; */
      /* background: url(https://jackrugile.com/images/misc/noise-diagonal.png), linear-gradient(#777, #444);
      border-left: 1px solid #555;
      border-right: 1px solid #777;
      border-top: 1px solid #555;
      border-bottom: 1px solid #333;
      box-shadow: inset 0 1px 0 #999;
      color: #fff;
      font-weight: bold;
      padding: 10px 15px;
      position: relative;
      text-shadow: 0 1px 0 #000;	 */
    }

    /* th:after {
      background: linear-gradient(rgba(255,255,255,0), rgba(255,255,255,.08));
      content: '';
      display: block;
      height: 25%;
      left: 0;
      margin: 1px 0 0 0;
      position: absolute;
      top: 25%;
      width: 100%;
    } */

    /* th:first-child {
      border-left: 1px solid #777;	
      box-shadow: inset 1px 1px 0 #999;
    }

    th:last-child {
      box-shadow: inset -1px 1px 0 #999;
    } */

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
      /* background: url(https://jackrugile.com/images/misc/noise-diagonal.png); */	
    }

    tr:nth-child(odd) td {
      background: #f1f1f1 ;	
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

    input.contoh1{
      height: 36px;
    }

    .media-slider{
      height: 400px;
    }
  </style>
</head>
<div class="container">
  <h1 style="color: grey"><b>DATA KINERJA REVIEWER TAHUN {{ $tahunpen }}</b></h1>
</div>
<div class="container">
  <div class="row">
      <div class="col s6 m6 l3" >
        <ul id="dropdown1" class="dropdown-content">
          <li><a href="/fakultas_reviewer_FIB?keyword=2021" class="-text">FIB{{-- <span class="badge"></span> --}}</a>
          </li>
          <li><a href="/fakultas_reviewer_FKIP?keyword=2021" class="-text">FKIP{{-- <span class="new badge "></span> --}}</a>
          </li>
          <li><a href="/fakultas_reviewer_FH?keyword=2021" class="-text">FH</a>
          </li>
          <li><a href="/fakultas_reviewer_FEB?keyword=2021" class="-text">FEB</a>
          </li>
          <li><a href="/fakultas_reviewer_FISIP?keyword=2021" class="-text">FISIP</a>
          </li>
          <li><a href="/fakultas_reviewer_FP?keyword=2021" class="-text">FP</a>
          </li>
          <li><a href="/fakultas_reviewer_FK?keyword=2021" class="-text">FK</a>
          </li>
          <li><a href="/fakultas_reviewer_FT?keyword=2021" class="-text">FT</a>
          </li>
          <li><a href="/fakultas_reviewer_FMIPA?keyword=2021" class="-text">FMIPA</a>
          </li>
          <li><a href="/fakultas_reviewer_FSRD?keyword=2021" class="-text">FSRD</a>
          </li>
          <li><a href="/fakultas_reviewer_FKOR?keyword=2021" class="-text">FKOR</a>
          </li>
          <li><a href="/fakultas_reviewer_SV?keyword=2021" class="-text">SV</a>
          </li>
        </ul>
        <a class="btn dropdown-button waves-effect waves-light teal" href="#!" data-activates="dropdown1">Fakultas<i class="mdi-navigation-arrow-drop-down right"></i></a>
   </div>
     {{--  <br/>
      <br/> --}}
      <div class="col s6 m6 l9" >
        <form style="float: right">
          <input type="hidden" name="keyword" value="{{ $keyword }}" {{-- placeholder="Cari Nama / Judul" --}} >
          <button style="margin-left: 2px;" type="submit" name="keyword" class="btn waves-effect waves-light cyan darken-2" value =2021 >2021</button>
          <button style="margin-left: 2px;" type="submit" name="keyword" class="btn waves-effect waves-light cyan darken-2" value =2020 >2020</button>
          <button style="margin-left: 2px;" type="submit" name="keyword" class="btn waves-effect waves-light cyan darken-2" value =2019 >2019</button>
          <button style="margin-left: 2px;" type="submit" name="keyword" class="btn waves-effect waves-light cyan darken-2" value =2018 >2018</button>
          <button style="margin-left: 2px;" type="submit" name="keyword" class="btn waves-effect waves-light cyan darken-2" value =2017 >2017</button>
        </form>
      </div>
  </div>
</div>
<br/>
<div class="container">
  <div class="row">
    {{-- Grafik 1 --}}
    <div class="col s12 m4 l12">
      <div class="card">
        <div id="chartline">
          @section('graph')
          <script src="https://code.highcharts.com/highcharts.js"></script>
          <script>
        Highcharts.chart('chartline', {
          chart: {
              type: 'areaspline'
          },
          title: {
              text: 'Jumlah Data Reviewer Per Tahun'
          },
          legend: {
              layout: 'vertical',
              align: 'left',
              verticalAlign: 'top',
              x: 90,
              y: 50,
              floating: true,
              borderWidth: 1,
              backgroundColor:
                  Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
          },
          xAxis: {
              categories: [
                  
                  '2017 <br/>',
                  '2018 <br/>',
                  '2019 <br/>',
                  '2020 <br/>',
                  '2021 <br/>'
              ],
              plotBands: [{ // visualize the weekend
                  from: 4.5,
                  to: 6.5,
                  color: 'rgba(68, 170, 213, .2)'
              }]
          },
          yAxis: {
              title: {
                  text: 'Jumlah'
              }
          },
          tooltip: {
              shared: true,
              valueSuffix: ''
          },
          credits: {
              enabled: false
          },
          plotOptions: {
              areaspline: {
                  fillOpacity: 0.5
              }
          },
          series: [{
                name: 'Ditolak',
                data: [ {{ $ditolak17 }},  {{ $ditolak18 }}, {{ $ditolak19 }}, {{ $ditolak20 }}, {{ $ditolak21 }}]

            }, {
                name: 'Menunggu',
                data: [ {{ $menunggu17 }}, {{ $menunggu18 }}, {{ $menunggu19 }}, {{ $menunggu20 }}, {{ $menunggu21 }}, ]

            }, {
                name: 'Tervalidasi',
                data: [ {{ $tervalidasi17 }},  {{ $tervalidasi18 }}, {{ $tervalidasi19 }}, {{ $tervalidasi20 }}, {{ $tervalidasi21 }},]


            }, {
                name: 'Perbaiki',
                data: [ {{ $perbaiki17 }}, {{ $perbaiki18 }}, {{ $perbaiki19 }}, {{ $perbaiki20 }}, {{ $perbaiki21 }},]

              }, {
                name: 'Terverifikasi',
                data: [ {{ $terverifikasi17 }},  {{ $terverifikasi18 }}, {{ $terverifikasi19 }}, {{ $terverifikasi20 }}, {{ $terverifikasi21 }},]
                }]
      });
        </script>
        @stop
        </div>

      </div>
    </div>
    
  </div>
</div>

<div class="container">
  <div class="row">
    {{-- Grafik 2 --}}
    <div class="col s12 m4 l4">
      <div class="card">
          <div id="chartpie">
            @section('graph2')
            
            <script>
            Highcharts.chart('chartpie', {
            chart: {
                type: 'bar'
              
            },
            title: {
                text: 'Tervalidasi Fakultas'
            },
            
            xAxis: {
            
                categories: {!! json_encode($categoriesval) !!},
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
                    dataLabels: {enabled: true}
                }
              
            },
            
            credits: {
                enabled: false
            },
            series:[{
                      name: 'Jumlah Tervalidasi',
                      data: {!! json_encode($dataval) !!},
                              }]
                });
            </script>
            @stop
          </div>
      </div>
    </div>

    {{-- Grafik 3 --}}
    <div class="col s12 m4 l4">
      <div class="card">
        <div id="chartReviewer3">
          @section('graph3')
          
          <script>
          Highcharts.chart('chartReviewer3', {
          chart: {
              type: 'column'
          },
          title: { 
              text: 'Data Kategori Reviewer'
          },
          xAxis: {
              categories: {!! json_encode($categoriescat) !!},
              crosshair: true
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Jumlah Kategori'
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
                  pointPadding: 0.1,
                  borderWidth: 3
              }
          },
          
          series:  [{
                name: 'Jumlah',
                data: {!! json_encode($datacat) !!},
            
            }]

          
          });
          </script>
          @stop
          </div>
        
      </div>
    </div>

    {{-- Grafik 4 --}}
    <div class="col s12 m4 l4">
      <div class="card">
          <div id="media-slider">
            <div class="row">
              <form action="{{ url('kinerja_reviewer') }}" method="get">
                  <div class="slider">
                    <ul class="slides">
                      <li>
                      
                        <div id="chartReviewer4">
                          @section('graph4')
                          
                          <script>
                          Highcharts.chart('chartReviewer4', {
                          chart: {type: 'line'},
                          title: {text: 'Kategori Reviewer per Fakultas'},
                          xAxis: {categories: {!! json_encode($categoriesslide1) !!} },
                          yAxis: {title: { text: 'Jumlah'}},
                          plotOptions: { line: {dataLabels: { enabled: true}, enableMouseTracking: false}},
                          series: [{name: 'Reviewer Jurnal Bereputasi', 
                          data: {!! json_encode($dataslide1) !!}, }]
                          });
                          </script>
                          @stop
                        </div>
                          <div class="fixed-action-btn click-to-toggle" style="position: absolute; left: 40px; bottom:1px;">
                              <button class="btn-floating blue accent-1" type="submit" name="keyword" value ='Reviewer Jurnal Bereputasi (Q1, Q2, Q3 dan Q4)'><i class="large mdi-action-info"></i></button>
                         </div>
                      </li>
                      
                      <li>
                        <div id="chartReviewer5">
                          @section('graph5')
                          
                          <script>
                          Highcharts.chart('chartReviewer5', {
                          chart: {type: 'line'},
                          title: {text: 'Kategori Reviewer per Fakultas'},
                          xAxis: {categories: {!! json_encode($categoriesslide2) !!} },
                          yAxis: {title: { text: 'Jumlah'}},
                          plotOptions: { line: {dataLabels: { enabled: true}, enableMouseTracking: false}},
                          series: [{name: 'Reviewer Jurnal Nasional Terakreditasi', 
                          data: {!! json_encode($dataslide2) !!}, }]
                          });
                          </script>
                          @stop
                        </div>
                          <div class="fixed-action-btn click-to-toggle" style="position: absolute; left: 40px; bottom:1px;">
                              <button class="btn-floating black accent-1" type="submit" name="keyword" value ='Reviewer Jurnal Nasional Terakreditasi (Sinta 1 dan Sinta 2)'><i class="large mdi-action-info"></i></button>
                         </div>
                      </li>

                    </ul>
          
                
                  </div>
              </form>
            </div>
          </div>
      </div>
    </div>
    
  </div>
</div>


<div class="container">
  <a href="/reviewer_ex" class="btn waves-effect waves-light teal" target="kinerja_reviewer">EXPORT EXCEL</a>      
</div>

<div class="container">
<div id="table-datatables">
      <div class="col s12 m8 l9">
        <table id="data-table-simple" class="responsive-table display">
          <thead>
              <tr>
                <th>NO</th>
                <th>NIK</th>
                <th>NAMA DOSEN</th>
                <th>FAKULTAS</th>
                <th>JURUSAN</th>
                <th>NAMA JURNAL</th>
                <th>JUDUL PAPER</th>
                <th>TAHUN</th>
                <th>PUBLISHER</th>
                <th>KATEGORI</th>
                <th>STATUS REVIEWER</th>
              </tr>
          </thead>
       
          <tbody>
            @foreach ($data as $dt)
              <tr>
                <td class="px-6 py-3 leading-6 text-center whitespace-nowrap"><center>{{ ++$i }}</center></td>
                <td>{{ $dt->nip_dosen }}</td>
                <td>{{ $dt->nama }}</td>
                <td>{{ $dt->FAKULTAS }}</td>
                <td>{{ $dt->NAMA }}</td>
                <td>{{ $dt->jurnal }}</td>
                <td>{{ $dt->paper }}</td>
                <td>{{ $dt->tahun }}</td>
                <td>{{ $dt->penerbit}}</td>
                <td>{{ $dt->nama_tmp}}</td>
                <td>{{ $dt->status_reviewer }}</td>
              </tr>
            @endforeach
              
          </tbody>
        </table>
      </div>
      {{-- <ul class="pagination" style="text-align:center">
        <li href="{{ $data->links() }}"></li>
      </ul> --}}
  </div> 
</div>

@endsection


{{-- <div id="morris-bar-chart" class="section">

    <h4 class="header">Bar Chart</h4>
    <div class="row">
      <div class="col s12 m4 l3">
            <p>Grafik Status Kinerja Reviewer Per tahun</p>
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
            title: 'Grafik Kinerja Reviewer',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
</div> --}}