<div class="mentors">
    <h2>
        <span class="iocnmen"></span>Mentors</h2>
    <div class="custom-scroll mentors-list-main">
    	<?php
        //$userMentors = $this->requestAction('user_mentor_followers/i_follows/'.$user['User']['id']);

	      foreach($userMentors as $index => $mentor):

	    ?>
        <div class="mentor-row">
            <div class="mentor-pic">
                <?php
                $imagePath = PROFILE_IMAGE_PATH_FINAL.$mentor->first_name.'_sml.jpeg';
				if(!$imagePath) {
					$imagePath = "img/mentorReg.jpg";
				}
                echo $this->Html->image('/'.$imagePath); ?>
            </div>
            <div class="mentor-detail">
                <h4><?php echo $mentor->first_name." ".$mentor->last_name;  ?></h4>
                <p>Mentor</p>
            </div>
            <div class="mentor-mail">
                <a href="#" class="envelope"></a>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>
