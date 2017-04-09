<?php   echo $this->element('profile/media_media_menu'); ?>
    <div class="clear"></div>
    <div class="filter-contents">
        
                    <!------------- Video--------------->
        
        <div id="filter-videos" class="filter-con-row"  >
            <div class="post-main" id="postboxid" >

                <div class="post-options">
                    <span class="iocnfr"></span>Videos</h2>
                    <div class="filter-search">
                        <input type="search" data-sort="cover-pic-disc-name" id="visitor-video-filter" placeholder="Search here.." class="friend-search"  />
                    </div>

                </div>

            </div>
            
            <div class="profile-row-mids">
                <div class="filter-con-row-inner" id='user_media_videos' >
                        <?php foreach($videoArray as $index => $vid ) {  ?> 
                                <div class="filter-box user_media_video">
                                    <div class="filter-box-thumb">
                                        <?php echo $this->Html->image('/'.POST_VIDEO_THUMBNAIL_UPLOAD_FOLDER.$vid['Post']['link'].'_196x110_thumb.png'); ?>
                                        <span class="icon-video">&#xf01d</span>
                                    </div>
                                    <div class="filter-box-details">
                                        <h3><?php echo $vid['Post']['title']; ?></h3>
                                        <div class="details-thumb">Uploaded by <b><?php echo $vid['Postby']['first_name'].' '.$vid['Postby']['last_name'] ?></b>
                                        </div>
                                    </div>
                                </div>
                        <?php } 
                        if(count($videoArray)>0){
                                echo $this->Paginator->next('Show more videos...');
                        }else{
                                echo '<p style="text-align:center;" >No video Found...</p>';
                        }
                        ?>

                </div>
            </div> 
        </div>
                    <!------------- Image --------------->
        
    
                        
    </div>
