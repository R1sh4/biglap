var i = 1;
var op = 1;
var d = -0.03;
var gi = 1;
window.onload = main;

function main() {
    setTimeout(function () {
        if (document.getElementById("img/preloader.gif") != null) {
            document.getElementById("img/preloader.gif").classList.add("hidden");
            document.getElementById("img/preloader.gif").classList.remove("visible");
        }
    }, 1000);
    if (document.getElementsByClassName('jumbotron').length != 0)
        setTimeout(Changeimg, 3000);

    if (document.getElementById("color1") != null) {
        document.getElementById("color1").onmouseover = function () {
            this.style.backgroundColor = "rgb(220, 220, 220)";
        }
        document.getElementById("color1").onmouseout = function () {
            this.style.backgroundColor = "rgb(255, 255, 255)";
        }
        document.getElementById("color1").onclick = function () {
            if (gi == 1)
                gi = 4;
            else
                gi -= 1;
            document.getElementById("gimg").style.backgroundImage = `url(\"/img/2${gi}.jpg\")`;
        }
    }

    if (document.getElementById("color1") != null) {
        document.getElementById("color2").onmouseover = function () {
            this.style.backgroundColor = "rgb(220, 220, 220)";
        }
        document.getElementById("color2").onmouseout = function () {
            this.style.backgroundColor = "rgb(255, 255, 255)";
        }
        document.getElementById("color2").onclick = function () {
            if (gi == 4)
                gi = 1;
            else
                gi += 1;
            document.getElementById("gimg").style.backgroundImage = `url(\"/img/2${gi}.jpg\")`;
        }
    }
    //document.forms.myform.onsubmit = valid;
}

//function valid(evt) {
//    var checknull = false;
//    var checkstr = false;
//    var checknum = false;
//    var checkem = false;
//    var s = "";
//    var regem = /^[a-zA-Z]\w*@[a-zA-Z]\w*\.[a-zA-Z]+$/;
//    var pn = this.elements.PersonName.value;
//    var ps = this.elements.PersonSurname.value;
//    var n = this.elements.Number.value;
//    var em = this.elements.email.value;
//    if (pn == "")
//        checknull = true;
//    else {
//        if (pn.search(/\d/) != -1)
//            checkstr = true;
//    }
//    if (ps == "")
//        checknull = true;
//    else {
//        if (pn.search(/\d/) != -1)
//            checkstr = true;
//    }
//    if (n == "")
//        checknull = true;
//    else {
//        if (n.search(/\D/) != -1)
//            checknum = true;
//    }
//    if (em == "")
//        checknull = true;
//    else {
//        if (!regem.test(em))
//            checkem = true;
//    }
//    if (checknull)
//        s += "Заполните пустые поля!\n";
//    if (checkstr)
//        s += "В полях Имя и Фамилия не должно быть цифр!\n";
//    if (checknum)
//        s += "В поле Номер телефона не должно быть символов!\n";
//    if (checkem)
//        s += "Неправильно введен email!\n";
//    if (s == "")
//        alert("Заявка успешно отправлена");
//    else {
//        evt.preventDefault();
//        alert(s);
//    }
//}

function Changeimg() {

    if (op <= 0.001 && d < 0) {
        d *= -1;
        i++;
        if (i == 5)
            i = 1;
        if ((i % 2) == 0) {
            document.getElementsByClassName('jumbotron')[0].style.cssText =
                `color: RGB(255, 255, 255) !important;
background-image: url(\"/img/${i}.jpg\");
text-decoration-color: RGB(33, 37, 41) !important;
opacity: 0;`;
        } else {
            document.getElementsByClassName('jumbotron')[0].style.cssText =
                `color: RGB(33, 37, 41) !important;
background-image: url(\"/img/${i}.jpg\");
text-decoration-color: RGB(235, 49, 114) !important;
opacity: 0;`;
        }
        setTimeout(Changeimg, 50);
    } else
    if (op > 0.999 && d > 0) {
        d *= -1;
        setTimeout(Changeimg, 3000);
    } else {
        document.getElementsByClassName('jumbotron')[0].style.opacity = op;
        op += d;
        setTimeout(Changeimg, 50);
    }
}

