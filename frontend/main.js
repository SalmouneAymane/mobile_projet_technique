document.addEventListener("DOMContentLoaded", () => {
    const API_URL = "../backend/api/api.php";
    const show_form = document.querySelector("#btn_show_form");
    const section_form = document.querySelector("#section_form");
    const cancel_form = document.querySelector("#btn_cancel_form");
    const form_name = document.querySelector("#form_name");
    const table_body = document.querySelector("#table_body");

    show_form.addEventListener("click", () => {
        section_form.hidden = false;
        show_form.hidden = true;
    });

    cancel_form.addEventListener("click", () => {
        section_form.hidden = true;
        show_form.hidden = false;
        section_form.reset();
    });

    section_form.addEventListener("submit", (event) => {
        event.preventDefault();
        pushCategorie(form_name.value.trim());
    });

    function fetchCategories() {
        fetch(API_URL)
            .then((response) => response.json())
            .then((categories) => {
                table_body.innerHTML = "";
                categories.forEach((categorie) => {
                    const html = `
                        <tr>
                            <td class="px-5 py-4 text-slate-500">${categorie.id}</td>
                            <td class="px-5 py-4">${categorie.name}</td>
                        </tr>
                    `;
                    table_body.insertAdjacentHTML("beforeend", html);
                });
            });
    }

    function pushCategorie(name) {
        const data = [{ name: name }];

        fetch(API_URL, {
            method: "POST",
            headers: { "content-type": "application/json" },
            body: JSON.stringify(data)
        })
            .then((response) => response.json())
            .then(() => {
                section_form.hidden = true;
                show_form.hidden = false;
                section_form.reset();
                fetchCategories();
            });
    }

    fetchCategories();
});