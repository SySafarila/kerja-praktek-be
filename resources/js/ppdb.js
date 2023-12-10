const form = document.getElementById("register-ppdb");
if (form) {
    const formButton = form.querySelector("button");

    let formStatus = true;
    form.addEventListener("submit", (e) => {
        if (!formStatus) {
            e.preventDefault();
        }
        formStatus = false;
        formButton.innerText = "Loading...";
        formButton.disabled = true;
    });
}

const updatePaymentMethods = document.querySelectorAll(
    "#update-payment-method"
);

if (updatePaymentMethods.length > 0) {
    let updatePaymentStatus = true;
    updatePaymentMethods.forEach((payment) => {
        payment.addEventListener("click", (e) => {
            if (!updatePaymentStatus) {
                e.preventDefault();
            }
            updatePaymentStatus = false;
            updatePaymentMethods.forEach((el) => {
                el.style = "cursor: not-allowed;";
            });
        });
    });
}
