function markReturned(button) {
    if (!confirm("Are you sure you want to mark this item as returned?")) {
        return; // stop if user clicks Cancel
    }

    const row = button.closest("tr");
    const statusCell = row.querySelector(".status");
    const buttonReturn = document.querySelector(".return-btn");

    statusCell.classList.remove("pending", "flagged");
    statusCell.classList.add("returned");
    statusCell.textContent = "Returned";
    button.textContent = "---";
    button.classList.remove("return-btn", "btn");
    button.classList.add("return-btn-out");
}
function applyFilters() {
    const status = document.getElementById("statusFilter").value.toLowerCase();
    const rows = document.querySelectorAll("#trackingTable tr");

    rows.forEach(row => {
        const rowStatus = row.querySelector(".status").textContent.toLowerCase();

        if (!status || rowStatus === status) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}