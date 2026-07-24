@extends('admin.master')
    
@section('konten')
<link href="/assets/vendor_datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="/assets/datatables/buttons.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Log Anggota</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a>Tabel Anggota</a></div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Tabel Anggota</h4>
                </div>
                <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-bordered " id="tabel_anggota" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Subject</th>
                                <th>URL</th>
                                <th>Method</th>
                                <th>User Agent</th>
                                <th>waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($data as $item)
                                <tr>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->subject}}</td>
                                    <td>{{$item->url}}</td>
                                    <td><span class="badge badge-primary">{{ $item->method }}</span></td>
                                    <td>{{$item->agent}}</td>
                                    <td>{{$item->created_at}}</td>
                                </tr>
                            @endforeach --}}
                        </tbody>
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

    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

   <script>
      $(document).ready(function() {
        var aksi_status = true;
        var table = $('#tabel_anggota').DataTable({
            processing  : true,
            searchable  : true,
            Paginate    : true, 
            serverSide  : true,
            pageLength  : 10,
            ajax: {
                url: '/tabel-log-user/detail/{{$id}}/data',
                type: 'POST',
                headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                // data: {
                //     'id_peserta': '',
                //     'status_logbook': ,
                // }
            },
            
            "columns": [
                { "data": "nama" },
                { "data": "subject" },
                { "data": "url" },
                { "data": "method" },
                { "data": "agent" },
                { "data": "created_at" },
            ],
            "pagingType": "full_numbers",
        });

      });

   </script>

@endsection