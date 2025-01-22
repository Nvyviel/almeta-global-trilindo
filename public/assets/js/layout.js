// CHECKBOX //
const individual = document.getElementById("individual");
const company = document.getElementById("company");

company.addEventListener("change", function () {
    if (company.checked) {
        individual.checked = false;
    }
});

individual.addEventListener("change", function () {
    if (individual.checked) {
        company.checked = false;
    }
});
// CHECKBOX //