

/*

    
$('.create_pron').on('click', function(){

  var lang_code = $(this).attr('lang_code');
  var source_lang = $(this).attr('source_lang');
  //var sense_bundle = $(this).attr('sense_bundle');
  var pron = $(this).attr('pron');
  //var items = $(this).attr('items');
  var pron_order = $(this).attr('pron_order');
  //var select = document.getElementById('product_id');
  //var index = $('#pron').selectedIndex;
  //var given_text = index.options[index].value;
              //            console.log(search);
  var div = "#pron_bundle_".concat(lang_code).concat("_").concat(pron);
  var create_pron = 1;
  //$(this).attr('items', items_new);
  console.log("create_pron");
console.log(create_pron);
  console.log(div);
  console.log(source_lang);
  console.log(pron_order);
  
  $.ajax({
      url:'edit_pron.php',
      data:{pron:pron, create_pron:create_pron, pron_order:pron_order, source_lang:source_lang, lang_code:lang_code},
      type: 'POST', 
      success: function(data){
          if(!data.error){
              $(div).html(data);
  
          }
      }
      
  
  
  
  })
  

})
*/

