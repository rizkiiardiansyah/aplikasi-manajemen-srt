<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/adminlte/AdminLTE-2.0.5/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image" />
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
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('barang') ?>"><i class="fa fa-circle-o"></i>Data Busa</a></li>
                    <li><a href="<?php echo site_url('barang') ?>"><i class="fa fa-circle-o"></i>Data Kain</a></li>
                    <li><a href="<?php echo site_url('barang') ?>"><i class="fa fa-circle-o"></i>Data Plastik</a></li>
                    <li><a href="<?php echo site_url('penjualan/pelanggan') ?>"><i class="fa fa-circle-o"></i>Data Pembeli</a></li>
                    <li><a href="<?php echo site_url('suplier') ?>"><i class="fa fa-circle-o"></i>Data Suplier</a></li>
                
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cube fa-fw"></i> <span>Transaksi</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('penjualan/transaksi') ?>"><i class="fa fa-circle-o"></i>Barang Masuk</a></li>
                    <li><a href="<?php echo site_url('penjualan/keluar') ?>"><i class="fa fa-circle-o"></i>Barang Keluar</a></li>
                    <li><a href="<?php echo site_url('penjualan/retur') ?>"><i class="fa fa-circle-o"></i>Barang Retur</a></li>
                </ul>
            </li>
            <li>
            <a href="<?php echo site_url('laporan') ?>">
                    <i class="fa fa-book"></i> <span>Laporan</span>
                </a>
                </li>
                <li>
            <a href="<?php echo site_url('user') ?>">
                    <i class="fa fa-user"></i> <span>List User</span>
                </a>
                </li>
         
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">