</div>
<script>
  $('#prezenta').click(function() {
    if ($('#prezenta').is(':checked')) {
      $("#sectia").attr('readonly', true);
      $("#sectia").val('NP');
    } else {
      $("#sectia").attr('readonly', false);
      $("#sectia").val('');
    }
  });
</script>
</body>

</html>