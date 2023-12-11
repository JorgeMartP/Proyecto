var pass = document.getElementById("password");
var msg = document.getElementById("massage");
var str = document.getElementById("strenght");
var icon = document.getElementById("icon");
var icon2 = document.getElementById("icon2");
pass.addEventListener('input', ()=>{
    if(pass.value.length > 0){
        msg.style.display = "block";
    }
    else{
        msg.style.display = "none";
    }
    if (pass.value.length < 6) {
        str.innerHTML = "Insegura";
        pass.style.borderBottom = "2px solid #C50A0B";
        msg.style.color = "#C50A0B";
        icon.style.color = "#C50A0B";
        icon2.style.color = "#C50A0B";
    } else if (pass.value.length >= 6 && pass.value.length < 12 && /\d/.test(pass.value) && /[A-Z]/.test(pass.value)) {
        str.innerHTML = "Medio Segura";
        pass.style.borderBottom = "2px solid #F76032";
        msg.style.color = "#F76032";
        icon.style.color = "#F76032";
        icon2.style.color = "#F76032";
    } else if (pass.value.length >= 12 && /\d/.test(pass.value) && /[A-Z]/.test(pass.value) && /[a-z]/.test(pass.value) && /[@#$%^&*()_+-=\[\]{};':"<>,./?\|`~!]/i.test(pass.value)) {
        str.innerHTML = "Segura";
        pass.style.borderBottom = "2px solid #669801";
        msg.style.color = "#669801";
        icon.style.color = "#669801";
        icon2.style.color = "#669801";
}
})




let toggle = document.querySelector('.toggle');
    let navegacion = document.querySelector('.navegacion');
    let main = document.querySelector('.main');

    toggle.onclick = function(){
        navegacion.classList.toggle('active');
        main.classList.toggle('active');
    }

    let list = document.querySelectorAll('.navegacion li');
    function activeLink(){
        list.forEach((item)=>
        item.classList.remove('hovered'));
        this.classList.add('hovered');
    }
    list.forEach((item)=>
    item.addEventListener('mouseover', activeLink))