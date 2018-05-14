<!-- 
    TIM
    LAST UPDATED: 18 05 14
    DASH ADMIN ADD/UPDATE
-->

<p class="tooling">
    Bewerk hier de verschillende eigenschappen voor de administrator "<?php echo $data['admin']->username; ?>". <br/>
</p>

<?php
    $arrayparameters = array();
    $arrayparameters['id'] = 'send';
    $arrayparameters['class'] = 'btn btn-primary';
    $arrayparameters['value'] = (isset($data['admin'])) ? $data['admin']->id : '0';
    
    if(isset($data['admin'])){
        $arrayparameters['content'] = "Pas admin aan";
    } else {
        $arrayparameters['content'] = "Maak nieuwe admin aan";
    }
?>

<script> 
    function passcheck(){
        if($('#id').val() != 0){
            if($('#oudpass').val() != ""){
            $.ajax({
                url: '<?= site_url(); ?>/admin/checkpass/' + $('#id').val() + '/' + $('#oudpass').val(),
                type: "GET",
                dataType:'json',
                success: function(data){                    
                   formcontrole(data);
                }
            });
        } else {
            formcontrole();
        }
        }else{
            formcontrole("dummy");
        }
    }

    function nieuwpassmatch(){  
        var $passnietleeg = false;
        var $passsame = false;

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

    function formcontrole(passdata){
        console.log("ok");
        passmatch = nieuwpassmatch();
        if(passdata != null){    
                $('#oudpasserror').hide();
                if(passmatch){
                $('#adminform').submit();
                }
            } else {
            $('#oudpasserror').show();
            }
    }

    $(document).ready(function () {
        $('#oudpasserror').hide();
        $('#nieuwpasserror').hide();
        $('#nieuwpasscheckerror').hide();
    
        $("#send").click(function(){
            passcheck();
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
        <input type="text" name="username" id="username" class="form-control" <?php if (isset($data['admin'])) echo 'value=' . $data['admin']->username; ?>>
        <label for="username">Gebruikersnaam:</label>
    </div>

    <div class="md-form">
        <input type="password" id="nieuwpass" name="nieuwpass" class="form-control">
        <label for="nieuwpass"><?php if (!isset($data['admin'])){ echo 'Nieuw wachtwoord:'; }else{ echo 'Wachtwoord:'; }?></label>
    </div>
    <div id="nieuwpasserror">
        <label for="nieuwpass" style="color:red">Gelieve een wachtwoord in te vullen</label>
    </div>
    
    <div class="md-form">
        <input type="password" id="nieuwpasscheck" class="form-control">
        <label for="nieuwpasscheck">Bevestig <?php if (!isset($data['admin'])) echo 'nieuw '; ?>wachtwoord:</label>
    </div>

    <div id="nieuwpasscheckerror">
    <label for="nieuwpasscheck" style="color:red">Het passwoord is niet correct</label>
    <br/></div>
    
    <input type="hidden" name="id" id="id" value="<?php echo (isset($data['admin'])) ? $data['admin']->id : '0';?>" />    
<?php    
    echo form_button($arrayparameters);
    if(isset($data['admin'])){
        echo '<a class="btn btn-danger" data-toggle="modal" data-target="#keuzeModal">
                <i class="fa fa-trash-o"></i> Verwijder
        </a>';
    }

    
    echo '<a class="btn btn-secondary" href="' . site_url() . '/admin/dash/adminbeheer/">Terug</a>' ;
    echo form_close();
?>


<div class="modal fade" id="keuzeModal" tabindex="-1" role="dialog" aria-labelledby="modaltitel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltitel">Administrator verwijderen?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="modaltekst">Weet u zeker dat u de administrator "<?php echo $data['admin']->username; ?>" wilt verwijderen?</p>
      </div>
      <div class="modal-footer">
        <a href="<?=site_url()?>/admin/delete/<?php echo $data['admin']->id; ?>" id="verwijderenKeuze" class="btn btn-danger btn-round">Verwijderen</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuleer</button>
      </div>
    </div>
  </div>
</div>

<?php
    /* =================================================================================================== /GREIF MATTHIAS */
?>