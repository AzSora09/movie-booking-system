// Simple helper: calculate total price based on class and concessions
function calculateTotal() {

    // Read selected class and ticket counts from the form
    let classType = document.getElementById("class_type").value;

    let amount = Number(
        document.getElementById("tkt_amount").value
    );

    let children = Number(
        document.getElementById("children_amount").value
    );


    // Guard: children cannot exceed total tickets
    if (children > amount) {
        children = amount;
        document.getElementById("children_amount").value = amount;
    }


    // Compute totals
    let adultTickets = amount - children;


    let ticketPrice = prices[classType];


    let childPrice = ticketPrice / 2; // 50% concession


    let total =
        (adultTickets * ticketPrice) +
        (children * childPrice);


    // Update UI with formatted price
    document.getElementById("total_price").innerHTML =
        "Rs. " + total;

}

calculateTotal();