if (document.querySelector("#cMAC")) {
    document.getElementById("cMAC").oninput = function () {
        checkNum(document.getElementById("cMAC"));
    }
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("cguLink").onclick = function (){
        display("cgu");
    }
});