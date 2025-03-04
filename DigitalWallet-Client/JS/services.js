const base_url = "http://localhost/"




// change btween sercive sections

document.getElementById("p2p").addEventListener("click", () => {
    toggleServiceSections("toggleSection", "p2p");
  });
  document.getElementById("QR").addEventListener("click", () => {
      toggleServiceSections("toggleSection", "QR");
    });
    document.getElementById("schedule").addEventListener("click", () => {
      toggleServiceSections("toggleSection", "schedule");
    });
  
  // give this func  classes to add hidden to all except the secific one
  function toggleServiceSections(comonClass, spicificClass) {
    document.querySelectorAll("." + comonClass).forEach((section) => {
      section.classList.add("hidden");
    });
    document.getElementsByClassName(spicificClass)[0].classList.remove("hidden");
  }

const send = document.getElementById("send");
send.addEventListener('click',async()=>{
    const amount = document.getElementById("sendAmount").value;
    const reciever = document.getElementById("recieverEmail").value;
    const currency = document.getElementById("currency").value;
    const walletInsUse =localStorage.getItem("walletInUse") ;
    
    const response = await axios.post(base_url+"Digital-wallet/DigitalWallet-Server/users/v1/peerTopeer.php",{
        amount :amount,
        email: reciever,
        currency,
        walletInUse:walletInsUse,
    })
    console.log(response);
    if(response.data.success){
        document.getElementById("peerSucc").innerText=response.data.message;
        setTimeout(() => {
            document.getElementById("peerSucc").innerText="";
            document.getElementById("sendAmount").value="";
            document.getElementById("recieverEmail").value="";
            document.getElementById("currency").value="";
        }, 2000);
         const wallet_id=localStorage.getItem("walletInUse");    
        try {
            const response =  await axios.post(base_url+"Digital-wallet/DigitalWallet-Server/users/v1/withdraw_deposit.php",{
            amount,
            wallet_id,
            type:"withdraw"
            });
            console.log(response);
        } catch (error) {
            console.log(error);

  }
    }else{
        document.getElementById("peerError").innerText=response.data.message;
        setTimeout(() => {
            document.getElementById("peerError").innerText="";
        }, 2000);
    }
})