<?php 
        $user = $data->user;
        $tweets = $data->tweets ;
        $likes = $data->likes;
        $replys = $data->replys;
        // dd($user);
?>
<?php $title =$user->username?>


<?php  require_once(VIEW_ROOT."/layouts/app.php");?>

<?php $title ="profil"?>

    <div  class="twt-p  ">
        
        <?php  require_once(VIEW_ROOT."/layouts/navbar.php");?>

            
        <div id="home" class="border-r-none md:border-r  lg:border-r-0 sm:ml-64 tw-home sm:px-3 ">
            <div class="fixed sm:px-5 px-3 py-3 bg-white home-head flex justify-between">
               <div class="flex"> 
                    <a href="/home" class="mr-5">
                        <svg viewBox="0 0 24 24" class="primaire w-5"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
                    </a>
                    <div class="flex flex-col">
                        <a href="" class=" font-black text-black text-xl"><?=$user->fullname;?></a>
                        <span class="text-sm text-gray-600">
                            <?= is_array($tweets) ?count($tweets) :0?> Tweet
                        </span>
                    </div>
               </div>
                <!-- <svg viewBox="0 0 24 24" class="primaire h-5"><g><path d="M22.772 10.506l-5.618-2.192-2.16-6.5c-.102-.307-.39-.514-.712-.514s-.61.207-.712.513l-2.16 6.5-5.62 2.192c-.287.112-.477.39-.477.7s.19.585.478.698l5.62 2.192 2.16 6.5c.102.306.39.513.712.513s.61-.207.712-.513l2.16-6.5 5.62-2.192c.287-.112.477-.39.477-.7s-.19-.585-.478-.697zm-6.49 2.32c-.208.08-.37.25-.44.46l-1.56 4.695-1.56-4.693c-.07-.21-.23-.38-.438-.462l-4.155-1.62 4.154-1.622c.208-.08.37-.25.44-.462l1.56-4.693 1.56 4.694c.07.212.23.382.438.463l4.155 1.62-4.155 1.622zM6.663 3.812h-1.88V2.05c0-.414-.337-.75-.75-.75s-.75.336-.75.75v1.762H1.5c-.414 0-.75.336-.75.75s.336.75.75.75h1.782v1.762c0 .414.336.75.75.75s.75-.336.75-.75V5.312h1.88c.415 0 .75-.336.75-.75s-.335-.75-.75-.75zm2.535 15.622h-1.1v-1.016c0-.414-.335-.75-.75-.75s-.75.336-.75.75v1.016H5.57c-.414 0-.75.336-.75.75s.336.75.75.75H6.6v1.016c0 .414.335.75.75.75s.75-.336.75-.75v-1.016h1.098c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"></path></g></svg> -->
            </div>
            <div class="pt-12"></div>
            <div id="barners" class="w-full">
                <div class="barners w-full" data-barners ="<?=$user->barners?>">

                </div>

                <div class="profil-info px-3">
                    <div class="flex justify-between">
                        <div class="profil-img">
                            <img src="/upload/profil/<?=$user->profil_picture?>" alt="">
                        </div>
                        <div class="mt-20" id="visite-follow" data-user-id="<?=$user->id?>">
                            <a href="" id="" data-user-id="<?=$user->id?>" class="  follow  px-4 py-2  <?php echo $data->status =="follow" ? "follow-class" : "unfollow-class"; ?>"><?=$data->status?></a>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-black text-xl"><?=$user->fullname;?></span>
                        <span class="text-gray-500">@<?=$user->username;?></span>
                    </div>
                    <div class="mt-5">
                        <div class="text-gray-700">
                            <?php show($user->bio,"Edit your profile to add your bio")?>
                        </div>
                        <div class="mt-3 flex">
                            <svg viewBox="0 0 24 24" class="w-5 tw-icon  "><g><path d="M19.708 2H4.292C3.028 2 2 3.028 2 4.292v15.416C2 20.972 3.028 22 4.292 22h15.416C20.972 22 22 20.972 22 19.708V4.292C22 3.028 20.972 2 19.708 2zm.792 17.708c0 .437-.355.792-.792.792H4.292c-.437 0-.792-.355-.792-.792V6.418c0-.437.354-.79.79-.792h15.42c.436 0 .79.355.79.79V19.71z"></path><circle cx="7.032" cy="8.75" r="1.285"></circle><circle cx="7.032" cy="13.156" r="1.285"></circle><circle cx="16.968" cy="8.75" r="1.285"></circle><circle cx="16.968" cy="13.156" r="1.285"></circle><circle cx="12" cy="8.75" r="1.285"></circle><circle cx="12" cy="13.156" r="1.285"></circle><circle cx="7.032" cy="17.486" r="1.285"></circle><circle cx="12" cy="17.486" r="1.285"></circle></g></svg>
                            <span class="ml-2 text-gray-600">Joined <?=joined_date($user->created_at)?></span>
                        </div>
                        <div class="mt-3 flex">
                            <div class="mr-5">
                                <span class="font-bold"><?=$user->total_following?></span>
                                <span class="text-gray-600">Following</span>     
                            </div>
                            <div class="">
                                <span class="font-bold"><?=$user->total_follower?></span> 
                                <span class="text-gray-600">Follower</span>
                            </div>
                        </div>
                    </div>
                </div>

                <?php show_success();?>
                <?php show_errors();?>

                <div class="">
                    <div class=" flex justify-space-between w-full border-b ">
                        <a href="" class="w-1/5 text-center  hover-white primaire border-b-primaire font-bold hover-color-primaire text-gray-600 py-3 " id="tweets-profil-btn">
                            <div class="">Tweets</div>
                        </a>
                        <a href="" class="text-center  hover-white  font-bold hover-color-primaire text-gray-600 py-3  w-2/5" id="replies-profil-btn">
                            <div class=" ">Tweets & replies</div>
                        </a>
                        <a href="" class="text-center  hover-white  font-bold hover-color-primaire text-gray-600 py-3  w-1/5" id="media-profil-btn">
                            <div class=" ">Media</div>
                        </a>
                        <a href="" class="text-center  hover-white  font-bold hover-color-primaire text-gray-600 py-3  w-1/5" id="likes-profil-btn">
                            <div class=" ">Likes</div>
                        </a>
                    </div>

                    <div id="tweets-profil" class="">
                        <?php 
                            if(is_array($tweets)) : 
                                foreach($tweets as $tweet) :?>
                                    <?php  include(VIEW_ROOT."/tweet/show-tweet.php");?>

                        <?php    endforeach;
                            else : 
                                echo "<p class='my-3 text-center ' >No tweet by <span class='primaire' >@$user->username</span> now </p>";
                            
                            endif;

                        ?>
                        
        
                    </div>
                    <div id="replies-profil" class="hidden">
                       
                        <?php 
                            if(is_array($replys) && !empty($replys)) : 
                                foreach($replys as $tweet) :?>
                                    <?php  include(VIEW_ROOT."/tweet/show-tweet.php");?>

                        <?php    endforeach;
                            else : 
                                echo "<p class='my-3 text-center ' >No tweet or replies by <span class='primaire' >@$user->username</span> now </p>";
                            
                            endif;

                        ?>
                    </div>

                    <div id="media-profil" class="hidden">
                        
                        <?php 
                            if(is_array($tweets)) : 
                                foreach($tweets as $tweet) :?>
                                    <?php  
                                        if(!empty($tweet->media )){
                                            include(VIEW_ROOT."/tweet/show-tweet.php");
                                        } 
                                        else { 
                                            echo "<p class='my-3 text-center ' >No media tweet by <span class='primaire' >@$user->username</span> now </p>";
                                        }     
                                    ?>

                        <?php    endforeach;
                            else : 
                                echo "<p class='my-3 text-center ' >No media tweet by <span class='primaire' >@$user->username</span> now </p>";
                            
                            endif;

                        ?>
                        

                    </div>
                    
                    <div id="likes-profil" class="hidden">
                      
                        
                        <?php 
                            if(is_array($likes) && !empty($likes)) : 
                                foreach($likes as $tweet) :?>
                                    <?php  
                                            include(VIEW_ROOT."/tweet/show-tweet.php");
                                    ?>

                        <?php    endforeach;
                            else : 
                                echo "<p class='my-3 text-center ' >No like tweet for <span class='primaire' >@$user->username</span> now </p>";
                            
                            endif;

                        ?>
                             
                    </div>

                    <div class="content  mb-4">
                            
                            <!-- Who to follow section -->
                        <div class="suggest-follow  ">
                                <div class="head border-b flex justify-between p-2">
                                    <p class="font-bold">Who to follow</p>
                                    
                                </div>

                                <?php  include(VIEW_ROOT."/profil/who-to-follow.php");?>
                                
                        
                                
                                
                                <div class="show-more border-b text-sm border-gray-200 hover:bg-gray-100 px-3 py-3">
                                    <a href="" class="primaire">Show more</a>

                                </div>
                            </div>
                           
                    </div>
                </div>

            </div>
            
        </div>

        
        <?php  require_once(VIEW_ROOT."/layouts/footer.php");?>


    </div>








    

    <script src="/js/upload.js"></script>
    <script src="/js/profil.js"></script>

    <?php  require_once(VIEW_ROOT."/layouts/app-foot.php");?>



























