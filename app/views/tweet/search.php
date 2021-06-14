<?php $title = $_GET["search"] ?>
<?php  require_once(VIEW_ROOT."/layouts/app.php");?>
<?php $all = $data?>
    <div  class="twt-p  ">
        
        <?php  require_once(VIEW_ROOT."/layouts/navbar.php");?>
        
        
        <div id="home" class="border-r-none md:border-r  lg:border-r-0 sm:ml-64 tw-home sm:px-3 ">
            <div class="fixed sm:px-5 px-3 py-3 bg-white home-head flex justify-between">
               <div class="flex"> 
                    <a href="/home" class="mr-5">
                        <svg viewBox="0 0 24 24" class="primaire w-5"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
                    </a>
                    <div class="flex flex-col">
                        <span href="" class=" font-black text-black text-xl">Search for :</span>
                        <span class="text-sm text-gray-600">
                        <?=$_GET["search"]?>
                        </span>
                    </div>
               </div>
                
            </div>
            <div class="pt-12"></div>
            <div id="tweets-profil" class="">
                        <?php 
                            if(!empty($all)) : 
                                foreach($all as $tweet) :?>
                                    <?php  include(VIEW_ROOT."/tweet/show-tweet.php");?>

                        <?php    endforeach;
                            else : 
                                echo "<p class='my-7 text-center ' >No result for <span class='primaire' >$_GET[search]</span> , Try another word </p>";
                            
                            endif;

                        ?>
                        
                        
        
            </div>
        </div>


        
        <?php  require_once(VIEW_ROOT."/layouts/footer.php");?>

    </div>








    
    <?php  require_once(VIEW_ROOT."/layouts/app-foot.php");?>

























