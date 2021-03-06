<!-- 
    GREIF MATTHIAS
    LAST UPDATED: 18 05 14
    DASH ADMIN BEHEER
-->

<p class="tooling">
    Hier kan u de verschillende administrators voor de toepassing bewerken.
</p>

<table class="table">
    <tr class="colored">
        <td>Naam</td>
        <td></td>
    </tr>

    <?php
        foreach($data['admins'] as $admin){
            echo "<tr><td><p>" . $admin->username . '</p></td>
            <td colspan="2">' . anchor("admin/dash/adminupdate/$admin->id",'<i class="fa fa-edit mr-1"></i> Edit', array('class' => 'btn btn-round btn-warning')) . "</td>
            </tr>";
        };
    ?>
</table>

<?php echo anchor("admin/dash/adminupdate/",'<i class="fa fa-plus"></i>', array('class' => 'btn btn-primary fab')); ?>