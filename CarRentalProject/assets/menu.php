  <div class='row'>
   <div class='col'>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" 
       aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
       <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
       </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Select Vehicle Type: </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	   <?php
        foreach($vehicle_types as $vehicle){
          // each element is an object that defines a particular vehicle type
          echo "<a class='dropdown-item'
                href='index.php?mode=category&type={$vehicle['type']}'>{$vehicle['type']}</a>";
        } // end for
        ?>


        </div>
       </li>
       <li class="nav-item">
        <a class="nav-link" href="index.php?mode=displaycart">My Rentals</a>
       </li>
       <li class="nav-item">
        <a class="nav-link" href="index.php?mode=displaypaymentmethod">Update Payment Method</a>
       </li>
	<li class="nav-item">
           <a class="nav-link" href="index.php?mode=logout">Sign out</a>
       </li>


     </ul>
   </div>
  </nav>
 </div>
</div>
