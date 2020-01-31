<main>
<div class="container-fluid">
  <div class="row">
    <div class="col-12 mb-4">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title"><?php echo $title_page; ?></h5>

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
                      <th>Nama Klinik</th>
                      <th>Status</th>
                      <th>Tanggal Pembayaran</th>
                      <th>Tanggal Kadaluarsa</th>
                      <th>Biaya</th>
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
               text: 'Download Excel'
               
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
                 url:"<?php echo base_url() .'admin/owner/transaksi_klinik/alldata/'; ?>",
                 type:"POST"
            },
            "columnDefs":[
                 {
                      "targets":[0,4,5],
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
