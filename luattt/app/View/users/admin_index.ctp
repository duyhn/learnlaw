<html>
<body>

<?php
//Load navigate
echo $this->element("backend/navigate");

//Hien thi du lieu
if($data==NULL){
    echo "<h2>Dada Empty</h2>";
}
else{
    echo "<table>
          <tr>
            <td>User ID</td>
            <td>Username</td>
            <td>Email<td>
            <td>Level<td>
            <td><td>
          </tr>";
    foreach($data as $item){
        echo "<tr>";
        echo "<td>".$item['User']['id']."</td>";
        echo "<td>".$item['User']['username']."</td>";
        echo "<td>".$item['User']['email']."</td>";
        if($item['User']['level']==1){
            $level = "Administrator";
        }else{
            $level = "Assistant";
        }
        echo "<td>".$level."</td>";
        echo "<td><a href='".$this->webroot."admin/users/edit/".$item['User']['id']."' >Edit</a></td>";
        echo "<td><a href='".$this->webroot."admin/users/delete/".$item['User']['id']."' >Del</a></td>";
        echo "</tr>";
    } 
}
?>
</body>
</html>