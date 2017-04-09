        <div class="tab-container">
            <?php //  pr($note); ?>

            <div class="tab-item" id="all">
                 <?php if(isset($note['request'])){ foreach($note['request'] as $one) { ?>
                <div class="notification-list-main">
                    <div class="notification-list-row">
                        <div class="search-row-sugg">

                            <div class="sugg-image">
                                <?php
                                $img='userReg.jpg';
                                if(isset($one['avathar'])){
                                    $img='/'.$one['avathar'];
                                }
                                echo $this->Html->image($img, array( 'url' => 
                                    array('controller' => 'userprofiles', 
                                        'action' => 'visitor',
                                        $one['link']
                                        )

                                    )); ?>
                            </div>
                            <div class="sugg-details">
                                <p><?php echo $one['subject'].$one['text']; ?></p>
                                <p class='date' ><?php echo $one['date']; ?></p>
                            </div>
                            <div class="sugg-red" >
                                <span data-id="<?php //echo $one['id']; ?>" class="closeme">&nbsp;</span>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php } } ?>
            </div>

            <div class="tab-item" id="ambition">
                 <?php if(isset($note[1])){  foreach($note[1] as $one) { ?>
                <div class="notification-list-main">
                    <div class="notification-list-row">
                        <div class="search-row-sugg">
                            <div class="sugg-image">
                                <?php
                                $img='userReg.jpg';
                                if(isset($one['avathar'])){
                                    $img='/'.$one['avathar'];
                                }
                                echo $this->Html->image($img, array( 'url' => 
                                    array('controller' => 'groups', 
                                        'action' => 'index',
                                        $one['link']
                                        )

                                    ));  ?>
                            </div>
                            <div class="sugg-details">
                                <p><?php echo $one['subject'].' '.$one['text']; ?></p>
                                <p class='date' ><?php echo $one['date']; ?></p>
                            </div>
                            <div class="sugg-red" >
                                <span data-id="<?php //echo $one['id']; ?>" class="closeme">&nbsp;</span>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php }  }?>

            </div>
            <div class="tab-item" id="hobbies">
                 <?php if(isset($note[2])){ foreach($note[2] as $one) { ?>
                <div class="notification-list-main">
                    <div class="notification-list-row">
                        <div class="search-row-sugg">
                            <div class="sugg-image">
                                <?php
                                $img='userReg.jpg';
                                if(isset($one['avathar'])){
                                    $img='/'.$one['avathar'];
                                }
                                echo $this->Html->image($img, array( 'url' => 
                                    array('controller' => 'groups', 
                                        'action' => 'index',
                                        $one['url']
                                        )

                                    ));  ?>
                            </div>
                            <div class="sugg-details">
                                <p><?php echo $one['mag']; ?></p>
                                <p class='date' ><?php echo $one['date']; ?></p>
                            </div>
                            <div class="sugg-red" >
                                <span data-id="<?php echo $one['id']; ?>" class="closeme">&nbsp;</span>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php }  }?>

            </div>
            <div class="tab-item" id="teams">
                 <?php if(isset($note[4])){  foreach($note[4] as $one) {  ?>
                <div class="notification-list-main">
                    <div class="notification-list-row">
                        <div class="search-row-sugg">
                            <div class="sugg-image">
                                <?php
                                $img='userReg.jpg';
                                if(isset($one['avathar'])){
                                    $img='/'.$one['avathar'];
                                }
                                echo $this->Html->image($img, array( 'url' => 
                                    array('controller' => 'groups', 
                                        'action' => 'team',
                                        $one['url']
                                        )

                                    ));  ?>
                            </div>
                            <div class="sugg-details">
                                <p><?php echo $one['mag']; ?></p>
                                <p class='date' ><?php echo $one['date']; ?></p>
                            </div>
                            <div class="sugg-red" >
                                <span data-id="<?php echo $one['id']; ?>" class="closeme">&nbsp;</span>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php } } ?>

            </div>

            <div class="more-notification">
                More Notification  
            </div>
        </div>