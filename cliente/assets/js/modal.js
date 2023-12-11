const openModal = document.querySelector(".btn-newUser");
const modal = document.querySelector(".modal");
const modalClose = document.querySelector(".modalClose");
openModal.addEventListener("click", (e)=>{
    e.preventDefault();
    modal.classList.add("modal--show");
});

modalClose.addEventListener("click", (e)=>{
    e.preventDefault();
    modal.classList.remove("modal--show");
});



const openModal1 = document.querySelector(".users-table--edit");
const modal2 = document.querySelector(".modal-actualizar");
const modalClose1 = document.querySelector(".modalClose2");
openModal1.addEventListener("click", (e)=>{
    e.preventDefault();
    modal2.classList.add("modal--show");
});

modalClose1.addEventListener("click", (e)=>{
    e.preventDefault();
    modal2.classList.remove("modal--show");
});
