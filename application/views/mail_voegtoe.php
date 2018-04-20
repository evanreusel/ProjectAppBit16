<div class="container">
    <form>

    <label for="datum">Datum:</label>
    <input type="date" id="datum" name="datum" class="form-control">
    <label >Ontvangers:</label>
    <?php
    foreach ($ontvangers as $ontvanger)
    {
        ?>
        <input type="radio" name="ontvanger" value="<?php echo $ontvanger?>"/><?php echo $ontvanger?><br>
    <?php
    }
    ?>
    <label >Sjabloon:</label>
    <?php
    foreach ($sjablonen as $sjabloon)
    {
        ?>
        <input type="radio" name="sjabloon" value="<?php echo $sjabloon->id?>"/><?php echo $sjabloon->naam?><br>
        <?php
    }
    ?>
        <button type="submit">OK</button>
    </form>

</div>