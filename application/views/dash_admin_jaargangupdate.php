<?php 
    $forminputs = [
        'naam' => '',
        'thema' => '',
        'info' => '',
        'beginTijdstip' => '',
        'eindTijstip' => ''
    ];

    if($data['jaargang']->naam != ''){
        $forminputs['naam'] = $data['jaargang']->naam;
    }

    if($data['jaargang']->thema != ''){
        $forminputs['thema'] = $data['jaargang']->thema;
    }

    if($data['jaargang']->info != ''){
        $forminputs['info'] = $data['jaargang']->info;
    }

    if($data['jaargang']->beginTijdstip != ''){
        $forminputs['beginTijdstip'] = $data['jaargang']->beginTijdstip;
    }

    if($data['jaargang']->eindTijdstip != ''){
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
        <textarea type="text" id="inpInfo" class="form-control md-textarea" rows="3"><?php echo $forminputs['naam']; ?></textarea>
    </div>
</div>