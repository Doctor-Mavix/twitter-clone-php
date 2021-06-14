const UIeditProfilImg = document.getElementById("edit-profil-img")
const UIeditingProfilImg = document.getElementById("editing-img")

const UIeditProfilBarners  = document.getElementById("edit-profil-barners")
const UIeditingBarners = document.getElementById("editing-barners")


const  upload_image =(input)=>{
    let image_instension,image_liens;
    image_liens=input.value;
    //on verifiera aussi le poid dans le futur
    image_instension=image_liens.split('.').pop().toLowerCase();
    
    const extensions = ["jpg","png","jpeg"]

   
    if(!inArray(extensions,image_instension)){ 
        alert("Ce type de fichier n'est pas autorisé");
        input.value="";
    }else{
        if(input == UIeditProfilImg){
            preview_profil_picture(input)
        }else {
            preview_barners(input)
        }
    }

}

const preview_profil_picture = (InputFile)=>{
    const file = InputFile.files[0];

    if (file) {
      const reader = new FileReader();

    reader.addEventListener("load", () => {
        UIeditingProfilImg.setAttribute("src",reader.result)
    })
    reader.readAsDataURL(file);

    
}
}



const preview_barners = (InputFile)=>{
    const file = InputFile.files[0];

    if (file) {
      const reader = new FileReader();

    reader.addEventListener("load", () => {
        UIeditingBarners.style.backgroundImage =`url(${reader.result}) `

    })
    reader.readAsDataURL(file);

    
}
}







if(UIeditProfilImg){
    UIeditProfilImg.addEventListener("change",()=>{
        upload_image(UIeditProfilImg)
    })
}


if(UIeditProfilBarners){
    UIeditProfilBarners.addEventListener("change",()=>{
        upload_image(UIeditProfilBarners)
    })

}

