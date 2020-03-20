
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body admin-content">
                                <div class="page-wrapper">

                                    <div class="page-body">
                                        <div class="row">
                                            <!-- task, page, download counter  start -->
                                            
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-lite-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"><?php echo $total_dokter; ?></h4>
                                                                <h6 class="text-white m-b-0">Total Dokter Terdaftar</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-4" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-lite-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"><?php echo $total_pasien; ?></h4>
                                                                <h6 class="text-white m-b-0">Total Pasien Terdaftar</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-4" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-lite-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"><?php echo $total_klinik; ?></h4>
                                                                <h6 class="text-white m-b-0">Total Rumah Sakit</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-4" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-lite-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white"><?php echo $total_poli; ?></h4>
                                                                <h6 class="text-white m-b-0">Total Poli Tersedia</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-4" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <!-- task, page, download counter  end -->

                                            <!--  sale analytics start -->
                                            <div class="container" style="width:70%;margin:0 auto;background-color:white;opacity:0.9;padding:20px;border-radius:10px;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table id="data3" class="table table-bordered">
          <thead>
            <tr>
              <th>Nomor</th>
              <th>Nama RS / Klinik</th>
              <th>Paket</th>
              <th>Tanggal Expired</th>
              <th> Sisa Masa Aktif </th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $nmr = 1;
            $get_klinik = $this->mymodel->getbywhere('klinik',"is_deleted='0' and paket != 'Selamanya' and status_pembayaran=",'1','result');
            //echo $this->db->last_query();
                foreach ($get_klinik as $key => $value) {
                  $tgl_expired = date_create(date("Y-m-d",strtotime($value->tanggal_expired)));
                  $today = date_create(date("Y-m-d"));
                  $selisih = date_diff($today,$tgl_expired);
                  $selisih = $selisih->format('%r%a');
    $convert = date("d m Y",strtotime($value->tanggal_expired));
    $convert = explode(" ", $convert);
    $tgl = $convert[0];
    $bulan = $convert[1];
    $thn = $convert[2];
    $bln="";
    if ($bulan == 1) {
      $bln = "Januari";
    }else if ($bulan == 2) {
      $bln = "Februari";
    }else if ($bulan == 3) {
      $bln = "Maret";
    }else if ($bulan == 4) {
      $bln = "April";
    }else if ($bulan == 5) {
      $bln = "Mei";
    }else if ($bulan == 6) {
      $bln = "Juni";
    }else if ($bulan == 7) {
      $bln = "Juli";
    }else if ($bulan == 8) {
      $bln = "Agustus";
    }else if ($bulan == 9) {
      $bln = "September";
    }else if ($bulan == 10) {
      $bln = "Oktober";
    }else if ($bulan == 11) {
      $bln = "November";
    }else if ($bulan == 12) {
      $bln = "Desember";
    }
    $tanggal = $tgl." ".$bln." ".$thn;
                  if ($selisih <=30 && $selisih >= 0) {
                    echo "<tr>";
                    echo "<td> ".$nmr." </td>";
                    echo "<td> ".$value->nama_klinik." </td>";
                    echo "<td> ".$value->paket." </td>";
                    echo "<td> ".$tanggal." </td>";
                    echo "<td> ".$selisih." Hari</td>";
                    echo "</tr>";
                    $nmr++;
                  }
                }
                    echo "<tr>";
                    echo "<td> </td>";
                    echo "<td>  </td>";
                    echo "<td>  </td>";
                    echo "<td> </td>";
                    echo "<td> </td>";
                    echo "</tr>";
            
             ?>
          </tbody>
      </table>
      <br>
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
    </div>

