                            <?php if(in_array(2,$permission)) { ?>
                            <div class="post-main" id="postboxid" >
                                <textarea placeholder="Hey Guys,......" id="post_box" class="post-textarea"></textarea>
                                <div id="preview_postimage" >

                                </div>
                                <div id="preview_postvideo" >


                                </div>
                                <div id="preview_postaudio" >


                                </div>
                                <div id="preview_postdoc" >


                                </div>
                                <progress class="progress-video" value="0" max="100"></progress>
                                <div class="post-options">
                                    <ul class="post-ulist">
                                        <li>
                                            <span class="camera">&nbsp;</span>
                                        </li>
                                        <li>
                                            <span class="video-camera">&nbsp;</span>
                                        </li>
                                        <li>
                                            <span class="file-text">&nbsp;</span>
                                        </li>
                                        <li>
                                            <span class="volume-off">&nbsp;</span>
                                        </li>
                                        <li>
                                            <span class="map-marker">&nbsp;</span>
                                        </li>
                                    </ul>
                                    <div class="share">
                                        <input type="button"  id="share" value="Share" />
                                    </div>

                                </div>


                      
                            </div>
                            <?php } ?>
                            <?php if(in_array(1,$permission)) { ?>
                            <div id='Posts'>

                                <?php echo  $this->element('wall',array('table' => 'UserAmbitionPost')); ?>
                            </div>

                            <?php
                            echo $this->Paginator->next('Show more star wars posts...');
                            }
                            ?>
