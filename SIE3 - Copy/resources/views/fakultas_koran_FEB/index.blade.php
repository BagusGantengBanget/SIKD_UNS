@extends('layouts.master_layout')
@section('title', 'Kinerja Koran FEB')
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
  <h1 style="color: grey"><b>DATA KINERJA KORAN FAKULTAS EKONOMI & BISNIS TAHUN {{ $tahunpen }}</b></h1>
</div>
<div class="container">
  <div class="row">
      <div class="col s6 m6 l3" >
     
          <ul id="dropdown1" class="dropdown-content">
            <li class="{{ 'fakultas_koran_FIB' == request()->path() ? 'active' : '' }}">
              <a href="/fakultas_koran_FIB?keyword=2021" class="-text">FIB</a>
            </li>
            <li class="{{ 'fakultas_koran_FKIP' == request()->path() ? 'active' : '' }}">
              <a href="/fakultas_koran_FKIP?keyword=2021" class="-text">FKIP</a>
            </li>
            <li class="{{ 'fakultas_koran_FH' == request()->path() ? 'active' : '' }}">
              <a href="/fakultas_koran_FH?keyword=2021" class="-text">FH</a>
            </li>
            <li class="{{ 'fakultas_koran_FEB' == request()->path() ? 'active' : '' }}">
              <a href="/fakultas_koran_FEB?keyword=2021" class="-text">FEB</a>
            </li>
            <li class="{{ 'fakultas_koran_FISIP' == request()->path() ? 'active' : '' }}">
              <a href="/fakultas_koran_FISIP?keyword=2021" class="-text">FISIP</a>
            </li>
            <li class="{{ 'fakultas_koran_FP' == request()->path() ? 'active' : '' }}">
              <a href="/fakultas_koran_FP?keyword=2021" class="-text">FP</a>
            </li>
            <li class="{{ 'fakultas_koran_FK' == request()->path() ? 'active' : '' }}">
              <a href="/fakultas_koran_FK?keyword=2021" class="-text">FK</a>
            </li>
            <li class="{{ 'fakultas_koran_FT' == request()->path() ? 'active' : '' }}">
              <a href="/fakultas_koran_FT?keyword=2021" class="-text">FT</a>
            </li>
            <li class="{{ 'fakultas_koran_FMIPA' == request()->path() ? 'active' : '' }}">
              <a href="/fakultas_koran_FMIPA?keyword=2021" class="-text">FMIPA</a>
            </li>
            <li class="{{ 'fakultas_koran_FSRD' == request()->path() ? 'active' : '' }}">
              <a href="/fakultas_koran_FSRD?keyword=2021" class="-text">FSRD</a>
            </li>
            <li class="{{ 'fakultas_koran_FKOR' == request()->path() ? 'active' : '' }}">
              <a href="/fakultas_koran_FKOR?keyword=2021" class="-text">FKOR</a>
            </li>
            <li class="{{ 'fakultas_koran_SV' == request()->path() ? 'active' : '' }}">
              <a href="/fakultas_koran_SV?keyword=2021" class="-text">SV</a>
            </li>
          </ul>
          <a class="btn dropdown-button waves-effect waves-light teal" href="#!" data-activates="dropdown1">Fakultas<i class="mdi-navigation-arrow-drop-down right"></i></a>
      </div>
  
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
              text: 'Jumlah Data Koran Per Tahun di Fakultas Ekonomi & Bisnis'
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
                data: [{{ $ditolak17 }},  {{ $ditolak18 }}, {{ $ditolak19 }}, {{ $ditolak20 }}, {{ $ditolak21 }}]

            }, {
                name: 'Menunggu',
                data: [{{ $menunggu17 }}, {{ $menunggu18 }}, {{ $menunggu19 }}, {{ $menunggu20 }}, {{ $menunggu21 }}, ]

            }, {
                name: 'Tervalidasi',
                data: [{{ $tervalidasi17 }},  {{ $tervalidasi18 }}, {{ $tervalidasi19 }}, {{ $tervalidasi20 }}, {{ $tervalidasi21 }},]


            }, {
                name: 'Perbaiki',
                data: [{{ $perbaiki17 }}, {{ $perbaiki18 }}, {{ $perbaiki19 }}, {{ $perbaiki20 }}, {{ $perbaiki21 }},]

              }, {
                name: 'Terverifikasi',
                data: [{{ $terverifikasi17 }},  {{ $terverifikasi18 }}, {{ $terverifikasi19 }}, {{ $terverifikasi20 }}, {{ $terverifikasi21 }},]
                }]
      });
        </script>
        @stop
        </div>

      </div>
    </div>

  </div>
</div>

<br/>
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
              text: 'Tervalidasi Program Studi'
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
          series: [{
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
      <div id="chartKoran3">
        @section('graph3')
        
        <script>
        Highcharts.chart('chartKoran3', {
        chart: {
            type: 'column'
        },
        title: { 
            text: 'Data Kategori Koran'
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
            <form action="{{ url('kinerja_koran') }}" method="get">
                <div class="slider">
                  <ul class="slides">
                    <li>
                      <div id="chartKoran6">
                        @section('graph6')
                        
                        <script>
                        Highcharts.chart('chartKoran6', {
                        chart: {type: 'line'},
                        title: {text: 'Kategori Koran Program Studi'},
                        xAxis: {categories: {!! json_encode($categoriesslide3) !!} },
                        yAxis: {title: { text: 'Jumlah'}},
                        plotOptions: { line: {dataLabels: { enabled: true}, enableMouseTracking: false}},
                        series: [{name: 'Penulis Koran Internasional', 
                        data: {!! json_encode($dataslide3) !!}, }]
                        });
                        </script>
                        @stop
                      </div>
                        <div class="fixed-action-btn click-to-toggle" style="position: absolute; left: 40px; bottom:1px;">
                            <button class="btn-floating green accent-3" type="submit" name="keyword" value ='PENULIS KORAN INTERNASIONAL'><i class="large mdi-action-info"></i></button>
                       </div>
                    </li>
                    <li>
                    
                      <div id="chartKoran4">
                        @section('graph4')
                        
                        <script>
                        Highcharts.chart('chartKoran4', {
                        chart: {type: 'line'},
                        title: {text: 'Kategori Koran Program Studi'},
                        xAxis: {categories: {!! json_encode($categoriesslide1) !!} },
                        yAxis: {title: { text: 'Jumlah'}},
                        plotOptions: { line: {dataLabels: { enabled: true}, enableMouseTracking: false}},
                        series: [{name: 'Penulis Koran Regional', 
                        data: {!! json_encode($dataslide1) !!}, }]
                        });
                        </script>
                        @stop
                      </div>
                        <div class="fixed-action-btn click-to-toggle" style="position: absolute; left: 40px; bottom:1px;">
                            <button class="btn-floating blue accent-1" type="submit" name="keyword" value ='PENULIS KORAN REGIONAL'><i class="large mdi-action-info"></i></button>
                       </div>
                    </li>
                    
                    <li>
                      <div id="chartKoran5">
                        @section('graph5')
                        
                        <script>
                        Highcharts.chart('chartKoran5', {
                        chart: {type: 'line'},
                        title: {text: 'Kategori Koran Program Studi'},
                        xAxis: {categories: {!! json_encode($categoriesslide2) !!} },
                        yAxis: {title: { text: 'Jumlah'}},
                        plotOptions: { line: {dataLabels: { enabled: true}, enableMouseTracking: false}},
                        series: [{name: 'Penulis Koran Nasional', 
                        data: {!! json_encode($dataslide2) !!}, }]
                        });
                        </script>
                        @stop
                      </div>
                        <div class="fixed-action-btn click-to-toggle" style="position: absolute; left: 40px; bottom:1px;">
                            <button class="btn-floating black accent-1" type="submit" name="keyword" value ='PENULIS KORAN NASIONAL'><i class="large mdi-action-info"></i></button>
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
<a href="/koran_ex" class="btn waves-effect waves-light teal" target="kinerja_koran">EXPORT EXCEL</a>
</div>

<div class="container">

  <div id="table-datatables">
   {{--  @yield('table-datables') --}}
      <div class="col s12 m8 l12">
        <table id="data-table-simple" class="responsive-table display"  >
          <thead>
            <tr>
              <th>NO</th>
              <th>NIK</th>
              <th width="120px">NAMA DOSEN</th>
              <th>FAKULTAS</th>
              <th>JURUSAN</th>
              <th>JUDUL KORAN</th>
              <th>PUBLISHER</th>
              <th width="130px">TANGGAL MUAT</th>
              <th>TAHUN</th>
              <th>KATEGORI</th>
              <th width="120px">STATUS KORAN</th>
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
              <td>{{ $dt->nama_koran }}</td>
              <td>{{ $dt->dimuat }}</td>
              <td>{{ $dt->tanggal_muat }}</td>
              <td>{{ $dt->tahun }}</td>
              <td>{{ $dt->nama_tmp }}</td>
              <td>{{ $dt->status_koran }}</td>
            </tr>
          @endforeach
            
        </tbody>
        </table>
      </div>
      
        {{--   <ul class="pagination" style="text-align:center">
            <li href="{{ $data->links() }}"></li>
          </ul> --}}
  </div> 
</div>
  <br>


  @endsection
  {{-- <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/query.dataTables.js"></script>
  <script>
    $(document).ready(function() {
      var table = $('datatable').DataTable({
        'processing' : true,
        'serverSide':true,
        'ajax': "{{ route('api.Kinerja_koran.index') }}",
        'columns': [
          {'data': 'judul_koran'},
          {'data': 'penerbit'},
          {'data': 'isbn'},
          {'data': 'tahun'},
          {'data': 'status_koran'},
          {'data': 'halaman'},
          {'data': 'tanggal_rev'},
          {'data': 'status_bayar'}
  
        ],
      });
  
      $('.filter-select').change(function() {
        table.columns ( $(this).data('column') )
        .search( $(this).val() )
        .draw();
      });
  
    })
  </script> --}}

    {{-- <div class="container">
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script>
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Tahun', 'Ditolak', 'Menunggu', 'Perbaiki', 'Tervalidasi'],
            ['2014', {{ $ditolak14 }}, {{ $menunggu14 }}, {{ $perbaiki14 }}, {{ $tervalidasi14 }}],
          
            
          ]);

          var options = {
            chart: {
              title: 'Grafik Kinerja koran',
              subtitle: '',
            }
          };

          var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

          chart.draw(data, google.charts.Bar.convertOptions(options));
        }
      </script>
      <div id="columnchart_material" style="width: 100%; height: 400px;"></div>
    
</div> --}}