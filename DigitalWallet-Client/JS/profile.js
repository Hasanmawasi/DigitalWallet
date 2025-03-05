
const base_url = "http://localhost/";

document.getElementById("update").addEventListener("click", function () {
    let formData = new FormData();
    formData.append("userName", document.getElementById("userName").value);
    formData.append("userEmail", document.getElementById("userEmail").value);
    formData.append("userPhone", document.getElementById("UserPhone").value);
    formData.append("userCardID", document.getElementById("UserCardID").value);
    formData.append("userAddress", document.getElementById("UserAddress").value);
    formData.append("userPhoto", document.getElementById("userPhoto").files[0]); 
    formData.append("userID", localStorage.getItem("id")); 
    console.log(document.getElementById("userPhoto").files[0])
    axios.post(base_url+"Digital-wallet/DigitalWallet-Server/users/v1/update_profile.php", formData, {
        headers: {
            "Content-Type": "multipart/form-data"
        }
    })
    .then(response => {
        console.log(response.data);
        alert(response.data.message);
    })
    .catch(error => {
        console.error(error);
        alert("Error updating user.");
    });
});