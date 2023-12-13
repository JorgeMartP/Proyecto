const form = document.querySelector(".form");
const nextBtn = document.querySelector(".nextBtn");
const backBtn = document.querySelector(".backBtn");
const allInput = document.querySelectorAll(".first input");

nextBtn.addEventListener("click", () => {
    const areAllInputsEmpty = Array.from(allInput).every(input => input.value === "");

    if (areAllInputsEmpty) {
        form.classList.remove('secActive');
            Swal.fire({
                icon: "warning",
                text: "Digite todos los campos para continuar"
            });
    } else {
        form.classList.add('secActive');
    }
});
backBtn.addEventListener("click", ()=>form.classList.remove('secActive'));