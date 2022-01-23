<?php echo view('admin_layout/header'); ?>
<div class="wrapper">
  <?php echo view('admin_layout/navbar'); ?>
  <?php echo view('admin_layout/sidebar'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php echo view('admin_layout/breadcrumb'); ?>
    <!-- Main content -->
    <section class="content">

    <div class="card mt-5">
      <div class="card-header ">        
        <h3 class="card-title">Employee</h3>

        <div class="card-tools">
          <a href="/employee/list" class="btn btn-secondary"> Employees List </a>
        </div>
      </div>
      <div class="card-body">
      
        <div class="container">
          <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-3 pt-3 pb-3 bg-white from-wrapper rounded">
              <div class="container">
                <h3> Edit Employee </h3>
                <hr>

                <?php if(isset($validation)){?>
                  <div class="alert alert-danger" role="alert">
                    <?= $validation->listErrors() ?>
                  </div>
                <?php } ?>
                
                <form class="" action="<?php echo base_url(); ?>/employee/update_employee" method="POST" enctype="multipart/form-data" >
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="employee_name">Employee Name</label>
                      <input type="text" class="form-control" name="employee_name" id="employee_name" value="<?php echo(@$employee->employee_name);?>">
                    </div>
                    
                    <div class="form-group col-6">
                      <label for="contact_number">Contact Number</label>
                      <input type="text" class="form-control" name="contact_number" id="contact_number" value="<?php echo(@$employee->contact_number);?>">
                    </div>
                  </div>

                  <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="text" class="form-control" name="email" id="email" value="<?php echo(@$employee->email);?>">
                  </div>

                  <div class="form-group">
                  <label for="username">User Name</label>
                  <input type="text" class="form-control" name="username" id="username" value="<?php echo(@$employee->username);?>">
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" name="password" id="password" value="">
                    </div>

                    <div class="form-group col-6">
                      <label for="com_password">Password</label>
                      <input type="password" class="form-control" name="com_password" id="com_password" value="">
                    </div>
                  
                  </div>
                
                  <div class="row">
                    <div class="col-12">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo(@$employee->employee_id);?>">
                   
                      <button type="submit" class="btn btn-primary btn-block"> Update </button>
                    </div>            
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      
      </div>
    </div>

   
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