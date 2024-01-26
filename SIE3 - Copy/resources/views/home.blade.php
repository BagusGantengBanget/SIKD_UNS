@extends('layouts.master_layout')
@section('title', 'Home')
@section('content')
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Stencil+Display:wght@300;600&family=Lobster&display=swap" rel="stylesheet"> 
    <link href="js\plugins\prism\prism.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js\plugins\perfect-scrollbar\perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js\plugins\data-tables\css\jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js\plugins\chartist-js\chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    
    <style>
   
   table {
     font-size: 12px;
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

    .container2{
        background-color: grey;
    }

    h4{
        font-family: 'Lobster', cursive;
        color: white;
    }


    .p2{
        text-align: justify;    
    }
    </style>

</head>
<body>
    <br/>
<div class="container">
    <div class="card">
    <div class="container2">
        <marquee>
        <h4>Selamat Datang di Sistem Informasi Kinerja Dosen Universitas Sebelas Maret</h4> 
        </marquee>
    </div>
    </div>
</div>

<div class="container">
    <div class="row">
            <div class="col s12 m8 l8">
                <div class="p2">
                    SIKD UNS (Sistem Informasi Kinerja Dosen) Universitas Sebelas Maret merupakan sarana untuk mengetahui informasi-informasi terkait berbagai kinerja dosen yang ada di UNS secara online dan terintegrasi. 
                    Melalui aplikasi ini diharapkan mampu memberikan layanan kepada pengguna khususnya eksekutif dan staff universitas dalam melakukan pencarian maupun pendataan tentang dokumentasi hasil kinerja yang telah dilakukan oleh dosen di Universitas Sebelas Maret
                    lengkap dengan beberapa keterangan mendetail seperti nama kegiatan, waktu pelaksanaan, lokasi, tahun pelaksanakan dan lain lain.  
                    Pengguna juga dapat melihat perkembangan kinerja dosen dan penelitian yang telah dilakukan dari manapun dan kapanpun, 
                    sehingga informasi yang ada dapat diakses dengan mudah. Selain itu update data selalu diperbaharui dengan cepat dan di publikasikan dengan media web 
                    sehingga kinerja maupun hasil penelitian yang telah dilakukan akan lebih update dan bermanfaat bagi semua yang membutuhkan.
                </div>
                <br/>
                 <a href="https://iris1103.uns.ac.id/" class="btn waves-effect waves-light teal">Info  lebih lanjut..</span></a>
            </div>

            <div class="col s1 m8 l4">
                <div class="product-card">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img src="images\gallary\uns.png" alt="UNS">
                        </div>
                        <ul class="card-action-buttons">
                            <li><a class="btn-floating waves-effect waves-light green accent-4"><i class="mdi-av-repeat"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light red accent-2"><i class="mdi-action-favorite"></i></a>
                            </li>
                            <li><a class="btn-floating waves-effect waves-light light-blue"><i class="mdi-action-info activator"></i></a>
                            </li>
                        </ul>
                        <div class="card-content">

                            <div class="row">
                                <div class="col s8 l7">
                                    <p class="card-title grey-text text-darken-4"><a href="https://uns.ac.id/id/" class="grey-text text-darken-4">Universitas Sebelas Maret, Surakarta</a>
                                    </p>
                                </div>
                                <div class="col s4 no-padding">
                                    <a href=""></a><img src="images\logo-uns3.png" alt="logo-uns" class="responsive-img">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i> <b>Universitas Sebelas Maret</b></span>
                            <p>Universitas Sebelas Maret (disingkat UNS) adalah salah satu universitas negeri di Indonesia yang berada di Kota Solo. Universitas yang giat membangun ini, menyediakan berbagai paket pendidikan mulai dari diploma, sarjana, pascasarjana, dan doktoral. </p>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>

<br/>
{{-- Grafik Dosen --}}
{{-- <div class="container">
    <div class="row">
    <div class="col s12 m4 l4">
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
                text: 'Data Kategori Buku'
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
            
            series: [{
                  name: 'Agung Nugroho Catur Saputro',
                
                  data: [ 
                    @foreach ($dosenbuku1 as $dt)
                        $dt->total
                    @endforeach
                        ]
                  
    
              
    
              }]
  
            
            });
            </script>
            @stop
            </div>
  
        </div>
      </div>
    </div>
</div> --}}

<div class="container">
    <hr/>
            <h5><b>Daftar Dosen Dengan Jumlah Index Tertinggi</b></h5>
            <p> Berikut merupakan daftar dosen yang memiliki index tertinggi di masing-masing bidang kinerja. Terdapat 5 dosen yang
                menyumbang produk terbanyak di setiap bidangnya.</p>
</div>


{{-- Tabel Kolom 1 --}}
<div class="container">
    <div class="row">
        {{-- Tabel TOP Buku --}}
        <div id="table-datatables" >
            <div class="col s12 m8 l4" style="padding-right: 30px;">
                    <h4 style="color: grey"><center>Buku</center></h4>
                    <div class="card">
                        <table class="responsive-table display"  >
                            <thead>
                            <tr>
                                <th><center>NO</center></th></center>
                                <th><center>NAMA DOSEN</center></th>
                                <th><center>FAKULTAS</center></th>
                                <th><center>TOTAL</center></th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php $no=0; ?>
                            @foreach ($dosenbuku1 as $dt)
                            <tr>
                                <td class="px-6 py-3 leading-6 text-center whitespace-nowrapper"><center>{{ ++$no }}</center></td>
                                <td>{{ $dt->nama }}</td>
                                <td>{{ $dt->FAKULTAS }}</td>
                                <td>{{ $dt->total }}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        </table>
                    </div>
            </div>
        {{-- Tabel TOP hakipaten --}}
            <div class="col s12 m8 l4" style="padding-right: 15px; padding-left: 15px;">
                <h4 style="color: grey"><center>Hakipaten</center></h4>
                <div class="card">
                    <table class="responsive-table display" >
                        <thead>
                        <tr>
                            <th><center>NO</center></th></center>
                            <th>NAMA DOSEN</th>
                            <th><center>FAKULTAS</center></th>
                            <th><center>TOTAL</center></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $no=0; ?>
                        @foreach ($dosenhakipaten1 as $dt)
                        <tr>
                            <td class="px-6 py-3 leading-6 text-center whitespace-nowrapper"><center>{{ ++$no }}</center></td>
                            <td>{{ $dt->nama }}</td>
                            <td>{{ $dt->FAKULTAS }}</td>
                            <td>{{ $dt->total }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
            </div>
        {{-- Tabel TOP Jurnal --}}
            <div class="col s12 m8 l4" style="padding-left: 30px;">
                <h4 style="color: grey"><center>Jurnal</center></h4>
                <div class="card">
                    <table class="responsive-table display" >
                        <thead>
                        <tr>
                            <th><center>NO</center></th></center>
                            <th>NAMA DOSEN</th>
                            <th><center>FAKULTAS</center></th>
                            <th><center>TOTAL</center></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $no=0; ?>
                        @foreach ($dosenjurnal1 as $dt)
                        <tr>
                            <td class="px-6 py-3 leading-6 text-center whitespace-nowrapper"><center>{{ ++$no }}</center></td>
                            <td>{{ $dt->nama }}</td>
                            <td>{{ $dt->FAKULTAS }}</td>
                            <td>{{ $dt->total }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
</div>

{{-- Tabel Kolom 2 --}}
<br/>
<div class="container">
    <div class="row">
        <div id="table-datatables" >
            <div class="col s12 m8 l4" style="padding-right: 30px;">
                <h4 style="color: grey"><center>Karya Cipta</center></h4>
                <div class="card">
                    <table class="responsive-table display"  >
                        <thead>
                        <tr>
                            <th><center>NO</center></th></center>
                            <th><center>NAMA DOSEN</center></th>
                            <th><center>FAKULTAS</center></th>
                            <th><center>TOTAL</center></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $no=0; ?>
                        @foreach ($dosenkaryacipta1 as $dt)
                        <tr>
                            <td class="px-6 py-3 leading-6 text-center whitespace-nowrapper"><center>{{ ++$no }}</center></td>
                            <td>{{ $dt->nama }}</td>
                            <td>{{ $dt->FAKULTAS }}</td>
                            <td>{{ $dt->total }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
            </div>

            <div class="col s12 m8 l4" style="padding-right: 15px; padding-left: 15px;">
                <h4 style="color: grey"><center>Karya Seni</center></h4>
                <div class="card">
                    <table class="responsive-table display" >
                        <thead>
                        <tr>
                            <th><center>NO</center></th></center>
                            <th>NAMA DOSEN</th>
                            <th><center>FAKULTAS</center></th>
                            <th><center>TOTAL</center></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $no=0; ?>
                        @foreach ($dosenkaryaseni1 as $dt)
                        <tr>
                            <td class="px-6 py-3 leading-6 text-center whitespace-nowrapper"><center>{{ ++$no }}</center></td>
                            <td>{{ $dt->nama }}</td>
                            <td>{{ $dt->FAKULTAS }}</td>
                            <td>{{ $dt->total }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
            </div>

            <div class="col s12 m8 l4" style="padding-left: 30px;">
                <h4 style="color: grey"><center>Koran</center></h4>
                <div class="card">
                    <table class="responsive-table display" >
                        <thead>
                        <tr>
                            <th><center>NO</center></th></center>
                            <th>NAMA DOSEN</th>
                            <th><center>FAKULTAS</center></th>
                            <th><center>TOTAL</center></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $no=0; ?>
                        @foreach ($dosenkoran1 as $dt)
                        <tr>
                            <td class="px-6 py-3 leading-6 text-center whitespace-nowrapper"><center>{{ ++$no }}</center></td>
                            <td>{{ $dt->nama }}</td>
                            <td>{{ $dt->FAKULTAS }}</td>
                            <td>{{ $dt->total }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
            </div>
        </div> 


    </div>
</div>

{{-- Tabel Kolom 3 --}}
<br/>
<div class="container">
    <div class="row">
        <div id="table-datatables" >
            <div class="col s12 m8 l4" style="padding-right: 30px;">
                <h4 style="color: grey"><center>Pembicara</center></h4>
                <div class="card">
                    <table class="responsive-table display"  >
                        <thead>
                        <tr>
                            <th><center>NO</center></th></center>
                            <th><center>NAMA DOSEN</center></th>
                            <th><center>FAKULTAS</center></th>
                            <th><center>TOTAL</center></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $no=0; ?>
                        @foreach ($dosenpembicara1 as $dt)
                        <tr>
                            <td class="px-6 py-3 leading-6 text-center whitespace-nowrapper"><center>{{ ++$no }}</center></td>
                            <td>{{ $dt->nama }}</td>
                            <td>{{ $dt->FAKULTAS }}</td>
                            <td>{{ $dt->total }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
            </div>

            <div class="col s12 m8 l4" style="padding-right: 15px; padding-left: 15px;">
                <h4 style="color: grey"><center>Pengabdian</center></h4>
                <div class="card">
                    <table class="responsive-table display" >
                        <thead>
                        <tr>
                            <th><center>NO</center></th></center>
                            <th>NAMA DOSEN</th>
                            <th><center>FAKULTAS</center></th>
                            <th><center>TOTAL</center></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $no=0; ?>
                        @foreach ($dosenpengabdian1 as $dt)
                        <tr>
                            <td class="px-6 py-3 leading-6 text-center whitespace-nowrapper"><center>{{ ++$no }}</center></td>
                            <td>{{ $dt->nama }}</td>
                            <td>{{ $dt->FAKULTAS }}</td>
                            <td>{{ $dt->total }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
            </div>

            <div class="col s12 m8 l4" style="padding-left: 30px;">
                <h4 style="color: grey"><center>Program</center></h4>
                <div class="card">
                    <table class="responsive-table display" >
                        <thead>
                        <tr>
                            <th><center>NO</center></th></center>
                            <th>NAMA DOSEN</th>
                            <th><center>FAKULTAS</center></th>
                            <th><center>TOTAL</center></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $no=0; ?>
                        @foreach ($dosenprogram1 as $dt)
                        <tr>
                            <td class="px-6 py-3 leading-6 text-center whitespace-nowrapper"><center>{{ ++$no }}</center></td>
                            <td>{{ $dt->nama }}</td>
                            <td>{{ $dt->FAKULTAS }}</td>
                            <td>{{ $dt->total }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
            </div>
        </div> 


    </div>
</div>

{{-- Tabel Kolom 4 --}}
<br/>
<div class="container">
    <div class="row">
        <div id="table-datatables" >
            <div class="col s12 m8 l4" style="padding-right: 30px;">
                <h4 style="color: grey"><center>Reviewer</center></h4>
                <div class="card">
                    <table class="responsive-table display"  >
                        <thead>
                        <tr>
                            <th><center>NO</center></th></center>
                            <th><center>NAMA DOSEN</center></th>
                            <th><center>FAKULTAS</center></th>
                            <th><center>TOTAL</center></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $no=0; ?>
                        @foreach ($dosenreviewer1 as $dt)
                        <tr>
                            <td class="px-6 py-3 leading-6 text-center whitespace-nowrapper"><center>{{ ++$no }}</center></td>
                            <td>{{ $dt->nama }}</td>
                            <td>{{ $dt->FAKULTAS }}</td>
                            <td>{{ $dt->total }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
            </div>

            <div class="col s12 m8 l4" style="padding-right: 15px; padding-left: 15px;">
                <h4 style="color: grey"><center>Scopus</center></h4>
                <div class="card">
                    <table class="responsive-table display" >
                        <thead>
                        <tr>
                            <th><center>NO</center></th></center>
                            <th>NAMA DOSEN</th>
                            <th><center>FAKULTAS</center></th>
                            <th><center>TOTAL</center></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $no=0; ?>
                        @foreach ($dosenscopus1 as $dt)
                        <tr>
                            <td class="px-6 py-3 leading-6 text-center whitespace-nowrapper"><center>{{ ++$no }}</center></td>
                            <td>{{ $dt->nama }}</td>
                            <td>{{ $dt->FAKULTAS }}</td>
                            <td>{{ $dt->total }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
            </div>

            <div class="col s12 m8 l4" style="padding-left: 30px;">
                <h4 style="color: grey"><center>Seminar</center></h4>
                <div class="card">
                    <table class="responsive-table display" >
                        <thead>
                        <tr>
                            <th><center>NO</center></th></center>
                            <th>NAMA DOSEN</th>
                            <th><center>FAKULTAS</center></th>
                            <th><center>TOTAL</center></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $no=0; ?>
                        @foreach ($dosenseminar1 as $dt)
                        <tr>
                            <td class="px-6 py-3 leading-6 text-center whitespace-nowrapper"><center>{{ ++$no }}</center></td>
                            <td>{{ $dt->nama }}</td>
                            <td>{{ $dt->FAKULTAS }}</td>
                            <td>{{ $dt->total }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
            </div>
        </div> 


    </div>
</div>

{{-- <br/>
<div class="container">
    <div class="row">
        <div id="table-datatables">
            <div class="col s12 m8 l12">
              <table id="data-table-simple" class="responsive-table display"  >
                <thead>
                  <tr>
                    <th><center>NO</center></th></center>
                    <th><center>NAMA DOSEN</center></th>
                    <th><center>FAKULTAS</center></th>
                    <th><center>TOTAL</center></th>
                    
                  </tr>
              </thead>
              
              <tbody>
                <?php $no=0; ?>
                @foreach ($data as $dt)
                  <tr>
                    <td class="px-6 py-3 leading-6 text-center whitespace-nowrapper"><center>{{ ++$no }}</center></td>
                    <td>{{ $dt->nama }}</td>
                    <td>{{ $dt->FAKULTAS }}</td>
                    <td>{{ $dt->total }}</td>
                    
                  </tr>
                @endforeach
                  
              </tbody>
              </table>
            </div>
            
            
        </div> 
    </div>
</div> --}}

<br/>
<br/>
<br/>
</body>
@endsection