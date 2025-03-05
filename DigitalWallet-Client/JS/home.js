// toggle between login and sign up
const navicon = document.getElementById("navicon");

navicon.addEventListener("click", () => {
  const toggleList = document.getElementById("toggleList");
  if (toggleList.style.display === "flex") {
    toggleList.style.display = "none";
  } else {
    toggleList.style.display = "flex";
  }
});
// add a dynmaic date for the footer
let date = new Date();

document.getElementById("date").innerText = date.getFullYear();



const base_url = "http://localhost/"
// Create wallet function

const createWallet = document.getElementById("createwallet");
createWallet.addEventListener("click",async()=>{
  try {
  const walletname = document.getElementById("Cwalletname").value;
  const balance = document.getElementById("Cbalance").value;
  const currency = document.getElementById("Ccurrency").value;
    const id = localStorage.getItem("id");
  const response = await axios.post(base_url+"Digital-wallet/DigitalWallet-Server/users/v1/create_wallet.php",{
    walletname: walletname,
    balance: balance,
    currency: currency,
    id,
   }, {
    headers: {
        "Content-Type": "application/json"
    }
})
if(response.data.success){
  messageTimeOut("createwsuc","wallet created!!");
}else{
  messageTimeOut("createwfail","wallet failed!!");

}

 } catch (error) {
   console.log(error)
 }
});

async function getCardNumber() {
  const cardNumber= document.getElementById("cardnumber");
  const response = await axios.post(base_url+"Digital-wallet/DigitalWallet-Server/users/v1/getCardNumber.php",{
    user_id: localStorage.getItem("id"),
  })
  console.log(response);
  cardNumber.innerText=response.data.card.card_number;
}
// with draw fitch
const withdraw = document.getElementById("withdraw");
withdraw.addEventListener('click',async ()=>{
  const amount = document.getElementById("withAmount").value;

  if(amount !=""){ 
  const wallet_id=document.getElementById("wallets").value;
  try {
    const response =  await axios.post(base_url+"Digital-wallet/DigitalWallet-Server/users/v1/withdraw_deposit.php",{
      amount,
      wallet_id,
      type:"withdraw"
    });
    messageTimeOut("wsuccess","Withdraw Success");      

    walletData();
  } catch (error) {
    console.log(error);
  }
  }else{
     messageTimeOut("wfail","Fill the blank");      
  }
});
  
// deposit fetch
const deposit = document.getElementById("deposit");
deposit.addEventListener('click',async ()=>{
  const amount = document.getElementById("depAmount").value;
  if(amount !=""){
  const wallet_id=document.getElementById("wallets").value;

  try {
    const response =  await axios.post(base_url+"Digital-wallet/DigitalWallet-Server/users/v1/withdraw_deposit.php",{
      amount,
      wallet_id,
      type:"deposit"
    });
console.log(response)
  
    messageTimeOut("dsuccess","Deposit success")

    walletData();
  } catch (error) {
    console.log(error);
  }
}else{
  messageTimeOut("dfail","Fill the blank!!")

}
});

const wallets = document.getElementById("wallets");
wallets.addEventListener('change',async ()=>{
  walletData ();
})


async function  walletData () {
  let walletid = document.getElementById("wallets").value;
  localStorage.setItem("walletInUse",walletid);
  const response= await axios.post(base_url+`Digital-wallet/DigitalWallet-Server/users/v1/getWalletById.php`,{
    wallet_id:walletid,
  });
  let wallet = response.data.walletData; 
  document.getElementById("cardAmount").innerText=wallet.balance;
  document.getElementById("currency").innerText=wallet.currency;
  // console.log(response.data.walletData);
}
 document.addEventListener('DOMContentLoaded',async ()=>{
  const userID = localStorage.getItem("id");
  
  const response= await axios.post(base_url+`Digital-wallet/DigitalWallet-Server/users/v1/getWallets.php`,{
    user_id:userID
  })
  let fetchwallet =await response.data.wallets;
  let data = JSON.parse(fetchwallet);
  let walletsData = data.walets;
  walletsData.map((wallet)=>{
    let option = document.createElement("option");
    option.value = wallet.wallet_id;
    option.textContent= wallet.wallet_name;
    wallets.appendChild(option);
  })
  await walletData ();
  await getCardNumber();
  await getProfileImg(userID)
 })


async function getProfileImg(id){
  const img = document.getElementById("profileimg");
  const response= await axios.post(base_url+`Digital-wallet/DigitalWallet-Server/users/v1/getProfilePic.php`,{
    user_id:id
  })
  console.log(response.data)
  // response.data.user;
  if(response.data.user.profile_url != ""){

    img.setAttribute("src" ,base_url+"Digital-wallet/DigitalWallet-Server/users/v1/"+ response.data.user.profile_url);
  }

}




 function messageTimeOut(id,message){
  document.getElementById(id).innerText=message;
  setTimeout(() => {
      document.getElementById(id).innerText="";
  }, 2000);
 }