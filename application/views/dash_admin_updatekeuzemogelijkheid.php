
    <label for="keuzemogelijkheid">Begin datum en tijdstip:</label>
    <input id="keuzemogelijkheid" name="naam" type="text" value="">
    

    <label for="begin">Begin datum en tijdstip:</label>
    <input id="begin" name="beginTijdstip" size="16" type="text" value="" readonly class="form_datetime">
    <label for="einde">Eind datum en tijdstip:</label>
    <input id="einde" name="eindTijdstip" size="16" type="text" value="" readonly class="form_datetime">
    <label for="deadline">Datum en tijdstip voor deadline:</label>
    <input id="deadline" name="deadlineTijdstip" size="16" type="text" value="" readonly class="form_datetime">

    <script type="text/javascript">
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    </script>            