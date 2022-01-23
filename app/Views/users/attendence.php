<?php echo view('layout/header'); ?>
<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper rounded">
      <div class="container">
        <h3 class="text-center"> Mark Attendence </h3>
        <hr>

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
        

        <?php
           // print_r($rec_id);
        ?>
       
        
        <form class="" action="/user/attendence" method="POST">
          <div class="form-group">
           <label for="emp_id">Your Name : <?php echo($employee['employee_name']); ?></label>           
          </div>
          <div class="form-group">
           <label for="emp_id">Now : <span id='ct7' style="background-color: #FFFF00"></span></label>           
          </div>
          <div class="form-group">
           <label for="special_note">Note</label>
           <input type="text" class="form-control" name="special_note" id="special_note" value="" />
          </div>          
         
         
          <div class="row">
            <div class="col-12">
                <?php if($out_time == true){
                ?>
                <input type="hidden" class="form-control" name="out" id="out" value="out" />  
                <input type="hidden" class="form-control" name="rec_id" id="rec_id" value="<?php echo($rec_id);?>" />   
                <button type="submit" class="btn btn-primary btn-block">Mark Out</button>
                <?php 
                }else{
                ?>
                    <input type="hidden" class="form-control" name="out" id="out" value="in" />
                    <button type="submit" class="btn btn-primary btn-block">Mark In</button>
                <?php
                } 
                ?>
             
            </div>            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript"> 
function display_ct7() {
var x = new Date()
var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
hours = x.getHours( ) % 12;
hours = hours ? hours : 12;
hours=hours.toString().length==1? 0+hours.toString() : hours;

var minutes=x.getMinutes().toString()
minutes=minutes.length==1 ? 0+minutes : minutes;

var seconds=x.getSeconds().toString()
seconds=seconds.length==1 ? 0+seconds : seconds;

var month=(x.getMonth() +1).toString();
month=month.length==1 ? 0+month : month;

var dt=x.getDate().toString();
dt=dt.length==1 ? 0+dt : dt;

var x1=month + "/" + dt + "/" + x.getFullYear(); 
x1 = x1 + " - " +  hours + ":" +  minutes + ":" +  seconds + " " + ampm;
document.getElementById('ct7').innerHTML = x1;
display_c7();
 }
 function display_c7(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct7()',refresh)
}
display_c7()
</script>
<?php echo view('layout/footer'); ?>