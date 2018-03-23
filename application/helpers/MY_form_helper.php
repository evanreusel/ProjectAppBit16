<?php
function form_labelpro($label_text, $id) {
    $attributes = array('class' => 'control-label');
    return form_label($label_text, $id, $attributes) . "\n";
}
?>