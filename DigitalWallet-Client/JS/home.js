
const navicon = document.getElementById("navicon");

navicon.addEventListener("click",()=>{
    const toggleList = document.getElementById("toggleList");
    if(toggleList.style.display === "flex"){
        toggleList.style.display = "none";
    }else{
        toggleList.style.display = "flex";
    }
})