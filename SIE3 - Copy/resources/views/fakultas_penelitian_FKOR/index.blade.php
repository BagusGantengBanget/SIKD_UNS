@extends('layouts.master_layout')
@section('title', 'Data Penelitian FKOR')
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
  <h1 style="color: grey"><b>DATA PENELITIAN FAKULTAS KEOLAHRAGAAN TAHUN {{ $tahunpen }}</b></h1>
</div>
<div class="container">
  <div class="row">
      <div class="col s6 m6 l3" >
        <ul id="dropdown1" class="dropdown-content">
          <li class="{{ 'fakultas_penelitian_FIB' == request()->path() ? 'active' : '' }}">
            <a href="/fakultas_penelitian_FIB?keyword=2021" class="-text">FIB</a>
          </li>
          <li class="{{ 'fakultas_penelitian_FKIP' == request()->path() ? 'active' : '' }}">
            <a href="/fakultas_penelitian_FKIP?keyword=2021" class="-text">FKIP</a>
          </li>
          <li class="{{ 'fakultas_penelitian_FH' == request()->path() ? 'active' : '' }}">
            <a href="/fakultas_penelitian_FH?keyword=2021" class="-text">FH</a>
          </li>
          <li class="{{ 'fakultas_penelitian_FEB' == request()->path() ? 'active' : '' }}">
            <a href="/fakultas_penelitian_FEB?keyword=2021" class="-text">FEB</a>
          </li>
          <li class="{{ 'fakultas_penelitian_FISIP' == request()->path() ? 'active' : '' }}">
            <a href="/fakultas_penelitian_FISIP?keyword=2021" class="-text">FISIP</a>
          </li>
          <li class="{{ 'fakultas_penelitian_FP' == request()->path() ? 'active' : '' }}">
            <a href="/fakultas_penelitian_FP?keyword=2021" class="-text">FP</a>
          </li>
          <li class="{{ 'fakultas_penelitian_FK' == request()->path() ? 'active' : '' }}">
            <a href="/fakultas_penelitian_FK?keyword=2021" class="-text">FK</a>
          </li>
          <li class="{{ 'fakultas_penelitian_FT' == request()->path() ? 'active' : '' }}">
            <a href="/fakultas_penelitian_FT?keyword=2021" class="-text">FT</a>
          </li>
          <li class="{{ 'fakultas_penelitian_FMIPA' == request()->path() ? 'active' : '' }}">
            <a href="/fakultas_penelitian_FMIPA?keyword=2021" class="-text">FMIPA</a>
          </li>
          <li class="{{ 'fakultas_penelitian_FSRD' == request()->path() ? 'active' : '' }}">
            <a href="/fakultas_penelitian_FSRD?keyword=2021" class="-text">FSRD</a>
          </li>
          <li class="{{ 'fakultas_penelitian_FKOR' == request()->path() ? 'active' : '' }}">
            <a href="/fakultas_penelitian_FKOR?keyword=2021" class="-text">FKOR</a>
          </li>
          <li class="{{ 'fakultas_penelitian_SV' == request()->path() ? 'active' : '' }}">
            <a href="/fakultas_penelitian_SV?keyword=2021" class="-text">SV</a>
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
    
    {{-- Grafik Status --}}
    <div class="col s12 m4 l6">
      <div class="card">
        <div id="chartpenelitian3">
          @section('graph3')
          
          <script>
          Highcharts.chart('chartpenelitian3', {
          chart: {
              type: 'column'
          },
          title: { 
              text: 'Status Data Penelitian Fakultas keolahragaan',
          },
          xAxis: {
              categories: {!! json_encode($categoriesval) !!},
              crosshair: true
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Jumlah Penelitian'
              }
          },
          /* legend: {
              backgroundColor:
              Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
          }, */
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
          
          series: [{
                      name: 'Jumlah Status',
                      data: {!! json_encode($dataval) !!},
                              }]

          
          });
          </script>
          @stop
          </div>

      </div>
    </div>

    {{-- Grafik Prodi --}}
    <div class="col s12 m4 l6">
        <div class="card">
            <div id="chartpie">
              @section('graph2')
              <script src="https://code.highcharts.com/highcharts.js"></script>
              <script>
              Highcharts.chart('chartpie', {
              chart: {
                  type: 'bar'
                
              },
              title: {
                  text: 'Jumlah Penelitian Program Studi'
              },
              
              xAxis: {
              
                  categories: {!! json_encode($categoriesfak) !!},
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
                      name: 'Jumlah Penelitian',
                      data: {!! json_encode($datafak) !!},
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
  {{-- grafik bidang ilmu --}}
  <div class="col s6 m6 l6">
    <div class="card">
      <div id="chartpenelitian4">
        @section('graph4')
        
        <script>
        Highcharts.chart('chartpenelitian4', {
        chart: {
            type: 'line'
        },
        title: { 
            text: 'Data Bidang Ilmu'
        },
        xAxis: {
            categories: {!! json_encode($categoriesilmu) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Bidang Ilmu'
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
        
        series: [{
                    name: 'Bidang Ilmu',
                    data: {!! json_encode($datailmu) !!},
                            }]

        
        });
        </script>
        @stop
        </div>
    </div>
  </div>

  {{-- grafik Bidang kajian --}}
  <div class="col s6 m6 l6">
    <div class="card">
      <div id="chartpenelitian8">
        @section('graph8')
        
        <script>
        Highcharts.chart('chartpenelitian8', {
        chart: {
            type: 'line'
        },
        title: { 
            text: 'Data Bidang Kajian'
        },
        xAxis: {
            categories: {!! json_encode($categorieskajian) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Bidang Kajian'
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
        
        series: [{
                    name: 'Bidang Kajian',
                    data: {!! json_encode($datakajian) !!},
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

  <div id="table-datatables">
   
      <div class="col s12 m8 l9">
        <table  id="data-table-simple" class="responsive-table display" >
          <thead>
            <tr>
              <th>NO</th>
              <th>ID TRANSAKSI</th>
              <th>NAMA DOSEN</th>
              <th>FAKULTAS</th>
              <th>JURUSAN</th>
              <th>JUDUL</th>
              <th>SKIM</th>
              <th>JENIS</th>
              <th>TAHUN</th>
              <th>BIAYA</th>
              <th>STATUS</th>
              <th>BIDANG ILMU</th>
              <th>BIDANG KAJIAN</th>
        
            </tr>
          </thead>
        
          <tbody>
          <?php $no=1; ?>
          @foreach ($data as $dt)
            <tr>
              <td class="px-2 py-3 leading-6 text-center "><center>{{ ++$i }}</center></td>
              <td>{{ $dt->id_transaksi }}</td>
              <td>{{ $dt->nama }}</td>
              <td>{{ $dt->FAKULTAS }}</td>
              <td>{{ $dt->NAMA }}</td>
              <td>{{ $dt->judul_penelitian }}</td>
              <td>{{ $dt->nama_penelitian }}</td>
              <td>{{ $dt->jenis }}</td>
              <td>{{ $dt->tahun_penelitian }}</td>
              <td>{{ $dt->biaya_setuju }}</td>
              <td>{{ $dt->nama_status }}</td>
              <td>{{ $dt->nama_bidangilmu }}</td>
              <td>{{ $dt->nama_kajian }}</td>
            </tr>
          @endforeach
            
          </tbody>

        </table>
      
</div>
<br>


  @endsection
  