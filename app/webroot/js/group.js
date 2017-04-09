/* 
 * Group page edit
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
   
        $('#group-title').on('click','.editPencil',function(){
            alert('sdf');
           $('#group-title').css({"display":"none"});
           $('#replace-group-title').css({"display":"block"});
        });

        $('#replace-group-title').on('click','input:button',function(){
           text = $('#replace-group-title').children('textarea').val();
           $('#group-title').children('h4').html(text);
           $('#group-title').css({"display":"block"});
           $('#replace-group-title').css({"display":"none"});
           var data = {title : text, id : jsVars .wall_id, field : 'name' ,user_id : jsVars.user_id};
           new callAjax(data,'/groups/update_group_field','feedback').fire();
           


        });
         $('#replace-group-title').on('click','input:reset',function(){
           $('#replace-group-title').css({"display":"none"});
           $('#group-title').css({"display":"block"});
        });
        
        
        $('#group-about').on('click','.editPencil',function(){
           $('#replace-group-about').css({"display" : "block"});
           $('#group-about').css({"display" : "none"});

        });

        $('#replace-group-about').on('click','input:button',function(){

            about = $('#replace-group-about').children('textarea[name="description"]').val(); 
            var data = {title : about, id : jsVars .wall_id, field : 'description'};
            console.log(data);
            new callAjax(data,'/groups/update_group_field','feedback').fire();
            $('#replace-group-about input:reset').val('');
            $('#group-about p').html(about);
            $('#replace-group-about input:reset').click();
        });

        $('#replace-group-about').on('click','input:reset',function(){
           $('#replace-group-about').css({ "display" : "none"});
           $('#group-about').css({ "display" : "block" });
        });
        
});


    function feedback(data){
       console.log(data); 
    }
    
 $(document).ready(function(){
    
    $('#crop_profile_pic_group_file').change(function(){
        groupIconCrop(this);
        alert('asd');
    });
    

        function groupIconCrop(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                //console.log();
                /*validate input file javascript*/

                    $supported_filetype=['image/png','image/PNG','image/jpeg','image/JPEG','image/jpg','image/JPG','image/gif','image/JIF','image/bmp','image/BMP'];

                    if($supported_filetype.indexOf(input.files[0].type) < 0){
                      alert('file format not supported');  
                      return false;
                    }
                    if(input.files[0].size >= 604800){
                        alert('Uploaded Image size is more the allowed size');
                        return false;
                    }

                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function() {
                    console.log(this.width);
                    };
                    var fact=1;
                    if(image.width>=image.height){
                            fact=image.width/600;
                    }else{
                            fact=image.height/600;
                    }
                    var img_width= image.width/fact;
                    var img_height= image.height/fact;
                    //console.log('img_width ='+img_width+'img_height ='+img_height);

                    $('#target').css('width',img_width);
                    $('#target').css('height',img_height);
                    $('#target').attr('src', e.target.result);
                    $('#imgp').attr('src', e.target.result);
//                    $('#light').css('display','block');
//                    $('#fade').css('display','block');
/****************************************/

    // Create variables (in this scope) to hold the API and image size
    var jcrop_api,
        boundx,
        boundy,

        // Grab some information about the preview pane
        $preview = $('#preview-pane'),
        $pcnt = $('#preview-pane .preview-container'),
        $pimg = $('#preview-pane .preview-container img'),

        xsize = $pcnt.width(),
        ysize = $pcnt.height();
    
    console.log('init',[xsize,ysize]);
    $('#target').Jcrop({
      onChange: updatePreview,
      onSelect: updatePreview,
      setSelect: [0, 250, 250, 0],
      minSize:[100,100],
      maxSize:[600,600],
      aspectRatio: xsize / ysize
    },function(){
      // Use the API to get the real image size
      var bounds = this.getBounds();
      boundx = bounds[0];
      boundy = bounds[1];
      // Store the API in the jcrop_api variable
      jcrop_api = this;

      // Move the preview into the jcrop container for css positioning
      $preview.appendTo(jcrop_api.ui.holder);
    });

    function updatePreview(c)
    {
      if (parseInt(c.w) > 0)
      {
        var rx = xsize / c.w;
        var ry = ysize / c.h;

        $pimg.css({
          width: Math.round(rx * boundx) + 'px',
          height: Math.round(ry * boundy) + 'px',
          marginLeft: '-' + Math.round(rx * c.x) + 'px',
          marginTop: '-' + Math.round(ry * c.y) + 'px'
        });
      }
      
      		$('#xx').val(c.x);
                $('#xx1').val(c.x2);
		$('#xy').val(c.y);
                $('#yy1').val(c.y2);
		$('#w').val(c.w);
		$('#h').val(c.h);
    };
/****************************************/

                }

                reader.readAsDataURL(input.files[0]);
            }

 


        }
        
    });