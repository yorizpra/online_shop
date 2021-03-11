<?php 
include '../../config/conn.php';
$aksi = "component/com_pegawai/pegawai_aksi.php";

if ($_GET['aksi']==''){
  $id = decrypt($idd);
  $query=mysqli_query($conn,"SELECT * FROM pengaturan LIMIT 1");
  $r=mysqli_fetch_array($query);
  ?>

        <div class="col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title" style="text-transform: capitalize;">
                    <h2 ><?php echo $_GET['module'];?> <small></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="?module=<?php echo $_GET['module'];?>&aksi=simpan"  enctype="multipart/form-data" method="POST">
                    <div class="row">
                    <div class="col-md-6">
                      <label for="nama">Nama Sekolah :</label>
                      <input type="hidden"  class="form-control"  name="id"  value="<?php echo $r['id_pengaturan'];?>" />
                      <input type="text"  class="form-control" requerid  name="nama_sekolah"  value="<?php echo $r['nama_sekolah'];?>" />

                      <label for="nama">Kepala Sekolah :</label>
                      <input type="text"  class="form-control" requerid  name="kepala_sekolah"  value="<?php echo $r['kepala'];?>" />

                      <label for="alamat">Alamat :</label>
                      <textarea class="form-control" name="alamat" requerid  ><?php echo $r['alamat'];?> </textarea>

                      <label for="telephone">Telephone :</label>
                      <input type="text"  class="form-control" requerid  name="telephone" value="<?php echo $r['telephone'];?>"  />  

                      <label for="username">Situs :</label>
                      <input type="text"  class="form-control" name="situs" value="<?php echo $r['situs'];?>"  />
                      </div>
                      </div>
                   
                  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                      <button type="submit" class="btn btn-success btn-sm"> Simpan</button><br>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>


<?php  } elseif ($_GET['aksi'] == 'simpan'){
    $module = $_GET['module'];
    mysqli_query($conn,"UPDATE pengaturan SET nama_sekolah = '$_POST[nama_sekolah]',
                                    alamat = '$_POST[alamat]',
                                    telephone = '$_POST[telephone]',
                                    kepala = '$_POST[kepala_sekolah]',
                                    situs = '$_POST[situs]' 
                                    WHERE id_pengaturan = '$_POST[id]'");
   
    echo "<script language='javascript'>document.location='?module=".$module."';</script>";

  }?>


