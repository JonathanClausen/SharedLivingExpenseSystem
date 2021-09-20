<?php
// We need to use sessions, so you should always start sessions using the below code.

include 'dbconfig.php';


// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

$sql = "SELECT accounts.username, expenses.amount, expenses.description, expenses.created_at 
FROM expenses
JOIN accounts ON expenses.payee = accounts.id";
$result = $con->query($sql);

?>
<?php include 'assets/header.php'; ?>

<div class="container pt-2">

    <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>

    <div class="row">
        <div class="col-md-6 pt-3">
            <div class="card">
                <div class="card-body">
                    <h2>Add expense</h2>

                    <form action="insert.php" method="post">
                        <div class="input-group">
                            <label class="input-group-text" for="amount">Amount:</label>
                            <input type="number" name="amount" class="form-control" id="amount">
                                <div class="input-group-append">
                                    <span class="input-group-text">DKK</span>
                                </div>
                        </div>
                        <div class="input-group mt-3">
                            <label class="input-group-text" for="description">Description</label>
                            <input type="text" name="description" class="form-control" id="description">
                        </div>
                        <button class="w-100 btn btn-lg btn-primary mt-4" value="insert" type="submit">Add</button>
                    </form>
                </div>
            </div>  
        </div>
        <div class="col-md-6 mt-4">
            <div class="card">
                    <div class="card-body">
                        <h2>Lates Expenses</h2>

                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col">Amount</th>
                                <th scope="col">Description</th>
                                <th scope="col">Date</th>
                                <th scope="col">User</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                // output data of each row
                                $i = 0;
                                while(($row = $result->fetch_assoc()) && $i < 15) {
                                    echo "<tr><td>".$row["amount"] ." kr.</td><td>".$row["description"] ."</td><td>".date("d-m-Y",strtotime($row["created_at"])). "</td><td>".$row["username"]. "</td></tr>";
                                    $i++;
                                }
                                } else {
                                echo "0 results";}
                            ?>

                            </tbody>
                            </table>

                        
                    </div>
                </div>  
        </div>
    </div> <!-- row -->

</div>
<?php include 'assets/footer.php'; ?>

