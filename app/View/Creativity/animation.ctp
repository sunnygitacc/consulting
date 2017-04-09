<div class="right-extended">
    <ul class="filter-cr">
        <li class="filterSel" data-tab="filter-all"><span class="seclectdot"></span>All</li>
        <li data-tab="filter-images"><span class="camera_creative_icon"></span> Images</li>
        <li data-tab="filter-videos"><span class="video-camera"></span> Videos</li>
        <li data-tab="filter-documents"><span class="file-text"></span> Documents</li>
        <li data-tab="filter-audios" class="volume-off-li"><span class="volume-off"></span>Audios</li>
    </ul>
    <div class="flr-left-section">
        <div class="flr-search">
            <input type="input" id="searchtext" name="filter-search" class="filterSR-input" />
            <input type="submit" id="searchsub" value="&#xf002;" class="filterSR-submit" />

        </div>
        <div><?php
//        echo $this->Form->create('UserCreativityPost', array(
//            'url' => array_merge(array('action' => 'index'), $this->params['pass'])
//            ));
//        echo $this->Form->input('Title', array('div' => false, 'empty' => true)); // empty creates blank option.
			//
//        echo $this->Form->submit(__('Search', true), array('div' => false));
//        echo $this->Form->end();

    ?>
        </div>
                    <div class="post-main" id="postboxid" >
                        <textarea placeholder="Hey Guys,......" id="post_box" class="post-textarea"></textarea>
                        <div id="preview_postimage" >
                            <div class="meta-form"  >
								<?php echo $this->Form->create('creativity', array('id' => 'creativity_form')); ?>
                                <div class="createG-row"><h3 class="creativity-upload-head" >Upload</h3></div>
                                <div class="createG-row">
                                        <div class="createG-row-label">Select file :</div>
                                                <div class="createG-row-value">

                                                        <?php echo $this->Form->input('file',array('id'=>'file','class'=>'form-input1','type'=>'file','label'=> false)); ?>

                                                </div>
								</div>
                                <div class="createG-row">
                                        <div class="createG-row-label"></div>
                                                <div class="createG-row-value">
                                                    <div  id="preview_cre_image"></div>
                                                </div>
								</div>


								<div class="createG-row">
                                        <div class="createG-row-label"> Name :</div>
                                                <div class="createG-row-value">
													<?php echo $this->Form->input('title', array('id' => 'title_id', 'class' => 'common-input1', 'type' => 'text', 'label' => false)); ?>
                                                </div>
                                </div>
                                <div class="createG-row">
                                        <div class="createG-row-label">Category :</div>
                                        <div class="createG-row-value">

											<?php
                                    echo $this->Form->input('category', array(
                                    'label'=>false,
                                    'class'=>'form-input',
                                    'class'=>'form-input',
                                    'options' => array(1=>'Movies', 2=>'Music', 3=>'Sports', 4=>'Nature', 5=>'Science', 6=>'Comedy', 7=>'Tutorials', 8=>'Animation'),
                                    'empty' => 'Select',
                                    'required'=>true
                                     ));
                                ?>
                                </div>
                                </div>

                                <div class="createG-row">
                                        <div class="createG-row-label">Tag :</div>
                                        <div class="createG-row-value">
                                                <input type="text" value="" id='tags' class="form-input1" />  <button type="button" style='visibility: hidden;' id="add_button_creativity" >Add</button>
                                        </div>
                                </div>


                            <div class="createG-row">

                                <div class="createG-row-value">
                                    <div class="creativitytags"></div>
                                </div>
                            </div>
<?php
                                    echo $this->Form->input('tag',array('id'=>'tags_id','class'=>'common-input','type'=>'hidden'));
                                    echo $this->Form->input('button_selected',array('id'=>'button_selected','class'=>'common-input','type'=>'hidden'));
?>
                            <?php echo  $this->Form->end(); ?>
                            </div>




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
                                    <span class="camera_creative">&nbsp;</span>
                                </li>
                                <li>
                                    <span class="video-camera_creative">&nbsp;</span>
                                </li>
                                <li>
                                    <span class="doc_creativity">&nbsp;</span>
                                </li>
                                <li>
                                    <span class="audio_creativity">&nbsp;</span>
                                </li>
                                <li>

                            </ul>
                            <div class="share">
                                <input type="button"  id="creativity_share" value="Share" />
                            </div>

                        </div>



                    </div>
    </div>
    <div class="flr-right-section">
        <div id="ads1" class="ads">ADS</div>
        <div class="ads">ADS</div>
    </div>
    <div class="clear"></div>
    <div class="filter-contents">
        <div id="filter-videos" class="filter-con-row">
            <h3 class="filter-head">Videos<a href="#seeall">(see all)</a></h3>
            <div class="filter-con-row-inner">
				<?php foreach ($Creativity_av as $key => $vid) {

                    ?>

				<div class="filter-box">
					<a href="<?php echo 'http://localhost/wizspeakv254/creativity/player/' . $vid->id ?>">
						<div data-rel="sharepopup-video" class="filter-box-thumb video_view_popupp">
							<span class="icon-video">&#xf01d</span>
							<span title="<?php echo $vid->title; ?>"</span>

							<?php echo $this->Html->image('/' . CRE_VIDEO_THUMBNAIL_UPLOAD_FOLDER . $vid->link . '_196x110_thumb.png');
							?>

						</div>

						<div class="filter-box-details">
							<h3><?php echo $vid->title; ?></h3>
					</a>
					<div class="details-thumb">Uploaded by
						<b><?php echo $vid->first_name . ' ' . $vid->last_name; ?></b>
					</div>
				</div>
			</div>
                 <?php                }  ?>
            </div>
        </div>


        <div id="filter-images" class="filter-con-row">
            <h3 class="filter-head">Images<a href="#seeall">(see all)</a></h3>
            <div class="filter-con-row-inner">
				<?php foreach ($Creativity_ai as $key => $image) {
    // pr($Creativity_img);
                    ?>
                <div class="filter-box">
                    <div class="filter-box-thumb">


						<a title="<?php echo $image->title; ?>"

						   href="<?php echo 'http://localhost/wizspeak/' . CRE_IMAGE_UPLOAD_FOLDER . $image->link; ?>"
						   rel="lightbox">
							<?php echo $this->Html->image('/' . CRE_IMAGE_UPLOAD_FOLDER . $image->link);
                           ?>  </a>

                    </div>
                    <div class="filter-box-details">
						<h3><?php echo $image->title; ?></h3>
						<div class="details-thumb">Uploaded by
							<b><?php echo $image->first_name . ' ' . $image->last_name; ?></b>

						</div>
                    </div>
                </div>
                <?php                }  ?>

            </div>
        </div>
        <div id="filter-documents" class="filter-con-row">
            <h3 class="filter-head">Documents<a href="#seeall">(see all)</a></h3>
            <div class="filter-con-row-inner">
                <?php foreach ($Creativity_ad as $key => $doc)  {

					?>


					<div class="filter-box">
						<div class="filter-box-thumb">
							<?php echo $this->Html->image('uploads/creativity_doc.jpg'); ?>

							<span class="icon-doc">
                            <?php
							echo $this->Html->image('down.png', array('url' => '/' . CRE_DOC_FOLDER . $doc->link));
							?>
                        </span>
						</div>
						<div class="filter-box-details">
							<h3><?php echo $doc->title; ?></h3>
							<div class="details-thumb">Uploaded By
								<b><?php echo $doc->first_name . ' ' . $doc->last_name; ?></b>
							</div>
						</div>
					</div>
                <?php                }  ?>

            </div>
        </div>

        <div id="filter-audios" class="filter-con-row">
            <h3 class="filter-head">Music<a href="#seeall">(see all)</a></h3>
            <div class="filter-con-row-inner">
				<?php foreach ($Creativity_aa as $key => $aud) {

                    ?>

					<div class="filter-box">
						<a href="<?php echo 'hhttp://localhost/wizspeak/creativity/audio/' . $aud->id ?>">
							<div class="filter-box-thumb">
								<div data-rel="sharepopup-video">


									<?php echo $this->Html->image('uploads/creativity_aud.jpg'); ?>
									<span class="icon-video">&#xf01d</span>
								</div>
							</div>
						</a>
						<div class="filter-box-details">
							<h3><?php echo $aud->title; ?></h3></a>
							<div class="details-thumb">Uploaded by
								<b><?php echo $aud->first_name . ' ' . $aud->last_name; ?></b>
							</div>
						</div>
					</div>

				<?php                }  ?>


			</div>
        </div>
    </div>
</div>


<div class="clear"></div>
</div>
</div>
</div>
<div class="clear"></div>
<?php
  echo $this->element('popUp');
  echo $this->element('hidden_forms');
  echo $this->element('video_popup');

echo $this->element('create_group');
  ?>


<?php


echo $this->Html->script('script');

?>
<script>



</script>
