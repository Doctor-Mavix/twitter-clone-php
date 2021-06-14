const UIsignUpBtn = document.getElementById("sign-up-btn")

const UImodal = document.getElementById("modal")

const UInext = document.getElementById("next")
const UIprev = document.getElementById("prev")

const UIpart1 = document.getElementById("part-1")
const UIpart2 = document.getElementById("part-2")
const UIpart3 = document.getElementById("part-3")

const UIinputEmail = document.getElementById("email")
const UIinputFullname = document.getElementById("fullname")
const UIinputUsername = document.getElementById("username")
const UIinputPassword = document.getElementById("password")
const UIinputConfirmePassword = document.getElementById("confirme-password")
const UIsubmit = document.getElementById("submit")

const UIinputMonth = document.getElementById("month")
const UIinputDay = document.getElementById("day")
const UIinputYear = document.getElementById("year")
const UIbirthday = document.getElementById("birthday")

const UIpreviewInfo = document.getElementById("preview-info")
const UIpreviewFullName = document.getElementById("preview-fullname") 
const UIpreviewEmail = document.getElementById("preview-email") 
const UIpreviewDate = document.getElementById("preview-date") 



let currentPart = 1;

const showSignupForm=(e)=>{
  e.preventDefault();
  modal.classList.toggle("hidden")
}



const modalView =()=>{
  if(currentPart ==1){
    UIprev.classList.add("sr-only")
    UInext.classList.remove("sr-only")

    UIpart1.classList.remove("hidden")
    UIpart2.classList.add("hidden")
    UIpart3.classList.add("hidden")
  }
  if(currentPart ==2){
    UIprev.classList.remove("sr-only")
    UInext.classList.remove("sr-only")

    UIpart1.classList.add("hidden")
    UIpart2.classList.remove("hidden")
    UIpart3.classList.add("hidden")
  }
  if(currentPart ==3){
    UInext.classList.add("sr-only")

    UIpart1.classList.add("hidden")
    UIpart2.classList.add("hidden")
    UIpart3.classList.remove("hidden")
  
    UIpreviewFullName.innerText = UIinputFullname.value
    UIpreviewEmail.innerText = UIinputEmail.value

    UIpreviewDate.innerText = `${UIinputDay.value} ${UIinputMonth.value} ${UIinputYear.value}`  
  }

}

const yearSelect =()=>{
  let year = new Date()
  year =year.getFullYear()
  

  for(let i = year; i>=1960 ; i--){
    UIinputYear.innerHTML +=`<option value="${i}">${i}</option>`
  }
}
const daySelect = (day)=>{
  UIinputDay.innerHTML =''
  for(let i = 1 ; i<=day ; i++){
    if(i<10){
      UIinputDay.innerHTML +=`<option value="0${i}">0${i}</option>`
    }
    else{
      UIinputDay.innerHTML +=`<option value="${i}">${i}</option>`

    }
  }
}

const validate = (field , rule)=>{
  const value = field.value
  const border = field.closest(".border")
  const invalideText = border.nextElementSibling
  if(!rule.test(value)){
    border.classList.add("is-invalid")
    invalideText.classList.remove("hidden")
    return true
  }
  else{
    border.classList.remove('is-invalid');
    invalideText.classList.add("hidden")

    return false;
  }
}

let emailValid = true
let nameValid = true
let usernameValid =true 

const validateEmail =()=> {
  const rule = /^[a-z]([\w\_\-\.])+@([\w\.])+\.(\w){2,5}$/i;
   
  emailValid = validate(UIinputEmail,rule)
  validation()

  return emailValid
}
const validateName =()=> {
  const rule = /^[a-z0-9]{3,25}$/i;
  nameValid =validate(UIinputFullname,rule)
  validation()
  return  nameValid
}

function validateUsername() {
  const rule = /^([\w\_]){3,15}$/i;
  usernameValid = validate(UIinputUsername,rule) 
  validation()
  return usernameValid
  
}


const validation = ()=>{
  if(emailValid==false && nameValid==false && usernameValid ==false){

    UInext.classList.remove("disabled")
    
  }
  else{
    UInext.classList.add("disabled")

  }
}

const confirmePassword = ()=>{
  if(UIinputConfirmePassword.value == UIinputPassword.value && UIinputConfirmePassword.value.length >5){

    UIsubmit.classList.remove("disabled")
    UIsubmit.setAttribute("type","submit")
    
  }
  else{
    UIsubmit.classList.add("disabled")
    UIsubmit.setAttribute("type","button")

  }
}

const dynamicDay = ()=>{

  const month =UIinputMonth.value
  const day =getMonthDay(month);
  daySelect(day)  
  
}

const getBirthDay=()=>{
  const date = `${UIinputYear.value}-${UIinputMonth.value}-${UIinputDay.value}`
  UIbirthday.value =date 
}
const getMonthDay=(month)=>{
  const days =[
    31,
    28,
    31,
    30,
    31,
    30,
    31,
    31,
    30,
    31,
    30,
    31
  ]
  let year = UIinputYear.value 
  

  if(year%4 ==0){
    days[1]=29
  }
  getBirthDay()
  return days[month - 1]
}
// initialize 
modalView()

yearSelect()
daySelect(31)
getBirthDay()



// event listener

UIsignUpBtn.addEventListener("click",showSignupForm)
UIpreviewInfo.addEventListener("click",()=>{
  currentPart =1
  modalView()

})
UInext.addEventListener("click",(e)=>{
  e.preventDefault();
  
  if(!UInext.classList.contains("disabled")){
    currentPart++
    modalView()
  }
  

})
UIprev.addEventListener("click",(e)=>{
  e.preventDefault();
  currentPart--
  modalView()

})



UIinputEmail.addEventListener("keyup",validateEmail)
UIinputFullname.addEventListener("keyup",validateName)
UIinputUsername.addEventListener("keyup",validateUsername)
UIinputPassword.addEventListener("keyup",confirmePassword)
UIinputConfirmePassword.addEventListener("keyup",confirmePassword)



UIinputMonth.addEventListener("change",dynamicDay)
UIinputYear.addEventListener("change",dynamicDay)
UIinputDay.addEventListener("change",getBirthDay)

