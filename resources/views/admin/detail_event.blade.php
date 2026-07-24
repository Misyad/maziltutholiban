@extends('admin.master')
    
@section('konten')
<link href="/assets/vendor_datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="/assets/datatables/buttons.min.css" rel="stylesheet" />
<link href="/assets/datetime/jquery.datetimepicker.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="/assets/ckeditor/ckeditor.js"></script>
<script src="/assets/datetime/jquery.datetimepicker.full.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Event Detail</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a>Tabel Event</a></div>
                <div class="breadcrumb-item active"><a>Event Detail</a></div>
           
            </div>
          </div>
          <div class="row">
            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Event Detail</h4>
                  </div>
                  <div class="card-body ">
                    <div class="text-center mb-4">
                        <h4>{{$data->judul_event}}</h4>
                    </div>
                        @if ($data->banner)
                            <div class="text-center mb-4">
                                <img alt="image" src="/storage/{{$data->banner}}" class="img-fluid">
                              </div>
                        @endif

                        @php
                            echo $data->deskripsi;
                        @endphp
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Waktu Kegiatan</h4>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-bordered " id="tabel_event" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                         
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
          

    </section>
  </div>

    {{-- start modal tambah data dan edit --}}
    
    <div class="modal fade bd-example-modal-lg" id="modal_event" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
            <div class="modal-body">
                <form id="form_event" >
                    <div class="mb-3">
                        <label for="judul" class="form-label">Full day : </label>
                        <input type="checkbox" data-toggle="toggle" value="full_day" id="full_day">
                        <input type="hidden" class="form-control" id="id_event" name="id_event" aria-describedby="nama">
                    </div>
                    <div class="mb-3">
                      <div class="row">
                        <div class="col-md-6">
                          <label for="start_date" class="form-label">Waktu Mulai</label>
                          <input type="text" class="form-control" required id="start_date" name="start_date" aria-describedby="judul">
                        </div>
                        <div class="col-md-4">
                          <label for="end_date" class="form-label">Waktu Selesai</label>
                          <input type="text" class="form-control" required id="end_date" name="end_date" aria-describedby="judul">
                        </div>
                        <div class="col-2">
                          <label for="sampai_selesai" class="form-label">Sampai Selesai</label>
                          <input type="checkbox" data-toggle="toggle" value="sampai_selesai" id="sampai_selesai">
                        </div>
                      </div>
                   
                    </div>
                </div>
                <div class="modal-footer">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            </div>
          </div>
        </div>
      </div>

    {{-- end modal tambah data dan edit --}}


      <!-- Datatable JS -->
      <script src="/assets/vendor_datatables/jquery.dataTables.min.js"></script>
      <script src="/assets/vendor_datatables/dataTables.bootstrap4.min.js"></script>
      <script src="/assets/datatables/buttons1.min.js"></script>
      <script src="/assets/datatables/jzip.min.js"></script>
      <script src="/assets/datatables/pdfmake.min.js"></script>
      <script src="/assets/datatables/vfs_font.js"></script>
      <script src="/assets/datatables/buttonhtml5.min.js"></script>
      <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script src="/stisla/assets/js/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  @if (in_array('event', $status_akses))
        <script>

          $(document).ready(function() {
          var aksi_status = true;
          var id = {{$data->id}};
          var table = $('#tabel_event').DataTable({
              ajax: {
                      url: `/tabel-event/detail/data`,
                      method :'post',
                      dataSrc: 'data',
                      headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                      data: {'id' : {{$data->id}} },
                  },
                  columns: [
                      {
                          data: 'tanggal',
                      },
                      {
                          data: function(data, catatan, row) {
                                  if (data.set_jam == 'seharian') {
                                      return `full day`
                                  } else {
                                      return `${moment(data.jam_mulai, 'HH:mm:ss.SSSS').format('HH:mm')} - ${data.jam_selesai}`
                                  }
                              },
                      },
                  ],         
                  aoColumnDefs: [{
                          targets: 2,
                          data: 'id',
                          "render": function(data, catatan, row) {
                                  return `
                                  <a class="" href="#" id="btn_edit" 

                                  data-id="${data}" 
                                  data-tanggal="${row.tanggal}" 
                                  data-jam-mulai="${row.jam_mulai}" 
                                  data-jam-selesai="${row.jam_selesai}" 
                                  data-set-jam="${row.set_jam}" 

                                  ><i class="fas fa-clock" ></i></a>
                                  <a class="" href="/tabel-event/detail/{{$data->id}}/${row.id}/prisensi"  ><i class="far fa-arrow-alt-circle-right"></i></a>
                                  
                                  `;
      
                              }
                          }, ],
                      dom: 'Bfrtip',
                      buttons: [
                          'copy', 'csv', 'excel', 'pdf', 'print'
                      ]
          });

          $('#tabel_event tbody').on('click', '#btn_edit', function(e) {
                  e.preventDefault();
                  aksi_status = true;
                  // var status = $('#full_day').prop('checked');
                  // statusdata(status);

                  var id = this.getAttribute('data-id');
                  var tanggal = this.getAttribute('data-tanggal');
                  var jam_mulai = this.getAttribute('data-jam-mulai');
                  var jam_selesai = this.getAttribute('data-jam-selesai');
                  var set_jam = this.getAttribute('data-set-jam');

                  if (set_jam == 'seharian') {

                      var status = true;
                      $(`#full_day`).prop( "checked", true );
                      $(`#full_day`).trigger("click");
                      statusdata(status);
                      if (set_jam == "sampai selesai") {
                        $(`#sampai_selesai`).prop( "checked", false );
                        $(`#sampai_selesai`).trigger("click");
                      }else{
                        $(`#sampai_selesai`).prop( "checked", true );
                        $(`#sampai_selesai`).trigger("click");
                      }
                      
                  } else {
                      var status = false;
                      $(`#full_day`).prop( "checked", false );
                      $(`#full_day`).trigger("click");
                      if (jam_selesai == "sampai selesai") {
                        $(`#sampai_selesai`).prop( "checked", true );
                        $(`#sampai_selesai`).trigger("click");
                        $("#start_date").val(moment(jam_mulai, 'HH:mm:ss.SSSS').format('HH:mm'));;
                        $("#end_date").val('');
                      }else{
                        $(`#sampai_selesai`).prop( "checked", false );
                        $(`#sampai_selesai`).trigger("click");
                        $("#start_date").val(moment(jam_mulai, 'HH:mm:ss.SSSS').format('HH:mm'));;
                        $("#end_date").val(jam_selesai);
            
                      }

                  }


                  
      
                  $('#id_event').val(id);

                  $('#modal_event').modal('show');

          });

          function statusCek(){

          }

          $('#form_event').submit(function(e){
              e.preventDefault();
            var id_event = $("#id_event").val();
            var start_date = $("#start_date").val();
            var end_date =  $("#end_date").val();
            var status_d = $('#full_day').prop('checked');
            var status_s = $('#sampai_selesai').prop('checked');

            if(start_date > end_date ){
                if(status_s){
                  datSendStatus(id_event,start_date,end_date,status_d,status_s);
                }else{
                    Toast.fire({
                    icon: 'error',
                    title: 'waktu mulai lebih besar'
                  });
                }
            }else{
                datSendStatus(id_event,start_date,end_date,status_d,status_s);
            }
            
          });

          function datSendStatus(id_event,start_date,end_date,status_d,status_s){

            $.ajax({
                              url: "/tabel-event/detail/save",
                              method: "POST",
                              headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              },
                              data: { 'id_event' : id_event ,'start_date' : start_date, 'end_date' : end_date, 'full_day' : status_d, 'sampai_selesai' : status_s},
                              success: function(data) {
                                  table.ajax.reload();
                                  $('#modal_event').modal('hide');
                                  Toast.fire({
                                      icon: 'success',
                                      title: 'Berhasil hapus data'
                                  });
                              },
                              error: function(data, exception){
                                  Toast.fire({
                                      icon: 'error',
                                      title: exception
                                  });
                              }
              });
          }

          $('#full_day').change(function(e){
            e.preventDefault();
            var status = $('#full_day').prop('checked');
            statusdata(status);
          })
          $('#sampai_selesai').change(function(e){
            e.preventDefault();
            var status = $('#sampai_selesai').prop('checked');
            if(status){
                $("#end_date").prop('disabled', true);
                $("#end_date").val('');
            }else{
                $("#end_date").prop('disabled', false);
                $("#end_date").val('');
              }
          })

          function statusdata(status){
              if(status){
                $("#start_date").prop('disabled', true);
                $("#end_date").prop('disabled', true);
                $("#sampai_selesai").prop('disabled', true);
                $(`#sampai_selesai`).prop( "checked", true );
                $(`#sampai_selesai`).trigger("click");
                cleardesabled();
              }else{
                $("#start_date").prop('disabled', false);
                $("#end_date").prop('disabled', false);
                $("#sampai_selesai").prop('disabled', false);
                $(`#sampai_selesai`).prop( "checked", false );
                $(`#sampai_selesai`).trigger("click");
                cleardesabled();
              }
          }
          
          function cleardesabled(){
              $("#start_date").val('');
              $("#end_date").val('');

          }

          $('#start_date').datetimepicker({
            datepicker:false,
            format:'H:i'
          });
          $('#end_date').datetimepicker({
            datepicker:false,
            format:'H:i'
          });


      
          });
        </script>
  @else
    <script>

            $(document).ready(function() {
            var aksi_status = true;
            var id = {{$data->id}};
            var table = $('#tabel_event').DataTable({
                ajax: {
                        url: `/tabel-prisensi/detail/data`,
                        method :'post',
                        dataSrc: 'data',
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        data: {'id' : {{$data->id}} },
                    },
                    columns: [
                        {
                            data: 'tanggal',
                        },
                        {
                            data: function(data, catatan, row) {
                                    if (data.set_jam == 'seharian') {
                                        return `full day`
                                    } else {
                                        return `${moment(data.jam_mulai, 'HH:mm:ss.SSSS').format('HH:mm')} - ${data.jam_selesai}`
                                    }
                                },
                        },
                    ],         
                    aoColumnDefs: [{
                            targets: 2,
                            data: 'id',
                            "render": function(data, catatan, row) {
                                    return `
                                    <a class="" href="/tabel-prisensi/detail/{{$data->id}}/${row.id}/prisensi"  ><i class="far fa-arrow-alt-circle-right"></i></a>
                                    
                                    `;

                                }
                            }, ],
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
            });

      



            });
    </script>
  @endif

  @endsection