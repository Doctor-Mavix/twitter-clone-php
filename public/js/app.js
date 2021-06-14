const UInav =document.getElementById('nav');
const UIuserNavBtn =document.getElementById('user-nav-btn');
const UIuploadImage= document.getElementById('uploadImage');
const UIuploadFile= document.getElementById('uploadFile');
const UIformView= document.getElementById('form-view');
const UIdebug = document.getElementById('debug')

//------- messages const
const UIsubmitMsg = document.getElementById('submit-msg');
const UImp3Msg =document.getElementById('btn-msg-mp3');
const UIgallerieMsg =document.getElementById('btn-msg-gallerie');
const UIemojiMsg =document.getElementById('btn-msg-emoji');
const UItextMsg =document.getElementById('msg-text');
const UIdiscussionHead =document.getElementById('discussion-head');

//-------------------

//---------- page article 

// const UIrepondreCommentaire = document.querySelectorAll('.repondre');

//-------------------------
const UIloveBtn =document.querySelectorAll('.post-love-btn');
// const UIloveSpan =document.querySelectorAll('.love-span');
let view=[];
let views='views';

let target_id;

let UIloveSpan;

let loves;
var httpRequest= new XMLHttpRequest();
var httpRequestLove= new XMLHttpRequest();

class DynamismeWeb {
    constructor (){}

    //méthode static
    static drop_link(){
        UIuserNavBtn.nextElementSibling.classList.toggle('display-inline');
    }
    
    static nav_liens(e){
        
        if(scrollY>700 && document.body.clientWidth>=580){
            UInav.lastElementChild.style.display ='none';
        }
        else{
            UInav.lastElementChild.style.display ='block';
        }
    }
    
    static upload_image(){
            let image_instension,image_liens;
            image_liens=UIuploadImage.value;
            //on verifiera aussi le poid dans le futur
            image_instension=image_liens.split('.').pop().toLowerCase();
            
            if(image_instension=='jpg' || image_instension=='gif'|| image_instension=='jpeg' || image_instension=='png' ){
                console.log(image_instension) 
            }
            else{
                alert("Ces types de fichiers ne sont pas autorisé");
                UIuploadImage.value="";
            }
    }
    static upload_file(){
            let image_instension,image_liens;
            image_liens=UIuploadFile.value;
            //on verifiera aussi le poid dans le futur
            image_instension=image_liens.split('.').pop().toLowerCase();
            
            if(image_instension=='jpg' || image_instension=='gif'|| image_instension=='jpeg' || image_instension=='png' || image_instension=='mp4' || image_instension=='avi'){
                console.log(image_instension) 
            }
            else{
                alert("Ces types de fichiers ne sont pas autorisé");
                UIuploadFile.value="";
            }
    }
    //-------------------------------------------------------------------------------------
    //genre method pour gérer les vues des articles
    static view_post(){
        const ratio=0.1
        const options ={
            root:null,
            rootMargin: '0px',
            threshold: ratio
        }
        const handlerIntersect =function (entries , observer){
            entries.forEach(function (entry){
             if (entry.intersectionRatio >ratio) {
                views =entry.target.dataset['view']
                httpRequest.open('POST','app/tache/post_view.php',true);
                httpRequest.onreadystatechange = function(){
                    if(httpRequest.readyState==4){
                     //   UIdebug.innerHTML=httpRequest.responseText
                    }
                }
                
                // httpRequest.setRequestHeader('Content-Type','application/x-www-form-urlencoded')
                // console.log("a");
                var data =new FormData();
                httpRequest.setRequestHeader('X-Requested-With','xmlhttprequest')
                data.append('views_id',views)
                httpRequest.send(data)
                observer.unobserve(entry.target)
             }
            
            })
    
        }
        const observer = new IntersectionObserver(handlerIntersect, options)
        
        document.querySelectorAll('.article').forEach(function (r) {
            observer.observe(r)
        })
    }
    //aimer une publication
    static lovePost(e){
        e.preventDefault();
        var ltarget=e.target;
        if(ltarget.getAttribute('href') !==null){
            ltarget.classList.toggle('active')
            UIloveSpan=e.target
        }
        else{
            UIloveSpan=e.target.parentElement;
            ltarget.parentElement.classList.toggle('active')
        }
        httpRequest.open('POST','app/tache/love_post.php',true);
        loves =UIloveSpan.dataset['love'];
        httpRequest.onreadystatechange = function(){
            if(httpRequest.readyState==4){
               UIloveSpan.innerHTML='<i class="fa fa-heart"></i> '+httpRequest.responseText
            }
        }
        var loveData =new FormData();
        httpRequest.setRequestHeader('X-Requested-With','xmlhttprequest');
        loveData.append('love',loves);
        httpRequest.send(loveData);
    

    }
    //envoyer un messages 
    static sentMessage(e){
        httpRequest.open('POST','app/tache/sent_message.php',true);
        httpRequest.setRequestHeader('X-Requested-With','xmlhttprequest');
        var textMessage =new FormData();
        target_id=UIdiscussionHead.dataset['discussion'];
        console.log(target_id);
        if(UItextMsg.value==''){//on ajoutera les medias ici aussi
            return ;
        }
        textMessage.append('text_content',UItextMsg.value);
        textMessage.append('target_id',target_id);
        
        httpRequest.onreadystatechange = function(){
            if(httpRequest.readyState==4){
            }
        }
        httpRequest.send(textMessage);
        UItextMsg.value='';
    }
    
}

UIuserNavBtn.addEventListener('click',DynamismeWeb.drop_link);
window.addEventListener('scroll',DynamismeWeb.nav_liens);
UIloveBtn.forEach(btn => {
    console.log(btn);
    btn.addEventListener('click',DynamismeWeb.lovePost);
    
});
//appel de la méthod static pour aider répondre
// appel de la méthod static pour gerer les vue(atteint)
DynamismeWeb.view_post(); 
if(UIuploadImage!==null){
    UIuploadImage.addEventListener('change',DynamismeWeb.upload_image);
}
if(UIuploadFile !==null){
    UIuploadFile.addEventListener('change',DynamismeWeb.upload_image);
}
if(UIsubmitMsg !== null){
    UIsubmitMsg.addEventListener('click',DynamismeWeb.sentMessage);
}

// setInterval('load_messages()',1500);

// UIrepondreBtn.forEach(repondreBtn => {
//     repondreBtn.addEventListener('click',innitReply);
// });

// console.log(debug);
