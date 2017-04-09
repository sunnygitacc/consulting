<div class="mid-section">
                    <div class="row-mid-notification search-notification">
                        <input class="search-notif-input" />
                        <input class="search-notif-button" type="submit" value="&#xf002;" name="search">
                    </div>
                    <div class="entrment-video">


                        <div class="entrment-video-wrapper">
							<?php foreach ($Creativity_player as $key => $player) {


								?>
    <div class="post-users-video">
		<video id="example_video_<?php echo $player->id; ?>"
			   poster='<?php echo 'http://localhost/wizspeak/' . CRE_VIDEO_THUMBNAIL_UPLOAD_FOLDER . $player->link . '_196x110_thumb.png'; ?>'
			   width="100%" height="100%" controls preload="auto" data-setup="{}" controls autoplay>
			<source
				src="<?php echo 'http://localhost/wizspeak/' . CRE_VIDEO_UPLOAD_FOLDER . $player->link . '_720x576_video.mp4' ?>"
				type='video/mp4'/>

		</video>

	</div>


							<?php                }  ?>
                        </div>

                        <div class="entrment-video-details">
							<h3><?php echo $player->title; ?></h3>
                            <div class="entrment-video-details2">
                                <div class="entrment-videod-left">

									<span>Uploaded by <b><?php echo $player->postby_name ; ?></b></span>
                                </div>
                                <div class="entrment-videod-mid">

                                    <div class="share">
                                        <input type="button" value="Follow" class="edit popup" data-rel="sharepopup">
                                    </div>
                                </div>
                                <div class="entrment-videod-right">
                                    <div class="post-users-option">
                                        <ul class="post-option-ulist">
                                            <li>
                                                <span class="star">&nbsp;</span>
                                            </li>
                                            <li>
                                                <span class="share-icon">&nbsp;</span>
                                            </li>
                                        </ul>

                                        <div class="post-likes"> Views</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="share-box-single">
                        <div class="share-box-top">

                            <div class="postedby-image">
								<?php echo $this->Html->image('/user/profile_photo/user_pic/'.$player->postby_pic."_sml.jpeg",array(
									'url' => array('controller' =>'profiles',"action" => "about")
								)); ?>
                            </div>

                            <div class="commnetedby">

                                <textarea class="post-textarea" placeholder="Hey Guys,......" id="field_comment"></textarea>

                            </div>

                        </div>
                        <div class="share-box-bottom">
                            <div class="share-box-checkbox">
                                <div class="custom-check">
                                    <div class="toogle-tick">
                                    </div>
                                    <input type="checkbox" />
                                </div>
                                <span>Public</span>
                            </div>


							<div class="share">
                                <input type="button" value="Send" class="" id="add_creativity_video_comment">
                            </div>
                        </div>
                    </div>
                    <div class="row-mid-notification list-notif-search">
                        <ul>
                            <li>
                                <div class="notif-image">
                                    <img src="assets/images/uploads/pic1.jpg" />
                                </div>
                                <div class="notif-copy">
                                    <h3>Hentry Json</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
                                    <span>19 JUN , 11:42 AM</span>
                                </div>
                            </li>
                            <li>
                                <div class="notif-image">
                                    <img src="assets/images/uploads/pic2.jpg" />
                                </div>
                                <div class="notif-copy">
                                    <h3>Erik Danson</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
                                    <span>19 JUN , 11:42 AM</span>
                                </div>
                            </li>
                            <li>
                                <div class="notif-image">
                                    <img src="assets/images/uploads/pic3.jpg" />
                                </div>
                                <div class="notif-copy">
                                    <h3>Gerorge Jimms</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
                                    <span>19 JUN , 11:42 AM</span>
                                </div>
                            </li>
                            <li>
                                <div class="notif-image">
                                    <img src="assets/images/uploads/pic4.jpg" />
                                </div>
                                <div class="notif-copy">
                                    <h3>Robin Jems</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
                                    <span>19 JUN , 11:42 AM</span>
                                </div>
                            </li>

                        </ul>

					</div>
                </div>
                <div class="right-panel">
                    <div class="right-toggle-button">X</div>
                    <div class="content-right">
                        <div class="friend-mentors">
                            <h3 class="mor-videos">More Videos</h3>
                            <div class="custom-scroll  friend-list video-list">
								<?php foreach ($Creativity_vid as $key => $vid) {

                    ?>
                                <div  class="filter-box">
									<a href="<?php echo 'http://localhost/wizspeak/creativity/player/' . $vid->id ?>">
                                    <div data-rel="sharepopup-video"  class="filter-box-thumb ">
                                        <span class="icon-video">&#xf01d</span>
										<span title="<?php echo $vid->title; ?>"</span>


										<?php echo $this->Html->image('/' . CRE_VIDEO_THUMBNAIL_UPLOAD_FOLDER . $vid->link . '_196x110_thumb.png');
										?>
                                    </div>

                                    <div class="filter-box-details">
										<h3><?php echo $vid->title; ?></h3>
										<div class="details-thumb">Uploaded by
											<b><?php echo $vid->postby_name ; ?></b>
                        </div>
                                    </div>
                                                                                     </a>

								</div>
                                  <?php                }  ?>


							</div>
                            <div class="mentors addbox">

                                <div class="ads">ADS</div>
                                <div class="ads">ADS</div>
                                <div class="ads">ADS</div>
                                <div class="ads">ADS</div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>



    <div class="simple_overlay shareOverlay" id="sharepopup">
        <div class="share-top">

            <div class="postedby-image">
                <img src="assets/images/uploads/profPic.jpg">
            </div>
            <textarea class="comments-share"></textarea>


        </div>
        <div class="share-image">
            <img src="assets/images/uploads/share.jpg" />
        </div>
        <div class="share-with">
            <h3>Shared with:</h3>
            <div class="share-list">

                <div class="sel-hob-main">
                    <div class="sel-copy">Army doctors</div>
                    <div class="sel-close"></div>
                </div>
                <div class="sel-hob-main">
                    <div class="sel-copy">Mentors</div>
                    <div class="sel-close"></div>
                </div>
                <a class="more-people">More People</a>
            </div>

        </div>
        <div class="share-bottom overlay-button">
            <div class="disable-notification">
                <div class="checkbox-wrapper">
                    <div class="custom-check">
                        <div class="toogle-tick">
                        </div>
                        <input type="checkbox" />
                    </div>
                    <span class="label-chk">Disable Notification</span>
                </div>
            </div>
            <div class="share-button-wrapper">
                <input type="submit" class="common-button share" value="SHARE">
                <input type="submit" class="common-button cancel" value="CANCEL">
            </div>

        </div>
    </div>
