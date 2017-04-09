                            <div class="profile-row-mids">
                                
                                <div class="education-left">
                            <div class="upload-profilePic">
                                <div class="upload-profilePicinner">
                                    <?php
                                    
                                    echo $this->Html->image('../'.PROFILE_IMAGE_PATH_FINAL.$mygroup['Group']['avatar'].'_mid.jpeg');
                                    ?>
                                </div>

                            </div>
                                </div>
                                <div class="education-desc">
                                    <h3>Select Profile Icon</h3>
                                    <div class="edu-desc-row">
                                        
                                               
                                        <input type='button' value="Select"  data-rel="profile-row-mids"  class='popup' >
                                    </div>
                                    <div class="edu-desc-row" id="group-title" >
                                        <div class="editPencil pencil">&nbsp;</div>
                                        <h3>title</h3>
                                        <h4><?php echo $mygroup['Group']['name']  ?></h4>
                                    </div>
                                    <div class="edu-desc-row" id="replace-group-title"   >
                                        
                                        <h3>title</h3>
                                        <textarea class="group-title" ><?php echo $mygroup['Group']['name']  ?></textarea>
                                        <input type="button"   value="save" />
                                        <input type="reset" value="cancel" />
                                    </div>
                                    <div id="group-about" class="edu-desc-row">
                                        <div class="editPencil pencil">&nbsp;</div>
                                        <h3>description</h3>
                                        <p><?php echo $mygroup['Group']['description']  ?></p>
                                    </div>
                                    <div id="replace-group-about" class="edu-desc-row">
                                        
                                        <h3>description</h3>
                                        <textarea name="description" class="group-title" ><?php echo $mygroup['Group']['description']  ?></textarea>
                                        <h3></h3>
                                        
                                        <input type="button"   value="save" />
                                        <input type="reset" value="cancel" />
                                    </div>
                                </div>
                            </div>
                            <?php 
                            echo $this->Form->create('Group', array('type'=>'file','id'=>'uploadfile',
                            'url' => array('controller' => 'team', 'action' => $mygroup['Group']['id'], 'settings' )));
                            
                            ?>
        <div class="simple_overlay" id="profile-row-mids">
            <div class="createG-left" >
                <h1>Crop Image</h1>
                <div id="img_place"  >
                   <img src="" id="target" alt="[Jcrop Example]" />  
                </div>
            </div>
            <div class="createG-right" >
                <h3>Select image</h3>
                <div class="group-search">
                    <?Php 
                    echo $this->Form->input('file', array('id' => 'crop_profile_pic_group_file', 'type' => 'file' ,'value' =>'Select' ));
                    ?>
                    
                    
                </div>
                
                <div id="preview-pane">
                  <div class="preview-container">
                    <img src="" class="jcrop-preview" id="imgp" alt="Preview" />
                  </div>
                </div>
                
                
                        <div class="share-button-wrapper">
                            <input type="submit" class="common-button share" value="SHARE" />
                            <input type="submit" class="common-button cancel" value="CANCEL">
                        </div>
                
            </div>

        </div>
<?php
                            echo $this->Form->input('x',array('id'=>'xx','type'=>'hidden'));
                            echo $this->Form->input('x1',array('id'=>'xx1','type'=>'hidden'));
                            echo $this->Form->input('y',array('id'=>'xy','type'=>'hidden'));
                            echo $this->Form->input('y1',array('id'=>'yy1','type'=>'hidden'));
                            echo $this->Form->input('w',array('id'=>'w','type'=>'hidden'));
                            echo $this->Form->input('h',array('id'=>'h','type'=>'hidden'));

                            echo  $this->Form->end(); ?>

<style>
/* Apply these styles only when #preview-pane has
   been placed within the Jcrop widget */
.jcrop-holder #preview-pane {
  display: block;
  position: absolute;
  z-index: 7000;
  top: 80px;
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
  z-index: 2001;
}
.simple_overlay{
    overflow: hidden;
}
</style> 
            <?php 

echo $this->Html->css('registration/jquery.Jcrop.css');

    ?>