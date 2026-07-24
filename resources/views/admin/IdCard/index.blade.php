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
            <h1>ID Card</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a>ID Card</a></div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">

                  <h4>Daftar ID Card</h4>
                </div>
                <div class="card-body ">
                    <div class="text-right mt-2 mb-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_card">Tambah ID Card</button>
                    </div>

                    <div class="row">
                      @foreach($data as $template)
                          <div class="col-md-3">
                              <label for="radio_{{ $template->id }}">
                                  <input type="radio" name="template_id" id="radio_{{ $template->id }}" value="{{ $template->id }}" @if ($template->status === 'ACTIVE') checked @endif>
                                  <div class="border">
                                      <img style="width: 100%;" src="{{ asset('storage/' . $template->path) }}" alt="{{ $template->nama_gambar }}">
                                  </div>
                              </label>
                              <div class="row">
                                <div class="col-md-6">
                                  <a href="/id-card/<?=$template->id?>">
                                      <button class="btn btn-warning w-100">Ubah</button>
                                  </a>
                                </div>
                                <div class="col-md-6">
                                  <button class="btn btn-danger w-100">Hapus</button>
                                </div>
                              </div>
                          </div>
                      @endforeach
                    </div>
                </div>
              </div>
            </div>
          </div>

    </section>
  </div>

    {{-- start modal tambah data dan edit --}}
    
    <div class="modal fade bd-example-modal-lg" id="modal_card" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ID Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
              <div class="modal-body">
                <form method="POST" action="{{ route('id-card.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="foto" class="form-label">Foto <a id="star_edit_2" style="color: red">*</a></label>
                    <input type="file" class="form-control" id="foto" name="foto" aria-describedby="foto">
                  </div>
                  <div class="text-right"><a style="color: red">*</a> Wajib diisi</div>
                </div>
                <div class="modal-footer">
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

    });
  </script>
  @endsection