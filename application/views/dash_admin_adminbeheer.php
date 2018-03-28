<script>
    function popup(data) {
        $('#popup').dialog();
        splitdata = data.split(',');
        var id = splitdata[0];
        var user = splitdata[1];
        $('#popupnaam').text(user);
        $('#popupja').val(id);
    }

    $(document).ready(function () {
        $('#popup').hide();
        $('.verwijder').click(function () {
            var data = $(this).val();
            popup(data);
        })

        $('#popupnee').click(function () {
            $('#popup').dialog("close");
        });

        $('#popupja').click(function () {
            $();
        });
    });
</script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<table class="table">
    <tr class="colored">
        <td>User</td>
        <td>Actions</td>
        <td><?php echo anchor("admin/dash/updateadmin/","Niewe admin", array('class' => 'btn btn-primary')); ?></td>
    </tr>

    <?php
        foreach($data['admins'] as $admin){
            echo "<tr> \n
            <td>" . $admin->username . '</td> \n
            <td colspan="2">' . anchor("admin/dash/updateadmin/$admin->id","Aanpassen", array('class' => 'btn btn-primary')) . form_button("verwijder",'<i class="fa fa-magic mr-1"></i>Verwijder',array('value'=>"$admin->id,$admin->username",'class'=>"verwijder btn btn-primary")) . "</td>
            </tr> \n";
        };
    ?>
</table>






<div id="popup" title="Waarschuwing">
    <?php $attributes = array('name' => 'verwijderform', 'id' => 'verwijderform', 'role' => 'form');
echo form_open("admin/delete")?> Bent u zeker dat u
    <div id="popupnaam"></div> wil verwijderen?
    <br/>
    <button id="popupja" name="id">Ja</button>
    <button id="popupnee">Nee</button>
    <?php echo form_close(); ?>
</div>