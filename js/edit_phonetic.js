$('.add_phonetic').on('click', function(){

    var lang_code = $(this).attr('lang_code');
    var entry_ref=$(this).attr('entry_ref');
    var source_lang=$(this).attr('source_lang');
      var phonemic_id = $(this).attr('phonemic_id');
      var form_bundle_id=$(this).attr('form_bundle_id');
    //var phonetic = $(this).attr('phonetic');
    var items = $(this).attr('items');
    //var count_phonemic_bundle = $(this).attr('count_phonemic_bundle');
    //var select = document.getElementById('product_id');
    //var index = $('#phonetic').selectedIndex;
    //var given_text = index.options[index].value;
                //            console.log(search);
    var entry_id = $(this).attr('entry_id'); 
    var div = "#form_bundle_all_".concat(entry_id);
    
    //var div = "#phonetic_div_".concat(phonemic_id);
    var add_phonetic = 1;
    //$(this).attr('items', items_new);
    console.log("add phonetic");
    console.log(div);
    console.log(phonemic_id);
    console.log(div);
    
    $.ajax({
        url:'edit_phonetic.php',
        data:{form_bundle_id:form_bundle_id, phonemic_id:phonemic_id, add_phonetic:add_phonetic, entry_ref:entry_ref, source_lang:source_lang, lang_code:lang_code, items:items},
        type: 'POST',
        success: function(data){
            if(!data.error){
                $(div).html(data);
    
            }
        }
        
    
    
    
    })
    
  
  })
  

$('.phonetic_input').keyup(function(){
    var lang_code = $(this).attr('lang_code');
    var phonemic_id = $(this).attr('phonemic_id');
    var first = $(this).attr('first');
    var phonetic = $(this).val();
    var phonetic_id = $(this).attr('phonetic_id');
    var phonetic_order = $(this).attr('phonetic_order');
    var update_phonetic = 1;
    console.log("phonetic input update bck")
    console.log(phonetic)
    console.log(phonetic_id)

    if(first==1){

      $(this).attr('first', 0);
      var bck_phonetic = 1;
      $.ajax({
      url:'edit_phonetic.php',
      data:{phonetic_id:phonetic_id, phonetic:phonetic, update_phonetic:update_phonetic, bck_phonetic:bck_phonetic},
      type: 'POST',
      success: function(data){
        /*  if(!data.error){
              $(phonetic_div).html(data);
  
          }*/
      }
      
  
    })
  



    }else{

              $.ajax({
                url:'edit_phonetic.php',
                data:{phonetic_id:phonetic_id, phonetic:phonetic, update_phonetic:update_phonetic},
                type: 'POST',
                  success: function(data){
                    /*  if(!data.error){
                          $(phonetic_div).html(data);
              
                      }*/
                  }
                  
              
                })
              
            
    }

      /*
          $.ajax({
          url:'modal_update.php',
          data:{bundle:bundle, lang_code:lang_code, phonetic_id:phonetic_id, update_phonetic:update_phonetic},
          type: 'POST',
          success: function(data){
              if(!data.error){
                  $('#modal_phonetic_panel').html(data);

              }
          }
          



      })

      */

  
  })

  
  $('.del_phonetic').on('click', function(){

    var phonemic_id = $(this).attr('phonemic_id');
    //var first = $(this).attr('first');
    var lang_code = $(this).attr('lang_code');
    var source_lang = $(this).attr('entry_ref');
    var entry_ref = $(this).attr('entry_ref');
    var phonetic = $(this).val();
    var phonetic_id = $(this).attr('phonetic_id');
    var phonetic_order = $(this).attr('phonetic_order');
    var form_bundle_id=$(this).attr('form_bundle_id');
    var bck_phonetic = 1;
    console.log("phonetic input update bck")
    console.log(phonetic)
    console.log(phonetic_id)
    //var bundle = $(this).attr('bundle');
    //var select = document.getElementById('product_id');
  //var index = $('#example').selectedIndex;
  //var given_text = index.options[index].value;
    var items = $(this).attr('items');
    var add_phonetic_id = "#add_phonetic_".concat(phonemic_id);
    //var count_phonemic_bundle = $(this).attr('count_phonemic_bundle');
    //var select = document.getElementById('product_id');
    //var index = $('#phonetic').selectedIndex;
    //var given_text = index.options[index].value;
                //            console.log(search);
    //var div = "#phonetic_div_".concat(phonemic_id);
    var entry_id = $(this).attr('entry_id'); 
    var div = "#form_bundle_all_".concat(entry_id);
    //var items = $(add_phonetic_id).attr('items');
    var del_phonetic = 1;
    var items_new = (parseInt(items))-1;
    $(add_phonetic_id).attr('items', items_new);
    console.log("del and bck phonetic")
    console.log(phonetic)
    console.log(phonetic_id)



  
  $.ajax({
      url:'edit_phonetic.php',
      data:{form_bundle_id:form_bundle_id, phonemic_id:phonemic_id, lang_code:lang_code, source_lang:source_lang, entry_ref:entry_ref, phonetic_id:phonetic_id, bck_phonetic:bck_phonetic, del_phonetic:del_phonetic},
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
    data:{bundle:bundle, lang_code:lang_code, phonetic_id:phonetic_id, phonetic_order:items_new, restore_phonetic:restore_phonetic},
    type: 'POST',
    success: function(data){
        if(!data.error){
            $('#modal_phonetic_panel').html(data);

        }
    }
    



})

*/

  
  })


/*

    
$('.create_phonetic').on('click', function(){

  var lang_code = $(this).attr('lang_code');
  var source_lang = $(this).attr('source_lang');
  //var sense_bundle = $(this).attr('sense_bundle');
  var phonetic = $(this).attr('phonetic');
  //var items = $(this).attr('items');
  var phonetic_order = $(this).attr('phonetic_order');
  //var select = document.getElementById('product_id');
  //var index = $('#phonetic').selectedIndex;
  //var given_text = index.options[index].value;
              //            console.log(search);
  var div = "#phonetic_bundle_".concat(lang_code).concat("_").concat(phonetic);
  var create_phonetic = 1;
  //$(this).attr('items', items_new);
  console.log("create_phonetic");
console.log(create_phonetic);
  console.log(div);
  console.log(source_lang);
  console.log(phonetic_order);
  
  $.ajax({
      url:'edit_phonetic.php',
      data:{phonetic:phonetic, create_phonetic:create_phonetic, phonetic_order:phonetic_order, source_lang:source_lang, lang_code:lang_code},
      type: 'POST', 
      success: function(data){
          if(!data.error){
              $(div).html(data);
  
          }
      }
      
  
  
  
  })
  

})
*/


