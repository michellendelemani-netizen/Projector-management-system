let btn_sus = document.getElementById("sus");
let btn_rem = document.getElementById("rem");

function confirmremoval(){
    let isSure = confirm("Are you sure you want to remove projector?");
    if (isSure) {
        let reason = prompt("Please enter the reason for removal:");
        if (reason !== null && reason.trim() !== "") {
            alert("item removed for:"+reason);
        }else{
            alert("removal cancelled.Reason is required");
        }
    }else{
        alert("removal cancelled");
    }
}