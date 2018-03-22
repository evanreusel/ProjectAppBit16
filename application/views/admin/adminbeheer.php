<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

    <table>
        <tr>
            <td>User</td>
            <td>Passwoord</td>
            <td></td>
            <td></td>
        </tr>

    <?php 
    foreach($admins as $admin){
    echo "<tr> \n";        
    echo "<td>" . $admin->username . "</td> \n";
    echo "<td> ***** </td> \n";
    echo "<td>" . anchor("admin/updatepage/$admin->id","<button>Aanpassen</button>") . "</td>";
    echo "<td>" . anchor("admin/verwijder/$admin->id","<button>Verwijderen</button>") . "</td>";
    echo "</tr> \n";
    }
    echo '<tr><td rowspan="4">' . anchor("admin/nieuwadmin","<button>Niewe admin</button>") . '</td></tr>';
    echo "<td>" . anchor("admin","home") . "</td>";
    ?>
    </table>    
</body>
</html>