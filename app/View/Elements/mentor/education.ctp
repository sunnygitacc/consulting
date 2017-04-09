
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

                                    <div class="editPencil add">&nbsp;</div>

                                    <div class="education-desc" id="edu_first">
                                    <h3>Education</h3>
                                    <?php echo $this->Form->create('user_educations',array('type'=>'hidden','id'=>'user_education_id'));  ?>

                                    <div class="edu-desc-row" style="display:none;" id="ui_add">
                                        <div class="edu-desc-row-inner">
                                            <label>Education</label>
                                            <span>
                                                <?php echo $this->Form->input('education',array('id' => 'education_id','type' => 'text','label' => FALSE ,'required' => true)) ?>
                                            </span>
                                        </div>
                                        <div class="edu-desc-row-inner">
                                            <label>School/Institute</label>
                                            <span>
                                                <?php echo $this->Form->input('institute',array('id' => 'institute_id','type' => 'text','label' => FALSE ,'required' => true)) ?>
                                            </span>
                                        </div>
                                        <div class="edu-desc-row-inner">
                                            <label>University</label>
                                            <span>
                                                <?php echo $this->Form->input('university',array('id' => 'institute_id','type' => 'text','label' => FALSE ,'required' => true)) ?>
                                            </span>
                                        </div>
                                        <div class="edu-desc-row-inner">
                                            <label>Date From</label>
                                            <span>
                                            <?php
                                                echo $this->Form->input('date_from', array(
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
                                        <div class="edu-desc-row-inner">
                                            <label>Date To</label>
                                            <span>
                                            <?php
                                                echo $this->Form->input('date_to', array(
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



                                    <div id="test_id"></div>
                                    <?php foreach($educations as $education) {
                                      $date_from = date_parse($education->date_from);
                                      $date_to = date_parse($education->date_to);

                                      $year = $date_from['year']. " - ".$date_to['year'];
                                     ?>

                                    	<div class="edu-desc-row" id="recover-<?php echo $education->id?>" >
	                                    	<div class="edu-desc-row-inner">

                                                <div class="editPencil pencil editDummy" id="<?php echo $education->id?>">&nbsp;</div>
                                                <div class="editPencil-remove trash" data="edu"  title="Delete" id="<?php echo $education->id?>">&nbsp;</div>

	                                        <h4><?php echo $education->education?></h4>
	                                        <p><?php echo $education->institute.' ('.$education->university.' )'?></p>
	                                        <p><?php echo $year ?></p>
                                                </div>
                                    	</div>



                                    	<!--Education Edit -->
                                        <?php echo $this->Form->create('user_education',array('type'=>'hidden','id'=>'user_education_id_'.$education->id));  ?>
                                    	<div class="edu-desc-row" style="display:none;"   id="edu_edit<?php echo $education->id?>">
                                            <div class="edu-desc-row-inner">
                                                <label>Education</label>
                                                <span>
                                                    <?php echo $this->Form->input('education',array('id' => 'education_id','type' => 'text','label' => FALSE ,'required' => true,'value' => $education->education )) ?>
                                                </span>
                                            </div>
                                            <div class="edu-desc-row-inner">
                                                <label>School/Institute</label>
                                                <span>
                                                    <?php echo $this->Form->input('institute',array('id' => 'institute_id','type' => 'text','label' => FALSE ,'required' => true, 'value' => $education->institute)) ?>
                                                </span>
                                            </div>
                                            <div class="edu-desc-row-inner">
                                                <label>University</label>
                                                <span>
                                                    <?php echo $this->Form->input('university',array('id' => 'institute_id','type' => 'text','label' => FALSE ,'required' => true, 'value' => $education->university)) ?>
                                                    <?php echo $this->Form->input('id',array('type' => 'hidden','label' => FALSE ,'required' => true, 'value' => $education->id)) ?>
                                                </span>
                                            </div>
                                            <div class="edu-desc-row-inner">
                                                <label>Date From</label>
                                                <span>
                                                <?php
                                                    echo $this->Form->input('date_from', array(
                                                        'type' => 'date',
                                                        'label' => FALSE,
                                                        'type' => 'date',
                                                        'dateFormat' => 'MY',
                                                        'minYear' => date('Y') - 100,
                                                        'maxYear' => date('Y'),
                                                        'required' => true,
                                                        'selected' => $education->date_from
                                                    ));
                                                ?>
                                                </span>
                                            </div>
                                            <div class="edu-desc-row-inner">
                                                <label>Date To</label>
                                                <span>
                                                <?php
                                                    echo $this->Form->input('date_to', array(
                                                        'type' => 'date',
                                                        'label' => FALSE,
                                                        'type' => 'date',
                                                        'dateFormat' => 'MY',
                                                        'minYear' => date('Y') - 100,
                                                        'maxYear' => date('Y'),
                                                        'required' => true,
                                                        'selected' => $education->date_to
                                                    ));
                                                ?>
                                                </span>
                                            </div>

                                            <div class="share">
                                                                            <input type="button" class="common-button share edu_edit" value="SAVE"
                                                                                            style="margin:10px;" id="edit-<?php echo $education->id?>">
                                                                            <input type="button" class="common-button cancel edu_edit" value="CANCEL" style="margin:10px;">
                                            </div>
                                        </div>
                                        <?php echo $this->Form->end(); ?>
                                    <!-- Edu edit end here -->

									<?php } ?>

                                </div>

                                </div>



                            </div>
                        </div>
