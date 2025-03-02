
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

const base_url = "localhost";

const signupButtom = document.getElementById("signup-btn");

signupButtom.addEventListener('click',async ()=>{
    const username = document.getElementById("Susername").value;
    const password = document.getElementById("Spassword").value;
    const email = document.getElementById("Semail").value;
    try {
        const response = await axios.post("http://localhost/Digital-wallet/DigitalWallet-Server/users/v1/signup.php",{
            username: username,
            password :password,
            email: email,
        }, {
            headers: {
                "Content-Type": "application/json"
            }
        }
    );
        if(response.data.success){
            window.location.href= "home.html";
        }else{
            console.log(response.data)
            document.getElementById("error-sign").innerText=response.data.message;
        }
    } catch (error) {
         console.error("Error: ", error);
    }
});

