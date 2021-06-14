// $("#comment-preview-form")
const UIReplyPopup = document.getElementById("reply-popup")
const UIcommentDiv = document.querySelectorAll(".comment-cont")
const UIcommentForm = document.getElementById("tweet-reply")

const UIcommentInputMedia = document.getElementById("comment-input-media")
const UIcommentInputMediaContainer = document.getElementById("comment-preview-media-contain")
const UIcommentFormMediaPreview = document.getElementById("comment-form-media-preview")
// const UIcommentInputBody = document.getElementById("tweet-short")

const UIshowComment = document.getElementById("show-comment")

const show_comment_form = (url,action)=>{
    $("#comment-preview-form").load(url,()=>{
        pauseLoadCommennt=false
    });
    UIReplyPopup.classList.remove("hidden")
    UIcommentForm.setAttribute("action",action);
}

for(let i = 0 ; i<UIcommentDiv.length ; i++){
    UIcommentDiv[i].addEventListener("click",(e)=>{
        e.preventDefault()
        const tweetId =  UIcommentDiv[i].closest(".reaction").getAttribute('data-tweet-id')
        show_comment_form("/tweet/comment/preview/"+tweetId,"/tweet/comment/post/"+tweetId)
    } )    

}


$("#close-reply-popup").on("click",(e)=>{
    e.preventDefault()
    UIReplyPopup.classList.add("hidden")

})



$("#remove-comment-media").on("click",(e)=>{
    removeFile(UIcommentInputMediaContainer,UIcommentFormMediaPreview);
});

if(UIcommentInputMedia){
    UIcommentInputMedia.addEventListener("change",(e)=>{
        upload_file(UIcommentInputMedia,UIcommentInputMediaContainer,UIcommentFormMediaPreview);

    })
}

  
const editComment = (url)=>{
    $("#comment-body").load(url,()=>{
        console.log(url);
        const contain = document.getElementById("comment-preview-media-contain")
        const form =document.getElementById("comment-form-media-preview")
        const input = document.getElementById("comment-input-media")
        // $("#comment-form-short").attr("action",action);
        $("#comment-preview-media-contain").on("click",(e)=>{
            removeFile(contain,form);
        })

        input.addEventListener("change",()=>{
            upload_file(input,contain,form);
        })
    }) ;

}
// every thing about a specific tweet

$("#tweet-view").load("/tweet/show/"+$("#tweet-view").attr("data-tweet-id"),(responseText,textStatus,XMLHttpRequest)=>{
    $("#show-comment").load("/tweet/comment/get/"+$("#tweet-view").attr("data-tweet-id"))
    
    let pauseLoadCommennt =false;
    setInterval(()=>{
        if(pauseLoadCommennt ==false){
            $("#show-comment").load("/tweet/comment/get/"+$("#tweet-view").attr("data-tweet-id"),()=>{
                $(".comment-option").on("click",(e)=>{
                    pauseLoadCommennt =true
                    const nextEl =e.currentTarget.nextElementSibling
                    nextEl.classList.remove("hidden")
                    
                })
                cancelOptions();
                $(".edit-comment-option").on("click",(e)=>{
                    e.preventDefault()
                    const commentId=  e.currentTarget.getAttribute("data-tweet-id")
                    
                    show_comment_form("/tweet/comment/preview/"+$("#tweet-view").attr("data-tweet-id"),"/comment/put/"+commentId)
                    editComment("/comment/edit/"+commentId)
                })

                $(".love-comment").on("click",(e)=>{
                    const commentId= e.currentTarget.closest(".reaction").getAttribute("data-comment-id")
                    // console.log(commentId);
                    loadData(`/comment/love/${commentId}`,e.currentTarget,"testiaire");
                    // $("#tweet-reations").load(`/tweet/reaction/${commentId}`)
            
                })

            })
    
        }

        $("#tweet-reations").load(`/tweet/reaction/${$("#tweet-view").attr("data-tweet-id")}`,()=>{
            $(".comment").on("click",(e)=>{
                const tweetId= e.currentTarget.closest(".reaction").getAttribute("data-tweet-id")
                show_comment_form("/tweet/comment/preview/"+tweetId,"/tweet/comment/post/"+tweetId)

            })
    
            $(".love").on("click",(e)=>{
                const tweetId= e.currentTarget.closest(".reaction").getAttribute("data-tweet-id")
                loadData(`/tweet/love/${tweetId}`,e.currentTarget,"testiaire");
                // $("#tweet-reations").load(`/tweet/reaction/${tweetId}`)
        
            })
        })

        pauseLoadCommennt=true;
    },(1000))
    
  


   

    $(".edit-option").on("click",(e)=>{

        e.preventDefault()
        const tweetId=e.currentTarget.getAttribute("data-tweet-id")
        UItweetPopup.classList.remove("hidden")
        $("#short-body").load("/tweet/edit/"+tweetId,()=>{
            const contain = document.getElementById("tweet-preview-media-contain-short")
            const form =document.getElementById("tweet-form-media-preview-short")
            const input = document.getElementById("tweet-input-media-short")
            $("#tweet-form-short").attr("action","/tweet/put/"+tweetId);
            $("#tweet-preview-media-contain-short").on("click",(e)=>{
                removeFile(contain,form);
            })
            input.addEventListener("change",()=>{
                upload_file(input,contain,form);
            })
        }) ;

    })
    $(".tweet-option").on("click",(e)=>{
        const nextEl =e.currentTarget.nextElementSibling
        nextEl.classList.remove("hidden")
    })

    cancelOptions();
   

   

    
    


    

   

    
})

