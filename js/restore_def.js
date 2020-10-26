$('.restore_sense').on('click', function(){
    var lang_code = $(this).attr('lang_code');
    var bundle = $(this).attr('bundle');
    //var select = document.getElementById('product_id');
  //var index = $('#example').selectedIndex;
  //var given_text = index.options[index].value;
              //            console.log(search);
    var def_div = "#def_bundle_"+bundle+"_"+lang_code;
    var add_sense_id = "#add_def_"+bundle+"_"+lang_code;
    var items = $(add_sense_id).attr('items');
    var restore_sense = 1;
    var sense_id = $(this).attr('sense_id');
    var items_new = (parseInt(items))+1;
    $(add_sense_id).attr('items', items_new);

  
  $.ajax({
      url:'edit_sense.php',
      data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, sense_order:items_new, restore_sense:restore_sense},
      type: 'POST',
      success: function(data){
          if(!data.error){
              $(def_div).html(data);
  
          }
      }
      
  
  
  
  })
  

  
  $.ajax({
    url:'modal_update.php',
    data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, sense_order:items_new, restore_sense:restore_sense},
    type: 'POST',
    success: function(data){
        if(!data.error){
            $('#modal_def_panel').html(data);

        }
    }
    



})


  })
