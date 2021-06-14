//recharge automatique de mon messagerie
function load_messages() {
    if(UIdiscussionHead==null){
        return;
    }
    target_id=UIdiscussionHead.dataset['discussion'];
    $('.messages').load('app/tache/load_messages.php',{['target_id']:target_id})
}
// recharge automatiquement la liste des messageries 
function load_messages_liste(){
    $('#all_discussion').load('app/tache/load_messages_list.php');
}
// recharge automatiquement les reactions de chaque acticle 
const UIcurentPostReaction = document.getElementById('reaction-post');
let post_id;
function load_reactions(){
    post_id= UIcurentPostReaction.dataset['reaction'];
    $('#reaction-post').load('app/tache/load_reaction.php',{['post_id']:post_id})

}


// recharge automatiquement les commentaires 
const article_id = document.getElementById('post-appat').dataset['view'];
// console.log(article_id);
function load_commentaire(){
    $('#commentaires').load('app/tache/load_commentaire.php',{['article_id']:article_id})
}
//recharge automatique de mon messagerie
setInterval('load_messages()',1500);
setInterval('load_messages_liste()',1000);
//recharge automaiquement des commentaires
setInterval('load_commentaire()',2000);
//recharge automaiquement des réactions
setInterval('load_reactions()',2000);

let UIrepondreBtn = document.querySelectorAll('.repondre');

UIrepondreBtn.forEach(repondreBtn => {
    repondreBtn.addEventListener('click',innitReply);
});

function innitReply(e){
    let per =e.target.parentElement.dataset['react']
    console.log(per);
}










//post de commentaires
const UIbtnComment = document.getElementById("btn-comment");
const UIcommentInput =document.getElementById("comment-text");
function addComment(){
    $('#debug').load('app/tache/addComment.php',{['comment']:UIcommentInput.value,['article_id']:article_id})
    load_commentaire();
    UIcommentInput.value="";
}

// console.log(UIrepondreBtn);

// $(document).ready(function (){
//     $('.repondre').on('click',function(){
//         console.log(this);
//     })

// });

UIbtnComment.addEventListener('click',addComment);


