<!-- 
    TIM
    LAST UPDATED: 18 03 30
    DASH ADMIN ADD/UPDATE
-->

<?php
    $arrayparameters = array();
    $arrayparameters['id'] = 'send';
    $arrayparameters['value'] = (isset($data['admin'])) ? $data['admin']->id : '0';
    
    if(isset($data['admin'])){
        $arrayparameters['content'] = "Pas admin aan";
    } else {
        $arrayparameters['content'] = "Maak nieuwe admin aan";
    }
?>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script> 
    function passcheck(){
        if($('#id').val() != 0){
            $.ajax({
                url: '<?= site_url(); ?>/admin/checkpass/' + $('#id').val() + '/' + $('#oudpass').val(),
                async: false,
                type: "GET",
                dataType:'json',
                success: function(data){                    
                    if(data != null){
                        $('#oudpasserror').hide();
                        return true;
                    } else {
                        $('#oudpasserror').show();
                    }
                }, error: function (xhr, status, error) {
                    console.log("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
        }else{
            return true;
        }

        return false;
    }

    function nieuwpassmatch(){  
        var $passnietleeg;
        var $passsame;

        if($('#nieuwpass').val() != "") {
            $('#nieuwpasserror').hide();
            $passnietleeg = true;
        } else {         
            $('#nieuwpasserror').show();
        }

        if($('#nieuwpass').val() == $('#nieuwpasscheck').val()) {
            $('#nieuwpasscheckerror').hide();
            $passsame = true;
        } else {         
            $('#nieuwpasscheckerror').show();
        }

        return $passsame && $passnietleeg;
    }

    $(document).ready(function () {
        $('#oudpasserror').hide();
        $('#nieuwpasserror').hide();
        $('#nieuwpasscheckerror').hide();
    
        $("#send").click(function(){
            if(passcheck() && nieuwpassmatch()){    
                $('#adminform').submit();
            }
        });
    });
</script>

<?php
    echo form_open('admin/update', array('name' => 'adminform', 'id' => 'adminform', 'role' => 'form'));

    if(isset($data['admin'])){
?>
    <div class="md-form">
        <input type="password" id="oudpass" class="form-control">
        <label for="oudpass">Oud wachtwoord</label>
    </div>

    <div id="oudpasserror">
    <label for="oudpasscheck" style="color:red">Het passwoord komt niet overeen met het oude passwoord</label>
    </div>
<?php
    }
?>

    <!-- =================================================================================================== GREIF MATTHIAS -->
    <div class="md-form">
        <input type="text" id="username" class="form-control" <?php if (isset($data['admin'])) echo 'value=' . $data['admin']->username; ?>>
        <label for="username">Gebruikersnaam:</label>
    </div>

    <div class="md-form">
        <input type="password" id="nieuwpass" class="form-control">
        <label for="nieuwpass"><?php if (!isset($data['admin'])) echo 'nieuwe '; ?>Wachtwoord:</label>
    </div>
    
    <div class="md-form">
        <input type="password" id="nieuwpasscheck" class="form-control">
        <label for="nieuwpasscheck">Bevestig <?php if (!isset($data['admin'])) echo 'nieuwe '; ?>wachtwoord:</label>
    </div>
    <div id="nieuwpasserror">
        <label for="nieuwpasscheck" style="color:red">Gelieve een wachtwoord in te vullen</label>
    </div>

    <div id="nieuwpasscheckerror">
    <label for="nieuwpasscheck" style="color:red">Het passwoord is niet correct</label>
    <br/></div>
    
    <input type="hidden" name="id" id="id" value="<?php echo (isset($data['admin'])) ? $data['admin']->id : '0';?>" />
    <!-- =================================================================================================== GREIF MATTHIAS -->
    
<?php    
    echo form_button($arrayparameters);
    echo form_close(); 

    /* =================================================================================================== GREIF MATTHIAS */
    echo anchor("admin/delete/" . $data['admin']->id,'<i class="fa fa-trash-o"></i> Verwijder', array('class' => 'btn btn-danger'));
    /* =================================================================================================== /GREIF MATTHIAS */
?>