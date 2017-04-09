                    <div class="header-right" >
                        <ul class="ulist-header">

                            <li class="search-icon-main">
                                <a href="#" class="searchicon">
                                &nbsp;
                            </a>
                            </li>
                            <li>
                                <a href="#" class="envelope">
                                &nbsp;
                                </a>

                            </li>
                            <li class="notification-main">
                                <a href="#" class="globe notification">
                                &nbsp;
                                </a>
                                <div  class="notification-drop">
                                    <ul class="notification-menu">
                                        <li class="selectTab" data-tab="all">User</li>
                                        <li data-tab="ambition">Ambition</li>
                                        <li data-tab="hobbies">Hobbies</li>
                                        <li data-tab="teams">Teams</li>
                                        
                                    </ul>
                                    <div  id="user-notification-div" class="tab-container">
                                        <?php foreach($notificatons as $one_not) { ?>
                                        <div class="tab-item" id="all">
                                            <div class="notification-list-main">
                                                <div class="notification-list-row">
                                                    <div class="search-row-sugg">
                                                        <div class="sugg-image">
                                                            <?php echo $this->Html->image('../'.$one_not['avathar']); ?>
                                                        </div>
                                                        <div class="sugg-details">
                                                            <p><?php echo $one_not['text'].' '.$one_not['icon']; ?></p>
                                                            <p class='date' ><?php echo$one_not['date']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="more-notification" >More Notification</div>
                                        </div>
                                        <div class="tab-item" id="ambition">
                                            <div class="notification-list-main">
                                                <div class="notification-list-row">
                                                    <?php if($one_not['tab']==1){ ?>
                                                    <div class="search-row-sugg">
                                                        <div class="sugg-image">
                                                            <?php echo $this->Html->image('../'.$one_not['avathar']); ?>
                                                        </div>
                                                        <div class="sugg-details">
                                                            <p><?php echo $one_not['text'].' '.$one_not['icon']; ?></p>
                                                            <p class='date' ><?php echo $one_not['date']; ?></p>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>

                                            </div>
                                            <div class="more-notification">More Notification</div>
                                        </div>
                                        <div class="tab-item" id="hobbies">
                                            <div class="notification-list-main">
                                                <div class="notification-list-row">
                                                    <?php if($one_not['tab']==2){ ?>
                                                    <div class="search-row-sugg">
                                                        <div class="sugg-image">
                                                            <?php echo $this->Html->image('../'.$one_not['avathar']); ?>
                                                        </div>
                                                        <div class="sugg-details">
                                                            <p><?php echo $one_not['text'].' '.$one_not['icon'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$one_not['date']; ?></p>
                                                            <p>das</p>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>

                                            </div>
                                            <div class="more-notification">More Notification</div>
                                        </div>
                                        <div class="tab-item" id="teams">
                                            <div class="notification-list-main">
                                                <div class="notification-list-row">
                                                    <?php if($one_not['tab']==3){ ?>
                                                    <div class="search-row-sugg">
                                                        <div class="sugg-image">
                                                            <?php echo $this->Html->image('uploads/pic1.jpg'); ?>
                                                        </div>
                                                        <div class="sugg-details">
                                                            <p><?php echo $one_not['text'].' '.$one_not['icon'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$one_not['date']; ?></p>
                                                         
                                                        </div>
                                                    </div>
                                                    <?php } ?>

                                                </div>

                                            </div>
                                            <div class="more-notification">More Notification</div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <?php 
                                echo $this->Html->link('',
                                        array('controller'=>'ambitions','action'=>'index')
                                        ,array('class'=>'home'));
                                ?>

                            </li>
                            <li>
                                <a href="#" class="power-off">
                                &nbsp;</a>

                            </li>

                        </ul>

                    </div>