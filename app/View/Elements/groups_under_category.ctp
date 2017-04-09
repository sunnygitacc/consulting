<?php

//debug($subcate);
$group = $this->requestAction('user_group_relations/groups_under_category/'.$subcate);

foreach ($group as $g){
    
    echo '<li>'.$g['Group']['name'].' </li>';
}

?>