/* Calculate total booking price based on seat class and children concession */
function calculateTotal() {

    // Get selected seat class
    let classType = document.getElementById("class_type").value;


    // Get ticket amounts entered by user
    let amount = Number(
        document.getElementById("tkt_amount").value
    );

    let children = Number(
        document.getElementById("children_amount").value
    );


    // Prevent children count from exceeding total tickets
    if (children > amount) {

        children = amount;

        document.getElementById("children_amount").value = amount;

    }


    // Calculate adult tickets after removing children tickets
    let adultTickets = amount - children;


    // Get price based on selected ticket class
    let ticketPrice = prices[classType];


    // Apply 50% concession for children tickets
    let childPrice = ticketPrice / 2;


    // Calculate total ticket price
    let total =
        (adultTickets * ticketPrice) +
        (children * childPrice);


    // Display updated ticket total
    document.getElementById("total_price").innerHTML =
        "Rs. " + total;

}


// Calculate price when page loads
calculateTotal();