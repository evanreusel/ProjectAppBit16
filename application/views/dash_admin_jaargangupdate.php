<!-- 
    GREIF MATTHIAS
    LAST UPDATED: 18 04 18
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
        $forminputs['id'] = (isset($data['id'])) ? $data['id']->id : '0';
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

    <div class="form-group">
        <div class='input-group date' id='inpBeginTijdstip'>
            <input type='text' class="form-control" placeholder="Begintijdstip van event" value="<?php echo $forminputs['beginTijdstip']; ?>"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>

    <div class="form-group">
        <div class='input-group date' id='inpEindTijdstip'>
            <input type='text' class="form-control" placeholder="Eindtijdstip van event" value="<?php echo $forminputs['eindTijdstip']; ?>"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>

    <a href="#" id="aApply"> Apply </a>
</form>

<script type="text/javascript">
    $(document).ready(function(){
        $('#inpBeginTijdstip').datetimepicker({
            viewmode: 'years',
            format: 'dd/MM/yyyy',
        });

        $('#inpEindTijdstip').datetimepicker({
            viewmode: 'years',
            format: 'dd/MM/yyyy',
            useCurrent: false //Important! See issue #1075
        });

        $("#inpBeginTijdstip").on("dp.change", function (e) {
            $('#inpEindTijdstip').data("DateTimePicker").minDate(e.date);
        });

        $("#inpEindTijdstip").on("dp.change", function (e) {
            $('#inpBeginTijdstip').data("DateTimePicker").maxDate(e.date);
        });


        $('#aApply').on("click", function(){
            $.ajax({
                url: '<?= site_url(); ?>/jaargang/update/<?php echo $forminputs["id"]; ?>/' + $('#inpName').val() + '/' + $('#inpThema').val() + '/' + $('#inpInfo').val()
                + '/' + $('#infpBeginTijdstip').val() + '/' + $('#inpEindTijdstip').val(),
                async: false,
                type: "GET",
                dataType:'json',
                success: function(data){
                    if(!data){
                        alert(data);
                    }
                }, error: function (xhr, status, error) {
                    alert("Something went wrong " + xhr.responseText);
                }
            });
        });

    });
</script>