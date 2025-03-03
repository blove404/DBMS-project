<?php require_once('../queries-connect.php'); 
                    getTableData($conn, 'SELECT COUNT(salary) FROM Therapists WHERE salary > 100000;'); 
                    mysqli_close($conn);?>