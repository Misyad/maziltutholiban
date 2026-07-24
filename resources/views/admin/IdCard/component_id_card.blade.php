@extends('admin.master')
    
@section('konten')
<link href="/assets/vendor_datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="/assets/datatables/buttons.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="/assets/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<style>
    #div_niqobah {
      position: absolute;
      z-index: 9;
      background-color: transparent;
      text-align: center;
      border: 1px solid #cccccc;
    }
    #div_name {
      position: absolute;
      z-index: 9;
      background-color: transparent;
      text-align: center;
      border: 1px solid #cccccc;
    }
    #div_photo {
      position: absolute;
      z-index: 9;
      background-color: transparent;
      text-align: center;
      border: 1px solid #cccccc;
    }
    #mydivphoto {
      width: 30mm;
      height: 40mm;
      padding: 0 10px;
      cursor: move;
      z-index: 10;
      background-color: transparent;
      color: #000;
    }
    
    #mydivheader {
      padding: 0 10px;
      cursor: move;
      z-index: 10;
      background-color: transparent;
      color: #000;
    }
</style>

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
                  <input type="hidden" name="id" id="id" value="<?=$id?>">

                  <h4>Layout ID Card</h4>
                </div>
                <div class="card-body">
                  <div style="height: 122mm; width: 94mm; position: relative;">
                      <img style="height: 122mm; width: 94mm;" src="{{ asset('storage/' . $data->path) }}" alt="{{ $data->nama_gambar }}">

                      <div id="div_name" @if ($name)) style="top: {{ $name->position_x }}; left: {{ $name->position_y }};" @endif>
                        <div id="mydivheader">Nama anda...</div>
                      </div>

                      <div id="div_niqobah" @if ($niqobah) style="top: {{ $niqobah->position_x }}; left: {{ $niqobah->position_y }};" @endif>
                        <div id="mydivheader">Nama niqobah...</div>
                      </div>

                      <div id="div_photo" @if ($photo) style="top: {{ $photo->position_x }}; left: {{ $photo->position_y }};" @endif>
                        <div id="mydivphoto"></div>
                      </div>
                  </div>

                  <button class="btn btn-primary mt-4" onclick="onSave()">
                    Simpan
                  </button>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      //Make the DIV element draggagle:
      dragElement(document.getElementById("div_name"));
      dragElement(document.getElementById("div_niqobah"));
      dragElement(document.getElementById("div_photo"));
      
      function dragElement(elmnt) {
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        if (document.getElementById(elmnt.id + "header")) {
          document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
        } else {
          elmnt.onmousedown = dragMouseDown;
        }
      
        function dragMouseDown(e) {
          e = e || window.event;
          e.preventDefault();
          pos3 = e.clientX;
          pos4 = e.clientY;
          document.onmouseup = closeDragElement;
          document.onmousemove = elementDrag;
        }
      
        function elementDrag(e) {
          e = e || window.event;
          e.preventDefault();
          pos1 = pos3 - e.clientX;
          pos2 = pos4 - e.clientY;
          pos3 = e.clientX;
          pos4 = e.clientY;
          elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
          elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
        }
      
        function closeDragElement() {
          document.onmouseup = null;
          document.onmousemove = null;
        }
      }
  
      function onSave() {
        const id = document.getElementById('id').value;

        const elementPhoto = document.getElementById("div_photo");
        const photoX = elementPhoto.style.top;
        const photoY = elementPhoto.style.left;

        const elementNiqobah = document.getElementById("div_niqobah");
        const niqobahX = elementNiqobah.style.top;
        const niqobahY = elementNiqobah.style.left;

        const elementName = document.getElementById("div_name");
        const nameX = elementName.style.top;
        const nameY = elementName.style.left;

        $.ajax({
            type: "POST",
            url: "{{ route('id-card.store.component') }}", 
            data: {
                id: id,
                photoX: photoX,
                photoY: photoY,
                niqobahX: niqobahX,
                niqobahY: niqobahY,
                nameX: nameX,
                nameY: nameY,
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data layout berhasil disimpan',
              })
            },
            error: function (xhr, status, error) {
              Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Data layout gagal disimpan',
              })
              console.error(xhr.responseText);
            }
        });
    }

  </script>
  <script>

    $(document).ready(function() {

    });
  </script>
  @endsection