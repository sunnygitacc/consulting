                       <div id="hidden_forms" style='visibility: hidden' >
                         <?php 
                        echo $this->Form->create('post_box',array('type'=>'hidden','id'=>'form_image'));                        
                        echo $this->Form->input('image',array('id'=>'post_box_image','type'=>'file','name'=>'postimage[]','label'=>false));
                        echo $this->Form->end();
                        
                        
                        echo $this->Form->create('post_box_video', array('url' => array('controller' => 'posts', 'action' => 'add_postvideo_ajax' ) ) );
                        echo $this->Form->input('post_box_video',array('type'=> 'file'));
                        echo $this->Form->end();
                        
                        echo $this->Form->create('audio',array('id' =>'post_box_audio_form' ));
                        echo $this->Form->input('audio_file',array('id'=> 'post_box_audio', 'type' => 'file' ));
                        echo $this->Form->end();
                        
                        echo $this->Form->create('doc',array('id' =>'post_box_doc_form' ));
                        echo $this->Form->input('doc_file',array('id'=> 'post_box_doc', 'type' => 'file' ));
                        echo $this->Form->end();
                        
                        ?>

                        <form name="cover_pic_pos" action="/wizspeakv254/groups/change_coverpic_pos" method="POST" id="cover_pic_pos">
                            <input type="text" id="cover_top"  name="top"  />
                            <input type="text" id="cover_left"  name="left"  />
                            <input type="text" id="cover_group_id"  name="id"  />
                        </form>  
                       </div>