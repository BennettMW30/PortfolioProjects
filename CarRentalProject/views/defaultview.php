
 <?php
        if (!isset($_SESSION['user'])){
?>
  <div class='row align-items-center justify-content-center'>
        <div class='col-6'>
         <h4>Please sign in</h4>
                  <form action='index.php?mode=checkLogin' method='post'>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-id-badge"></i></span>
                          </div>
                          <input type="text" class="form-control" name='username' placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                          </div>
                          <input type="text" class="form-control" name='pwd' placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                        </div>

			<p>
                                <button type='submit' class='btn btn-primary' >Sign in </button>
                                <button type='reset' class='btn' >Clear</button>
			</p>
                  </form>
               </div>

</div>
<?php
}  else {
  
  echo "<div class='row align-items-center justify-content-center'>
  <div class='col-12'>";
   // valid user. Display default view
//include('assets/menu.php');
?>

  <h2>Welcome to Warhawk Car Rentals</h2>
  <div class='col'>
	<img src='https://ymimg.b8cdn.com/uploads/spotlight/734_605_new_car_cover_picture.jpg?1530188562' alt='car' style='width: 90%'/>
  </div>  
  
  </div>
</div>
<?php 
}
?>
