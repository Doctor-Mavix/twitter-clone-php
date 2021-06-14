



var httpRequest= new XMLHttpRequest();
var httpRequestLove= new XMLHttpRequest();

const UIloves = document.querySelectorAll(".love")




const  loadData =(link,target="",className="",method="GET",data=[])=>{
    

    httpRequest.open(method,link,true);
    httpRequest.onreadystatechange = function(){
        if(httpRequest.readyState==4){
           if(target !=""){
            if(target.closest(".tw-icon")){
                target.innerHTML =httpRequest.responseText
                target.closest(".tw-icon").classList.toggle(className)
            }
           }
        }
    }
    httpRequest.setRequestHeader('X-Requested-With','xmlhttprequest');
    if(data.length >0){
        var form =new FormData();
        data.forEach((key,value) => {
            form.append(key,value);
        });
        httpRequest.send(form);
    }
    else{
        httpRequest.send();
    }


}



UIloves.forEach(btn => {
    btn.closest(".cursor-pointer"). addEventListener('click',(e)=>{
        e.preventDefault();
        const tweet_id =btn.closest(".reaction").getAttribute("data-tweet-id")
        loadData(`/tweet/love/${tweet_id}`,btn,"testiaire");
    });
    
});