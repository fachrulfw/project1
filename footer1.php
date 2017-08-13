</div><br><br>
<hr>
<footer class="text-center" id="footer">
  &copy; 2017 Hak Cipta Terpelihara Double D's Store
</footer>
<script>
  jQuery(window).scroll(function(){
    var vscroll = jQuery(this).scrollTop();
    jQuery('#logotext').css({
      "transform" : "translate(0px, "+vscroll/2+"px)"
    });
  });

  function detailsmodal(id){
    var data = {"id" : id};
    jQuery.ajax({
      url: '/project/include/detailsmodal.php',
      method: "post",
      data: data,
      success: function(data){
        jQuery('body').append(data);
        jQuery('#details-modal').modal('toggle');
      },
      error: function(){
        alert("Something went wrong!");
      }
    });
  }

  function add_to_cart(){
    jQuery('#modal_errors').html("");
    var product_id = jQuery('#product_id').val();
    var quantity = jQuery('#quantity').val();
    var error = '';
    var data = jQuery('#add_product_form').serialize();
    if(quantity == '' || quantity == 0){
      error += '<p class="text-danger text-center">You must choose the quantity before oreder it.</p>';
      jQuery('#modal_errors').html(error);
      return;
    }else{
      jQuery.ajax({
        url : '/project/Admin/index.php',
        method: "post",
        data: data,
        success:function(){
          window.location.href = "add_cart.php";
        },
        error:function(){alert("Something went wrong!");}
      });
    }
  }

  function buy(){
    jQuery('#modal_errors').html("");
    var nama_pembeli = jQuery('#nama_pembeli').val();
    var email_pembeli = jQuery('#email_pembeli').val();
    var no_telp = jQuery('#no_telp').val();
    var alamat = jQuery('#alamat').val();
    var error = '';
    var data = jQuery('#buy_item').serialize();
    if (nama_pembeli == ''||email_pembeli == ''||no_telp == ''||alamat == ''){
      error += '<p class="text-danger text-center">You must fill all the data before process it.</p>';
      jQuery('#modal_errors').html(error);
      return;
    }else{
      jQuery.ajax({
        url : '/project/add_cart.php',
        method : "post",
        data: data,
        success: function(){
          location.reload()
          
        },
        error:function(){alert("Something went wrong!")}
      });
    }
  }
</script>

</body>

</html>
