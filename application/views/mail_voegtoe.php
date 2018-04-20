<div class="container">
    <form>

    <label for="datum">Datum:</label>
    <input type="date" id="datum" name="datum" class="form-control">
    <label >Ontvangers:</label>
        <select name="ontvanger" id="ontvanger" class="form-control">
        <?php
    foreach ($ontvangers as $ontvanger)
    {
        ?>
        <option  value="<?php echo $ontvanger?>"><?php echo $ontvanger?></option>
    <?php
    }
    ?>
        </select>
    <label >Sjabloon:</label>
        <select name="sjabloon" id="sjabloon" class="form-control">
    <?php
    foreach ($sjablonen as $sjabloon)
    {
        ?>
        <option value="<?php echo $sjabloon->id?>"><?php echo $sjabloon->naam?></option>
        <?php
    }
    ?>
        </select>
        <button type="submit">OK</button>
    </form>

</div>