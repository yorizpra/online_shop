 <?php session_start();?>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <?php if ($_SESSION['leveluser'] == 'admin'){ ?>
                  <li><a href="./"><i class="fa fa-home"></i> Beranda </a></li>
                  <?php }?>
                  <li ><a><i class="fa fa-book"></i> Data Master <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?module=nasabah">Anggota</a></li>
                    </ul>
                  </li>
                  <?php if ($_SESSION['leveluser'] == 'admin'){ ?>
                  <li><a href="?module=transaksi"><i class="fa fa-dollar"></i> Transaksi </a>
                  </li>
                   <?php }?>
                  <li><a><i class="fa fa-print"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?module=laporan-transaksi">Laporan Transaksi</a></li>
                    </ul>
                  </li>
                  <?php if ($_SESSION['leveluser'] == 'admin'){ ?>
                  <li><a><i class="fa fa-cog"></i> Pengaturan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                  <li><a href="?module=pengaturan" >Pengaturan </a></li>
                  <li><a href="?module=pegawai">Data Akun</a></li>
                  <?php }?>
                  <li><a href="logout.php"><i class="fa fa-sign-out"></i> Keluar </a></li>
                </ul>
                </li>
              </div>
            </div>
