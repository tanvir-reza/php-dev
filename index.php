<?php require_once('./header.php') ?>
<?php require_once('./navbar.php') ?>


<div class="container text-center">
    <h1 style="color: #d9efff" class="mt-3">PHP DeveLoper Task</h1>
    <a class="btn btn-primary me-2" href="./login.php">Login</a>
    <a class="btn btn-warning me-2" href="./login.php">SignUp</a>
</div>

<!-- <div class="container text-center mt-5">
    <h1>All Users</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once('./config/db.php');
                $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
                $sql = "SELECT * FROM user";
                $result = mysqli_query($conn, $sql);
                $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach($users as $user){
                    echo "<tr>";
                    echo "<td>".$user['id']."</td>";
                    echo "<td>".$user['username']."</td>";
                    echo "<td>".$user['email']."</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

</div> -->




<?php require_once('./footer.php') ?>
    
    


