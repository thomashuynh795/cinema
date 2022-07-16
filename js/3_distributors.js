let let1 = document.getElementById("id1");
let let2 = document.getElementById("id2");
let2.onchange = () => {
    let1.submit();
};

$("#myId").on('change keydown paste input', function(){
    doSomething();
});