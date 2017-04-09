 
<?php foreach($group_members as $member){  ?>
    <div class="profile-row-mids" id="personal_details">

            <div class="education-left">
                <?php echo $this->Html->image('/'.$member['img']); ?>

                <div class="education-left-desc"><?php echo $member['user_name'] ?></div>
            </div>
            <div class="education-desc">
                <h3>Personal Details</h3>
                <div class="edu-desc-row">
                    <div class="edu-desc-row-inner" id="birth_on">
                        <label>Birthday on :</label>
                        <span>21 December</span>
                    </div>
                    <div class="edu-desc-row-inner" id="first_name">
                        <label>Name  :</label>
                        <span><?php echo $member['user_name']?></span>

                    </div>
                  <div class="edu-desc-row-inner" id="first_name">
                        <label>Role  :</label>
                        <span><?php echo $member['role']?></span>

                    </div>

                </div>
                <h3>Contact Details</h3>
                <div class="edu-desc-row">

                    <div class="edu-desc-row-inner" id="mail">
                        <label>Mail :</label>
                        <span></span>
                    </div>
                </div>

            </div>
        
        
    </div>

<?php } if(count($group_members) < 1) {
    
    echo '<h2> No Members</h2>';
} ?>

