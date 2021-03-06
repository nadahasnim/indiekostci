        <!-- Begin Page Content -->
        <div class="container-fluid">

        <div class="row">
            <div class="card col-12 mb-3">
              <div class="card-body">
                <h4 class="card-title">Cetak Laporan Laba/Rugi</h4>
                <p class="card-text">Berisi semua pemasukan, pengeluaran, dan total laba/rugi</p>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                  <form action="laporan/cetak-laba-rugi.php" target="_blank" method="POST">                    
                    <div class="form-row">
                      <div class="col">
                        <select name="tahun" id="tahun" required>
                          <option value="">Pilih Tahun</option>
                          <?php 
                          $query = "SELECT YEAR(pembayaran.tanggal_pembayaran) AS tahun FROM pembayaran
                                    GROUP BY YEAR(pembayaran.tanggal_pembayaran)";
                          
                          $result = mysqli_query($conn, $query);

                          while ($tahun = mysqli_fetch_array($result)) {
                          
                          ?>

                          <option value="<?php echo $tahun['tahun']; ?>"><?php echo $tahun['tahun']; ?></option>                          
                          
                          <?php } ?>
                        </select>
                        <select name="bulan" id="bulan" required>
                          <option value="">Pilih Bulan</option>
                          <option value="1">Januari</option>
                          <option value="2">Februari</option>
                          <option value="3">Maret</option>
                          <option value="4">April</option>
                          <option value="5">Mei</option>
                          <option value="6">Juni</option>
                          <option value="7">Juli</option>
                          <option value="8">Agustus</option>
                          <option value="9">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                        </select>
                      </div>
                      <div class="col">
                        
                      </div>
                    </div>
                        
                    <button class="btn btn-primary mt-2" name="cetakBulan" type="submit"><i class="fas fa-print"></i> Cetak Berdasarkan Bulan</button>
                    
                  </form>
                  </div>
                  <div class="col-md-6 col-sm-12">
                  <form action="laporan/cetak-laba-rugi.php" target="_blank" method="POST">                    
                    <div class="form-row">
                      <div class="col">
                        <select name="tahun" id="tahun" required>
                          <option value="">Pilih Tahun</option>
                          <?php 
                          $query = "SELECT YEAR(pembayaran.tanggal_pembayaran) AS tahun FROM pembayaran
                                    GROUP BY YEAR(pembayaran.tanggal_pembayaran)";
                          
                          $result = mysqli_query($conn, $query);

                          while ($tahun = mysqli_fetch_array($result)) {
                          
                          ?>

                          <option value="<?php echo $tahun['tahun']; ?>"><?php echo $tahun['tahun']; ?></option>                          
                          
                          <?php } ?>
                        </select>                        
                      </div>
                    </div>
                        
                    <button class="btn btn-primary mt-2" name="cetakTahun" type="submit"><i class="fas fa-print"></i> Cetak Berdasarkan Tahun</button>
                    
                  </form>
                  </div>
                </div>
              </div>
            </div>
        </div>

        </div>

        
        <!-- End of Main Content -->