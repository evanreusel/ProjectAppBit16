<?php
    echo $data['jaargang']->naam;
?>

<?php echo anchor("admin/dash/jaargangupdate/" . $data['jaargang']->id,'<i class="fa fa-edit"></i> Edit', array('class' => 'btn btn-primary')); ?>
<?php echo anchor("admin/dash/keuzemogelijkheidbeheer/" . $data['jaargang']->id,'<i class="fa fa-folder"></i>', array('class' => 'btn btn-primary')); ?>