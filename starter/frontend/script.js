document.addEventListener("DOMContentLoaded", () => {
    const API_URL = "http://localhost:8000/backend/api.php";
    const btn_show_form = document.getElementById("btn-show-form");
    const section_form = document.getElementById("section-form");
    const form_categorie = document.getElementById ("form-categorie");
    const cat_name = document.getElementById("cat-nom");
    const btn_cancel_form = document.getElementById("btn-cancel-form");
    const tBody = document.getElementById ("table-categories-body");




    function getData() {
        fetch(API_URL)
        .then((response)=>response.json())
        .then((data)=>{
            tBody.innerHTML="";
            data.forEach((genre) => {
            const HTML=`
            <tr>
                <td class="p-4 hidden text-right md:block ">${genre.id}<td>
                <td class="p-4 text-right ">${genre.name}<td>
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
        .then(response=> response.text())
        .then(tt=>{
            console.log(tt);
            toast("added","success");
            section_form.classList.add("hidden");
            section_form.classList.remove('block');
            form_categorie.reset();
            // toast("enrigistre","success");

        })
        .catch(error =>{
            toast(error,"error")
        }
        );
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
        section_form.classList.remove("hidden");
        section_form.classList.add('block');
        form_categorie.reset();
        
    });
function toast (message , type = "success") {
    const container = document.getElementById("toast-container");
    const toast = document.createElement("div");
    toast.className = `toast toast-${type}`
    toast.textContent = message ;

    container.appendChild(toast);

    setTimeout(()=>{
        toast.remove();
    },3000);
}


getData();

})

