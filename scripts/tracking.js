function markReturned(button, transactionId) {
    if (!confirm("Are you sure you want to mark this item as returned?")) {
        return;
    }

    const row = button.closest("tr");
    const statusCell = row.querySelector(".status");
    const dateInput = row.querySelector(".return-date");

    if (!dateInput.value) {
        alert("Please select return date");
        return;
    }

    // convert format
    let formattedDate = dateInput.value.replace("T", " ") + ":00";

    fetch("Track.php", {   
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `id=${transactionId}&date=${formattedDate}`
    })
    .then(res => res.text())
    .then(data => {
        console.log(data); // debug test

        if (data.includes("success")) {

            statusCell.classList.remove("pending", "flagged");
            statusCell.classList.add("returned");
            statusCell.textContent = "Returned";

            const cell = dateInput.parentElement;
            cell.textContent = formattedDate;

            document.getElementById("return-button-content").textContent = "---";
            button.classList.remove("btn", "return-btn");
            //button.remove();
        

        } else {
            alert("Error updating database");
        }
    });
}