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
            <h1>Profil</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a>Profil</a></div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">

                  <h4>{{auth()->user()->name}}</h4>
                </div>
                <div class="card-body ">
                  <div class="text-center">
                    <img alt="image" src="/storage/{{$foto_profil}}" class="img-fluid">
                  </div>
                  <form action="/profil/edit" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-4">
                      <label for="nama" class="form-label">Nama<a style="color : red">*</a></label>
                      <input type="text" class="form-control" value="{{$profil->nama}}" required id="nama" name="nama" aria-describedby="nama">
                      <input type="hidden" class="form-control" id="id_users" value="{{$profil->id_users}}" name="id_users" aria-describedby="nama">
                      <input type="hidden" class="form-control" id="barcode" value="{{$profil->barcode}}" name="barcode" aria-describedby="nama">
                      <input type="hidden" class="form-control" id="foto_lama" value="{{$profil->foto}}" name="foto_lama" aria-describedby="nama">
                  </div>
                  <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" value="{{$profil->email}}"  id="email" name="email" aria-describedby="email">
                  </div>
                <div class="mb-3">
                    <label for="no_hp" class="form-label">No telpon <a style="color : red">*</a></label>
                    <input type="number" class="form-control" required value="{{$profil->no_hp}}" id="no_hp" name="no_hp" aria-describedby="email">
                </div>
                  <div class="mb-3">
                      <label for="alamat" class="form-label">Alamat <a style="color : red">*</a></label>
                      <textarea class="form-control" id="alamat" required maxlength="50" name="alamat" rows="3">{{$profil->alamat}}</textarea>
                  </div>
                  <div class="mb-3">
                      <label for="niqobah" class="form-label">Niqobah<a style="color : red">*</a></label>
                      <input type="text" class="form-control" required id="niqobah" value="{{$profil->niqobah}}" maxlength="15" name="niqobah" aria-describedby="tanggal_lahir">
                  </div>
                  <div class="mb-3">
                    <label for="pekerjaan" class="form-label">Pekerjaan<a style="color : red">*</a></label>
                    <input type="text" class="form-control" required value="{{$profil->pekerjaan}}" id="pekerjaan" maxlength="15" name="pekerjaan" aria-describedby="tanggal_lahir">
                  </div>
                  <div class="mb-3">
                      <label for="tanggal_lahir" class="form-label">Tanggal lahir <a style="color : red">*</a></label>
                      <input type="date" class="form-control" required id="tanggal_lahir" value="{{$profil->tanggal_lahir}}" name="tanggal_lahir" aria-describedby="tanggal_lahir">
                  </div>
                  <div class="mb-3">
                      <label for="tahun_masuk" class="form-label">Tahun masuk <a style="color : red">*</a></label>
                      <input type="date" class="form-control" required id="tahun_masuk" value="{{$profil->tahun_masuk}}" name="tahun_masuk" aria-describedby="tanggal_lahir">
                  </div>
                  <div class="mb-3">
                      <label for="tahun_keluar" class="form-label">Tahun keluar <a style="color : red">*</a></label>
                      <input type="date" class="form-control" required id="tahun_keluar" value="{{$profil->tahun_keluar}}" name="tahun_keluar" aria-describedby="tanggal_lahir">
                  </div>
                  <div class="mb-3">
                      <label for="foto" class="form-label">foto </label>
                      <input type="file" class="form-control"  id="foto" name="foto" aria-describedby="foto">
                  </div>
                  <div class="mb-3">
                      <label for="password" class="form-label">password  <a id="star_edit_2"></a></label>
                      <input type="password" class="form-control" id="password" name="password" aria-describedby="password">
                  </div>
                  <div style="text-align: end">

                    <button type="submit"  class="btn btn-primary text-center">Simpan</button>
                  </div>
                  </form>
        
                </div>
              </div>
            </div>
          </div>

    </section>
  </div>

@if (session()->has('error'))
  {{-- {{session('error')}} --}}
    <script>
       Toast.fire({
                  icon: 'error',
                  title: 'Gagal Update'
                    });
    </script>
@endif
@if (session()->has('error2'))
  {{-- {{session('error')}} --}}
    <script>
       Toast.fire({
                  icon: 'error',
                  title: 'Gagal Simpan Hubungi Admin'
                    });
    </script>
@endif
@if (session()->has('sukses'))
  {{-- {{session('sukses')}} --}}
    <script>
       Toast.fire({
                  icon: 'success',
                  title: 'Berhasil Simpan Data'
                    });
    </script>
@endif



  @endsection