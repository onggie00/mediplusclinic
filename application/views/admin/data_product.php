<main>
<div class="container-fluid">
  <div class="row">
    <div class="col-12 mb-4">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title"><?php echo $title_page; ?></h5>

<!-- Modal starts -->
        <div class="text-left hidden">
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
                <?php  $this->load->view('admin/modal_add/product') ?>
              </div>
            </div>
          </div>
        </div>
        <div class="text-left">
          <button type="button" class="btn btn-primary btn-sm d-none" id="btneditdata" data-toggle="modal" data-target="#editdata"><i class="mdi mdi-plus-circle ml-1"></i> Ubah Data</button>
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

        <!--<div class="text-left">
        <button type="button" class="btn btn-primary btn-sm d-none" id="btndetaildata" data-toggle="modal" data-target="#detaildata"><i class="mdi mdi-plus-circle ml-1"></i> Detail Data</button>
        </div>
        <div class="modal fade" id="detaildata" tabindex="-1" role="dialog" aria-labelledby="detaildata" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Detail Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="detailform">
              </div>
            </div>
          </div>
        </div>-->

      <div class="text-left">
        <button type="button" class="btn btn-primary btn-sm d-none" id="btndeletedata" data-toggle="modal" data-target="#deletedata"><i class="mdi mdi-plus-circle ml-1"></i> Hapus Data</button>
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
                  <?php  $this->load->view('admin/modal_delete/product') ?>
              </div>
            </div>
          </div>
        </div>

      <!--<div class="text-left">
        <button type="button" class="btn btn-primary btn-sm d-none" id="btndeletedetaildata" data-toggle="modal" data-target="#deletedetaildata"><i class="mdi mdi-plus-circle ml-1"></i> Hapus Detail Data</button>
      </div>
        <div class="modal fade" id="deletedetaildata" tabindex="-1" role="dialog" aria-labelledby="deletedetaildata" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Hapus Detail Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <?php  //$this->load->view('admin/modal_delete/detail_product') ?>
              </div>
            </div>
          </div>
        </div>-->

                <button class="btn btn-outline-success d-none" onclick="showSwal('success-message')" id="done">Click here!</button>
                <button class="btn btn-outline-success d-none" onclick="showSwal('success-message1')"  id="done1">Click here!</button>
                <button class="btn btn-outline-success  d-none" onclick="showSwal('success-message2')"  id="done2">Click here!</button>
        <!-- Modal Ends -->
        <br>

              <table id="data" class="table-hover table-stripped responsive data-table ">
                  <thead>
                    <tr>
                      <th>Nomor</th>
                      <th>Kode SO</th>
                      <th>Deskripsi</th>
                      <th>Keterangan</th>
                      <th>Jumlah</th>
                      <th>Satuan</th>
                      <th>Harga/Unit</th>
                      <th >Actions</th>
                    </tr>
                  </thead>
                  
              </table>
          </div>

         </div>
     </div>
  </div>
</div>
</main>

</div>
<!-- main-panel ends -->

  <!-- Custom js for this page-->
  <script src="<?php echo base_url('admin/'); ?>js/vendor/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <!--<script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>dataTables/datatables.min.js"></script>-->
  <!--<script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>js/avgrund.js"></script>-->
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
    
       var dataTable = $('#data').DataTable({

         "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
         "dom": 'Bfrtip',
         "buttons": {
             dom: {
               button: {
                 tag: 'button',
                 className: ''
               }
             },
             buttons: [{
               extend: 'excel',
               className: 'btn btn-sm btn-info',
               titleAttr: 'Excel export.',
               text: 'Download Excel',
               exportOptions: {
                    columns: 'th:not(:last-child)'
              }
             }]
           },
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                 url:"<?php echo base_url() .'admin/product/alldata/'; ?>",
                 type:"POST"
            },
            "columnDefs":[
                 {
                      "targets":[0,4],
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
       /*$(document).on("click", ".delete_dtrans", function(e) {
            var id = $(this).attr("id");
            e.preventDefault();
            $('#btndeletedetaildata').click();
            $('#data_detail_id').val(id);
        });*/

        $(document).on('click', '.update', function(){
            var a = $(this).attr("id");
            $.post('<?php echo site_url('admin/product/getdataedit') ?>',
            {id :a},function (data) {
              if (data!="" || data != null) {
                $('#editform').html(data);
                $('#btneditdata').click();
              }
            });
       });
      /*$(document).on('click', '.detail', function(){
            var a = $(this).attr("id");
            $.post('<?php echo site_url('admin/product/getdetaildata') ?>',
            {id :a},function (data) {
              if (data!="" || data != null) {
                $('#detailform').html(data);
                $('#btndetaildata').click();
              }
            });
       });*/
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
