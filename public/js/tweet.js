
const UIremoveTweetMedia = document.getElementById("remove-tweet-media")
const UItweetInputMedia = document.getElementById("tweet-input-media")
const UItweetInputMediaContainer = document.getElementById("tweet-preview-media-contain")

const UIremoveTweetMediaShort = document.getElementById("remove-tweet-media-short")
const UItweetInputMediaShort = document.getElementById("tweet-input-media-short")
const UItweetInputMediaContainerShort = document.getElementById("tweet-preview-media-contain-short")
const UItweetInputBodyShort = document.getElementById("tweet-short")
const UItweetFormShort = document.getElementById("tweet-form-short")


const UItweetFormMediaPreview = document.getElementById("tweet-form-media-preview")
const UItweetFormMediaPreviewShort = document.getElementById("tweet-form-media-preview-short")


const UItweetOptions = document.querySelectorAll(".tweet-option") 
const UItweetCancelOptions = document.querySelectorAll(".cancel-option") 
const UItweetEditOptions = document.querySelectorAll(".edit-option") 


const UIcommentTweet = document.querySelectorAll(".comment") 



 


const upload_file=(inputMedia,inputMediaContainer,previewMedia)=>{
    
    const file_instension=getExtension(inputMedia.value)

    //on verifiera aussi le poid dans le futur
    const extensions = ["jpg","png","jpeg","gif","mp4"]

    if(!inArray(extensions,file_instension)){ 
        alert("Ce type de fichier n'est  pas autorisé");
        inputMediaContainer.classList.add("hidden")

        inputMedia.value="";
    }else{
        inputMediaContainer.classList.remove("hidden")
         
        
        if(inArray(["mp4"],file_instension)){
            element = document.createElement("video")
             element.setAttribute("controls","controls")
        }else{
            element = document.createElement("img")
        }
        previewMedia.innerHTML=`<p class="text-center ">loading file</p>`;
        element.setAttribute("class","w-full h-64  rounded-xl ")
        preview_tweet_media(inputMedia,element ,previewMedia,inputMediaContainer)
        
        
    }
}


const preview_tweet_media = (InputFile,element ,previewMedia,inputMediaContainer)=>{
    const file = InputFile.files[0];
    if (file) {
        if(file.size>1024 * 1024 *5){
            alert("This file is too big ")
            return removeFile(inputMediaContainer,previewMedia)
        }
        console.log(file);
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            previewMedia.innerHTML=""
           element.setAttribute("src", reader.result)
           previewMedia.appendChild(element)
           console.log(previewMedia);
        })
        reader.readAsDataURL(file);
    }

    
}


const removeFile =(inputMedia,previewMedia)=>{
    inputMedia.classList.add("hidden")
    previewMedia.innerHTML =""
}


if(UItweetInputMedia){
        UItweetInputMedia.addEventListener("change",(e)=>{
            upload_file(UItweetInputMedia,UItweetInputMediaContainer,UItweetFormMediaPreview);
        })
}
if(UItweetInputMediaShort){
        UItweetInputMediaShort.addEventListener("change",(e)=>{
            upload_file(UItweetInputMediaShort,UItweetInputMediaContainerShort,UItweetFormMediaPreviewShort);

        })
}
if(UIremoveTweetMedia){
        UIremoveTweetMedia.addEventListener("click",(e)=>{
            removeFile(UItweetInputMediaContainer,UItweetFormMediaPreview);

        })
}
if(UIremoveTweetMediaShort){
        UIremoveTweetMediaShort.addEventListener("click",(e)=>{
            removeFile(UItweetInputMediaContainerShort,UItweetFormMediaPreviewShort);

        })
}



if(UItweetOptions){
    for(let i = 0 ; i<UItweetOptions.length ; i++){
        UItweetOptions[i].addEventListener("click",(e)=>{
            UItweetOptions[i].nextElementSibling.classList.toggle("hidden")  
        })
    }
}
if(UItweetCancelOptions){
    for(let i = 0 ; i<UItweetCancelOptions.length ; i++){
        UItweetCancelOptions[i].addEventListener("click",(e)=>{
            e.preventDefault()
            UItweetCancelOptions[i].closest(".twt-options").classList.toggle("hidden")  
        })
    }
}


if(UItweetEditOptions){
    
    for(let i = 0 ; i<UItweetEditOptions.length ; i++){
        UItweetEditOptions[i].addEventListener("click",(e)=>{
            e.preventDefault()
            UItweetPopup.classList.remove("hidden")
            let value =UItweetEditOptions[i].closest(".twt-info").nextElementSibling.firstElementChild.textContent.trim()
            UItweetInputBodyShort.value=value
            
            let src =UItweetEditOptions[i].closest(".twt-info").nextElementSibling.nextElementSibling.firstElementChild.firstElementChild
            if(src.getAttribute("src") != '/upload/tweet/'){
                UItweetInputMediaContainerShort.classList.remove("hidden")
                UItweetFormMediaPreviewShort.innerHTML=""   
                src = src.getAttribute('src')
                const file_instension = getExtension(src)
                if(inArray(["mp4"],file_instension)){
                    element = document.createElement("video")
                     element.setAttribute("controls","controls")
                }else{
                    element = document.createElement("img")
                }

                element.setAttribute("src",src)
                 element.setAttribute("class","w-full h-64  rounded-xl ")

                 UItweetFormMediaPreviewShort.appendChild(element)

            }
            
            const action ="/tweet/put/"+UItweetEditOptions[i].getAttribute("data-tweet-id")
            UItweetFormShort.setAttribute("action",action)
        })
    }
}

