function calculateTotal() {

    let classType = document.getElementById("class_type").value;

    let amount = Number(
        document.getElementById("tkt_amount").value
    );

    let children = Number(
        document.getElementById("children_amount").value
    );


    if (children > amount) {
        children = amount;
        document.getElementById("children_amount").value = amount;
    }


    let adultTickets = amount - children;


    let ticketPrice = prices[classType];


    let childPrice = ticketPrice / 2; // 50% concession


    let total =
        (adultTickets * ticketPrice) +
        (children * childPrice);


    document.getElementById("total_price").innerHTML =
        "Rs. " + total;

}

calculateTotal();