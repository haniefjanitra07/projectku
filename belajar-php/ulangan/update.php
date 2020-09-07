<?php  
      if (is_numeric($_GET["update-data"])) {
        include 'connect.php';
        $id_update = strip_tags(trim($conn->real_escape_string($_GET["update-data"])));
        $sql_update = "SELECT * FROM users WHERE id = '$id_update' ";
        $query_update = $conn->query($sql_update);
          // var_dump($query_update);
          // die;
        if ($query_update->num_rows > 0) {
          $fetch = $query_update->fetch_assoc();
       ?>
       <div class="card">
         <div class="card-header bg-success">
            <p class="lead text-white mb-0">Update a User</p>
         </div>
         <div class="card-body">
           <form action="" method="post">
              <div class="form-group">
                  <label for="fullname">Full name</label>
                  <input type="text" class="form-control" id="fullname" name="full_name" value="<?= $fetch["full_name"] ?>">
                  <?php if(isset($_SESSION["msgUser"])) :?>
                  <small id="wrong" class="form-text text-muted"><?= $_SESSION["msgUser"]; ?></small>
                  <?php
                      session_unset();
                  ?>
                  <?php endif;?>
              </div>
              <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" value="<?= $fetch["username"] ?>">
                  <?php if(isset($_SESSION["msgUser"])) :?>
                  <small id="wrong" class="form-text text-muted"><?= $_SESSION["msgUser"]; ?></small>
                  <?php
                      session_unset();
                  ?>
                  <?php endif;?>
              </div> 
              <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
                  <?php if(isset($_SESSION["msgPass"])) :?>
                  <small id="wrong" class="form-text text-muted"><?= $_SESSION["msgPass"]; ?></small>
                  <?php
                      session_unset();
                  ?>
                  <?php endif;?>
              </div>
              <button type="submit" class="btn btn-success" name="update">Submit</button>
             </form>
              <a href="index.php" class="text-danger float-right">Close</a>
         </div>
       </div>


<?php
   }
   else{
      $_SESSION["error"] =  "There is no id on database";

   ?>
    <div class="card">
         <div class="card-header bg-success">
            <p class="lead text-white mb-0">Update a User</p>
         </div>
         <div class="card-body">
           <form action="" method="post">
              <div class="form-group">
                  <label for="fullname">Full name</label>
                  <input type="text" class="form-control" id="fullname" name="full_name">
                  <?php if(isset($_SESSION["msgUser"])) :?>
                  <small id="wrong" class="form-text text-muted"><?= $_SESSION["msgUser"]; ?></small>
                  <?php
                      session_unset();
                  ?>
                  <?php endif;?>
              </div>
              <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username">
                  <?php if(isset($_SESSION["msgUser"])) :?>
                  <small id="wrong" class="form-text text-muted"><?= $_SESSION["msgUser"]; ?></small>
                  <?php
                      session_unset();
                  ?>
                  <?php endif;?>
              </div> 
              <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
                  <?php if(isset($_SESSION["msgPass"])) :?>
                  <small id="wrong" class="form-text text-muted"><?= $_SESSION["msgPass"]; ?></small>
                  <?php
                      session_unset();
                  ?>
                  <?php endif;?>
              </div>
              <button type="submit" class="btn btn-success" name="update">Submit</button>
             </form>
              <a href="index.php" class="text-danger float-right">Close</a>
         </div>
       </div>
<?php      
   }

    }else{
      $_SESSION["error"] =  "Id is not valid!";
      ?>
       <div class="card">
         <div class="card-header bg-success">
            <p class="lead text-white mb-0">Update a User</p>
         </div>
         <div class="card-body">
           <form action="" method="post">
              <div class="form-group">
                  <label for="fullname">Full name</label>
                  <input type="text" class="form-control" id="fullname" name="full_name">
                  <?php if(isset($_SESSION["msgUser"])) :?>
                  <small id="wrong" class="form-text text-muted"><?= $_SESSION["msgUser"]; ?></small>
                  <?php
                      session_unset();
                  ?>
                  <?php endif;?>
              </div>
              <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username">
                  <?php if(isset($_SESSION["msgUser"])) :?>
                  <small id="wrong" class="form-text text-muted"><?= $_SESSION["msgUser"]; ?></small>
                  <?php
                      session_unset();
                  ?>
                  <?php endif;?>
              </div> 
              <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
                  <?php if(isset($_SESSION["msgPass"])) :?>
                  <small id="wrong" class="form-text text-muted"><?= $_SESSION["msgPass"]; ?></small>
                  <?php
                      session_unset();
                  ?>
                  <?php endif;?>
              </div>
              <button type="submit" class="btn btn-success" name="update">Submit</button>
             </form>
              <a href="index.php" class="text-danger float-right">Close</a>
         </div>
       </div>
 <?php     
    }

    if( isset($_POST["update"]) ){
       require_once 'connect.php'; 
        $full_name = trim(strip_tags($_POST["full_name"]));
        $username = strtolower(trim(strip_tags($_POST["username"])));
        $password = strip_tags(trim($conn->real_escape_string($_POST["password"])));

         $sql_update2 = $conn->query("SELECT * FROM users WHERE username = '$username'")->fetch_assoc();
         $sql_update3 = $conn->query("SELECT * FROM users");

          if($fetch["username"] == $sql_update2["username"]){
                if (empty($password)) {
                  // var_dump($password);
                  // die;
                  $sql_update2 = "UPDATE users SET  
                                        full_name = '$full_name', 
                                        username = '$username' WHERE id = '$id_update'";
                  $query_update2 = $conn->query($sql_update2);
                  $_SESSION["success"] = "Updated";
                  header('location: index.php');
                }else{
                  //  var_dump($password);
                  // die;
                  $hash = password_hash($password, PASSWORD_DEFAULT);

                  $sql_update2 = "UPDATE users SET  
                                        full_name = '$full_name', 
                                        username = '$username', 
                                        password = '$hash' WHERE id = '$id_update'";
                  $query_update2 = $conn->query($sql_update2);
                  $_SESSION["success"] = "Updated";
                  header('location: index.php');
                }
              
           }
           else if($username != $sql_update2["username"]){
                if (!isset($password)) {
                     $sql_update2 = "UPDATE users SET  
                                      full_name = '$full_name', 
                                      username = '$username' WHERE id = '$id_update'";
                    $query_update2 = $conn->query($sql_update2);
                    $_SESSION["success"] = "Updated";
                    header('location: index.php');
                }
                else{
                 $hash = password_hash($password, PASSWORD_DEFAULT);

                  $sql_update2 = "UPDATE users SET  
                                        full_name = '$full_name', 
                                        username = '$username', 
                                        password = '$hash' WHERE id = '$id_update'";
                  $query_update2 = $conn->query($sql_update2);
                  $_SESSION["success"] = "Updated";
                  header('location: index.php');

                }
           }
           else{

            while ($fetch2 = $sql_update3->fetch_assoc()) {
             if($sql_update2["username"] == $fetch2["username"]){
                $_SESSION["error"] = "Username is not available";
                return false;
                }
             }
          }

    }
