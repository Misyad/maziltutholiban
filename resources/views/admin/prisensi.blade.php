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
	
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Prisensi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a>Tabel Event</a></div>
                <div class="breadcrumb-item "><a>Event Detail</a></div>
                <div class="breadcrumb-item active"><a>Prisensiaa</a></div>
           
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Scann Barcode</h4>
                </div>
                <div class="card-body ">
                    <div>
                        <input type='text' class="form-control" id="input_scan">
                        <button type="button" id="btn_clear_text" class="btn btn-success mt-2" >Clear Text</button>
                    </div>
                    <script>
       
                    </script>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Prisensi</h4>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-bordered " id="tabel_event" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id Anggota</th>
                                    <th>Nama</th>
                                    <th>Tanggal Hadir</th>
                                    <th>Jam Hadir</th>
                                </tr>
                            </thead>
                            <tbody>
                         
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id Anggota</th>
                                    <th>Nama</th>
                                    <th>Tanggal Hadir</th>
                                    <th>Jam Hadir</th>
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

  <div class="modal fade bd-example-modal-sm" id="modal_event" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Anggota</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
        <div class="modal-body">
            <div class="col-md-12 text-center mb-2">
                <img src="/storage/" id="img_view" alt="" class="img-fluid " srcset="">
            </div>
            <div class="col-md-12 text-center">
                <a id="nama_atas" style="font-size:18px;"></a>
            </div>
            <div class="col-md-12 text-center mb-3 mt-3">
            <button type="button" class="btn btn-primary" id="button_detail">Detail</button>
            </div>
            <form id="form_prisensi" style="display: none;">
                <div class="mb-3">
                    <label for="id_anggota" class="form-label">ID Anggota </label>
                    <input type="text" class="form-control" disabled required id="id_anggota" name="id_anggota" aria-describedby="nama">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama </label>
                    <input type="text" class="form-control" disabled required id="nama" name="nama" aria-describedby="nama">
                    <input type="hidden" class="form-control" id="id_users" name="id_users" aria-describedby="nama">
                    <input type="hidden" class="form-control" id="id_anggota_2" name="id_anggota_2" aria-describedby="nama">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email </label>
                    <input type="email" class="form-control" disabled required id="email" name="email" aria-describedby="email">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat </label>
                    <textarea class="form-control" id="alamat" disabled required maxlength="50" name="alamat" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="niqobah" class="form-label">Niqobah</label>
                    <input type="text" class="form-control" disabled required id="niqobah" maxlength="15" name="niqobah" aria-describedby="tanggal_lahir">
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal lahir </label>
                    <input type="date" class="form-control" disabled required id="tanggal_lahir" name="tanggal_lahir" aria-describedby="tanggal_lahir">
                </div>
                <div class="mb-3">
                    <label for="tahun_masuk" class="form-label">Tahun masuk </label>
                    <input type="date" class="form-control" disabled required id="tahun_masuk" name="tahun_masuk" aria-describedby="tanggal_lahir">
                </div>
                <div class="mb-3">
                    <label for="tahun_keluar" class="form-label">Tahun keluar </label>
                    <input type="date" class="form-control" disabled required id="tahun_keluar" name="tahun_keluar" aria-describedby="tanggal_lahir">
                </div>
            </div>
            <div class="modal-footer">
                @csrf
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            var interval;

            $("#button_detail").click(function() {
                var formPrisensi = $("#form_prisensi");
                var tombolTampilkanSembunyikan = $("#button_detail");

                if (formPrisensi.is(":hidden")) {
                    formPrisensi.show();
                    tombolTampilkanSembunyikan.text("Hide");
                } else {
                    formPrisensi.hide();
                    tombolTampilkanSembunyikan.text("Detail");
                }
            });
            $('#input_scan').val("").focus();
                $('#input_scan').keyup(function(e){
                    var tex = $(this).val();
                    
                    if(tex !=="" && e.keyCode===13){
                        getDataUser(tex)
                    }
                    e.preventDefault();
                });
                $('#btn_clear_text').click(function(){
                    $('#input_scan').val("").focus();
            });

            function getDataUser(id){
                $.ajax({
                                url: "/data-user-prisensi",
                                method: "POST",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {'id' : id},
                                success: function(data) {
                                    var data_c = data['data']['0']; 

                                    $('#id_users').val(data_c.id_users);
                                    $('#id_anggota_2').val(data_c.id_anggota);
                                    $('#nama').val(data_c.nama);
                                    $('#nama_atas').html(data_c.nama);
                                    $('#email').val(data_c.email);
                                    $('#alamat').val(data_c.alamat);
                                    $('#niqobah').val(data_c.niqobah);
                                    $('#tahun_masuk').val(data_c.tahun_masuk);
                                    $('#tahun_keluar').val(data_c.tahun_keluar);
                                    $('#tanggal_lahir').val(data_c.tanggal_lahir);
                                    $('#id_anggota').val(data_c.id_anggota);
                                    $('#img_view').attr(`src`,`/storage/${data_c.foto}`);
                                    $("#form_prisensi").hide();
                                    $('#modal_event').modal('show');
                                    interval =  window.setInterval(function () {
                                        $('#modal_event').modal('hide');
                                        $('#form_prisensi').submit();
                                    }, 5000);
                                },
                                error: function(data, exception){
                                    console.log(data);
                                    Toast.fire({
                                        icon: 'error',
                                        title: exception
                                    });
                                }
                });
            }

       

            $('#form_prisensi').submit(function(e){
                    e.preventDefault();
                    var data = new FormData(this);
                    var id_event = {{$id_event}};
                    var id_tanggal = {{$id_tanggal}};
                    data.append('id_event', id_event);
                    data.append('id_tanggal', id_tanggal);
                        $.ajax({
                            url: "/data-user-prisensi/send-data",
                            method: "POST",
                            data:  data,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                table.ajax.reload();
                                $('#modal_event').modal('hide');
                                $('#input_scan').val("").focus();
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Prisensi Berhasil'
                                });
                                window.clearInterval(interval);
                            },
                            error: function(data){
                                Toast.fire({
                                    icon: 'error',
                                    title: data['responseJSON']['message']
                                });
                                $('#input_scan').val("").focus();
                                window.clearInterval(interval);
                            }
                        });
        


                });
            var table = $('#tabel_event').DataTable({
                ajax: {
                        url: `/data-user-prisensi/get-data-tabel`,
                        method :'post',
                        dataSrc: 'data',
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        data: {'id_event' : {{$id_event}},'id_tanggal' : {{$id_tanggal}} },
                    },
                    columns: [
                        {
                            data: 'id_anggota',
                        },
                        {
                            data: 'nama',
                        },
                        {
                            data: function(data, catatan, row) {
                                return moment(`${data.tanggal_kehadiran}`).format('DD-MM-YYYY')
                            },
                        },
                        {
                            data: function(data, catatan, row) {
                                return moment(`${data.jam_kehadiran}`).format('HH:mm:ss')
                        
                                },
                        },
                    ],         
                    // aoColumnDefs: [{
                    //         targets: 4,
                    //         data: 'id',
                    //         "render": function(data, catatan, row) {
                    //                 return `
                    //                 <a class="" href="#" id="btn_edit" 

                    //                 data-id="${data}" 
                    //                 data-tanggal="${row.tanggal}" 
                    //                 data-jam-mulai="${row.jam_mulai}" 
                    //                 data-jam-selesai="${row.jam_selesai}" 
                    //                 data-set-jam="${row.set_jam}" 

                    //                  ><i class="fas fa-clock" ></i></a>
                    //                 <a class="" href="/tabel-anggota/kta/${row.id}"  ><i class="far fa-arrow-alt-circle-right"></i></a>
                                    
                    //                 `;
                    //             }
                    //         }, ],
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
            });


        
            });
  </script>
@else
<script>

            $(document).ready(function() {
            var aksi_status = true;
            var interval;
            
            $("#button_detail").click(function() {
                var formPrisensi = $("#form_prisensi");
                var tombolTampilkanSembunyikan = $("#button_detail");

                if (formPrisensi.is(":hidden")) {
                    formPrisensi.show();
                    tombolTampilkanSembunyikan.text("Hide");
                } else {
                    formPrisensi.hide();
                    tombolTampilkanSembunyikan.text("Detail");
                }
            });
            $('#input_scan').val("").focus();
                $('#input_scan').keyup(function(e){
                    var tex = $(this).val();
                    
                    if(tex !=="" && e.keyCode===13){
                        getDataUser(tex)
                    }
                    e.preventDefault();
                });
                $('#btn_clear_text').click(function(){
                    $('#input_scan').val("").focus();
            });

            function getDataUser(id){
                $.ajax({
                                url: "/data-user-prisensi-anggota",
                                method: "POST",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {'id' : id},
                                success: function(data) {
                                    var data_c = data['data']['0']; 

                                    $('#id_users').val(data_c.id_users);
                                    $('#id_anggota_2').val(data_c.id_anggota);
                                    $('#nama').val(data_c.nama);
                                    $('#email').val(data_c.email);
                                    $('#alamat').val(data_c.alamat);
                                    $('#niqobah').val(data_c.niqobah);
                                    $('#tahun_masuk').val(data_c.tahun_masuk);
                                    $('#tahun_keluar').val(data_c.tahun_keluar);
                                    $('#tanggal_lahir').val(data_c.tanggal_lahir);
                                    $('#id_anggota').val(data_c.id_anggota);
                                    $('#img_view').attr(`src`,`/storage/${data_c.foto}`);
                                    $("#form_prisensi").hide();
                                    $('#modal_event').modal('show');
                                    interval =  window.setInterval(function () {
                                        $('#modal_event').modal('hide');
                                        $('#form_prisensi').submit();
                                    }, 5000);
                                },
                                error: function(data, exception){
                                    console.log(data);
                                    Toast.fire({
                                        icon: 'error',
                                        title: exception
                                    });
                                }
                });
            }
            $('#form_prisensi').submit(function(e){
                    e.preventDefault();
                    var data = new FormData(this);
                    var id_event = {{$id_event}};
                    var id_tanggal = {{$id_tanggal}};
                    data.append('id_event', id_event);
                    data.append('id_tanggal', id_tanggal);
                        $.ajax({
                            url: "/data-user-prisensi-anggota/send-data",
                            method: "POST",
                            data:  data,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                table.ajax.reload();
                                $('#modal_event').modal('hide');
                                $('#input_scan').val("").focus();
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Prisensi Berhasil'
                                });
                                window.clearInterval(interval);
                            },
                            error: function(data){
                                Toast.fire({
                                    icon: 'error',
                                    title: data['responseJSON']['message']
                                });
                                $('#input_scan').val("").focus();
                                window.clearInterval(interval);
                            }
                        });
                });

            var table = $('#tabel_event').DataTable({
                ajax: {
                        url: `/data-user-prisensi-anggota/get-data-tabel`,
                        method :'post',
                        dataSrc: 'data',
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        data: {'id_event' : {{$id_event}},'id_tanggal' : {{$id_tanggal}} },
                    },
                    columns: [
                        {
                            data: 'id_anggota',
                        },
                        {
                            data: 'nama',
                        },
                        {
                            data: function(data, catatan, row) {
                                return moment(`${data.tanggal_kehadiran}`).format('DD-MM-YYYY')
                            },
                        },
                        {
                            data: function(data, catatan, row) {
                                return moment(`${data.jam_kehadiran}`).format('HH:mm:ss')
                        
                                },
                        },
                    ],         
                    // aoColumnDefs: [{
                    //         targets: 4,
                    //         data: 'id',
                    //         "render": function(data, catatan, row) {
                    //                 return `
                    //                 <a class="" href="#" id="btn_edit" 

                    //                 data-id="${data}" 
                    //                 data-tanggal="${row.tanggal}" 
                    //                 data-jam-mulai="${row.jam_mulai}" 
                    //                 data-jam-selesai="${row.jam_selesai}" 
                    //                 data-set-jam="${row.set_jam}" 

                    //                  ><i class="fas fa-clock" ></i></a>
                    //                 <a class="" href="/tabel-anggota/kta/${row.id}"  ><i class="far fa-arrow-alt-circle-right"></i></a>
                                    
                    //                 `;
                    //             }
                    //         }, ],
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
            });



            });
</script>
@endif

  @endsection