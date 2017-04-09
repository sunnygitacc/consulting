
            <div class="post-main" id="postboxid" >

                <div class="post-options">
                    <span class="iocnfr"></span>Mentor list</h2>
                    <div class="filter-search">
                        <input type="search" data-sort="cover-pic-disc-name" id="mentor-users-list" placeholder="Search here.." class="friend-search"  />
                    </div>

                </div>

            </div>

            <div class="profile-row-mids">
                <?php
                      foreach($menti as $index => $mentor):

                          ?>

                        <div class="cover-inner-left">
                            <div class="cover-profile-Pic">
                                <?php
                                $imagePath = PROFILE_IMAGE_PATH_FINAL.$mentor->profilePic.'_sml.jpeg';
                                                if(!$mentor->profilePic) {
                                                        $imagePath = "img/mentorReg.jpg";
                                                }
                                echo $this->Html->image('/'.$imagePath);
                                ?>
                            </div>
                            <div class="cover-pic-Disc">
                                <div class="cover-pic-disc-name">
                                    <h3><?php echo $mentor->first_name.' '.$mentor->last_name ?></h3>
                                    <h5>xxxxxxxxxxxx</h5>
                                </div>
                            </div>
                        </div>

                <?php endforeach; ?>

            </div>
