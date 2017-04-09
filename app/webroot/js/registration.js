/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready( function() {
   
           
  


        $( "#UserCountryName" ).autocomplete({
        source: availableTags1,
        focus: function( event, ui ) {
                    $( "#UserCountryName" ).val( ui.item.label);
                    return false;
                },
                select: function( event, ui ) {
                    $( "#UserCountry" ).val( ui.item.value);   
                    
                    return false;
                },
                response: function(event, ui) {


                }
        });
        

        
//    $( "#UserState" ).autocomplete({
//        
//      source : "states/get_state_list/"+$('#UserCountryId').val(),
//      minLength : 2,
//      select: function( event, ui ) {
//          alert('sdfsd');
//          console.log(event);
//      }
//    });

        $( "#UserStateName" ).autocomplete({
              source: function( request, response ) {
                $.ajax({
                  url: baseUrl+"states/get_state_list/"+$('#UserCountry').val()+'/'+$('#UserStateName').val() ,
                  dataType: "json",
                  data: {
                    q: request.term
                  },
                  success: function( data ) {
                    response( data );
                    console.log(data);
                  }
                });
              },
            focus: function( event, ui ) {
                console.log(event);
                        $( "#UserStateName" ).val( ui.item.label);
                        return false;
                    },
                    select: function( event, ui ) {
                        $( "#UserState" ).val( ui.item.value);   
                        
                        return false;
                    },response: function(event, ui) {

                        if (ui.content.length === 0) {
                            $("#add_new_state").css('visibility','visible');

                        }else{
                            $("#add_new_state").css('visibility','hidden');
                        }
                    }
            });
            
            
        $( "#UserCityName" ).autocomplete({
              source: function( request, response ) {
                $.ajax({
                  url: baseUrl+"cities/get_city_list/"+$('#UserState').val()+'/'+$('#UserCityName').val() ,
                  dataType: "json",
                  data: {
                    q: request.term
                  },
                  success: function( data ) {
                    response( data );
                    console.log(data);
                  }
                });
              },
            focus: function( event, ui ) {
                console.log(event);
                        $( "#UserCityName" ).val( ui.item.label);
                        return false;
                    },
                    select: function( event, ui ) {
                        $( "#UserCity" ).val( ui.item.value);   
                        
                        return false;
                         if(!data.length){
                             alert('sdf');
                         }
                    },response: function(event, ui) {

                        if (ui.content.length === 0) {
                            $("#add_new_city").css('visibility','visible');

                        }else{
                            $("#add_new_city").css('visibility','hidden');
                        }
                    }
            });

            
        /* 
         * UI listion - users/select_ambition
         */
            $('#UserProfileAmbitionCategories').change( function() {
               var data = { "category_id" : $(this).val()}; 
               console.log(data);
               new callAjax(data,'sub_categories/get_subcategories','populateAmbSubCategories').fire();
            });
            
            $('#UserProfileHobbyCategories').change( function() {
               var data = { "category_id" : $(this).val()}; 
               new callAjax(data,'sub_categories/get_subcategories','populateHobSubCategories').fire();
            });
        
            var sel_ambition_ids = new Array();
            var sel_hobby_ids = new Array();
            
            $( "#UserProfileAmbitionSubCategories" )
              .change(function () {
                var str = "";
                var id = 0;
                $( "#UserProfileAmbitionSubCategories option:selected" ).each(function() {
                  str = $( this ).text();
                  id = $( this ).val();
                  
                });
                
                if(sel_ambition_ids.indexOf(id) < 0 )
                { 
                    if(id !== ''){
                    sel_ambition_ids.push(id);
                    
                    var template = "<div class='sel-hob-main' id='"+id+"' ><div class='sel-copy' >"+str+"</div><div class='sel-close' ></div></div>";
                    $(".ambitions-listsel").append(template);
                    }
                }
                
              })
              .change();
      
            $( "#UserProfileHobbySubCategories" )
              .change(function () {
                var str = "";
                var id = 0;
                $( "#UserProfileHobbySubCategories option:selected" ).each(function() {
                  str = $( this ).text();
                  id = $( this ).val();
                  
                });
                
                if(sel_hobby_ids.indexOf(id) < 0 )
                { 
                    if(id !== ''){
                    sel_hobby_ids.push(id);
                    
                    var template = "<div class='sel-hob-main' id='"+id+"' ><div class='sel-copy' >"+str+"</div><div class='sel-close' ></div></div>";
                    $(".hobbies-listsel").append(template);
                    }
                }
                
              })
              .change();
      
      
              $('#userCategory').submit( function(event) {
                  alert(sel_ambition_ids);
                  alert(sel_hobby_ids);
                  
                    
                  $('<input>').attr({
                    type: 'hidden',
                    name: 'ambitions',
                    value: sel_ambition_ids
                    }).appendTo('#userCategory');
                  $('<input>').attr({
                    type: 'hidden',
                    name: 'hobbies',
                    value:sel_hobby_ids
                    }).appendTo('#userCategory');
              });
              

        
           
});

        function populateStatesList(data){
            
            $('#state').empty();          
            $.each($.parseJSON(data), function( index , element) {
                $('#state').append($('<option>', {
                    text: element.name,
                    value:element.id
                }));

            });
            $('#city').empty();
        }
        
        
        function populateCitiesList(data){
            
            $('#city').empty();          
            $.each($.parseJSON(data), function( index , element) {
                $('#city').append($('<option>', {
                    text: element.name,
                    value:element.id
                }));

            });
            
        }
        
        
        
        function populateAmbSubCategories (data){
            
                    console.log(data);
            $('#UserProfileAmbitionSubCategories').val("");            
            $("#UserProfileAmbitionSubCategories > option").each(function( index ) {
                if(index){
                    $(this).remove();
                }
            });
  
            $.each($.parseJSON(data), function( index , element) {
                console.log(element);
                $('#UserProfileAmbitionSubCategories').append($('<option>', {
                    text: element.name,
                    value: element.id
                }));

            });
        }
        function populateHobSubCategories (data){
            
                    
            $('#UserProfileHobbySubCategories').val("");            
            $("#UserProfileHobbySubCategories > option").each(function( index ) {
                if(index){
                    $(this).remove();
                }
            });
  
            $.each($.parseJSON(data), function( index , element) {
                $('#UserProfileHobbySubCategories').append($('<option>', {
                    text: element.name,
                    value: element.id
                }));

            });
        }
        
        $('#add_new_state').click( function(){
           var country_id = $('#UserCountry').val();
           var state_name = $('#UserStateName').val();
           var data = {country_id : country_id,name: state_name};
           new callAjax(data,'states/add','after_state_add').fire();
            
        });
        
        function after_state_add(result) {
            
            var data = JSON.parse(result); 
            $('#UserState').val(data.id);
            $("#add_new_state").css('visibility','hidden');
        }
        
        
        $('#add_new_city').click( function(){
           var state_id = $('#UserState').val();
           var city_name = $('#UserCityName').val();
           var data = {state_id : state_id,name: city_name};
           new callAjax(data,'cities/add','after_city_add').fire();
            
        });
        
        function after_city_add(result) {
            var data = JSON.parse(result); 
            $('#UserCity').val(data.id);
            $("#add_new_city").css('visibility','hidden');
        }
