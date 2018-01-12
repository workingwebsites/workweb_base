<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/users/library/Users.php');

$User = new Users;

//===== LOOK UP USERS =====//
$str_sql = "SELECT firstname as 'First Name', lastname as 'Last Name', username, email, login_group, status, id"
            ." FROM employee "
            ." ORDER BY  firstname, lastname, username";

$results = $User->DoQuery($str_sql);

//Parse user results
if(empty($results)){
  $ar_return = 'null';
}else{
  $ar_return = $results;
/*
  foreach ($results as $row) {
    //Add edit button
    $row['id'] = '<button type="button" class="btn" ng-click="userEdit('.$row['id'].')"><i class="fas fa-edit"></i></button>';
    //Add to array
    $ar_return[] = $row;
  }
*/

}

//===== RETURN DATA =====//
echo  json_encode ($ar_return);
?>
