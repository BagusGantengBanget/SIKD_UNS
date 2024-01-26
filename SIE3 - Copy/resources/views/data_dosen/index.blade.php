@extends('layouts.master_layout')
@section('title', 'Data Dosen')
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
  <h1 style="color: grey"><b>DATA DOSEN UNIVERSITAS SEBELAS MARET</b></h1>
</div>
<div class="container">
  <div class="row">
      <div class="col s12 m6 l6">
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
                text: 'Jumlah Dosen per Fakultas'
            },
            xAxis: {
                categories: {!! json_encode($categoriesfak) !!},
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
                      name: 'Jumlah Dosen',
                      data: {!! json_encode($datafak) !!},
                              }]
            
            });
            </script>
            @stop
        </div>
      </div>
    </div>

      <div class="col s12 m6 l6">
        <div class="card">
          <div id="chartBuku4">
            @section('graph4')
            <script>
            Highcharts.chart('chartBuku4', {
            chart: {type: 'line'},
            title: {text: 'Pendidikan Dosen per Fakultas'},
            xAxis: {categories:  {!! json_encode($categoriespend) !!}, },
            yAxis: {title: { text: 'Jumlah'}},
            plotOptions: { line: {dataLabels: { enabled: true}, enableMouseTracking: false}},
            series: [{
                    name: 'Pendidikan S2', 
                    data: {!! json_encode($datapend) !!}
                    },{
                    name: 'Pendidikan S3', 
                    data: {!! json_encode($datapend2) !!},
                    }]
            
            });
            </script>
            @stop
          </div>
           {{--  <div class="fixed-action-btn click-to-toggle" style="position: absolute; left: 40px; bottom:1px;">
                  <button class="btn-floating blue accent-1" type="submit" name="keyword" value ='BUKU referensi ber ISBN'><i class="large mdi-action-info"></i></button>
          </div> --}}
        </div>
      </div>
  
  </div>
</div>

<div class="container">
<div id="table-datatables">
    
    <div class="col s12 m8 l12">
      <table id="data-table-simple" class="responsive-table display" cellspacing="0">
        <thead>
            <tr>
              <th>NO</th>
              <th>NIP</th>
              <th>NIDN</th>
              <th>NAMA DOSEN</th>
              <th>TEMPAT LAHIR</th>
              <th >TANGGAL LAHIR</th>
              {{-- <th>JABATAN STRUKTURAL</th> --}}
              <th>FAKULTAS</th>
              <th>JURUSAN</th>
              <th>NO TELP</th>
              <th >EMAIL</th>
              
              {{-- <th >AKSI</th> --}}
            </tr>
        </thead>
     
      
     
        <tbody>
          <?php $no=1; ?>
          @foreach ($data as $dt)
            <tr>
              <td class="px-2 py-3 leading-6 text-center "><center>{{ ++$i }}</center></td>
              <td>{{ $dt->nip_dosen }}</td>
              <td>{{ $dt->nidn }}</td>
              <td>{{ $dt->nama }}</td>
              <td>{{ $dt->tempat_lahir }}</td>
              <td>{{ $dt->tanggal_lahir }}</td>
              {{-- <td>{{ $dt->KETERANGAN_STRUKTURAL}}</td> --}}
              <td>{{ $dt->FAKULTAS }}</td>
              <td>{{ $dt->NAMA }}</td>
              <td>{{ $dt->telp }}</td>
              <td>{{ $dt->email }}</td>
              {{-- <td>
                <div id="modals-demo" class="section"  style="padding-top: 3px; padding-bottom: 3px;">
                    <p><a class="waves-effect waves-light btn modal-trigger light-blue" href="#modal1_{{$dt->id}}" style="padding-left: 10px; padding-right: 10px;"><i class="small mdi-editor-border-color center"></i></a></p>
                    
                    <div id="modal1_{{$dt->id}}" class="modal">
                      <div class="modal-content">
                        <div class="row">
                          <div class="">
                            <div class="">
                              <h6><center><b>Edit Data Dosen</b></center></h6>
                              <br/>
                            </div>
                          </div>
                        </div>
                        
                        <form action="{{ route('data_dosen.update',$dt->id) }}" method="POST">
                          @method('PUT')
                          @csrf
                              <div >
                                  <div class="form-group">
                                      <strong>Nama Dosen :</strong>
                                      <input type="text" name="nama" value="{{ $dt->nama }}" class="form-control" placeholder="Nama">
                                  </div>
                              </div>

                              <div class="modal-footer">

                                <div class="col s12 m8 l7">
                                  <div>
                                    <a class="btn btn-primary modal-action modal-close">BATAL</a>
                                  </div>
                                </div>
                                
                                <div class="col s12 m8 l7">
                                  <div >
                                    <button type="submit" class="btn btn-primary" style="margin-right: 20px;">SUBMIT</button>
                                  </div>
                                </div>
                                
                              </div>
                        </form>
                      </div>
                      
                    </div>
                </div>
                
                <form action="{{ route('data_dosen.destroy',$dt->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" style="padding-left: 10px; padding-right: 10px;"><i class="small mdi-action-delete"></i></button>
                </form>
              </td> --}}
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>




</div>
@endsection
 