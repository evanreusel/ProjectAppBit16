
<div class="well">
  <div class="input-append date">
    <input type="text" id="datetimepicker1"></input>
  </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
  $(function() {
    $('#datetimepicker1').datetimepicker({
      format: 'yyyy-mm-dd hh:ii'
      language: 'nl'
    });
  });
});
  
</script>