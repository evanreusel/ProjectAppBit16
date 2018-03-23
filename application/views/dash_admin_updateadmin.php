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

<script> 
    function passcheck(){
        if($('#id').val() != 0){
            $.ajax({
                url: '<?= site_url(); ?>/admin/checkpass/' + $('#id').val() + '/' + $('#oudpass').val(),
                async: false,
                type: "GET",
                dataType:'json',
                success: function(data){
                    console.log(data);
                    
                    if(data != null){
                        $('#oudpasserror').hide();
                        return true;
                    } else {
                        $('#oudpasserror').show();
                        return false;
                    }
                }, error: function (xhr, status, error) {
                    alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
        }
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

        if($passsame && $passnietleeg) {
            return true;
        } else {
            return false;
        }
    }

    $(document).ready(function () {
        $('#oudpasserror').hide();
        $('#nieuwpasserror').hide();
        $('#nieuwpasscheckerror').hide();
    
        $("#send").click(function(){
            if(passcheck() && nieuwpassmatch()){
                alert("submit");             
                $('#adminform').submit();
            }
        });
    });
</script>

<?php
    echo form_open('admin/update', array('name' => 'adminform', 'id' => 'adminform', 'role' => 'form'));

    if(isset($data['admin'])){
    echo '<label for="oudpass">oude passwoord: </label>' . "\n" . 
    '<br/>' . "\n" .
    '<input id="oudpass" name="oudpass" type="password">'  . "\n" .
    '<br/>' . "\n" .
    '<div id="oudpasserror">'  . "\n" .
    '<label for="oudpasscheck" style="color:red">Het passwoord komt niet overeen met het oude passwoord</label>' . "\n" .
    '<br/></div>' . "\n";
    }
    ?>
    <label for="username">username: </label>    
    <br/>
    <input id="username" name="username" <?php if (isset($data['admin'])) echo 'value=' . $data['admin']->username; ?> >
    <br/>
    <label for="nieuwpass"><?php if (!isset($data['admin'])) echo 'nieuwe '; ?>passwoord: </label>
    <br/>
    <input id="nieuwpass" name="nieuwpass" type="password">
    <br/>
    <div id="nieuwpasserror">
    <label for="nieuwpasscheck" style="color:red">Gelieve een passwoord in te vullen</label>
    <br/></div>
    <label for="nieuwpasscheck">bevestig <?php if (!isset($data['admin'])) echo 'nieuwe '; ?>passwoord: </label>
    <br/>
    <input id="nieuwpasscheck" name="nieuwpasscheck" type="password">
    <br/>
    <div id="nieuwpasscheckerror">
    <label for="nieuwpasscheck" style="color:red">Het passwoord is niet correct</label>
    <br/></div>
    <input type="hidden" name="id" id="id" value="<?php echo (isset($data['admin'])) ? $data['admin']->id : '0';?>" />

    <?php    
        echo form_button($arrayparameters);
    ?>

    
<?php echo form_close(); ?>