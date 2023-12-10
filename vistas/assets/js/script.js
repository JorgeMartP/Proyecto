const container = document.querySelector(".container"),
    pwShowHide = document.querySelectorAll(".showHipePw"),
    pwFields = document.querySelectorAll(".password"),
    signUp = document.querySelector(".signup-link"),
    login = document.querySelector(".login-link");




    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwFields =>{
                if(pwFields.type ==="password"){
                    pwFields.type = "text";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("bx-hide","bx-show");
                    })
                }else{
                    pwFields.type = "password";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("bx-show", "bx-hide");
                    })
                }
            })
        })
    })

signUp.addEventListener("click", ( )=>{
    container.classList.add("active");
});
login.addEventListener("click", ( )=>{
    container.classList.remove("active");
});


document.addEventListener('DOMContentLoaded', function () {
    var numberInputs = document.querySelectorAll('input[type="number"]');
    numberInputs.forEach(function (input) {
        input.addEventListener('mousewheel', function () {
        this.blur();
        });
    });
});




