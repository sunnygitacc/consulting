
                        <div class="post-main" id="postboxid" >
                            <div class="profile-row-mids">
                                <div class="left-container-profile tab1">
                                    <ul>
                                    <li>
                                    <?php echo $this->Html->link('about',$user_id.'/about'); ?>
                                    </li>
                                    <li>
                                    <?php echo $this->Html->link('education',$user_id.'/education'); ?>
                                    </li>
                                    <li>
                                    <?php echo $this->Html->link('experience',$user_id.'/experience'); ?>
                                    </li>
                                    <li>
                                    <?php echo $this->Html->link('Awards',$user_id.'/award'); ?>
                                    </li>
                                    <li>
                                    <?php echo $this->Html->link('Certifications',$user_id.'/certification'); ?>
                                    </li>
                                    </ul>
                                </div>
                                <div class="left-container-profile tab2">
                                    <div class="profile-row-mids" id="about_me_labels">
                                        <?php if(AuthComponent::user('id') == $user->id){ ?>
                                        <div class="editPencil pencil" id="about_me">&nbsp;</div>
                                        <?php } ?>
                                        <h3>About</h3>
                                        <p><?php echo $user->profileStatus; ?></p>
                                        <h3>Ratting</h3>
                                        <div class="rating">
                                        <span data-id="5" >☆</span><span data-id="4" >☆</span><span data-id="3" >☆</span><span data-id="2" >☆</span><span data-id="1" >☆</span>
                                        </div>
                                        <h3>Your rating</h3>
                                        <div id="my_rate" >
                                          <span data-id="5" >&#x2605;</span><span data-id="4" >☆</span><span data-id="3" >☆</span><span data-id="2" >☆</span><span data-id="1" >☆</span>
                                        </div>
                                    </div>
                                    <div class="profile-row-mids" id="about_me_edit" style="display:none;">
                                        <textarea id="about_me_edit_text" name="about_me_edit" style="width:99%;font-family: inherit;" rows="4"><?php echo $user->profileStatus; ?></textarea>
                                        <div class="share">
                                                                <input type="button" class="common-button share" value="SAVE" style="margin:10px;">
                                                                <input type="button" class="common-button cancel" value="CANCEL" style="margin:10px;">
                                                            </div>
                                    </div>
                                </div>



                            </div>
                        </div>
