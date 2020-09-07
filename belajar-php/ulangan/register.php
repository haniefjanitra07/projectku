            <div class="card">
                <div class="card-header bg-success">
                    <p class="lead text-white mb-0">Create a User</p>
                </div>
                <div class="card-body">
                      <form action="" method="post">
                        <div class="form-group">
                            <label for="fullname">Full name</label>
                            <input type="text"  class="form-control <?= isset($_SESSION["regis_fn"]) ? 'is-invalid' : ''?>" id="fullname" name="full_name" placeholder="Enter Full Name">
                            <?php if(isset($_SESSION["regis_fn"])) :?>
                              <small id="wrong" class="form-text text-danger"><?= $_SESSION["regis_fn"]; ?></small>
                              <?php
                                  unset($_SESSION["regis_fn"]);
                              ?>
                             <?php endif;?>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control <?= isset($_SESSION["regis_user"]) ? 'is-invalid' : ''?>" id="username" name="username" placeholder="Enter Username">
                            <?php if(isset($_SESSION["regis_user"])) :?>
                              <small id="wrong" class="form-text text-danger"><?= $_SESSION["regis_user"]; ?></small>
                              <?php
                                  unset($_SESSION["regis_user"]);
                              ?>
                            <?php endif;?>
                        </div> 
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control <?= isset($_SESSION["regis_pass"]) ? 'is-invalid' : ''?>" id="password" name="password" placeholder="Password">
                            <?php if(isset($_SESSION["regis_pass"])) :?>
                              <small id="wrong" class="form-text text-danger"><?= $_SESSION["regis_pass"]; ?></small>
                              <?php
                                  unset($_SESSION["regis_pass"]);
                              ?>
                            <?php endif;?>
                        </div>
                        <button type="submit" class="btn btn-success" name="submit">Submit</button>
                       </form>
                </div>
            </div>

<?php
// session_start();
    if( isset($_POST["submit"]) ){
       require_once 'connect.php'; 
        $full_name = trim(strip_tags($_POST["full_name"]));
        $username = strtolower(trim(strip_tags($_POST["username"])));
        $password = strip_tags(trim($conn->real_escape_string($_POST["password"])));


        $query1 = $conn->query("SELECT * FROM users WHERE username = '$username'")->fetch_assoc();

        if (empty($full_name)) {
            $_SESSION["regis_fn"] = "Please fill the input";
            return false;
        }
        if (empty($username)) {
            $_SESSION["regis_user"] = "Please fill the input";
            return false;
        }
        if($username === $query1["username"]){
            $_SESSION["error"] = "Username is not available";
            return false;
        }
        if ( empty($password)) {
            $_SESSION["regis_pass"] = "Please fill the input";
            return false;
        }
        else{
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (id, full_name, username, password) VALUES ('', '$full_name', '$username', '$hash')";
        $query = $conn->query($sql);
         $_SESSION["success"] = "created";
        }
        header('location: index.php');
    }



?>