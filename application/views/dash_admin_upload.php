<?php if(isset($error)) echo $error;?>

<?php echo form_open_multipart('admin/excel');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>
