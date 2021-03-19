<?php

require_once "database/config.php";
$queryfetch = "select * from backendactivity order by id";
if ($result = $pdo->query($queryfetch))
{
    if ($result->rowCount() > 0)
    {

        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>
                    <th scope ='row'>".$row['id']."</th>
                    <td>".$row['firstname']."</td>
                    <td>".$row['lastname']."</td>
                    <td>".$row['nickname']."</td>
                    <td>".$row['favheroname']."</td>
                    <td>".$row['address']."</td>
                    <td>".$row['created_at']."</td>
                    <td>
                     <button onclick = 'edit(".$row['id'].")' class = 'btn btn-primary'>EDIT</button> 
                     <button onclick = 'ondelete(".$row['id'].")' class = 'btn btn-danger' data-mdb-toggle='modal'
                     data-mdb-target= '#exampleModal'>REMOVED</button>
                    </td>
                 </tr>";
        }
        unset($result);


    }else echo "<p>NO Result FOUND</p>";
}
unset($pdo)
?>
