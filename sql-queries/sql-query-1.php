<?php require_once('../queries-connect.php'); 
                    getTableData($conn, 'SELECT Patient.E_first_name, Patient.E_last_name, insurance.NAME 
    FROM Patient JOIN covered_by ON Patient.P_ID_NO = covered_by.P_ID_NO JOIN insurance
    ON covered_by.I_ID_NO = insurance.I_ID_NO;'); 
                    mysqli_close($conn);?>