<?php   echo $this->element('profile/media_media_menu'); ?>

    <div class="clear"></div>
    <div class="filter-contents">
        
                     
                     <!------------- Doc --------------->
                    
        <div id="filter-documents" class="filter-con-row">
            <div class="post-main" id="postboxid" >

                <div class="post-options">
                    <span class="iocnfr"></span>Documents</h2>
                    <div class="filter-search">
                        <input type="search" data-sort="cover-pic-disc-name" id="visitor-doc-filter" placeholder="Search here.." class="friend-search"  />
                    </div>

                </div>

            </div>
            <div id="filter-documents" class="profile-row-mids">
            <div  class="filter-con-row-inner" id="user_media_docs">
                
                <?php foreach( $docArray as $index => $doc ){ ; ?>
                <div class="filter-box user_media_doc">
                    <a target="new_doc" href="<?php echo '../'.POST_DOC_UPLOAD_FOLDER.$doc['Post']['link']; ?>">
                    <div class="filter-box-thumb">
                        <?php echo $this->Html->image('uploads/video-thumb_03.jpg'); ?>
                        <span class="icon-music">&#xf025;</span>
                    </div>
                    </a>
                    <div class="filter-box-details">
                        <h3>Harmoney Of Colors</h3>
                        <div class="details-thumb">Uploaded by <b>jaidel rabier</b>
                        </div>
                    </div>
                </div>
                <?php }
                    if( count($docArray) > 0 ){
                        
                            echo $this->Paginator->next('Show more Doc...');
                    }else{
                            echo '<p style="text-align:center;" >No Doc Found...</p>';
                    }
                    

                    ?>



            </div>
            
            </div>
        </div>


                
                        
    </div>
