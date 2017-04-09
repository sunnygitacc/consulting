<?php 
echo $this->Html->script('registration/jquery.min.js');
echo $this->Html->script('registration/jquery.Jcrop.js');
?>
<script>
$(document).ready(function(){
$('#light').css('display','none');

 $("#image").change(function() {
 readURL(this);

 });

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //console.log();
            /*validate input file javascript*/

                $supported_filetype=['image/png','image/PNG','image/jpeg','image/JPEG','image/jpg','image/JPG','image/gif','image/JIF','image/bmp','image/BMP'];
                
                if($supported_filetype.indexOf(input.files[0].type) < 0){
                  alert('file format not supported');  
                  return false;
                }
                if(input.files[0].size >= 204800){
                    alert('Uploaded Image size is more the allowed size');
                    return false;
                }
                
            reader.onload = function (e) {
                var image = new Image();
                image.src = e.target.result;
                image.onload = function() {
                //console.log(this.width);
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
                $('#light').css('display','block');
                $('#fade').css('display','block');

		
				
				
		var jcrop_api,boundx,boundy,

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
		
		

		
//    $('#x1').val(c.x);
//    $('#y1').val(c.y);
//    $('#x2').val(c.x2);
//    $('#y2').val(c.y2);
//    $('#w').val(c.w);
//    $('#h').val(c.h);
                
	
      }
      		$('#xx').val(c.x);
      		$('#xx1').val(c.x2);
		$('#xy').val(c.y);
		$('#yy1').val(c.y2);
		$('#w').val(c.w);
		$('#h').val(c.h);
    };
				
            }

            reader.readAsDataURL(input.files[0]);
        }
        
  $('#accept').click(function(){
      
       $('#uploadfile').submit();
  
});      
        
        
    }




});


	 
</script>

            <div class="fixed-container">
                <div class="register-main">
                    <div class="register-left">
                        <div class="user-reg profileReg-pic">
                            <div class="user-regImg">
                                <?php
                                echo $this->Html->image('userReg.jpg');
                                ?>
                                
                            </div>
                            <div class="user-regDetails">
                                <h2>PROFILE IMAGE</h2>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</p>
                            </div>
                        </div>
                    </div>
                    <div class="register-right">
                        <div class="step-main">
                            <div class="step-copy">
                                <h3>REGISTRATION</h3>
                                <h2>STEPS</h2>
                            </div>
                            <div class="step-img step3">
                                <div class="bg-percent"></div>
                                <?php 
                                echo $this->Html->image('steps.png');
                                ?>
                               
                                <ul class="step-ulist" >
                                    <li class="no1 active" >1</li>
                                    <li class="no2 active">2</li>
                                    <li class="no3">3</li>
                                </ul>
                            </div>
                        </div>
                         
                        <div class="register-form-main upload-profilepic">
                            <div class="upload-profilePic">
                                <div class="upload-profilePicinner">
                                    <?php
                                    
                                    echo $this->Html->image('/'.$avathar);
                                    ?>
                                </div>

                            </div>
                            <?php 
                            echo $this->Form->create('Post', array('type'=>'file','id'=>'uploadfile',
                            'url' => array('controller' => 'users', 'action' => 'profile_photo')));
                            
                            ?>
                            <div class="rows-reg attachfile">
                                <div class="rows-reg-left">Profile Image</div>
                                <div class="rows-reg-right">

                                    <div class="file-upload ">

                                        <input class="common-input" id="uploadFile" placeholder="Choose File" disabled="disabled" />
                                        <div class="fileUpload">
                                            <span>OPEN</span>
                                            <?php 
                                            echo $this->Form->input('doc_file',array( 'type' => 'file','id'=>'image','class'=>'upload','label'=>false));
                                            ?>
                                           
                                        </div>

                                    </div>
                                    
                                    
                                </div>
                            </div>
                        <?php   echo $this->Html->link(
                                'Home',
                                array(
                                    'controller' => 'ambitions',
                                    'action' => 'index',
                                    'full_base' => true
                                   
                                )
                            );

                            echo $this->Form->input('x',array('id'=>'xx','type'=>'hidden'));
                            echo $this->Form->input('x1',array('id'=>'xx1','type'=>'hidden'));
                            echo $this->Form->input('y',array('id'=>'xy','type'=>'hidden'));
                            echo $this->Form->input('y1',array('id'=>'yy1','type'=>'hidden'));
                            echo $this->Form->input('w',array('id'=>'w','type'=>'hidden'));
                            echo $this->Form->input('h',array('id'=>'h','type'=>'hidden'));

                            echo  $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
			
<?php  

//echo $this->Html->script('jquery/jquery.js');




echo $this->Html->css('registration/main.css');
echo $this->Html->css('registration/demos.css');
echo $this->Html->css('registration/jquery.Jcrop.css');



    ?>

<style>
    .black_overlay{
        display: none;
        position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 130%;
        background-color: black;
        z-index:1001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        display: none;
        position: absolute;
        top: 0%;
        left: 10%;
        width: 80%;
        height: 90%;
        padding: 16px;
        border: 5px solid #C1C1C1;
        border-radius: 10px;
        background-color: white;
        z-index:1002;
        overflow: auto;
    }
   .img{
	   position:relative;
	   width:100%;
	}
	
/* Apply these styles only when #preview-pane has
   been placed within the Jcrop widget */
.jcrop-holder #preview-pane {
  display: block;
  position: absolute;
  z-index: 2000;
  top: 10px;
  right: -280px;
  padding: 6px;
  border: 1px rgba(0,0,0,.4) solid;
  background-color: white;

  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;

  -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
}

/* The Javascript code will set the aspect ratio of the crop
   area based on the size of the thumbnail preview,
   specified here */
#preview-pane .preview-container {
  width: 170px;
  height: 170px;
  overflow: hidden;
-webkit-border-radius: 120px;
-moz-border-radius: 120px;
border-radius: 120px;
}
</style>

<div id="light" class="white_content">This is the lightbox content. <a href = "javascript:void(0)" id="" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';">Close</a>

   <img  class='img'  id='target' />
   
        <div id="preview-pane">
    <div class="preview-container">
      <img src="" id='imgp' class="jcrop-preview" alt="Preview" />
    </div>
  </div>
   


<button class="common-button" id="accept"  >Accept</button>
</div>
   

   <div id="fade" class="black_overlay">

   </div>
   
