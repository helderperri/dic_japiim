$('#search_text').keyup(function(e){
                    
    var searchtext = $('#search_text').val();
    var langtype = $(this).attr('langtype');
    var length = searchtext.length;
    var reload=1;
    
    if(length >= 2){
        var searchtype = 0;
        $.ajax({
            url:'panel_search.php',
            data:{searchtext:searchtext, langtype:langtype, searchtype:searchtype, reload:reload},
            type: 'POST',
            success: function(data){
                if(!data.error){
                    $('#panel_all_div').html(data);
                }
            }
            
        })
    
    }
    







});
