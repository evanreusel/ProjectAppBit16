
    <input name= "begin" size="16" type="text" value="" readonly class="form_datetime">
    <label for="begin">Begin datum en tijdstip:</label>
    <input name= "einde" size="16" type="text" value="" readonly class="form_datetime">
    <label for="einde">Eind datum en tijdstip:</label>

    <script type="text/javascript">
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    </script>            