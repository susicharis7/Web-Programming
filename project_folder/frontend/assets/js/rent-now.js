document.addEventListener("DOMContentLoaded", function () {
    const rentForm = document.getElementById("rent-now-form");

    if (rentForm) {
        rentForm.addEventListener("submit", function (e) {
            e.preventDefault();

            let name = document.getElementById("name").value.trim();
            let email = document.getElementById("email").value.trim();
            let car = document.getElementById("car-select").value;
            let pickupDate = document.getElementById("pickup-date").value;
            let returnDate = document.getElementById("return-date").value;

            if (!name || !email || !car || !pickupDate || !returnDate) {
                alert("All fields are required!");
                return;
            }

            if (new Date(pickupDate) > new Date(returnDate)) {
                alert("Return date must be after the pick-up date!");
                return;
            }

            alert(`Car rental confirmed!\n\nName: ${name}\nEmail: ${email}\nCar: ${car}\nPickup Date: ${pickupDate}\nReturn Date: ${returnDate}`);

            // Reset form after submission
            rentForm.reset();
        });
    }
});
