<?php echo view('admin_layout/header'); ?>
<div class="wrapper">
  <?php echo view('admin_layout/navbar'); ?>
  <?php echo view('admin_layout/sidebar'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php echo view('admin_layout/breadcrumb'); ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php echo(session()->get('username')); ?>
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

</div>
<?php echo view('admin_layout/footer'); ?>