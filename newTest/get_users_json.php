<?php 
include '../includes/conn.inc.php';
$user_data = array();
$users = mysqli_query($conn,"select id,username from userdetailstb");
// $users=mysqli_fetch_assoc($users);
foreach($users as $key => $val)
{
$user_data[$key]['id'] = $val['id'];
$user_data[$key]['name'] = $val['username'];
// $user_data[$key]['avatar'] = "../profile/profile_pics/".$val['profilepic'];

}
header('Content-Type: application/json');
echo json_encode($user_data);