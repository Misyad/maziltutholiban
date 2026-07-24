@extends('admin.master')
    
@section('konten')
<link href="/assets/vendor_datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="/assets/datatables/buttons.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="/assets/ckeditor/ckeditor.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Carosel</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a>Carosel</a></div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">

                  <h4>Carosel</h4>
                </div>
                <div class="card-body ">
                  <div class="text-center">
                    <img alt="image" id="img_view" src="/storage/{{$data->foto}}" class="img-fluid">
                  </div>
                  <form  id="form_info_pesantren" method="post" enctype="multipart/form-data">
                    @csrf
                  <div class="mb-3 mt-4">
                      <label for="foto" class="form-label">Foto <a style="color : red">*</a></label>
                      <input type="file" class="form-control"  id="foto" name="foto" aria-describedby="foto">
                      <input type="hidden" class="form-control" id="foto_lama" value="{{$data->foto}}" name="foto_lama" aria-describedby="nama">
                      <input type="hidden" class="form-control" id="id" value="{{$data->id}}" name="id" aria-describedby="nama">
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

  <script>
    $(document).ready(function() {
    $('#form_info_pesantren').submit(function(e){
            e.preventDefault();
            var data = new FormData(this);
                $.ajax({
                    url: "/edit-carosel/simpan",
                    method: "POST",
                    data:  data,
                    processData: false,
                    contentType: false,
                    success: function(data) {

                        if(data['foto']){
                            $('#img_view').attr(`src`,`/storage/${data.foto}`);
                            $('#foto_lama').val(`${data.foto}`);
                        }
                        Toast.fire({
                            icon: 'success',
                            title: 'Simpan Berhasil'
                        });
                    },
                    error: function(data){
                        Toast.fire({
                            icon: 'error',
                            title: data['responseJSON']['message']
                        });
                    }
                });


        });
    });
  </script>


  @endsection