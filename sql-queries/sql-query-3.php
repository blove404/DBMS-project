<?php require_once('../queries-connect.php'); 
                    getTableData($conn, 'SELECT DISTINCT(country) FROM Address_P;'); 
                    mysqli_close($conn);?>