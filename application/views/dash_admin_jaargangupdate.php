<!-- 
    GREIF MATTHIAS
    LAST UPDATED: 18 03 30
    DASH ADMIN JAARGANG ADD/UPDATE
-->

<?php 
    $forminputs = [
        'naam' => '',
        'thema' => '',
        'info' => '',
        'beginTijdstip' => '',
        'eindTijdstip' => ''
    ];

    if(isset($data)){
        $forminputs['naam'] = $data['jaargang']->naam;
        $forminputs['thema'] = $data['jaargang']->thema;
        $forminputs['info'] = $data['jaargang']->info;
        $forminputs['beginTijdstip'] = $data['jaargang']->beginTijdstip;
        $forminputs['eindTijstip'] = $data['jaargang']->eindTijdstip;
    }
?>

<form>
    <div class="md-form">
        <input type="text" id="inpName" class="form-control" value="<?php echo $forminputs['naam']; ?>">
        <label for="inpName">Naam</label>
    </div>

    <div class="md-form">
        <input type="text" id="inpThema" class="form-control" value="<?php echo $forminputs['thema']; ?>">
        <label for="inpThema">Thema</label>
    </div>

    <div class="md-form">
        <label for="inpInfo">Info</label>
        <textarea type="text" id="inpInfo" class="form-control md-textarea" rows="3">
            <?php echo $forminputs['naam']; ?>
        </textarea>
    </div>

    <div class="md-form">
        <label for="einde">Begintijdstip van event:</label>
        <input id="einde" id="inpBeginTijdstip" size="16" type="text" value="<?php echo $forminputs['beginTijdstip']; ?>" readonly
            class="form_datetime">
    </div>

    <div class="md-form">
        <label for="deadline">Eindtijdstip van event:</label>
        <input id="deadline" id="inpEindtijdstip" size="16" type="text" value="<?php echo $forminputs['eindTijdstip']; ?>" readonly
            class="form_datetime">
    </div>
</form>

<script type="text/javascript">
    $(function () {
        $('#inpBeginTijdstip').datetimepicker({
            viewMode: 'months',
            format: 'dd-mm-yyyy'
        });
        $('#inpEindtijdstip').datetimepicker({
            viewMode: 'months',
            format: 'dd-mm-yyyy',
            useCurrent: false //Important! See issue #1075
        });
        $("#inpBeginTijdstip").on("dp.change", function (e) {
            $('#inpEindtijdstip').data("DateTimePicker").minDate(e.date);
        });
        $("#inpEindtijdstip").on("dp.change", function (e) {
            $('#inpBeginTijdstip').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>