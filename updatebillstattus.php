<?php
    if(isset($_POST['rno']))
    {
        $rno = $_POST['rno'];
        $conn = oci_connect("root", "root", "localhost/XE");
        
        $sql = "update reservation set status = 'paid' where RECEIPTNO=$rno";
        //SELECT * FROM (select * from reservation ORDER BY RECEIPTNO DESC) reservation2 WHERE rownum <= 1 ORDER BY rownum DESC;
        $result  = oci_parse($conn,$sql);   
        oci_execute($result);
        header("location:showbill.php");
    }
?>