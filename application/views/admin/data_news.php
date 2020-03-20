<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"><?php echo $title_page ?></h4>
        <!-- Modal starts -->
        <div class="text-left">
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#adddata"><i class="mdi mdi-plus-circle ml-1"></i> Tambah Data</button>
        </div>
        <div class="modal fade" id="adddata" tabindex="-1" role="dialog" aria-labelledby="adddata" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?php  $this->load->view('admin/modal_add/news') ?>
              </div>
            </div>
          </div>
        </div>
        <div class="text-left">
          <button type="button" class="btn btn-primary btn-sm d-none" id="btneditdata" data-toggle="modal" data-target="#editdata"><i class="mdi mdi-plus-circle ml-1"></i> Tambah Data</button>
        </div>
        <div class="modal fade" id="editdata" tabindex="-1" role="dialog" aria-labelledby="editdata" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Ubah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="editform">
              </div>
            </div>
          </div>
        </div>

      <div class="text-left">
        <button type="button" class="btn btn-primary btn-sm d-none" id="btndeletedata" data-toggle="modal" data-target="#deletedata"><i class="mdi mdi-plus-circle ml-1"></i> Tambah Data</button>
      </div>
        <div class="modal fade" id="deletedata" tabindex="-1" role="dialog" aria-labelledby="deletedata" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <?php  $this->load->view('admin/modal_delete/news') ?>
              </div>
            </div>
          </div>
        </div>

                <button class="btn btn-outline-success d-none" onclick="showSwal('success-message')" id="done">Click here!</button>
                <button class="btn btn-outline-success d-none" onclick="showSwal('success-message1')"  id="done1">Click here!</button>
                <button class="btn btn-outline-success  d-none" onclick="showSwal('success-message2')"  id="done2">Click here!</button>
        <!-- Modal Ends -->
        <br>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="data" class="table">
                <thead>
                  <tr>
                      <th>Judul Berita</th>
                      <th>Deskripsi</th>
                      <th>Gambar</th>
                      <th>Tumbnail</th>
                      <th>Tanggal Buat</th>
                      <th >Actions</th>
                  </tr>
                </thead>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:../../partials/_footer.html -->
  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a class="text-muted" href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Hand-crafted & made with <i class="mdi mdi-heart text-info"></i></span>
    </div>
  </footer>
  <!-- partial -->
</div>
<!-- main-panel ends -->

  <!-- Custom js for this page-->
  <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>dataTables/datatables.min.js"></script>
  <script src="<?php echo base_url('resource_admin/'); ?>js/avgrund.js"></script>
  <script>

  (function($) {
  showSwal = function(type) {
    'use strict';
    if (type === 'success-message') {
      swal({
        title: 'Berhasil!',
        text: 'Berhasil Menambahkan Data',
        icon: 'success',
        button: {
          text: "Tutup",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      })

    }
    if (type === 'success-message1') {
      swal({
        title: 'Berhasil!',
        text: 'Berhasil Mengubah Data',
        icon: 'success',
        button: {
          text: "Tutup",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      })

    }
    if (type === 'success-message2') {
      swal({
        title: 'Berhasil!',
        text: 'Berhasil Menghapus Data',
        icon: 'success',
        button: {
          text: "Tutup",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      })

    }
  }
  })(jQuery);

  $(document).ready(function(){
    $("#prov_id").change(function(){
        $.post("<?php echo site_url('utils/ambilkab') ?>",{prov_id:$("#prov_id").val()},function(msg){
          $("#kab_id").html(msg);
          $("#kec_id").html('<option value="">Pilih Kabupaten</option>');
        });
     });
     $("#kab_id").change(function(){
         $.post("<?php echo site_url('utils/ambilkec') ?>",{kab_id:$("#kab_id").val()},function(msg){
           $("#kec_id").html(msg);
         });
      });
       var dataTable = $('#data').DataTable({

         "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                 url:"<?php echo base_url() .'admin/news/alldata/'; ?>",
                 type:"POST"
            },
            "columnDefs":[
                 {
                      "targets":[2,3,4,5],
                      "orderable":false,
                 },
            ],
            "initComplete": function(settings, json) {
                $(".current").addClass("btn btn-primary");
              $(".current").removeClass("paginate_button");
            },
            "fnDrawCallback": function( oSettings ) {

                  $(".current").addClass("btn btn-primary");
                $(".current").removeClass("paginate_button");
            }
       });
       $(document).on("click", ".delete", function(e) {
            var id = $(this).attr("id");
            e.preventDefault();
            $('#btndeletedata').click();
            $('#data_id').val(id);
        });

        $(document).on('click', '.update', function(){
            var a = $(this).attr("id");
            $.post('<?php echo site_url('admin/news/getdataedit') ?>',
            {id :a},function (data) {
              if (data!="" || data != null) {
                $('#editform').html(data);
                $('#btneditdata').click();
              }
            });
       });
       <?php $msg = $this->session->flashdata('msg');
       if (isset($msg)): ?>
         <?php if ($msg == 1): ?>
           $('#done').click();
         <?php endif; ?>
         <?php if ($msg== 2): ?>
           $('#done1').click();
         <?php endif; ?>
         <?php if ($msg== 3): ?>
           $('#done2').click();
         <?php endif; ?>
         <?php else: ?>
       <?php endif; ?>

  });
  </script>
