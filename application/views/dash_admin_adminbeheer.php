<table>
    <tr>
        <td>User</td>
        <td>Passwoord</td>
        <td></td>
        <td></td>
    </tr>

    <?php
        foreach($data['admins'] as $admin){
            echo "<tr> \n
            <td>" . $admin->username . "</td> \n
            <td> ***** </td> \n
            <td>" . anchor("admin/dash/updateadmin/$admin->id","<button>Aanpassen</button>") . "</td>
            <td>" . anchor("admin/delete/$admin->id","<button>Verwijderen</button>") . "</td>
            </tr> \n";
        }
        echo '<tr><td rowspan="4">' . anchor("admin/dash/updateadmin","<button>Niewe admin</button>") . '</td></tr>';
    ?>
</table>