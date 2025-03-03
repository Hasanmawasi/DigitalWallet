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

// change btween sercive sections

// document.getElementById("p2p").addEventListener("click", () => {
//   toggleServiceSections("toggleSection", "p2p");
// });
// document.getElementById("QR").addEventListener("click", () => {
//     toggleServiceSections("toggleSection", "QR");
//   });
//   document.getElementById("schedule").addEventListener("click", () => {
//     toggleServiceSections("toggleSection", "schedule");
//   });

// give this func  classes to add hidden to all except the secific one
function toggleServiceSections(comonClass, spicificClass) {
  document.querySelectorAll("." + comonClass).forEach((section) => {
    section.classList.add("hidden");
  });
  document.getElementsByClassName(spicificClass)[0].classList.remove("hidden");
}

const base_url = "http://localhost/"
// Create wallet function

const createWallet = document.getElementById("createwallet");
createWallet.addEventListener("click",async()=>{
  const walletname = document.getElementById("walletname").value;
  const balance = document.getElementById("balance").value;
  const currency = document.getElementById("currency").value;

 try {
  const response = await axios.post(base_url+"Digital-wallet/DigitalWallet-Server/users/v1/create_wallet.php",{
    walletname,
    balance,
    currency
   }, {
    headers: {
        "Content-Type": "application/json"
    }
})
console.log(response)
 } catch (error) {
   console.log(error)
 }


});
// with draw fitch
const withdraw = document.getElementById("withdraw");
withdraw.addEventListener('click',async ()=>{
  const amount = document.getElementById("withAmount").value;
  try {
    const response =  await axios.post(base_url+"Digital-wallet/DigitalWallet-Server/users/v1/withdraw_deposit.php",{
      amount,
      wallet_id: 1,
      type:"withdraw"
    });
console.log(response)

  } catch (error) {
    console.log(error);
  }
});

// deposit fetch
const deposit = document.getElementById("deposit");
deposit.addEventListener('click',async ()=>{
  const amount = document.getElementById("depAmount").value;
  try {
    const response =  await axios.post(base_url+"Digital-wallet/DigitalWallet-Server/users/v1/withdraw_deposit.php",{
      amount,
      wallet_id: 1,
      type:"deposit"
    });
console.log(response)

  } catch (error) {
    console.log(error);
  }
});

const wallets = document.getElementById("wallets");
wallets.addEventListener('change',async ()=>{
  
})

function walletData (){
  // let balance = 
}
 document.addEventListener('DOMContentLoaded',async ()=>{
  const userID = 31;
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

 })
