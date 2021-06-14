const inArray=(array,value)=>{
    for(let i = 0; i<array.length ;i++){
        if(array[i] == value)
            return true
        
    }
 }


 
const getExtension =(file)=>{
    return file.split('.').pop().toLowerCase();
}


const cancelOptions = ()=>{
    $(".cancel-option").on('click',(e)=>{
        e.preventDefault()
        e.currentTarget.closest(".twt-options").classList.add("hidden")
        pauseLoadCommennt =false;
    })
}