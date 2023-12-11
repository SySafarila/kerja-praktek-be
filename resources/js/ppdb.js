const form = document.getElementById("register-ppdb");
if (form) {
    const formButton = form.querySelector("button");

    let formStatus = true;
    form.addEventListener("submit", (e) => {
        if (!formStatus) {
            return;
        }
        formStatus = false;
        formButton.innerText = "Loading...";
        formButton.disabled = true;
        form.action = "";
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
            updatePaymentMethods.forEach((el) => {
                el.style = "cursor: not-allowed;";
            });
            updatePaymentMethodForm.querySelector(
                '#update-payment-method-form input[name="update_payment_method"]'
            ).value = payment.dataset.payment;
            updatePaymentMethodForm.submit();
            updatePaymentMethodForm.remove();
            updatePaymentStatus = false;
        });
    });
}

const studentDetailModal = document.getElementById("student_detail_modal");
const studentDetailCloseToggle = document.getElementById("close-detail");
const studentDetailToggle = document.getElementById("student-detail-toggle");

if (studentDetailModal && studentDetailToggle && studentDetailCloseToggle) {
    studentDetailModal.addEventListener("click", (e) => {
        e.stopPropagation();
        studentDetailModal.classList.toggle("hidden");
    });

    studentDetailModal
        .querySelector("#content")
        .addEventListener("click", (e) => {
            e.stopPropagation();
        });

    studentDetailToggle.addEventListener("click", (e) => {
        e.preventDefault();

        studentDetailModal.classList.toggle("hidden");
    });

    studentDetailCloseToggle.addEventListener("click", (e) => {
        e.preventDefault();
        studentDetailModal.classList.toggle("hidden");
    });
}

const editable = document.querySelectorAll("[data-name]");
const editableToggle = document.querySelector(
    "#student_detail_modal #edit-ppdb"
);

if (editable.length > 0 && editableToggle) {
    editableToggle.addEventListener("click", (e) => {
        e.preventDefault();
        const updatePpdbButton = studentDetailModal.querySelector('#update-ppd-button');
        updatePpdbButton.disabled = false;
        updatePpdbButton.classList.remove('hidden');
        editable.forEach((element) => {
            element.classList.remove("p-2");

            if (element.dataset.typeinput == 'select') {
                if (element.dataset.selecttype == 'gender') {
                    element.innerHTML = `<select name="${element.dataset.name}" required="${element.dataset.required == 1 ? true : false}" style="border: none; width:100%;">
                        <option value="0" selected disabled>Pilih</option>
                        <option value="male" ${element.dataset.value == 'male' ? 'selected' : ''}>Laki-Laki</option>
                        <option value="female" ${element.dataset.value == 'female' ? 'selected' : ''}>Perempuan</option>
                    </select>`;
                } else if (element.dataset.selecttype == 'religion') {
                    element.innerHTML = `<select name="${element.dataset.name}" required="${element.dataset.required == 1 ? true : false}" style="border: none; width:100%;">
                        <option value="0" selected disabled>Pilih</option>
                        <option class="capitalize" value="islam" ${element.dataset.value == 'islam' ? 'selected' : ''}>islam</option>
                        <option class="capitalize" value="kristen_protestan" ${element.dataset.value == 'kristen_protestan' ? 'selected' : ''}>kristen_protestan</option>
                        <option class="capitalize" value="kristen_katolik" ${element.dataset.value == 'kristen_katolik' ? 'selected' : ''}>kristen_katolik</option>
                        <option class="capitalize" value="hindu" ${element.dataset.value == 'hindu' ? 'selected' : ''}>hindu</option>
                        <option class="capitalize" value="buddha" ${element.dataset.value == 'buddha' ? 'selected' : ''}>buddha</option>
                        <option class="capitalize" value="khonghucu" ${element.dataset.value == 'khonghucu' ? 'selected' : ''}>khonghucu</option>
                    </select>`;
                }
            } else {
                element.innerHTML = `<input name="${element.dataset.name}" type="${element.dataset.typeinput}" value="${element.dataset.value}" style="border: none; width:100%;" required="${element.dataset.required == 1 ? true : false}" />`;
            }
        });
    });
}

const formFiles = document.getElementById("upload-files");
if (formFiles) {
    const formFilesSubmitButton = formFiles.querySelector(
        "button[type=submit]"
    );
    const formKk = document.getElementById("form-kk");
    if (formKk) {
        formKk.querySelector("#reupload").addEventListener("click", (e) => {
            e.preventDefault();
            formKk.querySelector("input").classList.remove("hidden");
            formKk.querySelector("p").classList.add("hidden");
            formFilesSubmitButton.disabled = false;
            formFilesSubmitButton.classList.remove("cursor-not-allowed");
        });
    }

    const formAkta = document.getElementById("form-akta");
    if (formAkta) {
        formAkta.querySelector("#reupload").addEventListener("click", (e) => {
            e.preventDefault();
            formAkta.querySelector("input").classList.remove("hidden");
            formAkta.querySelector("p").classList.add("hidden");
            formFilesSubmitButton.disabled = false;
            formFilesSubmitButton.classList.remove("cursor-not-allowed");
        });
    }

    const formKip = document.getElementById("form-kip");
    if (formKip) {
        formKip.querySelector("#reupload").addEventListener("click", (e) => {
            e.preventDefault();
            formKip.querySelector("input").classList.remove("hidden");
            formKip.querySelector("p").classList.add("hidden");
            formFilesSubmitButton.disabled = false;
            formFilesSubmitButton.classList.remove("cursor-not-allowed");
        });
    }

    const formPkh = document.getElementById("form-pkh");
    if (formPkh) {
        formPkh.querySelector("#reupload").addEventListener("click", (e) => {
            e.preventDefault();
            formPkh.querySelector("input").classList.remove("hidden");
            formPkh.querySelector("p").classList.add("hidden");
            formFilesSubmitButton.disabled = false;
            formFilesSubmitButton.classList.remove("cursor-not-allowed");
        });
    }
}
