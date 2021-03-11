<?php
error_reporting(0);
session_start();
include "config/conn.php";
include 'config/rupiah.php';
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo '<meta http-equiv="refresh" content="0; url=index.php">';

}else{

include 'lib/function.php';
ob_start(); ?>

<html>
<head>
  <title>Cetak Laporan</title>

    <style type="text/css">
    body{
        font-family: sans-serif;
    }
    table {
    border-collapse: collapse;
     font-family: sans-serif;
        }
    th {
        height: 30px;
        font-size: 12px;
        font-family: sans-serif;
    }
    table, th, td {
        border: 1px solid black;
        font-size: 11px;
        padding: 5px;
    }

    h3{
        padding-bottom: -15px;
        font-family: sans-serif;
        text-align: center; text-transform: uppercase;

    }
    p{
        font-size: 12px;
        text-align: center;
        padding-bottom: -8px;
    }
    .divider-dashed {
    border-top: 1px dashed #ccc;
    background-color: #fff;
    height: 1px;
    margin: 10px 0;
    }

    #kiri
    {
    width:50%;
    height:100px;
    background-color:#FF0;
    float:left;
    }
    #kanan
    {
    width:50%;
    height:100px;
    background-color:#0C0;
    float:right;
    }
    </style>
</head>
<body>

<!-- laporan transaksi -->
<?php

if ($_GET['p']=='1'){
$query=mysqli_query($conn,"SELECT * FROM pengaturan LIMIT 1");
$r=mysqli_fetch_array($query);
$nama_file = 'lap_transaksi_periode';
$tanggal1 = $_GET[t1];
$tanggal2 = $_GET[t2];


$id1 = decrypt($tanggal1);
$id2 = decrypt($tanggal2);
$tgl1 = date('Y-m-d', strtotime($id1));
$tgl2 = date('Y-m-d', strtotime($id2));

?>
<h3 >Laporan Transaksi Periode <br><?php echo $r[nama_sekolah];?></h3>
<p><?php echo $r[alamat];?>  </p>
<p><?php echo $r[telephone];?> - <?php echo $r[situs];?> </p>
<div class="divider-dashed"></div><br><br>
<p>Tanggal : <?php echo $id1;?> s.d <?php echo $id2;?></p><br>
<table width="100%">
<tr>
  <th>Tanggal</th>
    <th>No Transaksi</th>
    <th>Nasabah</th>
    <th>Debit</th>
    <th>Kredit</th>
    <th width="110">Saldo</th>
</tr>
<?php
$query = "SELECT DATE_FORMAT(transaksi.tanggal, '%d-%m-%Y') as tgl,
                    transaksi.id_transaksi,
                    nasabah.nama,
                    transaksi.debit,
                    transaksi.kredit
                FROM transaksi JOIN nasabah ON transaksi.id_nasabah=nasabah.id_nasabah WHERE (tanggal BETWEEN '$tgl1' AND '$tgl2') order by id_transaksi asc "; // Tampilkan semua data gambar
$sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
$row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

if($row > 0){
  $count = 2 ;
    while($data = mysqli_fetch_array($sql)){ ?>
       <tr >
          <td><?php echo $data['tgl'];?></td>
          <td><?php echo $data['id_transaksi'];?></td>
          <td><?php echo $data['nama'];?></td>

          <?php if($count==1){?>

          <td><?php echo "Rp. ".rupiah($data['debit']);?></td>
          <td><?php echo "Rp. ".rupiah($data['kredit']);?></td>
          <td>
              <?php
              $debit=$data['debit'];
              $saldo=$data['debit'];
              echo "Rp. ".rupiah($saldo);
              ?>
          </td>

              <?php }else{ if($data['debit']!=0){ ?>
          <td><?php echo "Rp. ".rupiah($data['debit']);?></td>
          <td><?php echo "Rp. ".rupiah($data['kredit']);?></td>
          <td>
              <?php
                $debit=$denit+$data['debit'];
                $saldo=$saldo+$data['debit'];
                echo "Rp. ".rupiah($saldo);

               }else{?>
          <td><?php echo "Rp. ".rupiah($data['debit']);?></td>
          <td><?php echo "Rp. ".rupiah($data['kredit']);?></td>
          <td>
               <?php
                  $kredit=$kredit+$data['kredit'];
                  $saldo=$saldo-$data['kredit'];
                  echo "Rp. ".rupiah($saldo);
               }
            }
            $count++
          ?>
      </tr>
   <?php
      }

   }else {  echo "<tr><td colspan='6'>Data tidak ada</td></tr>";}
  ?>
</table>

<!-- laporan per nasabah -->
<?php }elseif($_GET['p']=='2'){
$nama_file = 'lap_transaksi_nasabah';
$query=mysqli_query($conn,"SELECT * FROM pengaturan LIMIT 1");
$r2=mysqli_fetch_array($query);


$tanggal1 = $_GET[t1];
$tanggal2 = $_GET[t2];
$nasabah = $_GET[id];

$id1 = decrypt($tanggal1);
$id2 = decrypt($tanggal2);
$id_nasabah = decrypt($nasabah);
$tgl1 = date('Y-m-d', strtotime($id1));
$tgl2 = date('Y-m-d', strtotime($id2));

$query_rek=mysqli_query($conn,"SELECT * FROM nasabah WHERE id_nasabah='$id_nasabah'");
$r=mysqli_fetch_array($query_rek);

?>
<h3 >Laporan Transaksi Nasabah <br><?php echo $r2[nama_sekolah];?></h3>
<p><?php echo $r2[alamat];?>  </p>
<p><?php echo $r2[telephone];?> - <?php echo $r2[situs];?> </p>
<div class="divider-dashed"></div><br><br>
<p>Tanggal : <?php echo $id1;?> s.d <?php echo $id2;?></p>
<p><b><?php echo $r['nama'];?></b> <i> ( <?php echo $r['no_rekening'];?> )</i></p>

<table width="100%">
<tr>
  <th>Tanggal</th>
    <th>No Transaksi</th>
    <th>Debit</th>
    <th>Kredit</th>
    <th width="110">Saldo</th>
</tr>
<?php

$query = "SELECT DATE_FORMAT(transaksi.tanggal, '%d-%m-%Y') as tgl,
                    transaksi.id_transaksi,
                    nasabah.nama,
                    transaksi.debit,
                    transaksi.kredit
                FROM transaksi JOIN nasabah ON transaksi.id_nasabah=nasabah.id_nasabah WHERE (tanggal BETWEEN '$tgl1' AND '$tgl2') AND transaksi.id_nasabah ='$id_nasabah' order by id_transaksi asc "; // Tampilkan semua data gambar
$sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
$row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

if($row > 0){
  $count = 2 ;
    while($data = mysqli_fetch_array($sql)){ ?>

        <tr >
          <td><?php echo $data['tgl'];?></td>
          <td><?php echo $data['id_transaksi'];?></td>

          <?php if($count==1){?>

          <td><?php echo "Rp. ".rupiah($data['debit']);?></td>
          <td><?php echo "Rp. ".rupiah($data['kredit']);?></td>
          <td>
              <?php
              $debit=$data['debit'];
              $saldo=$data['debit'];
              echo "Rp. ".rupiah($saldo);
              ?>
          </td>

              <?php }else{ if($data['debit']!=0){ ?>
          <td><?php echo "Rp. ".rupiah($data['debit']);?></td>
          <td><?php echo "Rp. ".rupiah($data['kredit']);?></td>
          <td>
              <?php
                $debit=$denit+$data['debit'];
                $saldo=$saldo+$data['debit'];
                echo "Rp. ".rupiah($saldo);

               }else{?>
          <td><?php echo "Rp. ".rupiah($data['debit']);?></td>
          <td><?php echo "Rp. ".rupiah($data['kredit']);?></td>
          <td>
               <?php
                  $kredit=$kredit+$data['kredit'];
                  $saldo=$saldo-$data['kredit'];
                  echo "Rp. ".rupiah($saldo);
               }
            }
            $count++
          ?>
      </tr>
   <?php }
    }else{
    echo "<tr><td colspan='6'>Data tidak ada</td></tr>";
}
?>
</table>
<?php } elseif($_GET['p']=='3'){
$kelas = $_GET[k] ;
$id = decrypt($kelas);



$query_rek=mysqli_query($conn,"SELECT * FROM nasabah WHERE id_kelas='$id'");
if (mysqli_num_rows($query_rek) == 0){
  $query_rek=mysqli_query($conn,"SELECT * FROM nasabah");
}

while($r=mysqli_fetch_array($query_rek)){;
echo $r[nama];
echo $r[no_rekening];

}
?>

<?php

?>


<?php } ?>

</body>
</html>


<?php
$html = ob_get_contents();
ob_end_clean();
require_once 'dompdf/dompdf_config.inc.php';
  $dompdf = new dompdf();
  $dompdf->set_paper('A4', 'potrait');
  $dompdf->load_html($html);
  $dompdf->render();
  $dompdf->stream("$nama_file.pdf",array('Attachment'=>0))?>

<?php
  }
?>
