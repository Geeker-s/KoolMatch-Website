"use strict";

const btn = document.getElementById('ttt');

console.log(btn);

btn.addEventListener('click', function () {
    let c1 = document.querySelector('input[name="c1"]:checked').value;
    let c2 = document.querySelector('input[name="c2"]:checked').value;
    let c3 = document.querySelector('input[name="c3"]:checked').value;
    let c4 = document.querySelector('input[name="c4"]:checked').value;
    let c5 = document.querySelector('input[name="c5"]:checked').value;
    let interet = c1 + c2 + c3 + c4 + c5;
    document.getElementById("registration_Interet_user").value = interet;
});
