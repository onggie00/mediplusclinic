<main>
<div class="container-fluid">
  <div class="row">
    <div class="col-12 mb-4">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title"><?php echo $title_page; ?></h5>

<!-- Modal starts -->
        <div class="text-left">
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#adddata"><i class="mdi mdi-plus-circle ml-1"></i> Tambah Data</button>
        </div>
        <div class="modal fade" id="adddata" tabindex="-1" role="dialog" aria-labelledby="adddata" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Tambah Data Highlight</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?php  $this->load->view('admin/modal_add/promo_pengumuman') ?>
              </div>
            </div>
          </div>
        </div>
        <div class="text-left">
          <button type="button" class="btn btn-primary btn-sm d-none" id="btneditdata" data-toggle="modal" data-target="#editdata"><i class="mdi mdi-plus-circle ml-1"></i> Tambah Data</button>
        </div>
        <div class="modal fade" id="editdata" tabindex="-1" role="dialog" aria-labelledby="editdata" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
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
                  <?php  $this->load->view('admin/modal_delete/promo_pengumuman') ?>
              </div>
            </div>
          </div>
        </div>

                <button class="btn btn-outline-success d-none" onclick="showSwal('success-message')" id="done">Click here!</button>
                <button class="btn btn-outline-success d-none" onclick="showSwal('success-message1')"  id="done1">Click here!</button>
                <button class="btn btn-outline-success  d-none" onclick="showSwal('success-message2')"  id="done2">Click here!</button>
        <!-- Modal Ends -->
        <?php if (isset($err_msg)): ?>
          <br/>
          <div class="alert alert-danger alert-dismissible fade show rounded mb-0" role="alert">
              <span><i class="iconsminds-danger"></i></span> <?php echo $err_msg; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
        <?php endif; ?>
        <?php if (isset($success_msg)): ?>
                <br>
                <div class="alert alert-success alert-dismissible fade show rounded mb-0" role="alert">
                    <span><i class="iconsminds-yes"></i></span> <?php echo $success_msg; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <?php endif; ?>
        <br/>
              <table id="data" class="display nowrap table-hover table-stripped data-table ">
                  <thead>
                    <tr>
                      <th>Nomor</th>
                      <th>Judul Highlight</th>
                      <th>Deskripsi Highlight</th>
                      <th>Gambar</th>
                      <th>Keterangan</th>
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
  
  
  <script>

    $(document).ready(function(){
    
       var dataTable = $('#data').DataTable({

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
           "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "scrollX": true,
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                 url:"<?php echo base_url() .'admin/promo_pengumuman/alldata/'; ?>",
                 type:"POST"
            },
            "columnDefs":[
                 {
                      "targets":[0,3,4],
                      "orderable":false,
                      "visible":true
                 },{
                      "targets": 'invisible',
                      "visible":false
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
            $.post('<?php echo site_url('admin/promo_pengumuman/getdataedit') ?>',
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
