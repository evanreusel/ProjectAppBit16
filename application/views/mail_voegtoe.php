<div class="container">
    <form>

    <label for="datum">Datum:</label>
    <input type="date" id="datum" name="datum" class="form-control">
    <label >Ontvangers:</label>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
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
                        <td><?php echo $ontvanger->naam?></td>
                        <td><?php echo $ontvanger->mail?></td>
                        <td><?php echo $ontvanger->soort?></td>
                        <td><?php echo $ontvanger->nummer?></td>
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