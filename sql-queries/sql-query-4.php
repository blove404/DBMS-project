<?php require_once('../queries-connect.php'); 
                    getTableData($conn, 'SELECT house_number, city, street, state, zip_code, country FROM Address_P GROUP BY COUNTRY;'); 
                    mysqli_close($conn);?>