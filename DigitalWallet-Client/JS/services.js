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
    const fee =2;
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
           let allAmount = fee +parseInt(amount)
           console.log(allAmount)
            const response =  await axios.post(base_url+"Digital-wallet/DigitalWallet-Server/users/v1/withdraw_deposit.php",{
            amount: allAmount,
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
});

const createQR  = document.getElementById("createQR");
createQR.addEventListener('click',async ()=>{
  const amount = document.getElementById("QRamount").value;

  if(amount != ""){ 
    let userid= localStorage.getItem('id');
  let walletid = localStorage.getItem('walletInUse');
 
  let data = `${base_url}Digital-wallet/DigitalWallet-Server/users/v1/QRgenerate.php?amount=${amount}&wallerid=${walletid}&userid=${userid}`;
  let qrcode = new QRCode(document.getElementById("qrcode"), {
    text: data,
    width: 200,
    height: 200
  });
  }else{
    document.getElementById("QRError").innerText="Fill the blanck!!";
        setTimeout(() => {
            document.getElementById("QRError").innerText="";
        }, 2000);
  }
  
    
})