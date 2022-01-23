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
        <h3 class="card-title">Employee Listing</h3>

        <div class="card-tools">
          <a href="new_employee" class="btn btn-primary"> Create New Employee</a>
        </div>
      </div>
      <div class="card-body">

        <?php if(session()->get('success')):?>
          <div class="alert alert-success" role="alert">
            <?php echo(session()->get('success')); ?>
          </div>
        <?php endif; ?>

        <?php if(session()->get('error')){?>
          <div class="alert alert-danger" role="alert">
          <?php echo(session()->get('error')) ?>
          </div>
        <?php } ?>
        
        <table class="table table-hover">
          <?php if(isset($employee) && count($employee->getResult('array')) > 0) { ?>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Phone</th>
              <th scope="col">Email</th>
              <th scope="col">action</th>
            </tr>
          </thead>
          <tbody>
            <?php 


              $count = 1;
              foreach ($employee->getResult('array') as $row) :
               // if($row['role_id'] != 0){
            ?>
            <tr>
              <th scope="row"><?php echo($count++)?></th>
              <td><?php echo($row['employee_name']); ?></td>
              <td><?php echo($row['contact_number']); ?></td>
              <td><?php echo($row['email']); ?></td>
              <td>
              <a href="edit_employee/<?=base64_encode($row['id']);?>" class="btn btn-success"> Edit </a>
              <a href="delete_employee<?=base64_encode($row['id']);?>" class="btn btn-danger"> Delete </a>
              </td>
            </tr>
          </tbody>
          <?php 
                 // }
                endforeach; 
              }else{
          ?>
            <tr class="noData">
              <td>
                No Employee data exist
              </td>
            </tr>
          <?php                
              }  
          ?>
        </table>

     
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