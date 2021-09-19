<?php
require 'dbconfig.php';

class ExpenseMonth
{
    protected $month;
    protected $year;
    protected $expenses;
    protected $con;
    
    public function __construct($imonth, $iyear, $con)
    {
        $this->month = $imonth;
        $this->year = $iyear;
        $this->con = $con;


        $sql = "SELECT accounts.username, expenses.amount, expenses.description, expenses.created_at 
        FROM expenses JOIN accounts ON expenses.payee = accounts.id 
        WHERE YEAR(created_at) = ". $this->year ." AND MONTH(created_at) = ". $this->month ."
        ORDER BY created_at DESC";

        $result = $this->con->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        echo $rows;
        foreach($rows as $row){
            echo $row['username'];
        }

    }

    public function doSomething()
    {
        # we then use the $pdo var using $this->pdo
        $this->pdo->prepare('SELECT * FROM `table`');
        # etc.
    }
}

$em = new ExpenseMonth(9,2021,$con);