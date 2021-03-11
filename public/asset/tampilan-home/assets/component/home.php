<?php
session_start();
$query_saldo=mysqli_query($conn,"SELECT SUM(debit) as jumlah_debit, SUM(kredit) as jumlah_kredit FROM transaksi");
$row_saldo=mysqli_fetch_array($query_saldo);
$saldo_keseluruhan= $row_saldo['jumlah_debit'] - $row_saldo['jumlah_kredit'];

$bulan = date('m');
$query_saldo=mysqli_query($conn,"SELECT SUM(debit) as jumlah_debit, SUM(kredit) as jumlah_kredit FROM transaksi WHERE DATE_FORMAT((tanggal),'%m') like '%$bulan%'");
$saldo = mysqli_fetch_array($query_saldo);
$saldo_bulan= $saldo['jumlah_debit'] - $saldo['jumlah_kredit'];

$hari = date('d');
$query_hari=mysqli_query($conn,"SELECT SUM(debit) as jumlah_debit, SUM(kredit) as jumlah_kredit FROM transaksi WHERE DATE_FORMAT((tanggal),'%m') like '%$bulan%'");
$saldo_h = mysqli_fetch_array($query_hari);
$saldo_hari= $saldo_h['jumlah_debit'] - $saldo_h['jumlah_kredit'];
?>

<!-- page content -->
        <div class="col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title" style="text-transform: capitalize;">
                    <h2 >Selamat datang, <?php echo $_SESSION['namalengkap'];?></h2>
                    
                    <div class="clearfix"></div>
                  </div>
              
                  <?php if ($_SESSION['leveluser'] == 'admin'){ ?>
                  <div class="x_content" style="padding: 20px; text-align: center;  ">

                    <div class="animated flipInY col-lg-6 col-md-3 col-sm-6 col-xs-12">
                     <div class="tile-stats">
                        <div class="icon"></div>
                        <h1>Rp. <?php echo rupiah($saldo_keseluruhan);?></h1>
                        <p>Saldo Keseluruhan</p>
                       
                      </div>
                      
                    </div>
                    <div class="animated flipInY col-lg-6 col-md-3 col-sm-6 col-xs-12">
                     <div class="tile-stats">
                        <div class="icon"></div>
                        <h1>Rp. <?php echo rupiah($saldo_bulan);?></h1>
                        <p>Saldo Bulan ini</p>
                       
                      </div>
                      
                    </div>

                   <div class="divider-dashed" style="padding: 40px;"></div>
                   <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                <?php 
                $query_pegawai=mysqli_query($conn,"SELECT *  FROM pegawai");
                $num_pegawai = mysqli_num_rows($query_pegawai);
                $query_nasabah=mysqli_query($conn,"SELECT *  FROM nasabah");
                $num_nasabah = mysqli_num_rows($query_nasabah);

                
                ?>
                  <div class="icon"></div>
                  <h1><?php echo $num_pegawai;?></h1>
                  <p>Data Akun</p>
                 
                </div>

              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"></div>
                  <h1><?php echo $num_nasabah;?></h1>
                  <p>Data Nasabah</p>
                 
                </div>
                
              </div>
              <div class="animated flipInY col-lg-6 col-md-3 col-sm-6 col-xs-12">
               <div class="tile-stats">
                  <div class="icon"></div>
                  <h1>Rp. <?php echo rupiah($saldo_hari);?></h1>
                  <p>Saldo Hari ini</p>
                 
                </div>
                
              </div>
                  </div>
                  <?php }?>

                </div>
              </div>

          </div>
        </div>
      </div><br><br>
    </div>
  </div>
</div>
<!-- /page content -->