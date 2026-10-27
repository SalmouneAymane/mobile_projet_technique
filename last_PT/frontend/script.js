document.addEventListener("DOMContentLoaded", () => {
    const API_URL = "http://localhost:8000/backend/api.php";
    const btn_show_form = document.getElementById("btn-show-form");
    const section_form = document.getElementById("section-form");
    const form_categorie = document.getElementById ("form-categorie");
    const cat_name = document.getElementById("cat-nom");
    const btn_cancel_form = document.getElementById("btn-cancel-form");
    const tBody = document.getElementById ("table-categories-body");


// TODO:
    //functions
    function getData() {
        fetch(API_URL)
        .then((response)=>response.json())
        .then((data)=>{
            tBody.innerHTML="";
            data.forEach((genre) => {
            const HTML=`
            <tr>
                <td class="p-4">${genre.id}<td>
                <td class="p-4">${genre.name}<td>
            </tr>
            `;
            tBody.insertAdjacentHTML("beforeend",HTML);
            });
        });
        
    };


    function pushData(name) {

        const data = { name : name};
        fetch(API_URL, {
            method : "POST",
            headers : {"Content-Type": "application/json",},
            body : JSON.stringify(data)
        })
        .then((response)=> response.json())
        .then((data)=>{
            section_form.classList.add("hidden");
            section_form.classList.remove('block');
            form_categorie.reset();

        })
    }

    btn_show_form.addEventListener ("click",()=>{
        section_form.classList.remove("hidden");
        section_form.classList.add('block');
    });
    btn_cancel_form.addEventListener("click",()=>{
        section_form.classList.add("hidden");
        section_form.classList.remove('block');
    });
    form_categorie.addEventListener("submit",(event)=>{
        event.preventDefault();
        const name = cat_name.value.trim();
        pushData(name);
        getData();
    });



getData();

})


