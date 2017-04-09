                            <div class="group-row-main">
                                <h3>
                                    <span class='group-name'>Ambition</span>
                                    <span class='group-number'>(<?php echo  count($groups[1]) ; ?>  -  groups)</span>
                                </h3>
                                <?php foreach($groups[1] as $index => $group) {
                                
                                if($index % 3 == 0) {
                                if($index != 0){ 
                                 echo '</div>';
                                   } 
                                
                                echo '<div class="group-row">';
                                  } ?>

                                    <div class="group-row-box">
                                        <div class="row-pic">
                                            <?php
                                            $img = 'ambition.jpg';
                                            if($group['name'] != ''){
                                               $img =  '../'.PROFILE_IMAGE_PATH_FINAL.$group['link'].'_sml.jpeg';
                                            } 
                                            echo $this->Html->image($img , array('url' => 
                                                array('controller' => 'groups' ,'action' => $group['id'])
                                                ));
                                            ?>
                                            
                                        </div>
                                        <div class="row-pic-name"><?php echo $group['name']; ?></div>
                                    </div>
                                    
                                <?php 
                                if( ($index+1)  == count($groups[1])){
                                    echo '</div>';
                                } }    ?>

                            </div>
                            <div class="group-row-main">
                                <h3>
                                    <span class='group-name'>Hobbies</span>
                                    <span class='group-number'>(<?php echo count($groups[2]); ?>  -  groups)</span>
                                </h3>
                                <?php foreach($groups[2] as $index => $group) {
                                
                                if($index % 3 == 0) {
                                if($index != 0){ 
                                 echo '</div>';
                                   } 
                                
                                echo '<div class="group-row">';
                                  } ?>

                                    <div class="group-row-box">
                                        <div class="row-pic">
                                            <?php
                                            $img = 'ambition.jpg';
                                            if($group['link'] != ''){
                                               $img =  '../'.PROFILE_IMAGE_PATH_FINAL.$group['link'].'_sml.jpeg';
                                            } 
                                            echo $this->Html->image($img , array('url' => 
                                                array('controller' => 'groups' ,'action' => $group['id'])
                                                ));
                                            ?>
                                            
                                        </div>
                                        <div class="row-pic-name"><?php echo $group['name']; ?></div>
                                    </div>
                                    
                                <?php 
                                if( ($index+1)  == count($groups[2])){
                                    echo '</div>';
                                } }    ?>

                            </div>
                            <div class="group-row-main">
                                <h3>
                                    <span class='group-name'>Teams</span>
                                    <span class='group-number'>(<?php echo  count($groups[4]) ; ?>  -  groups)</span>
                                </h3>
                                <?php foreach($groups[4] as $index => $group) {
                                
                                if($index % 3 == 0) {
                                if($index != 0){ 
                                    echo '</div>';
                                   } 
                                
                                echo '<div class="group-row">';
                                  } ?>

                                    <div class="group-row-box">
                                        <div class="row-pic">
                                            <?php
                                            $img = 'ambition.jpg';
                                            if($group['link'] != ''){
                                               $img =  '/'.PROFILE_IMAGE_PATH_FINAL.$group['link'].'_sml.jpeg';
                                            } 
                                            
                                            echo $this->Html->image($img , array('url' => 
                                                array('controller' => 'team' ,'action' => $group['id'] )
                                                ));
                                            ?>
                                            
                                        </div>
                                        <div class="row-pic-name"><?php echo $group['name']; ?></div>
                                    </div>
                                    
                                <?php 
                                if( ($index+1)  == count($groups[4])){
                                    echo '</div>';
                                } }    ?>

                            </div>



