const wrapper= document.querySelector(".wrapper");
const loginlink= document.querySelector(".login-link");
const registerlink= document.querySelector(".register-link");
const btnPopup= document.querySelector(".btnlogin-popup");
const iconClose= document.querySelector(".close-icon");

if (registerlink != null) {
registerlink.addEventListener('click', ()=> {
    wrapper.classList.add('active');
})};

if (registerlink != null) {
loginlink.addEventListener('click', ()=> {
    wrapper.classList.remove('active');
})};

if (registerlink != null) {
btnPopup.addEventListener('click', ()=> {
    wrapper.classList.add('active-popup');
})};

if (registerlink != null) {
iconClose.addEventListener('click', ()=> {
    wrapper.classList.remove('active-popup');
})};