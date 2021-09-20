<?php
include 'dbconfig.php';
include 'assets/header.php';


// ---- Queries -----
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['month'], $_POST['year']) ) {
    $sql = "SELECT accounts.username, expenses.amount, expenses.description, expenses.created_at 
    FROM expenses JOIN accounts ON expenses.payee = accounts.id 
    WHERE YEAR(created_at) = ".$_POST['year']." AND MONTH(created_at) = ".$_POST['month']."
    ORDER BY created_at DESC";
    $result = $con->query($sql);
    
    $sql = "SELECT username, SUM(expenses.amount) AS totalexpenses 
    FROM expenses JOIN accounts ON expenses.payee = accounts.id 
    WHERE YEAR(created_at) = ".$_POST['year']." AND MONTH(created_at) = ".$_POST['month']." 
    GROUP BY accounts.id 
    ORDER BY created_at DESC 
    ";
    $byuser = $con->query($sql);

    $sql = "SELECT SUM(expenses.amount) AS totalexpenses 
    FROM expenses 
    WHERE YEAR(created_at) = ".$_POST['year']." AND MONTH(created_at) = ".$_POST['month']." 
    ";
    $totalexpenses = $con->query($sql);

    // Expenses calculations by user. HC and JC count as one.

    $sql = "SELECT username, SUM(expenses.amount) as totalexpenses
    FROM accounts 
    LEFT JOIN expenses 
    ON accounts.id = expenses.payee AND YEAR(created_at) = ".$_POST['year']." AND MONTH(created_at) = ".$_POST['month']."
    GROUP BY accounts.id 
    ORDER BY created_at DESC";
    $totalbyuser = $con->query($sql);

    $calTotal = 0;
    if ($totalbyuser->num_rows > 0) {
        // output data of each row
        $calTotalRows = $totalbyuser->fetch_all(MYSQLI_ASSOC);
        foreach ($calTotalRows as $row){
            $calTotal = $calTotal + intval($row['totalexpenses']);
        }
        
        $calTotal = intval($calTotal / 3);
        
    }    
    $con->close();
    

}
else {
    $sql = "SELECT accounts.username, expenses.amount, expenses.description, expenses.created_at 
    FROM expenses
    JOIN accounts ON expenses.payee = accounts.id
    ORDER BY created_at DESC";
    $result = $con->query($sql);

    $sql = "SELECT username, SUM(expenses.amount) AS totalexpenses 
    FROM expenses JOIN accounts ON expenses.payee = accounts.id 
    GROUP BY accounts.id 
    ORDER BY created_at DESC 
    ";
    $byuser = $con->query($sql);

    $sql = "SELECT SUM(expenses.amount) AS totalexpenses 
    FROM expenses";
    $totalexpenses = $con->query($sql);
}
// ---- END Queries ----

$total = "";
    if ($totalexpenses->num_rows > 0) {
        // output data of each row
        while($row = $totalexpenses->fetch_assoc()) {
            $total = $row['totalexpenses'];
        }
    }
?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 mt-4">
            <div class="card">
                <div class="card-body">
                    <h3>Select month</h3>
                    <form action="expenses.php" method="POST">
                        <select name="month" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
                            <?php   
                            $transdate = date('m', time());
                            for ($x = 1; $x <= 12; $x++) {
                                $monthName = date('F', mktime(0, 0, 0, $x, 10));
                                if (isset($_POST['month']) && $x == $_POST['month']){
                                    echo "<option selected value='".$x."'>".$monthName."</option>";
                                } elseif(!isset($_POST['month']) && $x == $transdate){
                                    echo "<option selected value='".$x."'>".$monthName."</option>";
                                
                                } else{
                                    echo "<option value='".$x."'>".$monthName."</option>";
                                }
                            }
                            ?>
                        </select>
                        <select name="year" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
                            <option selected value="2021">2021</option>
                            <option value="2022">2022</option>
                        </select>
                        <button class="w-100 btn btn-md btn-primary" value="select" type="submit">Select</button>
                    </form>
                </div>
            </div>
        </div>
       
        <div class="col-sm-4 mt-4">
            <div class="card">
                <div class="card-body">
                    <h3>Totals</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Total: <?php echo $total?></li>
                        <?php
                        if ($byuser->num_rows > 0) {
                            // output data of each row
                            while($row = $byuser->fetch_assoc()) {
                                echo "<li class='list-group-item'>".$row['username'].": ".$row['totalexpenses']." kr. </li>";
                            }
                            }
                        ?>
                        
                    </ul>
                    
                </div>
            </div>
        </div>
        <div class="cold-md-12 mt-4">
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $totalbyuser->num_rows > 0): ?>
                <div class="card">
                    <div class="card-body">
                    <h3>Distribution for <?php echo DateTime::createFromFormat('!m', $_POST['month'])->format('F')  ?></h3>
                        <?php
                            foreach ($calTotalRows as $row){
                                $res = intval($row['totalexpenses']) - $calTotal;
                                echo "<li class='list-group-item'>".$row['username'].": ". $res ." kr. </li>";
                            }
                        ?>
                    </div>
                </div>
            <?php endif; ?>
                    
        </div>
        <div class="col-md-12 mt-4">
                    <div class="card">
                            <div class="card-body">
                                <h2>Expenses</h2>

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
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr><td>".$row["amount"] ." kr.</td><td>".$row["description"] ."</td><td>".date("d-m-Y",strtotime($row["created_at"])). "</td><td>".$row["username"]. "</td></tr>";
                                        }
                                        } else {
                                        echo "0 results";}
                                    ?>

                                    </tbody>
                                    </table>

                                
                            </div>
                        </div>  
                </div>
        </div>

</div>

