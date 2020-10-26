$('.add_phonemic').on('click', function(){

  var lang_code = $(this).attr('lang_code');
  var entry_ref=$(this).attr('entry_ref');
  var source_lang=$(this).attr('source_lang');
    var phonemic_id = $(this).attr('phonemic_id');
  var form_id = $(this).attr('form_id');
  var entry_id = $(this).attr('entry_id');
  var items = $(this).attr('items');
  var form_bundle_id=$(this).attr('form_bundle_id');
  var add_phonemic_id = "#add_phonemic_".concat(form_id).concat("_").concat(lang_code);
  var items = $(add_phonemic_id).attr('items');
  var items_new = (parseInt(items))-1;
$(add_phonemic_id).attr('items', items_new);

  //var count_phonemic_bundle = $(this).attr('count_phonemic_bundle');
  //var select = document.getElementById('product_id');
  //var index = $('#phonemic').selectedIndex;
  //var given_text = index.options[index].value;
              //            console.log(search);
  //var div = "#phonemic_div_".concat(form_id).concat("_").concat(lang_code);
  var div = "#form_bundle_all_".concat(entry_id);

  var add_phonemic = 1;
  //$(this).attr('items', items_new);
  console.log("add phonemic");
  console.log(div);
  //console.log(phonemic_id);
  console.log(div);
  
  $.ajax({
      url:'edit_phonemic.php',
      data:{form_bundle_id:form_bundle_id, form_id:form_id, add_phonemic:add_phonemic, entry_ref:entry_ref, source_lang:source_lang, lang_code:lang_code, items:items},
      type: 'POST',
      success: function(data){
          if(!data.error){
              $(div).html(data);
  
          }
      }
      
  
  
  
  })
  

})



    
$('.create_phonemic').on('click', function(){

  var lang_code = $(this).attr('lang_code');
  var source_lang = $(this).attr('source_lang');
  //var sense_bundle = $(this).attr('sense_bundle');
  var phonemic = $(this).attr('phonemic');
  //var items = $(this).attr('items');
  var phonemic_order = $(this).attr('phonemic_order');
  //var select = document.getElementById('product_id');
  //var index = $('#phonemic').selectedIndex;
  //var given_text = index.options[index].value;
              //            console.log(search);
  //var div = "#phonemic_div_".concat(form_id).concat("_").concat(lang_code);
  var entry_id = $(this).attr('entry_id');
  var div = "#form_bundle_all_".concat(entry_id);
  var create_phonemic = 1;
  //$(this).attr('items', items_new);
  console.log("create_phonemic");
console.log(create_phonemic);
  console.log(div);
  console.log(source_lang);
  console.log(phonemic_order);
  
  $.ajax({
      url:'edit_phonemic.php',
      data:{phonemic:phonemic, create_phonemic:create_phonemic, phonemic_order:phonemic_order, source_lang:source_lang, lang_code:lang_code},
      type: 'POST', 
      success: function(data){
          if(!data.error){
              $(div).html(data);
  
          }
      }
      
  
  
  
  })
  

})



$('.phonemic_input').keyup(function(){
    var lang_code = $(this).attr('lang_code');
    var bundle = $(this).attr('bundle');
    var first = $(this).attr('first');
    var phonemic = $(this).val();
    var phonemic_id = $(this).attr('phonemic_id');
    var phonemic_order = $(this).attr('phonemic_order');
    var update_phonemic = 1;
    console.log("phonemic input update bck")
    console.log(phonemic)
    console.log(phonemic_id)

    if(first==1){

      $(this).attr('first', 0);
      var bck_phonemic_form = 1;
      $.ajax({
      url:'edit_phonemic.php',
      data:{phonemic_id:phonemic_id, phonemic:phonemic, update_phonemic:update_phonemic, bck_phonemic_form:bck_phonemic_form},
      type: 'POST',
      success: function(data){
        /*  if(!data.error){
              $(phonemic_div).html(data);
  
          }*/
      }
      
  
    })
  



    }else{

              $.ajax({
                  url:'edit_phonemic.php',
                  data:{phonemic:phonemic, phonemic_id:phonemic_id, update_phonemic:update_phonemic},
                  type: 'POST',
                  success: function(data){
                    /*  if(!data.error){
                          $(phonemic_div).html(data);
              
                      }*/
                  }
                  
              
                })
              
            
    }

      /*
          $.ajax({
          url:'modal_update.php',
          data:{bundle:bundle, lang_code:lang_code, phonemic_id:phonemic_id, update_phonemic:update_phonemic},
          type: 'POST',
          success: function(data){
              if(!data.error){
                  $('#modal_phonemic_panel').html(data);

              }
          }
          



      })

      */

  
  })

  $('.del_phonemic').on('click', function(){
    var lang_code = $(this).attr('lang_code');
    var source_lang = $(this).attr('source_lang');
    var form_bundle_id =$(this).attr('form_bundle_id');
    var form_id = $(this).attr('form_id');
    
    //var select = document.getElementById('product_id');
  //var index = $('#example').selectedIndex;
  //var given_text = index.options[index].value;
              //            console.log(search);
    var phonemic_id = $(this).attr('phonemic_id');
    var add_phonemic_id = "#add_phonemic_".concat(form_id).concat("_").concat(lang_code);
    var items = $(add_phonemic_id).attr('items');
    var del_phonemic = 1;
    //var restore_phonemic = 1;
    var entry_id = $(this).attr('entry_id');
    var div = "#form_bundle_all_".concat(entry_id);
    //var div = "#phonemic_div_".concat(form_id).concat("_").concat(lang_code);
    var items_new = (parseInt(items))-1;
    $(add_phonemic_id).attr('items', items_new);

  
    $.ajax({
        url:'edit_phonemic.php',
        data:{form_id:form_id, form_bundle_id:form_bundle_id, lang_code:lang_code, source_lang:source_lang, phonemic_id:phonemic_id, del_phonemic:del_phonemic},
        type: 'POST',
        success: function(data){
            if(!data.error){
                $(div).html(data);
    
            }
        }
        
    
      })
  
/*      
    $.ajax({
      url:'modal_update.php',
      data:{bundle:bundle, lang_code:lang_code, phonemic_id:phonemic_id, phonemic_order:items_new, restore_phonemic:restore_phonemic},
      type: 'POST',
      success: function(data){
          if(!data.error){
              $('#modal_phonemic_panel').html(data);

          }
      }
      



  })

*/

  
})
