
const UInavProfil = document.getElementById("nav-profil")
const UIshortProfil = document.getElementById("short-profil")

// tweet popup
const UItweetPopup = document.getElementById("tweet-popup")

const UIopenTweetPopupBtn = document.querySelectorAll(".open-tweet-popup")
const UIcloseTweetPopupBtn = document.getElementById("close-tweet-popup")

//flash message

// responsive nav btn 
const UIappBtn = document.getElementById("app-btn")
const UIcloseAppBtn = document.getElementById("close-app-nav")

const UIdrawer = document.getElementById("drawer")

if(UInavProfil){
    UInavProfil.addEventListener("click",()=>{
        UIshortProfil.classList.toggle("hidden")
    })
}

if(UIappBtn){
    UIappBtn.addEventListener("click",()=>{
        UIdrawer.classList.toggle("hidden")
    })
}
if(UIcloseAppBtn){
    UIcloseAppBtn.addEventListener("click",()=>{
        UIdrawer.classList.add("hidden")
    })
}


// tweet popup
if(UIopenTweetPopupBtn){
    UIopenTweetPopupBtn.forEach(btn => {
        btn.addEventListener("click",(e)=>{
            e.preventDefault()
            UItweetPopup.classList.remove("hidden")
        })
    });
   
}

if(UIcloseTweetPopupBtn){
    UIcloseTweetPopupBtn.addEventListener("click",(e)=>{
        e.preventDefault()
        UItweetPopup.classList.add("hidden")
    })
}

setTimeout(()=>{
    $(".flash").attr("class","hidden")
},2500)