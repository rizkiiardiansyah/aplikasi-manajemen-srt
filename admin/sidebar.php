<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="content.php">
                <i class="fa fa-dashboard"></i> <span>Beranda</span> 
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i>
                <span>Transaksi Surat</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="surat_masuk.php"><i class="fa fa-inbox"></i>Surat Masuk</a></li>
                <li><a href="surat_keluar.php"><i class="fa fa-inbox"></i>Surat Keluar</a></li>

              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-calendar"></i>
                <span>Agenda Surat</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="agenda_masuk.php"><i class="fa fa-archive"></i>Agenda Surat Masuk</a></li>
                <li><a href="agenda_keluar.php"><i class="fa fa-archive"></i>Agenda Surat Keluar</a></li>

              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-image"></i>
                <span>Galeri File</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="galeri_masuk.php"><i class="fa fa-file"></i>Galeri Surat Masuk</a></li>
                <li><a href="galeri_keluar.php"><i class="fa fa-file"></i>Galeri Surat Keluar</a></li>

              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-cog"></i>
                <span>Pengaturan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="backup_admin.php"><i class="fa fa-hdd-o"></i>Backup Database</a></li>
                <li><a href="restore_admin.php"><i class="fa fa-undo"></i>Restore Database</a></li>

              </ul>
            </li>
            <li class="treeview">
              <a href="man_instansi.php">
                <i class="fa fa-edit"></i> <span>Manajemen Instansi</span> 
              </a>
            </li>
            <li class="treeview">
              <a href="kelola_user.php">
                <i class="fa fa-group"></i> <span>Kelola User</span>
              </a>
            </li>
            <li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
