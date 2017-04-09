
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
                                    <?php if(in_array(19, $permission)){ ?>
                                    <div class="editPencil add">&nbsp;</div>
                                    <?php } ?>
                                    <div class="education-desc" id="edu_first">
                                    <h3>Awards</h3>
                                    <?php if(in_array(19, $permission)){ ?>
                                    <?php echo $this->Form->create('user_certifications',array('type'=>'hidden','id'=>'user_certification_id'));  ?>
                                    <div class="edu-desc-row" style="display:none;" id="ui_add">
                                        <div class="edu-desc-row-inner">
                                            <label>Certification</label>
                                            <span>
                                                <?php echo $this->Form->input('certification',array('id' => 'certification_id','type' => 'text','label' => FALSE ,'required' => true)) ?>
                                            </span>
                                        </div>
                                        <div class="edu-desc-row-inner">
                                            <label>Authority</label>
                                            <span>
                                                <?php echo $this->Form->input('authority',array('id' => 'authority_id','type' => 'text','label' => FALSE ,'required' => true)) ?>
                                                <?php echo $this->Form->input('user_id',array('id' => 'user_id','value' => $user_id,'type' => 'hidden','label' => FALSE ,'required' => true)) ?>
                                            </span>
                                        </div>
                                        <div class="edu-desc-row-inner">
                                            <label>Awarded Date</label>
                                            <span>
                                            <?php 
                                                echo $this->Form->input('date_certified', array(
                                                    'type' => 'date',
                                                    'label' => FALSE,
                                                    'type' => 'date',
                                                    'dateFormat' => 'MY',
                                                    'minYear' => date('Y') - 100,
                                                    'maxYear' => date('Y'),
                                                    'required' => true
                                                ));
                                            ?>
                                            </span>
                                        </div>
	 
                                            <div class="share save-education-details">
                                                <input type="button" class="common-button share" value="SAVE" style="margin:10px;">
                                                <input type="button" class="common-button cancel" value="CANCEL" style="margin:10px;">
                                            </div>
                                    </div>
                                    <?php } echo $this->Form->end();   ?>
                                    <div id="test_id"></div>
                                    <?php foreach($certification as $education) { 
                                      $date_from = date_parse($education['UserCertification']['date_certified']);
                                      
                                      $year = $date_from['year'];	
                                     ?>
                                    
                                    	<div class="edu-desc-row" id="recover-<?php echo $education['UserCertification']['id']?>" >
	                                    	<div class="edu-desc-row-inner">
                                                <?php if(in_array(19, $permission)){ ?>
                                                <div class="editPencil pencil editDummy" title="Edit" id="<?php echo $education['UserCertification']['id']?>">&nbsp;</div> 
                                                <div class="editPencil-remove trash" data="certi"  title="Delete" id="<?php echo $education['UserCertification']['id']?>">&nbsp;</div> 
	                                        <?php } ?>
                                                <h4><?php echo $education['UserCertification']['certification']?></h4>
	                                        <p><?php echo $education['UserCertification']['authority'] ?></p>
	                                        <p><?php echo $year ?></p>
                                                </div>
                                    	</div>
                                    
                                    
                                    	
                                    	<!--Education Edit -->
                                        <?php if(in_array(19, $permission)){ ?>
                                        <?php echo $this->Form->create('user_certifications',array('type'=>'hidden','id'=>'user_certification_id_'.$education['UserCertification']['id']));  ?>
                                    	<div class="edu-desc-row" style="display:none;"   id="cer_edit<?php echo $education['UserCertification']['id']?>">
                                            <div class="edu-desc-row-inner">
                                                <label>Certification</label>
                                                <span>
                                                    <?php echo $this->Form->input('certification',array('id' => 'certification_id','type' => 'text','label' => FALSE ,'required' => true,'value' => $education['UserCertification']['certification'] )) ?>
                                                </span>
                                            </div>
                                            <div class="edu-desc-row-inner">
                                                <label>Authority</label>
                                                <span>
                                                    <?php echo $this->Form->input('authority',array('id' => 'authority_id','type' => 'text','label' => FALSE ,'required' => true, 'value' => $education['UserCertification']['authority'])) ?>
                                                    <?php echo $this->Form->input('id',array('type' => 'hidden','label' => FALSE ,'required' => true, 'value' => $education['UserCertification']['id'])) ?>
                                                    <?php echo $this->Form->input('user_id',array('type' => 'hidden','label' => FALSE ,'required' => true, 'value' => $user_id )) ?>
                                                </span>
                                            </div>
                                            <div class="edu-desc-row-inner">
                                                <label>Awarded Date</label>
                                                <span>
                                                <?php 
                                                    echo $this->Form->input('date_certified', array(
                                                        'type' => 'date',
                                                        'label' => FALSE,
                                                        'type' => 'date',
                                                        'dateFormat' => 'MY',
                                                        'minYear' => date('Y') - 100,
                                                        'maxYear' => date('Y'),
                                                        'required' => true,
                                                        'selected' => $education['UserCertification']['date_certified']
                                                    ));
                                                ?>
                                                </span>
                                            </div>

                                          
                                            <div class="share">
                                                                            <input type="button" class="common-button share cer_edit" value="SAVE" 
                                                                                            style="margin:10px;" id="edit-<?php echo $education['UserCertification']['id']?>">
                                                                            <input type="button" class="common-button cancel cer_edit" value="CANCEL" style="margin:10px;">
                                            </div>
                                        </div>
                                        <?php echo $this->Form->end(); } ?>
                                    <!-- Edu edit end here -->
                                    	
									<?php } ?>
                                    
                                </div>
                                    
                                </div>
                                
                                
                                
                            </div>
                        </div>
