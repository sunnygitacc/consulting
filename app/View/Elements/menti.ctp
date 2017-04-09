<?php


?>
                        <div class="group-row-main">
                                <h3>
                                    <span class='group-name'>Protege</span>
                                    <span class='group-number'>(<?php echo  count($menti) ; ?>  -  followers)</span>
                                </h3>
                                <?php foreach($menti as $index => $user) {

                                if($index % 3 == 0) {
                                if($index != 0){
                                 echo '</div>';
                                   }

                                echo '<div class="group-row">';
                                  } ?>

                                    <div class="group-row-box">
                                        <div class="row-pic">
                                            <?php
                                        $imagePath = PROFILE_IMAGE_PATH_FINAL.$user->profilePic.'_sml.jpeg';
                                                        if(!$user->profilePic) {
                                                                $imagePath = "img/mentorReg.jpg";
                                                        }
                                            echo $this->Html->image('/'.$imagePath , array('url' =>
                                                array('controller' => 'profiles' ,'action' => $user->id  )
                                                ));
                                            ?>

                                        </div>
                                        <div class="row-pic-name"><?php echo ( $user->first_name.' '.$user->last_name); ?></div>
                                    </div>

                                <?php
                                if( ($index+1)  == count($menti)){
                                    echo '</div>';
                                } }    ?>

                            </div>
