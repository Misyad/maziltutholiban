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
            <h1>Prisensi</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a>Prisensi</a></div>
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
                <div class="col-md-12 text-center mb-2">
                    <img src="/storage/" id="img_view" alt="" class="img-fluid " srcset="">
                </div>
                <form id="form_event" >
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul <a style="color : red">*</a></label>
                        <input type="text" class="form-control" required id="judul" name="judul" aria-describedby="judul">
                        <input type="hidden" class="form-control" id="id_event" name="id_event" aria-describedby="nama">
                        <input type="hidden" class="form-control" id="foto_lama" name="foto_lama" aria-describedby="nama">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug <a style="color : red">*</a></label>
                        <input type="text" class="form-control" required id="slug" name="slug" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi <a style="color : red">*</a></label>
                        <textarea class="form-control" id="deskripsi" required maxlength="50" name="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal <a style="color : red">*</a></label>
                        <input type="text" class="form-control" required id="tanggal" name="tanggal" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="banner" class="form-label">Banner</label>
                        <input type="file" class="form-control" id="banner" name="banner" aria-describedby="judul">
                    </div>
            
                    <div class="text-right"><a style="color : red">*</a> Wajib diisi</div>
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

  <script src="/stisla/assets/js/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  <script>

    $(document).ready(function() {
     var aksi_status = true;
     var table = $('#tabel_event').DataTable({
        ajax: {
                url: `/tabel-prisensi/data`,
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
            ],         
            aoColumnDefs: [{
                    targets: 4,
                    data: 'id',
                    "render": function(data, catatan, row) {
                            return `
                            <a class="" href="/tabel-prisensi/detail/${row.id}"  ><i class="far fa-arrow-alt-circle-right"></i></a>
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