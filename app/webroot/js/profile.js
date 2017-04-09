    $("#personal_details").on("click", '.editPencil', function() {
		$("#personal_details_edit").show();
        $("#personal_details").hide();
        
        $('#dob_in').val($("#dob").val());
        $('#first_name_in').val($("#first_name span").text());
        $('#last_name_in').val($("#last_name span").text());
        $('#city_in').val($("#city span").text());
        $('#mobile_in').val($("#mobile span").text());
        $('#mail_in').val($("#mail span").text());
    }); 
  

    $('#about_me_labels').on('click','#about_me', function(){
            
        $(this).parent('#about_me_labels').css({'display': 'none'});
        $('#about_me_edit').css({'display':'block'});
    });
    
    $('#about_me_edit').on('click',':button.cancel', function(){
        title = $('#about_me_labels p').html();
        $('#about_me_edit_text').val(title);
        $('#about_me_edit').css({'display': 'none'});
        $('#about_me_labels').css({'display':'block'});
        
    });
    $('#about_me_edit').on('click','.share:button', function(){
        newtext = $('#about_me_edit_text').val();
        $('#about_me').find('p').html(newtext);
        $('#about_me_labels p').html(newtext);
        $('#about_me_edit').css({'display': 'none'});
        $('#about_me_labels').css({'display':'block'});
        var data = {"user_id" : jsVars.wall_id, "status" : newtext, "is_mentor" : 0};
        new callAjax(data,'user_profile_status/add_status','afterAddStatus').fire();
       
    });
  
    function afterAddStatus(result) {
        var data = JSON.parse(result);
        
    }
  
  //Personal Details Update
    $("#personal_details_edit").on("click", '.common-button', function() {
    	$("#personal_details_edit").hide();
        $("#personal_details").show();
    	if($(this).val() == 'SAVE') {
	        $("#first_name span").text($('#first_name_in').val());
	        $("#last_name span").text($('#last_name_in').val());
	        $("#city span").text($('#city_in').val());
	        $("#mobile span").text($('#mobile_in').val());
	        $("#mail span").text($('#mail_in').val());
	        
                $dob = $('#UserDobYear').val()+'-'+$('#UserDobMonth').val()+'-'+$('#UserDobDay').val();
                $("#birth_on span").text($.datepicker.formatDate('dd-M-', new Date($dob))+$('#UserDobYear').val());
	        
	        var data = {"user_id": jsVars.user_id ,"first_name": $('#first_name_in').val(),"last_name": $('#last_name_in').val(),
						"email": $('#mail_in').val(),
						"city": $('#city_in').val(),"dob": $dob};
		console.log(data);		
	        new callAjax(data,'users/update_personal_details','').fire();
	        
    	}
        
    });
    
    $(".profile-row-mids").on("click", '.add', function() {
		$("#ui_add").show();
    });
    
    //Education Add Update
    $(".education-desc").on("click", '.common-button', function() {
        
    	$("#ui_add").hide();
 
    	if($(this).val() == 'SAVE' && $('#education_id').val()) {
            
            var formData = new FormData($('#user_education_id')[0]);


                
                $.ajax({
                    url: baseUrl + 'user_educations/add',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(result) {
                        alert(result);
                        $('#edu_first').append(result);

                    }

                });
                
            $('#user_education_id').each(function(){
                this.reset();
            }); 
    	}
        
        
        
    	if($(this).val() == 'SAVE' && $('#title_id').val()) {
            
            var formData = new FormData($('#user_work_id')[0]);


                
                $.ajax({
                    url: baseUrl + 'user_works/add',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(result) {
                        alert(result);
                        $('#edu_first').append(result);

                    }

                });
                
            $('#user_education_id').each(function(){
                this.reset();
            }); 
    	}
        
        
    	if($(this).val() == 'SAVE' && $('#award_id').val()) {
            
            var formData = new FormData($('#user_award_id')[0]);


                
                $.ajax({
                    url: baseUrl + 'user_awards/add',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(result) {
                        alert(result);
                        $('#edu_first').append(result);

                    }

                });
                
            $('#user_education_id').each(function(){
                this.reset();
            }); 
    	}
        
    	if($(this).val() == 'SAVE' && $('#certification_id').val()) {
            
            var formData = new FormData($('#user_certification_id')[0]);


                
                $.ajax({
                    url: baseUrl + 'user_certifications/add',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(result) {
                        alert(result);
                        $('#edu_first').append(result);

                    }

                });
                
            $('#user_education_id').each(function(){
                this.reset();
            }); 
    	}
        
        
    });
    






    //profile education edit
    var editedEdu = "";
    $('.left-container-profile').on('click','.editDummy', function(){
    	$("#edu_edit"+$(this).prop("id")).show();
    	editedEdu = $(this).parent();
    	editedEdu.hide();
    });
    
    //profile education edit
    $('.left-container-profile').on('click','.editDummy', function(){
    	$("#exp_edit"+$(this).prop("id")).show();
    	editedEdu = $(this).parent();
    	editedEdu.hide();
    });
    
    //profile education edit
    $('.left-container-profile').on('click','.editDummy', function(){
    	$("#awd_edit"+$(this).prop("id")).show();
    	editedEdu = $(this).parent();
    	editedEdu.hide();
    });
    
    //profile certification edit
    $('.left-container-profile').on('click','.editDummy', function(){
    	$("#cer_edit"+$(this).prop("id")).show();
    	editedEdu = $(this).parent();
    	editedEdu.hide();
    });
    
    
    //Save Profile edit
    $(".profile-row-mids").on("click", '.edu_edit', function() {
        
    	if($(this).val() == 'SAVE') {
            var res = $(this).attr('id').split("-");
            var form_id = res[1];
            
             var formData = new FormData($('#user_education_id_'+form_id)[0]);

                $.ajax({
                    url: baseUrl + 'user_educations/edit',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(result) {
                        var div = '<div class="editPencil pencil editDummy" id="'+form_id+'"></div>';
                        div = div+result;
                        $('#'+form_id).parent('.edu-desc-row-inner').html(div);
                    }

                });
    	}
    	
    	$(this).parent().parent().hide();
    	editedEdu.show();
    });
    
    
    //Save Profile edit
    $(".profile-row-mids").on("click", '.cer_edit', function() {
        
    	if($(this).val() == 'SAVE') {
            var res = $(this).attr('id').split("-");
            var form_id = res[1];
            
             var formData = new FormData($('#user_certification_id_'+form_id)[0]);

                $.ajax({
                    url: baseUrl + 'user_certifications/edit',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(result) {
                        var div = '<div class="editPencil pencil editDummy" id="'+form_id+'"></div>';
                        div = div+result;
                        $('#'+form_id).parent('.edu-desc-row-inner').html(div);
                    }

                });
    	}
    	
    	$(this).parent().parent().hide();
    	editedEdu.show();
    });
    
    //Save Experience Profile edit
    $(".profile-row-mids").on("click", '.exp_edit', function() {
        
    	if($(this).val() == 'SAVE') {
            var res = $(this).attr('id').split("-");
            var form_id = res[1];
            
             var formData = new FormData($('#user_work_id_'+form_id)[0]);

                $.ajax({
                    url: baseUrl + 'user_works/edit',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(result) {
                        var div = '<div class="editPencil pencil editDummy" id="'+form_id+'"></div>';
                        div = div+result;
                        $('#'+form_id).parent('.edu-desc-row-inner').html(div);
                    }

                });
    	}
    	
    	$(this).parent().parent().hide();
    	editedEdu.show();
    });
    
    
    //Save Award  edit
    $(".profile-row-mids").on("click", '.awd_edit', function() {
        
    	if($(this).val() == 'SAVE') {
            var res = $(this).attr('id').split("-");
            var form_id = res[1];
            
             var formData = new FormData($('#user_award_id_'+form_id)[0]);

                $.ajax({
                    url: baseUrl + 'user_awards/edit',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(result) {
                        var div = '<div class="editPencil pencil editDummy" id="'+form_id+'"></div>';
                        div = div+result;
                        $('#'+form_id).parent('.edu-desc-row-inner').html(div);
                    }

                });
    	}
    	
    	$(this).parent().parent().hide();
    	editedEdu.show();
    });
    
    
    $(document).ready( function(){
       new InfinateScrollFun('user_media_images','user_media_image','').fire(); 
    });
    
    
    $('.cover-pic-Disc-right').on('click','.wcamera', function(){
        $('#cover_image_upload').css({'display' : 'block'});

    });
    
    $('.cover-image').on('change','#cover-photo-input', function() {
        change_cover_pic(this)
    });
    
    $('#cover_pic_upload').change(function(){
        change_cover_pic(this)
        alert('sdf');
    });
    
    function change_cover_pic(input){
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            $supported_filetype = ['image/png', 'image/PNG', 'image/jpeg', 'image/JPEG', 'image/jpg', 'image/JPG', 'image/gif', 'image/JIF', 'image/bmp', 'image/BMP'];

            if ($supported_filetype.indexOf(input.files[0].type) < 0) {
                alert('file format not supported');
                return false;
            }
            if (input.files[0].size >= 1004800) {
                alert('Uploaded Image size is more the allowed size');
                return false;
            }
            alert('validated');

            //console.log(input.files[0]);
            reader.onload = function(e) {
                
                var image = new Image();
                image.src = e.target.result;
                image.onload = function() {
                    
                    if(this.width < 930 || this.width < 285){
                        alert('img size should be above 930X285');
                        
                        
                        
                        
                        
                        
                        return false;
                        
                        
                        
                    }else{
                        
                        $('#draggMe').attr('src',e.target.result);
                    }
                
                }
                
                
                
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function(){

        $("#draggableHelper").draggable({
            disabled: true ,
            drag: function( event, ui ) {
                console.log(ui);
           $('#cover_top').val(Math.round(ui.position.top));
           $('#cover_left').val(Math.round(ui.position.left));



            }
        });

    });

        
    var dragEnable = 0;

    $('#enable_cover_drag').click(function(){
        
       if(dragEnable==0){
           alert($(this).val());
           $('#draggableHelper').css('top','0px');
           $('#draggableHelper').css('left','0px');
           $(this).val('stop drag');
           $("#draggableHelper").draggable({disabled:false});
           dragEnable = 1;
       }else{
           $(this).val('Drag');
           $("#draggableHelper").draggable({disabled:true});
           dragEnable = 0;
       }
        
    });
    
    //add user to group
    
    $('#edit_group_members').on('click','.pencil', function(){
        $(this).toggleClass('pencil black-pencil');
        $('#edit-group-members').css({'dispaly' : 'block','visibility' : 'visible'});
        $('#edit-group-members').attr('class','members-main group-profile connected');
    });
    
    $('#edit_group_members').on('click','.black-pencil', function(){
        $(this).toggleClass('black-pencil pencil');
        $('#edit-group-members').css({'dispaly' : 'none','visibility' : 'hidden'});
        
    });
   
           $( "#search-user-invitee" ).autocomplete({
        source: jsVars.invitee,
        focus: function( event, ui ) {
                    $( "#search-user-invitee" ).val( ui.item.label);
                    return false;
                },
                select: function( event, ui ) {
                    var str = ui.item.value;
                    populate_user(ui.item);
                    return false;
                },
                response: function(event, ui) {

                    console.log(ui.content.length);

                }
        });
        
        var invitee = new Array();
        
        
        function populate_user(user) {
            
            
            alert(invitee.indexOf(user.value));
            if(!(invitee.indexOf(user.value) >= 0)){
                invitee.push(user.value);
       table = '<div class="mentor-row" id="addDiv_'+user.value+'"  style="width:51%;" >'+
                '<div class="mentor-pic">'+
                    '<img src="'+baseUrl+jsVars.invitee_imgpath+user.img+"_sml.jpeg"+'" />'+
                '</div>'+
                '<div class="mentor-detail">'+
                    '<h4>'+user.label+'</h4>'+
                    '<select id="invitee-'+user.value+'" >'+
                        '<option value="0" >Select</option>'+
                        '<option value="3" >Member</option>'+
                        '<option value="2" >Admin</option>'+
                    '</select>'+
                '</div>'+
                '<div class="mentor-mail">'+
                '<button class="invite-me"  data-id="'+user.value+'"  >Send</button>'+
                    '<a href="#" title="remove" class="sel-close" ></a>'+

                '</div>'+
            '</div>';

            $('#edit-group-members').append(table);
                
            }
            

        }
        
        $('#edit-group-members').on('click','.invite-me', function(){
           var user = $(this).attr('data-id');
           var status = $('#invitee-'+user).val();
           var name = $('#invitee-'+user+' option:selected').text();
           if(status==0){
               alert('please select role');
               return false;
           }
           var data ={'user_id': user,'group_id' :jsVars.wall_id,'role_id': status,'role_alias' : name,}; 
           new callAjax(data,'user_group_relations/add','afterInvitation').fire();
        });
        
        function afterInvitation(result) {

            data = JSON.parse(result);
            $('#edit-group-members #addDiv_'+data.div).remove();
            var index = invitee.indexOf(data.div);
            if(index > -1){
                invitee.splice(index, 1);
            }
            
        }
        
        
        $('.left-container-profile').on('click','.trash', function(){
           var id = $(this).attr('id');
           var tab = $(this).attr('data');
           if(tab=='award'){
               
           var data ={'user_id': jsVars.wall_id,'id' :id }; 
           new callAjax(data,'user_awards/delete','afterDetailRemove').fire();
               
           }
           if(tab=='work'){
               
           var data ={'user_id': jsVars.wall_id,'id' :id }; 
           new callAjax(data,'user_works/delete','afterDetailRemove').fire();
               
           }
           if(tab=='edu'){
               
           var data ={'user_id': jsVars.wall_id,'id' :id }; 
           new callAjax(data,'user_educations/delete','afterDetailRemove').fire();
               
           }
           if(tab=='certi'){
               
           var data ={'user_id': jsVars.wall_id,'id' :id }; 
           new callAjax(data,'user_certifications/delete','afterDetailRemove').fire();
               
           }
           
           
           $(this).parents('.edu-desc-row').css({'display' : 'none'});
           
           
        });
        
        
        
        function afterDetailRemove(result) {
            
            var data =JSON.parse(result);
            if(!data.success){
                alert('Some thing went wrong!!');
                $('#recover-'+data.id).css({'display' : 'block'});
            }else{
                $('#rcover-'+data.id).remove(); 
            }
            
             
        }
        