
const base_url = "http://13.36.167.91/";

document.getElementById("update").addEventListener("click", async (event)=> {
    let formData = new FormData();
    event.preventDefault(); 
    formData.append("userName", document.getElementById("userName").value);
    // formData.append("userEmail", document.getElementById("userEmail").value);
    formData.append("userPhone", document.getElementById("UserPhone").value);
    formData.append("userCardID", document.getElementById("UserCardID").value);
    formData.append("userAddress", document.getElementById("UserAddress").value);
    formData.append("userPhoto", document.getElementById("userPhoto").files[0]); 
    formData.append("userID", localStorage.getItem("id")); 
    console.log(document.getElementById("userPhoto").files[0])
   const response=  await axios.post(base_url+"users/v1/update_profile.php",
         formData, {
        headers: {
            "Content-Type": "multipart/form-data"
        }
    })
    console.log(response)
    if(response.data.success){
        alert(response.data)
        document.getElementById("psuccess").innerText=response.data.message;
        setTimeout(() => {
            document.getElementById("psuccess").innerText="";
        }, 2000);
    }else{
        alert(response.data)
        document.getElementById("pfail").innerText=response.data.message;
        setTimeout(() => {
            document.getElementById("pfail").innerText="";
        }, 2000);
    }
});

getProfileImg(localStorage.getItem("id"))
async function getProfileImg(id){
    const img = document.getElementById("profileimg");
    const fimg = document.getElementById("fprofileimg");

    const response= await axios.post(base_url+`users/v1/getProfilePic.php`,{
      user_id:id
    })
    console.log(response)
    // response.data.user;
    if(response.data.user.profile_url != ""){
      fimg.setAttribute("src" ,base_url+"users/v1/"+ response.data.user.profile_url);
        
      img.setAttribute("src" ,base_url+"users/v1/"+ response.data.user.profile_url);
    }
    document.getElementById("userName").value=response.data.user?.user_name;
    document.getElementById("userEmail").value=response.data.user?.user_email;
  }