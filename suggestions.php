<div class="card-body">
                        <?php 
                        $flag=0;
                            $queryf=mysqli_query($conn,"select * from userdetailstb where id=$lUserId") or die(error_page());
                            $ff=mysqli_fetch_assoc($queryf);
                            $rf=$ff['interests'];
                            $fol=json_decode($ff['following']);
                            $interestsArray=json_decode($rf);
                            $sqlArray = '(' . join(',', $interestsArray) . ')';
                            $sqls="";
                            foreach($interestsArray as $i){
                                $sqls .= "union SELECT * FROM `userdetailstb` where interests like '%$i%' ";
                            }
                            if($sqls==""){
                                // echo "Please add interested tags in your profile";
                                // return;
                                $sqls="select * from `userdetailstb` order by id desc";
                                $flag=1;
                            }
                            if($flag!=1){
                                $sqls=substr($sqls,6); 
                                $sqls.="union select * from `userdetailstb` order by id desc";
                            }
                            $query=mysqli_query($conn,$sqls) or die(error_page());
                            $c=0;
                            while($r=mysqli_fetch_assoc($query)){
                                
                                $aid=$r['id'];
                                if($aid==$lUserId) continue;
                                if(in_array($aid,$fol)) continue;
                                $c++;
                                if($c>10) break;
                        ?>
                        <a class="nav-link" href="profileshow.php?userName=<?php echo $r['username'];?>">
                            <img class="img img-fluid rounded-circle" src="profile/profile_pics/<?php echo $r['profilepic'];?>" style="width:25px;height:25px;"> <?php echo $r['username']; ?>
                        </a>
                        <?php } ?>
                </div>