const UIeditProfilModal = document.getElementById("edit-profil")

const UIopenEditProfilBtn = document.getElementById("edit-profil-btn")
const UIcloseEditProfilBtn = document.getElementById("close-edit-profil")


const UItweetsProfilBtn = document.getElementById("tweets-profil-btn")
const UIrepliesProfilBtn = document.getElementById("replies-profil-btn")
const UImediaProfilBtn = document.getElementById("media-profil-btn")
const UIlikesProfilBtn = document.getElementById("likes-profil-btn")

const UItweetsProfil = document.getElementById("tweets-profil")
const UIrepliesProfil = document.getElementById("replies-profil")
const UImediaProfil = document.getElementById("media-profil")
const UIlikesProfil = document.getElementById("likes-profil")


const UIbarners = document.querySelectorAll(".barners");




// function
const windowView = (currentTab,currentTabBtn)=>{
    let tabs = [UItweetsProfil,UIrepliesProfil,UImediaProfil,UIlikesProfil]
    let tabBtns = [UItweetsProfilBtn,UIrepliesProfilBtn,UImediaProfilBtn,UIlikesProfilBtn]
    
    tabBtns.forEach(tabBtn=>{
        if(tabBtn == currentTabBtn){
            tabBtn.classList.add("primaire")
            tabBtn.classList.add("border-b-primaire")
        }
        else{
            tabBtn.classList.remove("primaire")
            tabBtn.classList.remove("border-b-primaire")
        }
    })
    tabs.forEach(tab=>{
        if(tab == currentTab){
            tab.classList.remove("hidden")
        }
        else{
            tab.classList.add("hidden")
        }
    })
}



const barnersDynamic = ()=>{
    for(let i = 0;i<UIbarners.length;i++){
        barners =UIbarners[i].getAttribute("data-barners")
        UIbarners[i].style.backgroundImage =`url(../upload/barners/${barners}) `

    }
}

barnersDynamic()



// event 
if(UIopenEditProfilBtn){
    UIopenEditProfilBtn.addEventListener("click",(e)=>{
        e.preventDefault()
        UIeditProfilModal.classList.remove("hidden")
    })
}

if(UIcloseEditProfilBtn){
    UIcloseEditProfilBtn.addEventListener("click",(e)=>{
        e.preventDefault()
        UIeditProfilModal.classList.add("hidden")
    })
}




if(UItweetsProfilBtn){
    UItweetsProfilBtn.addEventListener("click",(e)=>{
        e.preventDefault()
        windowView(UItweetsProfil,UItweetsProfilBtn)
    })
}
if(UIrepliesProfilBtn){
    UIrepliesProfilBtn.addEventListener("click",(e)=>{
        e.preventDefault()
        windowView(UIrepliesProfil,UIrepliesProfilBtn)
    })
}
if(UImediaProfilBtn){
    UImediaProfilBtn.addEventListener("click",(e)=>{
        e.preventDefault()
        windowView(UImediaProfil,UImediaProfilBtn)
    })
}
if(UIlikesProfilBtn){
    UIlikesProfilBtn.addEventListener("click",(e)=>{
        e.preventDefault()
        windowView(UIlikesProfil,UIlikesProfilBtn)
        
    })
}


// $("#likes-profil").load("/profil/likes");

// $("#likes-profil-btn").on("click",()=>{
//     $("#likes-profil").load("/profil/likes");
// })