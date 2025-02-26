
const login = document.getElementById("login");
const singup = document.getElementById("signup");

const tologin = document.getElementById("tologin");
const tosignup =  document.getElementById("tosignup");

tologin.addEventListener('click',(e)=>{
    singup.classList.add("hidden");
    login.classList.remove("hidden");
});

tosignup.addEventListener('click',(e)=>{
    login.classList.add("hidden");
    singup.classList.remove("hidden");
});