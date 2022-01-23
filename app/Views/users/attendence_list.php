<?php echo view('layout/header'); ?>
<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-8 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper rounded">
      <div class="container">
        <h3 class="text-center"> Mark Attendence </h3>
       
          <div class="row">
            <div class="col-12">
              
               <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">In Time</th>
                        <th scope="col">Out time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td><?php echo(ucfirst($last_attendence->username)); ?></td>
                        <td><?php echo(date("m/d/Y h:i:s", $last_attendence->in_time)); ?></td>
                        <td><?php echo(date("m/d/Y h:i:s", $last_attendence->out_time)); ?></td>
                        </tr>                        
                    </tbody>
                </table>

             
            </div>            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?php echo view('layout/footer'); ?>