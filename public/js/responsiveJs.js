const UImessageContent =document.getElementById('message_content');
const UImessageListe =document.getElementById('message_list');
const UImessageBody =document.getElementById('messages-body');

function responsiveMessage(){
    if(screen.width<580){

        if(UImessageBody!==null){
            UImessageContent.classList.add('current');
            UImessageListe.style.display="none";
        }
        else{
            UImessageListe.classList.add('current');
            console.log(UImessageListe);
            UImessageContent.style.display="none";
        }
    }
}
responsiveMessage();
// screen.width.addEventListener('change',responsiveMessage);