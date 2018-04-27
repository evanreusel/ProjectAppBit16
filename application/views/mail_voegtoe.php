<div class="container">
    <form>

    <label for="datum">Datum:</label>
    <input type="date" id="datum" name="datum" class="form-control">
    <label >Ontvangers:</label>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                <th></th>
                <th>Naam</th>
                <th>Email</th>
                <th>Soort</th>
                <th>Nummer</th>

                </thead>

            <?php
            foreach ($ontvangers as $ontvanger)
            {
                ?>
                    <tr>
                        <td><input type="checkbox"> </td>
                        <td class="naam"><?php echo $ontvanger->naam?></td>
                        <td class="mail"><?php echo $ontvanger->mail?></td>
                        <td class="soort"><?php echo $ontvanger->soort?></td>
                        <td class="nummer"><?php echo $ontvanger->nummer?></td>
                    </tr>
                <?php
            }
            ?>
            </table>
        </div>
    </div>


    <label>Sjabloon:</label>
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