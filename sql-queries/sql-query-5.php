<?php require_once('../queries-connect.php'); 
                    getTableData($conn, 'SELECT SUM(Salary) FROM therapists WHERE Salary > 80000;'); 
                    mysqli_close($conn);?>