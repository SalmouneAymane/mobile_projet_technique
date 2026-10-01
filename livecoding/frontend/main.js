document.addEventListener(("DOMContentLoaded"),()=>{
    const API_URL = "../backend/api/api.php";
    const btn_show_form = document.querySelector("#btn_show_form");
    const btn_cancel_form = document.querySelector("#btn_cancel_form");
    const btn_submit_form = document.querySelector("#btn_submit_form");
    const form = document.querySelector("#form");
    const form_name = document.querySelector("#form_name");
    const table_body = document.querySelector("#table_body");

    btn_show_form.addEventListener("click",()=>{
        form.hidden = false;
        btn_show_form.hidden=true;
    });
    btn_cancel_form.addEventListener("click",()=>{
        form.hidden = true;
        btn_show_form.hidden=false;
    });
    btn_submit_form.addEventListener("click",(event)=>{
        event.preventDefault();
        form.hidden = true;
        btn_show_form.hidden=false;
        pushGenres(form_name.value.trim());

    });


    function getGenres(){
        fetch(API_URL)
        .then((response)=>response.json())
        .then((data)=>{
        table_body.innerHTML=""
           data.forEach((genre) => {
            HTML=
                `<tr>
                    <td>${genre.id}</td>
                    <td>${genre.name}</td>
                </tr>
                `;
                table_body.insertAdjacentHTML("beforeend" , HTML);
            });
        });
    };
    function pushGenres(name){
            function getGenres(){

        const data=[
            { "name" : name  }
        ];

        fetch(API_URL,{
            method : "POST",
            headers : {"Content-Type":"application/json"},
            body : JSON.stringify(data)
        })
        .then((response)=>response.json())
        .then((data)=>{
        form.hidden = true;
        btn_show_form.hidden=false;
        getGenres();

            });

    };
};
    getGenres();
});
