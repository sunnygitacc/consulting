/*
 * search page for searches/search 
 * include for searches/advance
 */

search_obj ={q : getUrlParameter('q'), amb : true , hob : true , tea :true , user : true , mentor : true};
$(document).ready(function(){
    
    $('.search-notif-input').val(getUrlParameter('q'));
    
search_obj ={q : getUrlParameter('q'), amb : true , hob : true , tea :true , user : true};

var result = new callAjax(search_obj,'searches/search/','afterFirstSearch').fire();


$('.a-search-ulist').on('click','input:checkbox',function() {
    
    var name = $(this).prop('name');
    $('.a-search-ulist input:checkbox').each(function(){
        var name = $(this).prop('name');
        search_obj[name] = $(this).prop('checked');
    });
console.log(search_obj);
    var result = new callAjax(search_obj,'searches/search/','afterFirstSearch').fire(); 

});


});

    function getUrlParameter(sParam)
    {

        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) 
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam) 
            {
                return sParameterName[1];
            }else{
                return '';
            }
        }
    }   


    function afterFirstSearch(result){

            var Sresult = JSON.parse(result);
            console.log(Sresult);
            var msg = '';
            for(i = 0; i < Sresult.length;i++){


                var about = Sresult[i].about;
                if(about != null && about.length > 70){
                    about = 'aaaaaaaaaaaa';
                }

                var msg = msg+'<li>'+
                            '<div class="notif-image">'+
                            '<img src="/wizspeakv254/'+Sresult[i].pic+'" />'+
                            '</div>'+
                            '<div class="notif-copy">'+
                            '<h2>'+Sresult[i].name+'</h2>'+
                            '<p>'+about+'</p>'+
                            '</div>'+
                          '</li>';


            }
             $('#result_pop').html(msg);
             msg = '';
    }
console.log('hi hi  hi');
    $(".search-notif-input").on("input", function() {
        
       
    
search_obj.q = $(this).val();

new callAjax(search_obj,'searches/search/','afterFirstSearch').fire(); 

    });