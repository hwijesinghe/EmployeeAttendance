<?php echo view('layout/header'); ?>
<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper rounded">
      <div class="container">
        <h3 class="text-center"> Login to System</h3>
        <hr>

        <?php if(isset($validation)){?>
          <div class="alert alert-danger" role="alert">
            <?= $validation->listErrors() ?>
          </div>
        <?php } ?>

        
        
        <form class="" action="/" method="POST">
          <div class="form-group">
           <label for="username">Username</label>
           <input type="text" class="form-control" name="username" id="username" value="<?php echo(set_value('username')); ?>" />
          </div>
          <div class="form-group">
           <label for="password">Password</label>
           <input type="password" class="form-control" name="password" id="password" value="" />
          </div>
         
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php echo view('layout/footer'); ?>