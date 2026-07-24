@extends('admin.master')
    
@section('konten')
<link href="/assets/vendor_datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="/assets/datatables/buttons.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="/assets/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tabel Event</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a>Tabel Event</a></div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">

                  <h4>Tabel Event</h4>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-bordered " id="tabel_event" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Lokasi</th>
                                    <th>Slug</th>
                                    <th>Tanggal</th>
                                    <th>Harga</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                         
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Judul</th>
                                    <th>Lokasi</th>
                                    <th>Slug</th>
                                    <th>Tanggal</th>
                                    <th>Harga</th>
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
      <!-- Datatable JS -->
      <script src="/assets/vendor_datatables/jquery.dataTables.min.js"></script>
      <script src="/assets/vendor_datatables/dataTables.bootstrap4.min.js"></script>
      <script src="/assets/datatables/buttons1.min.js"></script>
      <script src="/assets/datatables/jzip.min.js"></script>
      <script src="/assets/datatables/pdfmake.min.js"></script>
      <script src="/assets/datatables/vfs_font.js"></script>
      <script src="/assets/datatables/buttonhtml5.min.js"></script>

  <script src="/stisla/assets/js/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  <script>

    $(document).ready(function() {
     var aksi_status = true;
     var table = $('#tabel_event').DataTable({
        ajax: {
                url: `/tabel-event/data`,
                method :'get',
                dataSrc: 'data',
            },
            columns: [
                {
                    data: 'judul_event',
                },
                {
                    data: 'lokasi',
                },
                {
                    data: 'slug',
                },
                {
                    data: 'tanggal',
                },
                {
                    data: 'harga',
                },
            ],         
            aoColumnDefs: [{
                    targets: 5,
                    data: 'id',
                    "render": function(data, catatan, row) {
                            return `
                            <a class="" href="/tabel-event-transaksi/transaksi?id=${row.id}"  ><i class="far fa-eye"></i></a>
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
  @endsection