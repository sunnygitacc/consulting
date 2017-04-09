

<div class="full-container main-content">
            <div class="fixed-container">
                <div class="left-container-profile">
                    <div class="profile-top-section">
                       
                       
                       
                    </div>
                    <div class="profile-main-section">
                        <div class="left-panel">
                            <div class="content-left">
                                <div class="groups">
                                    
                                   
                                 
                                </div>
                            </div>
                        </div>
                        
                        <div class="profile-mid-section" id="media-tabs" >
                                 <div class="profile-mid-section">
                            <div class="profile-row-mids">
                                <div class="editPencil pencil">&nbsp;</div>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a</p>
                            </div>
                            <div class="profile-row-mids">
                            
                                <div class="editPencil add">&nbsp;</div>
                                
                                
                                <div class="education-left">
                                    <img src="assets/images/uploads/education.jpg" />
                                    <div class="education-left-desc">St Alberts University</div>
                                </div>
                                <div class="education-desc">
                                    <h3>Education</h3>
                                    <div class="edu-desc-row">
                                        <h4>St. Alberts university Alba</h4>
                                        <p>2013 current</p>
                                    </div>
                                    <div class="edu-desc-row">
                                        <h4>Noth stair middle school, Alba</h4>
                                        <p>2011 - 2013</p>
                                    </div>
                                    <div class="edu-desc-row">
                                        <h4>Praire star school, Alba</h4>
                                        <p>2009 - 2011</p>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-row-mids">
                          
                                <div class="editPencil pencil">&nbsp;</div>
                               
                                <div class="education-left">
                                    <img src="assets/images/uploads/profilePic_2.jpg" />
                                    <div class="education-left-desc">Edward Snowman</div>
                                </div>
                                <div class="education-desc">
                                     <?php foreach ($Creativity_sa as $key => $editd) { 
     
                    ?>
                                    <h3>Personal Details</h3>
                                    <div class="edu-desc-row">
                                        <div class="edu-desc-row-inner">
                                            <label>Title :</label>
                                            <span><?php  echo  $editd['Post']['title']; ?></span>
                                        </div>
                                        <div class="edu-desc-row-inner">
                                            <label>Tags :</label>
                                            <span><?php  echo  $editd['Post']['keywords']; ?></span>
                                        </div>
                                        <div class="edu-desc-row-inner">
                                            <label>category:</label>
                                            <span><?php  echo $editd['Post']['postto_id'].$Creativity_cat[ $editd['Post']['postto_id']]; ?>
                                            
       
        
    </span>
                                            
                                        </div>

                                    </div>
                                    <h3>Personal Details</h3>
                                    <div class="edu-desc-row">
                                        <div class="edu-desc-row-inner">
                                            <label>Via mobile :</label>
                                            <span>123123213</span>
                                        </div>
                                        <div class="edu-desc-row-inner">
                                            <label>Mail :</label>
                                            <span>test@test.com</span>
                                        </div>
                                        <div class="edu-desc-row-inner">
                                            <label>Address :</label>
                                            <span>address 10 , 10 line , alba</span>
                                        </div>

                                    </div>
<?php                }  ?>
                                </div>
                            </div>
                                     <?php if($p_edit) { ?>
                            <div class="profile-row-mids" id="personal_details_edit" style="display:none;">
                            	<div class="education-left">
                                    <?php echo $this->Html->image('/'.$avathar_mid); ?>
                                    <div class="education-left-desc"><?php echo $user['User']['first_name']. " ". $user['User']['last_name']?></div>
                                </div>
                                <?php $this->Form->create('User',array('id'=> 'Edit_User_Details')); ?> 
                                <div class="education-desc">
                                    <h3>Personal Details</h3>
                                    <div class="edu-desc-row">
                                        <div class="edu-desc-row-inner">
                                            <label>Birthday on</label>
                                            <span>
                                                <?php 
                                                    echo $this->Form->input('dob', array(
                                                        'type' => 'date',
                                                        'label' => FALSE,
                                                        'type' => 'date',
                                                        'dateFormat' => 'DMY',
                                                        'minYear' => date('Y') - 113,
                                                        'maxYear' => date('Y') - 13,
                                                        'required' => true,
                                                        'selected' => $user['User']['dob']
                                                    ));
                                                ?>
                                                
                                            </span>
                                        </div>
                                        <div class="edu-desc-row-inner">
                                            <label>First Name</label>
                                            <span>
                                                <?php echo $this->Form->input('first_name',array('type'=> 'text','id'=> 'first_name_in','required' => TRUE ,'label' => False)); ?>
                                            </span>
                                        </div>
                                        <div class="edu-desc-row-inner">
                                            <label>Last Name</label>
                                            <span>
                                                <?php echo $this->Form->input('last_name',array('type'=> 'text','id'=> 'last_name_in','required' => TRUE ,'label' => False)); ?>
                                            </span>
                                        </div>
                                        <div class="edu-desc-row-inner">
                                            <label>Home town</label>
                                            
                                            <span>
                                                <?php echo $this->Form->input('city',array('type'=> 'text','id'=> 'city_in','required' => TRUE ,'label' => False)); ?>
                                            </span>
                                        </div>

                                    </div>
                                    <h3>Contact Details</h3>
                                    <div class="edu-desc-row">

                                        <div class="edu-desc-row-inner">
                                            <label>Mail</label>
                                            <span>
                                                <?php echo $this->Form->input('email',array('type'=> 'text','id'=> 'mail_in','required' => TRUE ,'label' => False)); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="share-button-wrapper">
                                    <span class="share">
					                <input type="button" class="common-button share" value="SAVE" style="margin:10px;">
					                <input type="button" class="common-button cancel" value="CANCEL" style="margin:10px;">
                                    </span>
				</div>
                                
                                <?php echo $this->Form->end(); ?> 
                            </div>
                            <?php } ?>
                        </div>        
                        </div>
                        
                        
                    </div>
                </div>
                <div class="right-panel">
                    <div class="right-toggle-button">X</div>
                    
                </div>
    
                <div class="clear"></div>
            </div>
        </div>
        <?php   echo $this->element('hidden_forms');  ?>