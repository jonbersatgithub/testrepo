<?php

 
require_once "../database/config.php";

if (isset($_POST['insertrigger']) == 2)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $query = "insert into backendactivity values(default, :fname, :lname, :nickname, :heroname, :add, current_timestamp)";

        if ($statement = $pdo->prepare($query))
        {
            $statement->bindParam(":fname", $param_firstname, PDO::PARAM_STR);
            $statement->bindParam(":lname", $param_lastname, PDO::PARAM_STR);
            $statement->bindParam(":nickname", $param_nickname, PDO::PARAM_STR);
            $statement->bindParam(":heroname", $param_favheroname, PDO::PARAM_STR);
            $statement->bindParam(":add", $param_addres, PDO::PARAM_STR);

            $param_firstname = $_POST['data1'];
            $param_lastname = $_POST['data2'];
            $param_nickname = $_POST['data3'];
            $param_favheroname = $_POST['data4'];
            $param_addres = $_POST['data5'];

            if ($statement->execute())
            {
                $backresponce = array(
                    "statusCode" => 200
                    );
                echo json_encode($backresponce);
            }
            unset($statement);
            unset($pdo);

        }
    }
}

if (isset($_POST['trigger']) == 1)
{
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $editquery = "select * from backendactivity where id=:id";
            if ($stmt = $pdo->prepare($editquery))
            {
                $stmt->bindParam(":id", $param_pid, PDO::PARAM_STR);
                $param_pid = $_POST['id'];
                $stmt->execute();
                if ($stmt->rowCount() > 0)
                {
                    if ($row = $stmt->fetch())
                    {
                        echo json_encode(array(
                            "fname" => $row['firstname'],
                            "lname" => $row['lastname'],
                            "nname" => $row['nickname'],
                            "heroname" => $row['favheroname'],
                            "adress" => $row['address']
                        ));
                    }
                    unset($stmt);
                    
                }
                unset($pdo);
                
            }

        }
}
if (isset($_POST['deletetrigger']) == 3)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $deletequery = "delete from backendactivity where id = :id";
        if ($delstmt = $pdo->prepare($deletequery))
        {
            $delstmt->bindParam(":id", $param_delid, PDO:: PARAM_STR);
            $param_delid = $_POST['id'];
            
            if ($delstmt->execute())
            {
                
                    $response = array ("statusDelete" => 300);
                    echo json_encode($response);
            }
        }
        unset($delstmt);
        unset($pdo);
    }
}
if (isset($_POST['updatetrigger']) == 4)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $updatequery = "update backendactivity set firstname = :upfname, lastname = :uplname, nickname = :upnname, favheroname = :upfheroname, address = :adress where id = :id";
        if ($upstmt = $pdo->prepare($updatequery))
        {
            $upstmt->bindParam(":upfname", $param_upfname, PDO:: PARAM_STR);
            $upstmt->bindParam(":uplname", $param_uplname, PDO:: PARAM_STR);
            $upstmt->bindParam(":upnname", $param_upnname, PDO:: PARAM_STR);
            $upstmt->bindParam(":upfheroname", $param_upfavname, PDO:: PARAM_STR);
            $upstmt->bindParam(":adress", $param_upaddname, PDO:: PARAM_STR);
            $upstmt->bindParam(":id", $param_upid, PDO:: PARAM_INT);

            $param_upfname = $_POST['updata1'];
            $param_uplname = $_POST['updata2'];
            $param_upnname = $_POST['updata3'];
            $param_upfavname = $_POST['updata4'];
            $param_upaddname = $_POST['updata5'];
            $param_upid = $_POST['id'];

            if ($upstmt->execute())
            {
                    $upresponse = array("statusUpdate" => 400);
                    echo json_encode($upresponse);
            }

        }
        unset($upstmt);
        unset($pdo);
    }
}