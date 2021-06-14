<?php $title ="followers"?>
    <?php $tweets =$data;?>
    <?php  require_once(VIEW_ROOT."/layouts/app.php");?>
    <div  class="twt-p  ">

        
        <?php  require_once(VIEW_ROOT."/layouts/navbar.php");?>
            
        <div id="" class="border-r-none md:border-r  lg:border-r-0 ml-64 tw-home px-3 ">
            <div class="fixed border-b sm:px-5 px-3 py-3 bg-white home-head flex justify-between">
                        <div class="flex"> 
                            <a href="/home" class="mr-5">
                                <svg viewBox="0 0 24 24" class="primaire w-5"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
                            </a>
                            <div class="flex flex-col">
                                <span class=" font-black text-black text-xl">Followers</span>
                               
                            </div>
                        </div>
            </div>
            <div class="pt-12"></div>
            <div id="followers">
                <?php Show::loading();?>
            </div>
            
            <?php show_success();?>
            <?php show_errors();?>
            
            
        </div>

        
        
        <?php  require_once(VIEW_ROOT."/layouts/footer.php");?>

    </div>
 
    <?php  require_once(VIEW_ROOT."/layouts/app-foot.php");?>
    





























