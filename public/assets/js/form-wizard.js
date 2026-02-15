let currentStep = 1;
const totalSteps = 4;

function showStep(step) {
    document.querySelectorAll(".wizard-content").forEach((content) => {
        content.classList.remove("active");
    });
    document.getElementById("step" + step).classList.add("active");

    document.querySelectorAll(".wizard-step").forEach((stepEl) => {
        const stepNum = parseInt(stepEl.dataset.step);
        stepEl.classList.remove("active", "completed");
        if (stepNum === step) {
            stepEl.classList.add("active");
        } else if (stepNum < step) {
            stepEl.classList.add("completed");
        }
    });

    document.getElementById("prevBtn").style.display =
        step === 1 ? "none" : "inline-block";
    document.getElementById("nextBtn").style.display =
        step === totalSteps ? "none" : "inline-block";
    document.getElementById("submitBtn").style.display =
        step === totalSteps ? "inline-block" : "none";

    if (step === 4) {
        updateReview();
    }
}

function updateReview() {
    const form = document.getElementById("wizardForm");
    document.getElementById("reviewName").textContent =
        form.firstName.value + " " + form.lastName.value;
    document.getElementById("reviewPhone").textContent = form.phone.value;
    document.getElementById("reviewEmail").textContent = form.email.value;
    document.getElementById("reviewUsername").textContent = form.username.value;
}

document.getElementById("nextBtn").addEventListener("click", function () {
    if (currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
    }
});

document.getElementById("prevBtn").addEventListener("click", function () {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
});

document.getElementById("wizardForm").addEventListener("submit", function (e) {
    e.preventDefault();
    alert("Form submitted successfully!");
});

document.querySelectorAll(".file-upload-wrapper").forEach((wrapper) => {
    wrapper.addEventListener("click", function () {
        this.querySelector('input[type="file"]').click();
    });
});
