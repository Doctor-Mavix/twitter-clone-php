setInterval(()=>{
    if(pause == false){
        pause=true
        $("#lists").load("/users/get",()=>{
            follow()
        })

        $("#followers").load("/followers/get",()=>{
            follow()
        })
        $("#visite-follow").load("/followers/profil/get/"+$("#visite-follow").attr("data-user-id"),()=>{
            follow()
        })

        $(".who-to-follow").load("/users/who-to-follow",()=>{
            follow()
        })
    }
},1000);

let pause = false
const follow = ()=>{
    $(".follow").on("click",(e)=>{
        e.preventDefault();
        pause = false
        const userId = e.currentTarget.getAttribute("data-user-id")
        loadData("/users/follow/"+userId);
    })
}

follow()
