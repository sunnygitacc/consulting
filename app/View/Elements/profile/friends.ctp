
            <div class="post-main" id="postboxid" >

                <div class="post-options">
                    <span class="iocnfr"></span>Friends list</h2>
                    <div class="filter-search">
                        <input type="search" data-sort="cover-pic-disc-name" id="visitor-friend-search" placeholder="Search here.." class="friend-search"  />
                    </div>

                </div>

            </div>

            <div class="profile-row-mids">
                <?php  
                      foreach($Friends as $index => $post): 
                ?>
                
                        <div class="cover-inner-left">
                            <div class="cover-profile-Pic">
                                    <?php 
                                    $imagePath = "../img/userReg.jpg";
                                    if($post['User']) {
                                            $imagePath = '/'.$post['User']['avatar'];
                                    }
                                    echo $this->Html->image($imagePath,array('url'=>array(
                                        'controller'=> 'profiles','action'=>'visitor',$post['User']['id']
                                    ))); 
                                    ?>
                            </div>
                            <div class="cover-pic-Disc">
                                <div class="cover-pic-disc-name">
                                    <h3><?php echo $post['User']['first_name'];?> <?php echo $post['User']['last_name']; ?></h3>
                                    <h5>Become a doctor</h5>
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