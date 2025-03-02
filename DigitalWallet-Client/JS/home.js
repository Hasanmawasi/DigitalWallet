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
