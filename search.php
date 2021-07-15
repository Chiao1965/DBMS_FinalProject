<?php
include("conn.php");
$ctid = $POST["ctid"];

$SQL = "SELECT * FROM aircraft A, chartertrip C1, customer C2
        WHERE A.aid = C1.aid AND C2.cid = C1.cid AND C2.ctid = '$ctid'";
if($result = mysqli_query($link,$SQL)){
    echo "<table cellpadding=5 style='border-collapse:collapse;
           width:100%; height:auto; table-layout: fixed;
           background-color: rgba(256,256,256,0.7); color: #204969;'>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr style='border: 1px solid #f2f4f6'>";
                echo "<td>".$ctid."</td>";
                echo "<td>".$row["cname"]."</td>";
                echo "<td>".$row["ctdate"]."</td>";
                echo "<td>".$row["mid"]."</td>";
            echo "</tr>";
        }
     echo "</table>";
}
?>
