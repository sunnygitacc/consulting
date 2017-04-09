
            <div class="post-main" id="postboxid" >

                <div class="post-options">
                    <span class="iocnfr"></span>Mentor list</h2>
                    <div class="filter-search">
                        <input type="search" data-sort="cover-pic-disc-name" id="visitor-mentor-search" placeholder="Search here.." class="friend-search"  />
                    </div>

                </div>

            </div>

            <div class="profile-row-mids">
                <?php  
                      foreach($menters as $index => $mentor):
                ?>
                
                        <div class="cover-inner-left">
                            <div class="cover-profile-Pic">
                                <?php 
                                $imagePath = PROFILE_IMAGE_PATH_FINAL.$mentor['link'].'_sml.jpeg';
                                                if(!$imagePath) {
                                                        $imagePath = "img/mentorReg.jpg";
                                                }
                                echo $this->Html->image('/'.$imagePath); 
                                ?>
                            </div>
                            <div class="cover-pic-Disc">
                                <div class="cover-pic-disc-name">
                                    <h3><?php echo $mentor['name'] ?></h3>
                                    <h5><?php if(isset($mentor['Mentor']['MentorProfile']['designation'])){echo $mentor['Mentor']['MentorProfile']['designation'];}  ?></h5>
                                </div>
                            </div>
                        </div>
                
                <?php endforeach; ?> 
   
            </div>
<script src="http://listjs.com/no-cdn/list.js"></script>
<script>
    var options = {
  valueNames: [ 'cover-pic-disc-name' ]
};

var userList = new List('users', options);
    </script>