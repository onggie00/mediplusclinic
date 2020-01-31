<main>
<div class="container-fluid">
  <div class="row">
    <div class="col-12 mb-4">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title"><?php echo $title_page; ?></h5>
<!-- Modal starts -->
        <div class="text-left">
          <button type="button" class="mt-4 btn btn-success btn-round" data-toggle="modal" data-target="#adddata"><i class="mdi mdi-plus-circle ml-1"></i> Broadcast Ke Semua</button>
        </div>
        <div class="modal fade" id="adddata" tabindex="-1" role="dialog" aria-labelledby="adddata" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Broadcast Ke Semua</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?php  $this->load->view('admin/modal_add/notifikasi_pasien') ?>
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
        <div class="dt-responsive table-responsive">
            <table id="data" class="table table-striped table-bordered">
                  <thead class="thead-light">
                    <tr>
                      <th>Nomor</th>
                      <th>Nama Pasien</th>
                      <th>Email</th>
                      <th>Telepon</th>
                      <th>Alamat</th>
                      <th>Tanggal Lahir</th>
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
</main>

</div>
<!-- main-panel ends -->
        <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>bower_components\jquery\js\jquery.min.js"></script>
  <!-- Custom js for this page-->  
  <script >
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
             },{
               extend: 'print',
               className: 'btn btn-sm btn-info',
               titleAttr: 'PDF export.',
               text: 'Print Table',
               exportOptions: {
                    columns: 'th:not(:last-child)'
              }
             }]
           },
            "scrollX":true,
            "processing":true,
            "serverSide":true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order":[],
            "ajax":{
                 url:"<?php echo base_url() .'admin/asisten/notifikasi_asisten/alldata/'; ?>",
                 type:"POST"
            },
            "columnDefs":[
                 {
                      "targets":[0],
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
            $.post('<?php echo site_url('admin/asisten/notifikasi_asisten/getdataedit') ?>',
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
