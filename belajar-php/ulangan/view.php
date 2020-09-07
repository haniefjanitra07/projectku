<?php
// session_start();


        if (is_numeric($_GET["view-data"])) {
            require_once 'connect.php'; 
            $id = strip_tags(trim($conn->real_escape_string($_GET["view-data"])));
            $query1 = $conn->query("SELECT * FROM users WHERE id = '$id'");

            if ($query1->num_rows > 0) {
                $fetch = $query1->fetch_assoc();

?>
        <div class="card">
            <div class="card-header bg-success">
                <p class="lead mb-0 text-white">Detail User</p>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Full name</th>
                      <th scope="col">Username</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?= $fetch["full_name"] ?></td>
                      <td><?= $fetch["username"] ?></td>
                    </tr>
                  </tbody>
                </table>
                <a href="index.php" class="text-danger float-right">Close</a>
            </div>
        </div>
    <?php    

    }
    else{
        $_SESSION["error"] = "There is no id on Database";
        header('location: index.php');
    }

    } else{
        $_SESSION["error"] = "Id is not valid";
        header('location: index.php');
    }  

            if( isset($_POST["submit"]) ){
                $full_name = trim(strip_tags($_POST["full_name"]));
                $username = strtolower(trim(strip_tags($_POST["username"])));
                $password = strip_tags(trim($conn->real_escape_string($_POST["password"])));


                if($username === $query1["username"]){
                    $_SESSION["error"] = "Username is not available";
                    return false;
                }

                $hash = password_hash($password, PASSWORD_DEFAULT);
                // var_dump($hash);
                // die;
                $sql = "";
                $query = $conn->query($sql);

                header('location: index.php');
            }