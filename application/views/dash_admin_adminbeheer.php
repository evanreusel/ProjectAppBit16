<!-- 
    TIM
    LAST UPDATED: 18 03 30
    DASH ADMIN BEHEER
-->
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

<!-- =================================================================================================== GREIF MATTHIAS -->
<table class="table">
    <tr class="colored">
        <td>Naam</td>
    </tr>

    <?php
        foreach($data['admins'] as $admin){
            echo "<tr><td><p>" . $admin->username . '</p></td>
            <td colspan="2">' . anchor("admin/dash/adminupdate/$admin->id",'<i class="fa fa-cog mr-1"></i> Aanpassen', array('class' => 'btn btn-round btn-warning')) . form_button("verwijder",'<i class="fa fa-trash mr-1"></i> Verwijder',array('value'=>"$admin->id,$admin->username",'class'=>"verwijder btn btn-round btn-danger")) . "</td>
            </tr>";
        };
    ?>
</table>

<?php echo anchor("admin/dash/adminupdate/",'<i class="fa fa-plus"></i>', array('class' => 'btn btn-primary fab')); ?>
<!-- =================================================================================================== /GREIF MATTHIAS -->

<div id="popup" title="Waarschuwing">
    <?php $attributes = array('name' => 'verwijderform', 'id' => 'verwijderform', 'role' => 'form');
echo form_open("admin/delete")?> Bent u zeker dat u
    <div id="popupnaam"></div> wil verwijderen?
    <br/>
    <button id="popupja" name="id">Ja</button>
    <button id="popupnee">Nee</button>
    <?php echo form_close(); ?>
</div>