let let1 = document.querySelectorAll("form");
console.log(let1);
let let2 = document.querySelectorAll("select");
console.log(let2);
let2.onchange = () => {
    console.log("ok");
    let1.submit();
};