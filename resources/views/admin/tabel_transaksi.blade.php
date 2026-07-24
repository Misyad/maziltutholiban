@extends('admin.master')
    
@section('konten')
<link href="/assets/vendor_datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="/assets/datatables/buttons.min.css" rel="stylesheet" />
<link href="/assets/datetime/jquery.datetimepicker.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="/assets/ckeditor/ckeditor.js"></script>
<script src="/assets/datetime/jquery.datetimepicker.full.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
                  <h4>Peserta</h4>
                </div>
                <div class="card-body ">
                <div class="text-right mt-2 mb-4">
                    <button type="button" class="btn btn-primary mx-3" onclick="tambahTransaksiAnggota()" >Tambah Transaksi Anggota Terdaftar</button>
                    <button type="button" class="btn btn-primary" onclick="tambahTransaksi()" >Tambah Transaksi</button>
                  </div>
                    <div class="table-responsive">
                        <table class="table table-bordered " id="tabel_event" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">ID Anggota</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Id Transaksi</th>
                                    <th class="text-center">Pembayaran</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              @php
                                  $no = 1;
                              @endphp
                              @foreach ($transaksi as $item)
                                <tr>
                                  <td class="text-center">{{$no++}}</td>
                                  <td>{{$item->id_anggota}}</td>
                                  <td>{{$item->name}}</td>
                                  <td>{{$item->order_id}}</td>
                                  <td>Rp. {!! ($item->gross_amount)?$item->gross_amount:'-' !!}</td>
                                  <td class="text-center">@php
                                      switch ($item->transaction_status) {
                                        case 'settlement':
                                            echo '<span class="badge bg-success text-white">Pembayaran Berhasil</span>';
                                          break;
                                        case 'pending':
                                            echo '<span class="badge bg-primary text-white">Pembayaran Pending</span>';
                                          break;
                                        case 'capture':
                                            echo '<span class="badge bg-warning  text-white">Pembayaran akan diproses 1x24 jam</span>';
                                          break;
                                        case 'cancel':
                                            echo '<span class="badge bg-danger text-white">Pembayaran Dibatalkan</span>';
                                          break;
                                        case 'offline':
                                            echo '<span class="badge bg-warning text-white">Pembayaran Melalui admin</span>';
                                          break;
                                        default:
                                            echo '<span class="badge bg-danger text-white">Pembayaran Tidak ada status</span>';
                                          break;
                                      }
                                  @endphp</td>
                                  <td>{{$item->updated_at}}</td>
                                  <td class="text-center">

                                    @php
                                      switch ($item->transaction_status) {
                                          case 'settlement':
                                            echo '<a class="btn btn-primary" target="_blank" href="/tabel-event-transaksi/transaksi/'.$item->id.'/'.$item->id_anggota.'"  ><i class="fas fa-print" ></i> Cetak ID Card</a>';
                                            break;
                                          case 'offline':
                                            echo '<a class="btn btn-warning text-white" onclick="verifikasiPendaftarModal(`'. $item->id_anggota .'`)" ><i class="far fa-edit" ></i> Verifikasi </a>';
                                            break;
                                          case '':
                                            echo '<a class="btn btn-warning text-white" onclick="verifikasiPendaftarModal(`'. $item->id_anggota .'`)" ><i class="far fa-edit" ></i> Verifikasi </a>';
                                            break;
                                          default:
                                            echo '-';
                                            break;
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
            </div>
          </div>
    </section>
  </div>
<div class="modal fade" id="modal_bayar" data-backdrop="static" data-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h5 class="modal-title" id="staticBackdropLabel">Isi Data Pembayaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="/pengumunan/infak/pembayaran" method="POST" id="formDaftar">
              @csrf
              <div class="mb-3">
                <label for="nama" class="form-label">Nama <a style="color : red">*</a></label>
                <input type="text" class="form-control" required id="nama" maxlength="40"  oninvalid="this.setCustomValidity('Nama Tidak Boleh Kosong.')" onchange="this.setCustomValidity('')"  name="nama" placeholder="Isikan Dengan Nama Anda">
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Nomer telpon <a style="color : red">*</a></label>
                <input type="number" class="form-control numberonly" maxlength="20" required id="nomer_telpon"  name="nomer_telpon" oninvalid="this.setCustomValidity('Nomer telpon Tidak Boleh Kosong.')" onchange="this.setCustomValidity('')"   placeholder="Contoh Nomer telpon : 08123231331">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email"  name="email"   placeholder="Isikan dengan email anda">
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat <a style="color : red">*</a></label>
                <textarea class="form-control" id="alamat" required maxlength="100" name="alamat" rows="3" oninvalid="this.setCustomValidity('Alamat Tidak Boleh Kosong.')" onchange="this.setCustomValidity('')" ></textarea>
              </div>
              <div class="mb-3">
                <label for="niqobah" class="form-label">Niqobah<a style="color : red">*</a></label>
                <input type="text" class="form-control" required id="niqobah" maxlength="20" name="niqobah" aria-describedby="tanggal_lahir" placeholder="Isikan dengan niqobah anda" oninvalid="this.setCustomValidity('Niqobah Tidak Boleh Kosong.')" onchange="this.setCustomValidity('')">
              </div>
              <div class="mb-3">
                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                <input type="text" class="form-control"  id="pekerjaan" maxlength="20" name="pekerjaan" aria-describedby="tanggal_lahir" placeholder="Isikan dengan pekerjaan anda">
              </div>
              <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir <a style="color : red">*</a></label>
                <input type="text" required class="form-control"  id="tempat_lahir" maxlength="20" name="tempat_lahir" aria-describedby="tanggal_lahir" placeholder="Isikan dengan pekerjaan anda">
              </div>
              <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal lahir <a style="color : red">*</a></label>
                <input type="date" class="form-control" required id="tanggal_lahir" name="tanggal_lahir" aria-describedby="tanggal_lahir" oninvalid="this.setCustomValidity('Tanggal lahir tidak boleh Kosong.')" onchange="this.setCustomValidity('')">
              </div>
              <div class="mb-3">
                <label for="tahun_masuk" class="form-label">Tahun masuk <a style="color : red">*</a></label>
                <input type="date" class="form-control" required id="tahun_masuk" name="tahun_masuk" aria-describedby="tanggal_lahir" oninvalid="this.setCustomValidity('Tahun masuk Tidak Boleh Kosong.')" onchange="this.setCustomValidity('')">
              </div>
              <div class="mb-3">
                  <label for="tahun_keluar" class="form-label">Tahun keluar <a style="color : red">*</a></label>
                  <input type="date" class="form-control" required id="tahun_keluar" name="tahun_keluar" aria-describedby="tanggal_lahir" oninvalid="this.setCustomValidity('Tahun keluar Tidak Boleh Kosong.')" onchange="this.setCustomValidity('')">
              </div>
              <div class="mb-3">
                <label for="infak" class="form-label">Infak <a style="color : red">*</a></label>
                <input type="text" class="form-control" required   id="infak" name="infak" aria-describedby="infak">
            </div>
              <div class="mb-3">
                <label for="foto" class="form-label">foto </label>
                <input type="file" class="form-control"  id="foto" name="foto" aria-describedby="foto" oninvalid="this.setCustomValidity('Foto Tidak Boleh Kosong.')" onchange="this.setCustomValidity('')">
                <small style="color :red;">Format foto harus: jpg atau png | Foto diri menggunakan baju koko dan kofyah putih</small>
              </div>
              <div class="text-end"><a style="color : red">*</a> Wajib diisi</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
          </div>
        </div>
      </div>
  </div>
<div class="modal fade" id="modalverifikasi" data-backdrop="static" data-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h5 class="modal-title" id="staticBackdropLabel">Isi Data Pembayaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="/pengumunan/infak/pembayaran" method="POST" id="formVerifikasi">
              @csrf
              <div class="mb-3">
                <label for="infak" class="form-label">Infak <a style="color : red">*</a></label>
                <input type="text" class="form-control" required   id="infak2" name="infak" aria-describedby="infak">
                <input type="hidden" class="form-control" required   id="id_anggota" name="id_anggota" aria-describedby="id_anggota">
            </div>
              <div class="text-end"><a style="color : red">*</a> Wajib diisi</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
          </div>
        </div>
      </div>
</div>
<div class="modal fade" id="modalTambahAnggota" data-backdrop="static" data-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h5 class="modal-title" id="staticBackdropLabel">Tambah Transaksi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="/pengumunan/infak/pembayaran" method="POST" id="formTransaksiAdmin">
              @csrf
              <div class="mb-3">
                <label for="infak" class="form-label">Nama Anggota <a style="color : red">*</a></label>
                <select class="form-control select2" required name="nama_anggota" id="nama_anggota">
                  <option value="" disabled selected>Pilih Nama</option>
                  @foreach ($data_user as $item)
                    <option value="{{$item->id_anggota}}">{{$item->name}} - {{$item->id_anggota}}</option>
                  @endforeach
                </select>
            </div>
              <div class="text-end"><a style="color : red">*</a> Wajib diisi</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
          </div>
        </div>
      </div>
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
  <script src="/stisla/assets/js/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script>

          $(document).ready(function() {
             $('#tabel_event').DataTable({
        dom: 'Bfrtip', // 'B' untuk tombol Buttons
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
             $('#formDaftar')[0].reset();
             $(".select2").select2({
              dropdownParent: $("#modalTambahAnggota").parent()
            });
          });



  


      function tambahTransaksiAnggota()
      {
        setTimeout(()=>{
            $('#modalTambahAnggota').removeAttr('tabindex');
        });
        $('#modalTambahAnggota').modal('show');
      }

      $('#infak').on('input', function (e) {
        var inputValue = $(this).val();
        if (inputValue) {
            var numericValue = unformatRupiah(inputValue);
            $(this).val(formatRupiah(numericValue, 'Rp. '));
        }
      });
      $('#infak2').on('input', function (e) {
        var inputValue = $(this).val();
          if (inputValue) {
            var numericValue = unformatRupiah(inputValue);
            $(this).val(formatRupiah(numericValue, 'Rp. '));
          }
      });

      function formatRupiah(angka, prefix) {
          var rupiah = ''; // Inisialisasi variabel rupiah

          if (typeof angka === 'string') {
              // Jika angka adalah string, kita langsung gunakan
              rupiah = angka;
          } else if (typeof angka === 'number') {
              // Jika angka adalah number, kita konversi ke string dan gunakan
              rupiah = angka.toString();
          } else {
              // Jika angka tidak sesuai, beri nilai default
              rupiah = '0';
          }

          var split = rupiah.split(',');
          var sisa = split[0].length % 3;
          rupiah = split[0].substr(0, sisa);
          var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

          if (ribuan) {
              separator = sisa ? '.' : '';
              rupiah += separator + ribuan.join('.');
          }

          rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

          if (prefix == undefined) {
              return rupiah;
          } else {
              return rupiah ? prefix + rupiah : prefix;
          }
      }


      function unformatRupiah(rupiah) {
          return parseInt(rupiah.replace(/[^0-9]/g, ''), 10);
      }

          function tambahTransaksi()
          {
            $('#modal_bayar').modal('show');
          }

          $('#formDaftar').on('submit', function(e){
            e.preventDefault();
            var data = new FormData(this);
            data.append('id_event','{{$id_event}}');
            $.ajax({
            url: "/tabel-event-transaksi/simpan",
            method: "POST",
            data:  data,
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
            processData: false,
            contentType: false,
            success: function(response) {
              if(response.success){
                Swal.fire('berhasil !!!', 'Pendaftaran berhasil', "success");
                location.reload();
              }else{
                Swal.fire(response.message, response.data, "error");
              }
            },
            error: function(response){
              Swal.fire('Pendaftaran Gagal!',response.responseJSON.data, "error");
              console.log(response.responseJSON.message);
            }
        });

          });

          function verifikasiPendaftarModal(id_anggota)
          {
     
            $('#id_anggota').val(id_anggota);
            $('#modalverifikasi').modal('show');

          }

          $('#formVerifikasi').on('submit', function(e){
            e.preventDefault();
            var data = new FormData(this);
            data.append('id_event','{{$id_event}}');
            $.ajax({
            url: "/tabel-event-transaksi/verifikasi",
            method: "POST",
            data:  data,
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
            processData: false,
            contentType: false,
                success: function(response) {
                  if(response.success){
                    Swal.fire('berhasil !!!', 'Verifikasi berhasil', "success");
                    location.reload();
                  }else{
                    Swal.fire(response.message, response.data, "error");
                  }
                },
                error: function(response){
                  Swal.fire('Pendaftaran Gagal!',response.responseJSON.message, "error");
                  console.log(response.responseJSON.message);
                }
            });

          });
          $('#formTransaksiAdmin').on('submit', function(e){
            e.preventDefault();
            var data = new FormData(this);
            data.append('id_event','{{$id_event}}');
            $.ajax({
            url: "/tabel-event-transaksi/tambah-transasi-anggota",
            method: "POST",
            data:  data,
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
            processData: false,
            contentType: false,
                success: function(response) {
                  if(response.success){
                    Swal.fire('berhasil !!!', 'Tambah berhasil', "success");
                    location.reload();
                  }else{
                    Swal.fire(response.message, response.data, "error");
                  }
                },
                error: function(response){
                  Swal.fire('Pendaftaran Gagal!',response.responseJSON.message, "error");
                  console.log(response.responseJSON.message);
                }
            });

          });

        </script>


  @endsection