$('.add_form').on('click', function(){

  var lang_code = $(this).attr('lang_code');
  var entry_ref=$(this).attr('entry_ref');
  var source_lang=$(this).attr('source_lang');
  var form_id = $(this).attr('form_id');
  var items = $(this).attr('items');
  var form_bundle_id=$(this).attr('form_bundle_id');
  //var count_form_bundle = $(this).attr('count_form_bundle');
  //var select = document.getElementById('product_id');
  //var index = $('#form').selectedIndex;
  //var given_text = index.options[index].value;
              //            console.log(search);
  //var div = "#form_div_".concat(form_id).concat("_").concat(lang_code);
  var entry_id = $(this).attr('entry_id');
  var div = "#form_bundle_all_".concat(entry_id);

  var add_form = 1;
  //$(this).attr('items', items_new);
  console.log("add form");
  console.log(div);
  //console.log(form_id);
  console.log(div);

  $.ajax({
      url:'edit_form.php',
      data:{form_bundle_id:form_bundle_id, form_id:form_id, add_form:add_form, entry_ref:entry_ref, source_lang:source_lang, lang_code:lang_code, items:items},
      type: 'POST',
      success: function(data){
          if(!data.error){
              $(div).html(data);

          }
      }
      



  })


})


    
$('.create_form').on('click', function(){

  var lang_code = $(this).attr('lang_code');
  var source_lang = $(this).attr('source_lang');
  //var sense_bundle = $(this).attr('sense_bundle');
  var form = $(this).attr('form');
  //var items = $(this).attr('items');
  var form_order = $(this).attr('form_order');
  //var select = document.getElementById('product_id');
  //var index = $('#form').selectedIndex;
  //var given_text = index.options[index].value;
              //            console.log(search);
  //var div = "#form_div_".concat(form_id).concat("_").concat(lang_code);
  var entry_id = $(this).attr('entry_id');
  var div = "#form_bundle_all_".concat(entry_id);
  var create_form = 1;
  //$(this).attr('items', items_new);
  console.log("create_form");
console.log(create_form);
  console.log(div);
  console.log(source_lang);
  console.log(form_order);
  
  $.ajax({
      url:'edit_form.php',
      data:{form:form, create_form:create_form, form_order:form_order, source_lang:source_lang, lang_code:lang_code},
      type: 'POST', 
      success: function(data){
          if(!data.error){
              $(div).html(data);
  
          }
      }
      
  
  
  
  })
  

})

