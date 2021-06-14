const UIlicence =document.getElementById('licence');
const UIbtnSubmit= document.getElementById('submit');


UIbtnSubmit.addEventListener('click',(e)=>{
        if(UIlicence.checked===false){
            alert('vous devez accepter la licence d\'utilisation');
            e.preventDefault();
        }
})