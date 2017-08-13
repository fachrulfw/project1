</div><br><br>

<footer class="text-center" id="footer">
  &copy; 2017 Hak Cipta Terpelihara Double D's Store
</footer>

<script>
  function get_child_option(){
   var parent_id = jQuery('#parent').val();
   jQuery.ajax({
     url: '/project/admin/parsers/child_category.php',
     type: 'POST',
     data: {parent_id : parent_id},
     success: function(data){
       jQuery('#child').html(data);
     },
     error: function(){alert("Something went wrong with the child options.")},
   });
  }
  jQuery('select[name="parent"]').change(get_child_option);
</script>
</body>

</html>
