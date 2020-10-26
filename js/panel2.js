$('.entry_select').on('click', function(){
              
    var search = $(this).attr('value');
  //var select = document.getElementById('product_id');
  //var index = $('#example').selectedIndex;
  //var given_text = index.options[index].value;
              //            console.log(search);
  
  $.ajax({
      url:'panel_entry_display.php',
      data:{search:search},
      type: 'POST',
      success: function(data){
          if(!data.error){
              $('#entry_display').html(data);
  
          }
      }
      
  
  
  
  })
  
  
  
  
  
  
  })
