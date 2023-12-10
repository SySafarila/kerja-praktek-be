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
const updatePaymentMethodForm = document.getElementById(
    "update-payment-method-form"
);

if (updatePaymentMethods.length > 0) {
    let updatePaymentStatus = true;
    updatePaymentMethods.forEach((payment) => {
        payment.addEventListener("click", (e) => {
            if (!updatePaymentStatus) {
                return;
            }
            console.log("submit");
            updatePaymentMethods.forEach((el) => {
                el.style = "cursor: not-allowed;";
            });
            updatePaymentMethodForm.querySelector(
                '#update-payment-method-form input[name="update_payment_method"]'
            ).value = payment.dataset.payment;
            updatePaymentMethodForm.submit();
            updatePaymentStatus = false;
        });
    });
}
