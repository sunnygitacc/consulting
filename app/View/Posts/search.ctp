<?php
    echo $this->Form->create();
    echo $this->Form->input('search');
    
    
    echo $this->Form->submit(__('Submit'));
    echo $this->Form->end();
    debug($users);
?>