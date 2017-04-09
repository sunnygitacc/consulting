<?php 
echo $this->Html->css('jquery-ui');
echo $this->Html->script('script');
?> 
<script>
    
   var availableTags1 = <?php echo json_encode($countries); ?> 
    </script>
            
<style>
    .error-message 
{
  width  : 100%;
  padding: 3px;
  padding-left: 5px;
 
  font-size: 80%;
  color: white;
  background-color: #900;
  border-radius: 0 0 5px 5px;
 
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
</style>
<div class="fixed-container">
                <div class="register-main">
                    <div class="register-left">
                        <div class="user-reg">
                            <div class="user-regImg">
                                <?php 
                                echo $this->Html->image('userReg.jpg');
                                ?>
                            </div>
                            <div class="user-regDetails">
                                <h2>USER</h2>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</p>
                            </div>
                        </div>
                        <div class="mentor-reg">
                            <div class="user-regImg">
                                <?php 
                                echo $this->Html->image('mentorReg.jpg');
                                ?>
                                
                            </div>
                            <div class="user-regDetails">
                                <h2>MENTOR</h2>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</p>
                            </div>

                        </div>
                    </div>
                    <div class="register-right">
                        <div class="step-main">
                            <div class="step-copy">
                                <h3>REGISTRATION</h3>
                                <h2>STEPS</h2>
                            </div>
                            <div class="step-img">
                                <div class="bg-percent"></div>
                                <?php 
                                echo $this->Html->image('steps.png');
                                ?>
                         
                                <ul class="step-ulist" >
                                    <li class="no1" >1</li>
                                    <li class="no2">2</li>
                                    <li class="no3">3</li>
                                </ul>
                            </div>
                        </div>
                        <div class="register-form-main">
                            
                            <?= $this->Form->create($user); ?>
                            <div class="rows-reg">
                                <div class="rows-reg-left">Account Type</div>
                                <div class="rows-reg-right">
                                    <div id="check_user" class="checkbox-wrapper">
                                        <div  class="custom-check" >
                                            <div id='userdiv'  class="toogle-tick">
                                            </div>
                                            
                                            <input   id='user1' type='checkbox'>
                                           
                                        </div>
                                        <span class="label-chk">User</span>
                                    </div>
                                    <div id="check_mentor" class="checkbox-wrapper">
                                        <div class="custom-check"  >
                                            <div id='mentordiv'  class="toogle-tick">
                                            </div>
                                            <input id='mentor1' type='checkbox'>
                                            
                                        </div>
                                        <span class="label-chk">Mentor</span>
                                    </div>

                                </div>

                            </div>
                            <div class="rows-reg">
                                <div class="rows-reg-left"></div>
                                <div class="rows-reg-right">
                                <?php 
                            if ($this->Form->isFieldError('user_type')) {
                            echo $this->Form->error('user_type');
                            }
                                    ?>
                                </div>
                            </div>
                            <?php 
                            echo $this->Form->create('User',array("validate",'Method'=>'POST','formnovalidate'=>true));
                            echo $this->Form->input('is_mentor',array('id'=>'user_type','type'=>'hidden'));
                            

                            ?>
                            
                            
                            <div class="rows-reg">
                                <div class="rows-reg-left">First Name</div>
                                <div class="rows-reg-right">
                                    <?php 
                                     echo $this->Form->input('first_name',array('class'=>'common-input','type'=>'text','label'=>false,'required'=>true));
                                    ?>
                                </div>
                            </div>
                            <div class="rows-reg">
                                <div class="rows-reg-left">Last Name</div>
                                <div class="rows-reg-right">
                                    <?php 
                                     echo $this->Form->input('last_name',array('class'=>'common-input','type'=>'text','label'=>false,'formnovalidate'=>true));
                                    ?>
                                </div>
                            </div>
                            <div class="rows-reg">
                                <div class="rows-reg-left">Email</div>
                                <div class="rows-reg-right">
                                    <?php 
                                     echo $this->Form->input('email',array('class'=>'common-input','type'=>'text','label'=>false,'type'=>'email','formnovalidate'=>true ,'required'=>true));
                                    ?>
                                </div>
                            </div>
                            <div class="rows-reg">
                                <div class="rows-reg-left">Password</div>
                                <div class="rows-reg-right">
                                    <?php 
                                     echo $this->Form->input('password',array('class'=>'common-input','type'=>'password','label'=>false,'formnovalidate'=>true ,'required'=>true));
                                    ?>
                                </div>
                            </div>

                            <div class="rows-reg date-ofB">
                                <div class="rows-reg-left">Date of Birth</div>
                                <div class="rows-reg-right">
                                    <?php 
                                        echo $this->Form->input('dob', 
                                            array(
                                                'type' => 'date',
                                                'label' => false,
                                                'dateFormat' => 'MDY',
                                                'empty' => array(
                                                    'month' => 'Month',
                                                    'day'   => 'Day',
                                                    'year'  => 'Year'
                                                ),
                                                'minYear' => date('Y')-110,
                                                'maxYear' => date('Y'),
                                                'options' => array('1','2')
                                            )
                                        );

                                    ?>
                                    
                                </div>
                            </div>
                            <div class="rows-reg date-ofB">
                                <div class="rows-reg-left">Gender</div>
                                <div class="rows-reg-right">
                                    <?php 
                                   $options = array('1' => 'Male', '2' => 'Female');
                                   $attributes = array('legend' => false,'required'=>true);
                                   echo $this->Form->radio('gender', $options, $attributes);
                                    ?>
                                </div>
                            </div> 
                            <div class="rows-reg">
                                <div class="rows-reg-left">Country</div>
                                <div class="rows-reg-right">
                                    <?php 
//                                    echo $this->Form->input('country', array(
//                                        'label'=>false,
//                                        'class'=>'custom-select',
//                                        'empty' => 'Select',
//                                        'required'=>true   
//                                    ));
                                    
                                    echo $this->Form->input('countryName',array('class'=>'common-input','type'=>'text','label'=>false,'formnovalidate'=>true));
                                    echo $this->Form->input('country',array('type'=>'hidden','label'=>false,'formnovalidate'=>true));
                                    ?>
                                </div>
                            </div>
                            <div class="rows-reg">
                                <div class="rows-reg-left">State</div>
                                <div class="rows-reg-right">
                                    <?php 
//                                    echo $this->Form->input('state', array(
//                                    'label' => false,
//                                    'required' => true 
//                                     ));
                                    echo $this->Form->input('stateName',array('class'=>'common-input','type'=>'text','label'=>false,'formnovalidate'=>true));
                                    echo $this->Form->input('state',array('type'=>'hidden','label'=>false,'formnovalidate'=>true));
                                    
                                    ?>
                                    <?php ?> 
                                    <p id="add_new_state" style="visibility: hidden" >+ add state</p>
                                </div>
                            </div>
                            <div class="rows-reg">
                                <div class="rows-reg-left">City</div>
                                <div class="rows-reg-right">
                                    <?php 
//                                    echo $this->Form->input('city', array(
//                                    'label'=>false,
//                                    'class'=>'custom-select',
//                                    'options' => array(),
//                                    'empty' => 'Select',
//                                    'required'=>true 
//                                     ));
                                    
                                    echo $this->Form->input('cityName',array('class'=>'common-input','type'=>'text','label'=>false,'formnovalidate'=>true));
                                    echo $this->Form->input('city',array('type'=>'hidden','label'=>false,'formnovalidate'=>true));
                                    
                                    
                                    ?>
                                    <p id="add_new_city" style="visibility: hidden" >+ add city</p>
                                </div>
                            </div>
                            <div class="rows-reg">
                                <div class="rows-reg-left">&nbsp;</div>
                                <div class="rows-reg-right">

                                    <?= $this->Form->button(__('Next'), array('class'=>'common-button')) ?>

                                </div>
                            </div>

                        <?php 
                        
                        echo $this->Form->end();
                        ?>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>


