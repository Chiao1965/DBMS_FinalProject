<!DOCTYPE html>
<html lang="zh">
<head>
    <title>A1073314_Checkpoint6</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="jquery.horizontalmenu.css">
</head>
<body>
    <div class = "header">
    RC CHARTER2 COMPANY 
    </div>
    <div class="htmleaf-container"></div>
        <div class="content">
            <div class="ah-tab-wrapper">
                <div class="ah-tab">
                    <a class="ah-tab-item" data-ah-tab-active="true" href="">預約航班列表</a>
                    <a class="ah-tab-item" href="">員工列表</a>
                    <a class="ah-tab-item" href="">飛機列表</a>
                    <a class="ah-tab-item" href="">查詢</a>
                </div>
            </div>
            <div class="ah-tab-content-wrapper">
                <div class="ah-tab-content" data-ah-tab-active="true">
                    <table width = "100%" cellpadding = "0" cellspacing = "10"
                     style = "table-layout: fixed; background-color: rgba(218,218,218,0.7); 
                     color: #204969;">
                        <tr>
                            <th>航班編號</th>
                            <th>預約客戶</th>
                            <th>起飛時間</th>
                            <th>飛機代碼</th>
                        </tr>
                    <?php
                        include("conn.php");
                        $SQL = "SELECT * FROM aircraft A, chartertrip C1, customer C2 
                                WHERE A.aid = C1.aid AND C2.cid = C1.cid";
                        if($result = mysqli_query($link,$SQL)){
                            echo "<table cellpadding=5 style='border-collapse:collapse; 
                                   width:100%; height:auto; table-layout: fixed; 
                                   background-color: rgba(256,256,256,0.7); color: #204969;'>";
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tr style='border: 1px solid #f2f4f6'>";
                                    echo "<td>".$row["ctid"]."</td>";
                                    echo "<td>".$row["cname"]."</td>";
                                    echo "<td>".$row["ctdate"]."</td>";
                                    echo "<td>".$row["mid"]."</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                    ?> 
                    </table>
                </div>

                <div class="ah-tab-content">
                    <table width = "100%" cellpadding = "0" cellspacing = "10"
                     style = "table-layout: fixed; background-color: rgba(218,218,218,0.7); 
                     color: #204969;">
                        <tr>
                            <th>員工編號</th>
                            <th>員工姓名</th>
                            <th>員工職務</th>
                        </tr>
                        <?php
                            include("conn.php");
                            $SQL="SELECT * 
                                  FROM employee E";
                            if($result = mysqli_query($link,$SQL)){
                                echo "<table cellpadding=5 style='border-collapse:collapse;
                                       width:100%; height:auto; table-layout: fixed;
                                       background-color: rgba(256,256,256,0.7); color: #204969;'>";
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "<tr style='border: 1px solid #f2f4f6'>";
                                        echo "<td>".$row["eid"]."</td>";
                                        echo "<td>".$row["ename"]."</td>";
                                        $SQL1="SELECT *
                                               FROM crewmember C, pilot P
                                               WHERE C.cmid = P.cmid AND C.eid='".$row["eid"].'\'';
                                        $SQL2="SELECT *
                                               FROM crewmember C, pilot P
                                               WHERE C.cmid <> P.cmid AND C.eid='".$row["eid"].'\'';
                                        $i1=0;
                                        $i2=0;
                                        if($result1 = mysqli_query($link,$SQL1)){
                                            if($row1 = mysqli_fetch_assoc($result1)){
                                                if($row["eid"]==$row1["eid"]){
                                                    $i1=$i1+1;
                                                }
                                            }
                                        }
                                        if($result2 = mysqli_query($link,$SQL2)){
                                            if($row2 = mysqli_fetch_assoc($result2)){
                                                if($row["eid"]==$row2["eid"]){
                                                    $i2=$i2+1;
                                                }
                                            }
                                        }
                                        if($i1>0 && $i2>0){
                                            echo "<td>"."pilot"."</td>";
                                        }
                                        else if($i==0 && $i2>0){
                                            echo "<td>"."crew member"."</td>";
                                        }
                                        else{
                                            echo "<td>"."employee"."</td>";
                                        }
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                        ?>
                    </table>
                </div>

                <div class="ah-tab-content">
                    <table width = "100%" cellpadding = "0" cellspacing = "10"
                     style = "table-layout: fixed; background-color: rgba(218,218,218,0.7); 
                     color: #204969;">
                        <tr>
                            <th>飛機代碼</th>
                            <th>飛機型號</th>
                            <th>預約費用</th>
                        </tr>
                        <?php
                            include("conn.php");
                            $SQL="SELECT * FROM model";
                            if($result = mysqli_query($link,$SQL)){
                                echo "<table cellpadding=5 style='border-collapse:collapse;
                                       width:100%; height:auto; table-layout: fixed;
                                       background-color: rgba(256,256,256,0.7); color: #204969;'>";
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "<tr style='border: 1px solid #f2f4f6'>";
                                            echo "<td>".$row["mid"]."</td>";
                                            echo "<td>".$row["mname"]."</td>";
                                            echo "<td>".$row["charge"]."</td>";
                                        echo "</tr>";
                                    }
                                echo "</table>";
                            }
                        ?>
                    </table>
                </div>

                <div class="ah-tab-content">
                    <table width = "100%" cellpadding = "0" cellspacing = "10"
                     style = "table-layout: fixed; background-color: rgba(218,218,218,0.7);
                     color: #204969;">
                        <p>
                        <form action = "" method="post">
                        航班編號查詢 : <input type="text" name="ctid" placeholder="CT0001" 
                                        style="font-size:20px; padding:5px; border:0px;
                                        background-color: rgba(218,218,218,0.7);
                                        text-align:center" >
                        <input type="submit" value="搜尋">
                        </form>
                        </p>
                        <tr>
                            <th>航班編號</th>
                            <th>預約客戶</th>
                            <th>起飛時間</th>
                            <th>飛機代碼</th>
                        </tr>
                        <?php
                            include("conn.php");
                            $ctid = $_POST["ctid"];
                            $SQL = "SELECT * FROM aircraft A, chartertrip C1, customer C2
                                    WHERE A.aid = C1.aid AND C2.cid = C1.cid AND C1.ctid = '$ctid'";
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
                    </table>

                    <table width = "100%" cellpadding = "0" cellspacing = "10"
                     style = "table-layout: fixed; background-color: rgba(218,218,218,0.7);
                     color: #204969;">
                        <p>
                        <form action = "" method="post">
                        員工編號查詢 : <input type="text" name="eid" placeholder="E0001"
                                        style="font-size:20px; padding:5px; border:0px;
                                        background-color: rgba(218,218,218,0.7);
                                        text-align:center" >
                        <input type="submit" value="搜尋">
                        </form>
                        </p>
                        <tr>
                            <th>員工編號</th>
                            <th>員工姓名</th>
                            <th>員工職務</th>
                        </tr>

                        <?php
                            include("conn.php");
                            $eid=$_POST["eid"];
                            $SQL= "SELECT * FROM employee E WHERE E.eid = '$eid'";
                            if($result=mysqli_query($link,$SQL)){
                                echo "<table cellpadding=5 style='border-collapse:collapse;
                                       width:100%; height:auto; table-layout: fixed;
                                       background-color: rgba(256,256,256,0.7); color: #204969;'>"; 
                                while($row=mysqli_fetch_assoc($result)){
                                    echo "<tr style='border: 1px solid #f2f4f6'>";
                                    echo "<td>".$eid."</td>";
                                    echo "<td>".$row["ename"]."</td>";
                                    $SQL1="SELECT *
                                           FROM crew member C, pilot P
                                           WHERE C.cmid = P.cmid AND C.eid = '.$eid.'";
                                    $SQL2="SELECT *
                                           FROM crew member C, pilot P
                                           WHERE C.cmid <> P.cmid AND C.eid = '.$eid.'";   
                                    $i1=0;
                                    $i2=0;
                                    if($result1=mysqli_query($link,$SQL1)){
                                        if($row1=mysqli_fetch_assoc($result1)){
                                            if($eid=$row1["eid"]){
                                                $i1++;
                                            }
                                        }
                                    }
                                    if($result2=mysqli_query($link,$SQL2)){
                                        if($row2=mysqli_fetch_assoc($result2)){
                                            if($eid=$row2["eid"]){
                                                $i2++;
                                            }
                                        }
                                    }
                                    if($i1>0 && $i2>0){
                                        echo "<td>"."pilot"."</td>";
                                    }
                                    else if($i1==0 && $i2>0){
                                        echo "<td>"."crew member"."</td>";
                                    }
                                    else{
                                        echo "<td>"."employee"."</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }             
                        ?>
                    </table>

                </div>
            </div>
        </div>
    
    <script src="jquery-1.11.0.min.js" type="text/javascript"></script>
    <script src="jquery.horizontalmenu.js"></script>
    <script>
        $(function () {
            $('.ah-tab-wrapper').horizontalmenu({
                itemClick : function(item) {
                    $('.ah-tab-content-wrapper .ah-tab-content').removeAttr('data-ah-tab-active');
                    $('.ah-tab-content-wrapper .ah-tab-content:eq(' + $(item).index() + ')').attr('data-ah-tab-active', 'true');
                    return false; //if this finction return true then will be executed http request
                }
            });
        });
    </script>
</body>
</html>
