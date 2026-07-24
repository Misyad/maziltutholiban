@extends('admin.master')
    
@section('konten')
<style>
.scroll {
  max-height: 600px;
  overflow-y: auto;
  height:  600px;

}
</style>
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="/stisla/node_modules/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="/stisla/assets/css/components.css">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
     
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="far fa-calendar-alt"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Event</h4>
              </div>
              <div class="card-body">
                {{$event}}  
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="far fa-calendar-check"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Event Selesai</h4>
              </div>
              <div class="card-body">
                {{$event_selesai}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-redo-alt"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Event Upcoming</h4>
              </div>
              <div class="card-body">
                {{$event_mendatang}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-user-friends"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Anggota</h4>
              </div>
              <div class="card-body">
                {{$total_anggota}}  
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="row">

        <div class="col-lg-5">
          <div class="card">
            <div class="card-header">
              <h4>Event</h4>
            </div>
            <div class="card-body table-responsive scroll">
              <table class="table table-striped ">
                <thead>
                  <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($event_all as $val)
                  <tr>
                    <td>{{$val->judul_event}}</td>
                    <td>@php
                       echo  date('d/m/Y', strtotime($val->tanggal_mulai )) .' - '. date('d/m/Y', strtotime($val->tanggal_selesai));;
                    @endphp</td>
                    <td>
                      @php

                        if ($val->status == "Ongoing") {
                          echo '<span class="badge badge-info">Ongoing</span>';
                        }elseif ($val->status == "Complate") {
                          echo '<span class="badge badge-success">Complate</span>';
                        }elseif ($val->status == "Upcomming") {
                          echo '<span class="badge badge-warning">Upcomming</span>';
                        }
                    @endphp
                    </td>
                  </tr>
                  @endforeach
             
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card">
            <div class="card-header">
              <h4>Upcoming Event</h4>
            </div>
            <div class="card-body">
              <div class="fc-overflow">
                <div id="myEvent"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- JS Libraies -->
  <script src="/stisla/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
  <script src="/stisla/node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="/stisla/node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
  <script src="/stisla/node_modules/summernote/dist/summernote-bs4.js"></script>
  <script src="/stisla/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <script src="/stisla/assets/js/moment.min.js"></script>

    <!-- JS Libraies -->
    <script src="/stisla/node_modules/fullcalendar/dist/fullcalendar.min.js"></script>
      <!-- Page Specific JS File -->
  <script>
    $(document).ready(function() {
         var data1;
          $.ajax({
                        url: "/dashboard/get-calender",
                        method: "get",
                        success: function(data) {
                          data1 = data['data'];
                      $("#myEvent").fullCalendar({
                        height: 'auto',
                        header: {
                          left: 'prev,next today',
                          center: 'title',
                          right: 'month'
                        },
                        editable: true,
                        events: data1

                      });
                      
                    },
                        error: function(data, exception){
                            alert('server not responding...');
                        }
                      });

  });
  </script>

@endsection
     