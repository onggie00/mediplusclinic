        <div class="text-left">
          <button type="button" class="btn btn-primary btn-sm d-none" id="btneditdata" data-toggle="modal" data-target="#editdata"><i class="mdi mdi-plus-circle ml-1"></i> Tambah Data</button>
        </div>
        <div class="modal fade" id="editdata" tabindex="-1" role="dialog" aria-labelledby="editdata" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
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
          <button type="button" class="btn btn-primary btn-sm d-none" id="btnfotodata" data-toggle="modal" data-target="#fotodata"><i class="mdi mdi-plus-circle ml-1"></i> Tambah Data</button>
        </div>
        <div class="modal fade" id="fotodata" tabindex="-1" role="dialog" aria-labelledby="fotodata" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Ubah Foto Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="fotoform">
              </div>
            </div>
          </div>
        </div>

        <div class="text-left">
          <button type="button" class="btn btn-primary btn-sm d-none" id="btnpwdata" data-toggle="modal" data-target="#pwdata"><i class="mdi mdi-plus-circle ml-1"></i> Tambah Data</button>
        </div>
        <div class="modal fade" id="pwdata" tabindex="-1" role="dialog" aria-labelledby="pwdata" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="pwform">
              </div>
            </div>
          </div>
        </div>

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body admin-content">
                                <div class="page-wrapper">

                                    <div class="page-body">
                                        <?php if (isset($msg)): ?>
                                              <br/>
                                              <div class="alert alert-danger alert-dismissible fade show rounded mb-0" role="alert">
                                                  <span><i class="iconsminds-danger"></i></span> <?php echo $msg; ?>
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
                                        <div class="row">
                                            
                                            <!-- task, page, download counter  start -->
                                            
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-lite-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"><?php echo $biaya_awal; ?></h4>
                                                                <h6 class="text-white m-b-0"></h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-4" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0">Biaya Awal Datang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <button type="button" name="update" id="<?php echo $dokter->dokter_id; ?>" class="btn btn-sm btn-success update">
                                                            Ubah</button>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-lite-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h3 class="text-white"> <?php echo $antrian_selanjutnya; ?> </h3>
                                                                <h6 class="text-white m-b-0"></h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-4" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0">Antrian Selanjutnya</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-lite-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"> <?php echo $batas_antrian; ?>  Pasien</h4>
                                                                <h6 class="text-white m-b-0"></h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-4" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0">Batas Antrian Hari ini</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-lite-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"> <?php echo $total_pasien ?>  Pasien</h4>
                                                                <h6 class="text-white m-b-0"></h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-4" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0">Total Pasien / Bulan</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- task, page, download counter  end -->
                                            <div class="col-xl-6 col-md-12">
                                                <div class="card user-card-full">
                                                    <div class="row m-l-0 m-r-0">
                                                        <div class="col-sm-4 bg-c-lite-green user-profile">
                                                            <div class="card-block text-center text-white">
                                                                <div class="m-b-25">
                                                                    <img src="<?php 
                                                                        if ($foto_profil != "") {
                                                                            echo base_url('assets/image/asisten_dokter/'.$foto_profil);
                                                                        }else{
                                                                            echo base_url('assets/image/asisten_dokter/'.'kosong.png');
                                                                        }
                                                                         ?>" width="100px" height="100px" class="img-radius" alt="foto-profile">
                                                                </div>
                                                                <h6 class="f-w-600"><?php echo $asisten->nama_lengkap; ?></h6>
                                                                <p><?php echo "Asisten Dokter ".$poli->nama_poli; ?></p>
                                                                <h6><?php echo $rumah_sakit->nama_klinik; ?></h6>
                                                                
                                                                    <button id="<?php echo $asisten->asisten_dokter_id; ?>" class="btn btn-success waves-effect editfoto" type="button">
                                                                        <span> <i class="feather icon-image m-t-10 f-16"></i> </span>
                                                                        <span> <h6>Ubah Foto</h6> </span>
                                                                    </button>
                                                                
                                                                <br/><br/>
                                                                
                                                                    <button id="<?php echo $asisten->asisten_dokter_id; ?>" class="btn btn-success waves-effect editpw" type="button">
                                                                        <span> <i class="feather icon-edit m-t-10 f-16"></i> </span>
                                                                        <span> <h6>Ubah Password</h6> </span>
                                                                    </button>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="card-block">
                                                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Informasi Asisten Dokter</h6>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Nama Asisten</p>
                                                                        <h6 class="text-muted f-w-400"> <?php echo $asisten->nama_lengkap; ?> </h6>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Nomor Telepon</p>
                                                                        <h6 class="text-muted f-w-400"> <?php echo $asisten->phone; ?> </h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    
                                                                    <div class="col-sm-12">
                                                                        <p class="m-b-10 f-w-600">Alamat Rumah</p>
                                                                        <h6 class="text-muted f-w-400"> <?php echo $asisten->alamat; ?> </h6>
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Informasi Dokter</h6>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Asisten dari Dokter</p>
                                                                        <h6 class="text-muted f-w-400"> <?php echo $dokter->nama_dokter; ?> </h6>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Nomor Telepon Dokter</p>
                                                                        <h6 class="text-muted f-w-400"> <?php echo $dokter->phone; ?> </h6>
                                                                    </div>
                                                                </div>
                                                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Informasi Rumah Sakit / Klinik</h6>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">RS / Klinik</p>
                                                                        <h6 class="text-muted f-w-400"> <?php echo $rumah_sakit->nama_klinik; ?> </h6>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Ruangan</p>
                                                                        <h6 class="text-muted f-w-400"> <?php echo $dokter->ruangan; ?> </h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Status Kehadiran Dokter</p>
                                                                        <h6 class="text-muted f-w-400"> <?php 
                                                                            if ($dokter->status_aktif=="0") {
                                                                            echo "Tidak Hadir";
                                                                            }else{
                                                                                echo "Hadir";
                                                                            }
                                                                         ?> </h6>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Status Akun Dokter</p>
                                                                        <h6 class="text-muted f-w-400"> <?php 
                                                                        if ($dokter->is_aktif=="0") {
                                                                            echo "Nonaktif";
                                                                        }else{
                                                                            echo "Aktif";
                                                                        } ?> </h6>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--  sale analytics start -->
                                            <div class="col-xl-3 col-md-12">
                                                <div class="card user-card2">
                                                    <div class="card-block text-center">
                                                        <h6 class="m-b-15">Antrian</h6>
                                                            <table id="data" class="table table-striped table-bordered">
                                                              <thead class="thead-light">
                                                                <tr>
                                                                  <th>Nomor</th>
                                                                  <th>Nama Pasien</th>
                                                                  <th>Tanggal Kadaluarsa</th>
                                                                  <th>Status</th>
                                                                  <th>Actions</th>
                                                                </tr>
                                                              </thead>
                                                              
                                                            </table>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-3 col-md-12">
                                                <div class="card user-card2">
                                                    <div class="card-block text-center">
                                                        <h6 class="m-b-15">Antrian Terkini</h6>
                                                        <div class="risk-rate">
                                                            <span><b><?php echo $antrian_terkini; ?></b></span>
                                                        </div>
                                                        <h6 class="m-b-10 m-t-10">Nomor Antrian</h6>
                                                    </div>
                                                    <form action="<?php echo site_url('admin/asisten/dashboard/next_antrian'); ?>" method="post">
                                                        <input type="hidden" name="nomor_antri" value="<?php echo $antrian_terkini; ?>">
                                                        <button type="submit" name="btn_next_antrian" class="btn btn-warning btn-block p-t-15 p-b-15 waves-effect">Lanjutkan Antrian</button>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>bower_components\jquery\js\jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    
       var dataTable = $('#data').DataTable({
         "dom": 'rtip',

            "scrollX":true,
            "processing":true,
            "serverSide":true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order":[],
            "ajax":{
                 url:"<?php echo base_url() .'admin/asisten/dashboard/alldata/'; ?>",
                 type:"POST"
            },
            "columnDefs":[
                 {
                      "targets":[0,1],
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
  });
setTimeout(function() {
  location.reload();
}, 30000);
</script>
<script >
    $(document).on('click', '.update', function(){
            var a = $(this).attr("id");
            $.post('<?php echo site_url('admin/asisten/dashboard/getdataedit') ?>',
            {id :a},function (data) {
              if (data!="" || data != null) {
                $('#editform').html(data);
                $('#btneditdata').click();
              }
            });
       });
    $(document).on('click', '.editfoto', function(){
            var a = $(this).attr("id");
            $.post('<?php echo site_url('admin/asisten/profile_asisten/getfotoedit') ?>',
            {id :a},function (data) {
              if (data!="" || data != null) {
                $('#fotoform').html(data);
                $('#btnfotodata').click();
              }
            });
       });
    $(document).on('click', '.editpw', function(){
            var a = $(this).attr("id");
            $.post('<?php echo site_url('admin/asisten/profile_asisten/getpwedit') ?>',
            {id :a},function (data) {
              if (data!="" || data != null) {
                $('#pwform').html(data);
                $('#btnpwdata').click();
              }
            });
       });
    
</script>