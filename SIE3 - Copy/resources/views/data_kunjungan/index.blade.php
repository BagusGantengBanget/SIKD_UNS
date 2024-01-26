@extends('layouts.master_layout')
@section('title', 'Data Kunjungan')
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

{{-- <div class="container">
  <div class="col s12 m4 l12">
    <div class="card">
      <div id="chartBuku3">
        @section('graph3')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script>
        Highcharts.chart('chartBuku3', {
        chart: {
            type: 'column'
        },
        title: { 
            text: 'Jumalh Dosen per Fakultas'
        },
        xAxis: {
            categories: [
                'Kategori Buku <br/>',
                
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Dosen'
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
                              name: 'FIB',
                              data: [{{ $FIB }}],

                          }, {
                              name: 'FKIP',
                              data: [{{ $FKIP }}]

                          }, {
                              name: 'FH',
                              data: [{{ $FH }}]

                          }, {
                              name: 'FEB',
                              data: [{{ $FEB }}]

                          }, {
                              name: 'FISIP',
                              data: [{{ $FISIP }} ]

                          }, {
                              name: 'FP',
                              data: [{{ $FP }} ]

                          }, {
                              name: 'FK',
                              data: [{{ $FK }} ]

                          }, {
                              name: 'FT',
                              data: [{{ $FT }} ]

                          }, {
                              name: 'FMIPA',
                              data: [{{ $FMIPA }} ]

                          }, {
                              name: 'FSRD',
                              data: [{{ $FSRD }} ]

                          }, {
                              name: 'FKOR',
                              data: [{{ $FKOR }} ]

                          }, {
                              name: 'SV',
                              data: [{{ $SV }} ]

                              }]

        
        });
        </script>
        @stop
    </div>
  </div>
</div> --}}
<br/>
<div class="container">
  <div id="table-datatables">
    <div class="col s12 m8 l9">
      <table id="data-table-simple" class="responsive-table display" cellspacing="0">
        <thead>
            <tr>
              <th>NO</th>
              <th>NAMA PAKAR</th>
              <th>NEGARA TUJUAN</th>
              <th>NAMA INSTITUSI</th>
              <th>NAMA KONTAK</th>
              <th>LAMA KUNJUNGAN</th>
              <th>WEB</th>
              <th >TAHUN</th>
            </tr>
        </thead>
     
        <tbody>
          <?php $no=1; ?>
          @foreach ($data as $dt)
            <tr>
              <td class="px-2 py-3 leading-6 text-center "><center>{{ ++$i }}</center></td>
              <td>{{ $dt->nama_pakar }}</td>
              <td>{{ $dt->negara_tujuan }}</td>
              <td>{{ $dt->nama_institusi }}</td>
              <td>{{ $dt->nama_kontak }}</td>
              <td>{{ $dt->lama_kunjungan }}</td>
              <td>{{ $dt->web_institusi }}</td>
              <td>{{ $dt->tahun }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
  {{--  <td>
                <a  class="waves-effect waves-light btn modal-trigger  teal" href="#modal1">Detail</a>
                <div id="modal1" class="modal">
                  <div class="modal-content">
                  teassasasa
                  </div>
                  <div class="modal-footer">
                    <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Disagree</a>
                    <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Agree</a>
                  </div>
                </div>
              </td> --}}