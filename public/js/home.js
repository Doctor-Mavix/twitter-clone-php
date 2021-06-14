const UItwtNames = document.querySelectorAll(".twt-name")
const UItwtNicknames = document.querySelectorAll(".twt-nickname")


const wrapUserInfo = (availableSize)=>{
    for(let i =0; i< UItwtNames.length ; i++){
        let name = UItwtNames[i].textContent
        if(!UItwtNicknames[i]){
            return 
        }
        let nickname = UItwtNicknames[i].textContent 
        if(nickname.length + name.length >availableSize){
            if(name.length > availableSize){
                name =name.slice(0,availableSize)
                name += "..."
                nickname =""
            }
            else{
                let remember = availableSize - name.length
                if(remember >= 0 && remember<2) {
                    name += "."
                    nickname =""
                }
                else{
                    console.log(remember);
                    nickname =nickname.slice(0,remember )
                    nickname += "..."

                }
            }
        }

        UItwtNames[i].innerText = name
        UItwtNicknames[i].innerText = nickname

    }
}

function responsiveWrap(){

        if(screen.width<=360){
            const availableSize =Math.floor( (screen.width * 15)/414)
            wrapUserInfo(availableSize -3 )
        }
        else if(screen.width<=540){
            const availableSize =Math.floor( (screen.width * 15)/414)
            wrapUserInfo(availableSize)
        }
        

        
    
}

responsiveWrap()


