                            <style type="text/css">
DIV.list_item_container {
height: 40px;
padding: 0px;
    }
    list_item_container .search-row-sugg{
max-width:60px;

    }
    .list_item_container.sugg-details{
        width:60px;
    }
    #edit_group_members-replace{
        display: none;
    }
    #connectedGroup_list-replace{
        display: none;
    }
</style>

                            <div class="profile-row-mids original_about">
                                <h3 class="common-head-h3">Description</h3>

                                

                                <p id='group_about' ><?php echo $mygroup['Group']['description']; ?></p>
                            </div>
                            <div class="profile-row-mids replace_about">
                                <h3 class="common-head-h3">Description</h3>
                                <div contenteditable id='group_about_edit' style='width:98%;height:auto;' > </div>
                                <div class="share">
                                    </br>
                                            <input type="button"  id="save_about" value="Save" />
                                            <span>&nbsp;</span>
                                            <input type="button"  id="cancel_about" value="Cancel" />
                                </div>
                            </div>
                            <div   class="members-main group-profile">
                                <h3 class="common-head-h3">Members (<?Php echo count($group_members); ?>)</h3>

                                

                                <ul>
                                    
                                    <?php foreach($group_members as $index => $member){ 
                                        
                                            if(isset($member['img']) && ($member['img'] != '') ){
                                                $pic='/'.$member['img'];
                                            }else{
                                                 $pic = 'uploads/pic1.jpg';
                                            }
                                    
                                    ?>
                                    <li>
                                        <div class="memberpic">
                                            <?php echo $this->Html->image($pic); ?>
                                        </div>
                                        <h3><?php echo $member['user_name']; ?></h3>
                                        <p><?php echo '('.$member ['role'].')'; ?></p>
                                        <?php if(in_array(16, $permission)) { ?>
                                        <div class="chatbtn-main">
                                            <div class="share">
                                                
                                                <input type="button" value="chat" />
                                            </div>
                                        </div>
                                        <?php } ?> 
                                    </li>
                                    <?php   }?>


                                </ul>
                            </div>
                             <?php if(in_array(9,$permission)) { ?>
                            <div  id='edit_group_members' class="members-main group-profile">
                                <h3 class="common-head-h3">Invitee (<?Php echo count($group_invitee); ?>)</h3>
                                 <?php if(in_array(9, $permission)) { ?>
                                <div  class="editPencil pencil">&nbsp;</div>
                                 <?php } ?>

                                <ul>
                                    
                                    <?php foreach($group_invitee as $index => $member){ 
                                        
                                            if(isset($member['img']) && ($member['img'] != '') ){
                                                $pic='/'.$member['img'];
                                            }else{
                                                 $pic = 'uploads/pic1.jpg';
                                            }
                                    
                                    ?>
                                    <li>
                                        <div class="memberpic">
                                            <?php echo $this->Html->image($pic); ?>
                                        </div>
                                        <h3><?php echo $member['user_name']; ?></h3>
                                        <p><?php echo '('.$member ['role'].')'; ?></p>
                                        
                                            
                                        <div class="chatbtn-main">
                                            <div class="share">

                                                <input type="button" data-id="<?php echo $member['id'] ?>" class="remove-invitee"  value="remove" />
                                            </div>
                                        </div>
                                        
                                    </li>
                                    <?php   } ?>


                                </ul>

                                
                                <div id='edit-group-members'  >
                                    
                                    <div class="groups" >
                                        <div class ='group-row-main'></div>
                                    </div>
                                            <div class="createG-row">
                                                <div class="createG-row-label">Add Users :</div>
                                                <div class="createG-row-value">
                                                    <input type='search' id='search-user-invitee'  class='form-input2' />
                                                </div>
                                            </div>
                                    <div> &nbsp;</div>
                           
                                   
                                </div>

                               
                            </div>
                             <?php } ?>



                            <div class="members-main group-profile" id="edit_group_members-replace" >
                                <h3 class="common-head-h3">Add New Members </h3>
                                <input type="text" id="auto-addmembers"/>
                        <!-- -->    

                            <div  id="added_member_list" ></div>

                                <div class="share">
                                    <input type="button" id="add_more_members"  value="Add" />
                                </div>

                        <!-- -->
                            </div>
