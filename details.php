<?php
//connect to database
include('./db-connect.php');

//checking POST request id
if(isset($_POST['delete'])){

    //Checking Data using mysqli_real_escape_string()
    $id_to_delete = mysqli_real_escape_string($conn, $_POST["id_to_delete"]);

    //Making query using "DELETE FROM customer_info WHERE id = $id_to_delete"
    $sql = "DELETE FROM customer_info WHERE id = $id_to_delete";
                    
    //If success     
    if(mysqli_query($conn,$sql)){ //execute the query

        //Go back to index.php
        header('Location: index.php'); 
        
    }else{
        // If fail - echo error
        echo 'Query error: ' . mysqli_error($conn);

    }
}


//checking GET request id
if(isset($_GET['id'])){

    //Checking Data using mysqli_real_escape_string()
    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    //Making query using "SELECT * FROM customer_info WHERE id = $id";
    $sql = "SELECT * FROM customer_info WHERE id = $id";

    //Get the query result
    $result = mysqli_query($conn, $sql);
    //Fetch the result as an associative array using mysqli_fetch_assoc()
    $order = mysqli_fetch_assoc($result);

    //free result from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

        <?php include('templates/header.php'); ?>

        <div class="container center">
            <?php if($order): ?>

                <h4><?php echo htmlspecialchars($order['name']);?></h4>
                <p>Create by: <?php echo htmlspecialchars($order['email']);?></p>
                <p>Phone Number: <?php echo htmlspecialchars($order['phone']);?></p>
                <h5>Items Ordered:</h5>
                <p><?php echo htmlspecialchars($order['items']);?></p>

                <!-- DELETE FORM -->
                <form action="details.php" method="POST">
                    <input type="hidden" name="id_to_delete" value="<?php echo $order['id'] ?>">
                    <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
                </form>

            <?php else: ?>

                <h5>Order Doesn't Exist!</h5>

            <?php endif; ?>
        </div>


        <?php include('templates/footer.php'); ?>
    </body>

</html>