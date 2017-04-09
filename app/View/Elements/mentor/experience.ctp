
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
                                    <h3>Experience</h3>
                                    <?php echo $this->Form->create('user_work',array('type'=>'hidden','id'=>'user_work_id'));  ?>

                                    <div class="edu-desc-row" style="display:none;" id="ui_add">
                                        <div class="edu-desc-row-inner">
                                            <label>Job Title</label>
                                            <span>
                                                <?php echo $this->Form->input('jobtitle',array('id' => 'title_id','type' => 'text','label' => FALSE ,'required' => true)) ?>
                                                <?php echo $this->Form->input('user_id',array('id' => 'title_id','value' => $user_id,'type' => 'hidden','label' => FALSE ,'required' => true)) ?>
                                            </span>
                                        </div>
                                        <div class="edu-desc-row-inner">
                                            <label>Company</label>
                                            <span>
                                                <?php echo $this->Form->input('company',array('id' => 'company_id','type' => 'text','label' => FALSE ,'required' => true)) ?>
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
                                    <?php  echo $this->Form->end();   ?>
                                    <div id="test_id"></div>
                                    <?php foreach($experience as $education) {

                                      $date_from = date_parse($education-> date_from);
                                      $date_to = date_parse($education->date_to);

                                      $year = $date_from['year']. " - ".$date_to['year'];
                                     ?>

                                    	<div class="edu-desc-row" id="recover-<?php echo $education->id ?>"  >
	                                    	<div class="edu-desc-row-inner">

                                                <div class="editPencil pencil editDummy" id="<?php echo $education->id ?>">&nbsp;</div>
                                                <div class="editPencil-remove trash" data="work"  title="Delete" id="<?php echo $education->id ?>">&nbsp;</div>

	                                        <h4><?php echo $education-> company ?></h4>
	                                        <p><?php echo $education-> jobtitle ?></p>
	                                        <p><?php echo $year ?></p>
                                                </div>
                                    	</div>



                                    	<!--Education Edit -->

                                        <?php echo $this->Form->create('user_work',array('type'=>'hidden','id'=>'user_work_id_'.$education->id));  ?>
                                    	<div class="edu-desc-row" style="display:none;"   id="exp_edit<?php echo $education->id ?>">
                                            <div class="edu-desc-row-inner">
                                                <label>Jobtitle</label>
                                                <span>
                                                    <?php echo $this->Form->input('user_id',array('id' => 'title_id','value' => $user_id,'type' => 'hidden','label' => FALSE ,'required' => true)) ?>
                                                    <?php echo $this->Form->input('jobtitle',array('id' => 'work_id','type' => 'text','label' => FALSE ,'required' => true,'value' => $education->jobtitle )) ?>
                                                </span>
                                            </div>
                                            <div class="edu-desc-row-inner">
                                                <label>Company</label>
                                                <span>
                                                    <?php echo $this->Form->input('id',array('type' => 'hidden','label' => FALSE ,'required' => true, 'value' => $education->id )) ?>
                                                    <?php echo $this->Form->input('company',array('id' => 'company_id','type' => 'text','label' => FALSE ,'required' => true, 'value' => $education->company)) ?>
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
                                                                            <input type="button" class="common-button share exp_edit" value="SAVE"
                                                                                            style="margin:10px;" id="edit-<?php echo $education->id ?>">
                                                                            <input type="button" class="common-button cancel exp_edit" value="CANCEL" style="margin:10px;">
                                            </div>
                                        </div>
                                        <?php echo $this->Form->end(); ?>

                                    <!-- Edu edit end here -->
<?php } ?>


                                </div>

                                </div>


                            </div>
                        </div>
