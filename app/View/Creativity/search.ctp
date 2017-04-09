<div class="right-extended">
    <ul class="filter-cr">
        <li class="filterSel" data-tab="filter-all"><span class="seclectdot"></span>All</li>
        <li data-tab="filter-images"><span class="camera_creative_icon"></span> Images</li>
        <li data-tab="filter-videos"><span class="video-camera"></span> Videos</li>
        <li data-tab="filter-documents"><span class="file-text"></span> Documents</li>
        <li data-tab="filter-audios" class="volume-off-li"><span class="volume-off"></span>Audios</li>
    </ul>
    <div class="flr-left-section">
        <div class="flr-search">
            <?php echo $this->Form->create(); 
            echo $this->Form->input('search',array('class'=>'filterSR-input','id'=>'searchcre','label'=>false));
            echo $this->Form->submit('Submit',array('class'=>'filterSR-submit'));
            echo $this->Form->end();
           
            ?>
            
        </div>
                    <div class="post-main" id="postboxid" >
                       
                      
         
<h3>Search Result </h3>
 <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-->
<?php foreach ($searchr as $key => $search) 
{   
       ?> 
                 <div class="profile-row-mids" id="personal_details">

            <div class="education-left">
                <a href="<?php echo 'http://localhost/wizspeakv254/creativity/player/'.$search['Post']['id'] ?>"> 
                <?php echo $this->Html->image('/'.CRE_VIDEO_THUMBNAIL_UPLOAD_FOLDER.$search['Post']['link'].'_196x110_thumb.png');
                           ?>  

               
            </div>
            <div class="education-desc">
               
                <div class="edu-desc-row">
                    <div class="edu-desc-row-inner" id="birth_on">
                        <label>Title: </label>
                        <span><?php echo $search['Post']['title'];?></span>
                    </div>
                    <div class="edu-desc-row-inner" id="first_name">
                        <label>Description:</label>
                        <span><?php echo $search['Post']['description'];?></span>
                    </div>
                    
                    <div class="edu-desc-row-inner" id="city">
                        <label>Tags :</label>
                        <span><?php echo $search['Post']['description'];?></span>
                    </div>

                </div>
                
            </a>
            </div>
                     
    </div>
   <?php                }  ?>
             <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-->

                    </div>
    </div>
    <div class="flr-right-section">
        <div id="ads1" class="ads">ADS</div>
        <div class="ads">ADS</div>
    </div>
    <div class="clear"></div>
    <div class="filter-contents">
        <div id="filter-videos" class="filter-con-row">
            
                </div>
                

                
                
                
                
                
            </div>
        </div>
    </div>
</div>


<div class="clear"></div>
</div>
</div>
</div>
<div class="clear"></div>
<?php
  echo $this->element('popUp');
  echo $this->element('hidden_forms');
  echo $this->element('video_popup');

  echo $this->element('create_group'); 
  ?>


<?php 


echo $this->Html->script('script');
echo $this->Form->create();
echo $this->Form->input('product');
echo $this->Form->end(__('Search'));

?>

<?php

        echo $this->Form->create('Ticket', array(
    'url' => array_merge(array('action' => 'index'), $this->params['pass'])
));
        echo $this->Form->input('title', array('div' => false,'empty'=>true));
        echo $this->Form->input('status', array('div' => false,'empty'=>true));
        echo $this->Form->submit(__('Search', true), array('div' => false));
        echo $this->Form->end();

    ?>
