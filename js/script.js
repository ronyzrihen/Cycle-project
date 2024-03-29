window.onload = function() {
    fetch("json/sort.json")
        .then(response => response.json())
        .then(data => dropDown(data));

    let formElement = document.getElementById("btnform");
    if (formElement) {
        formElement.onclick = function() { checkform(); }
    }

    let infoBtn = document.getElementById("info");
    let editBtn = document.getElementById("edit");
    let deleteBtn = document.getElementById("delete");
    if (infoBtn) {
        infoBtn.onclick = function() {


            infoAction("bi bi-info-circle replaceable_icon");
            if (deleteBtn.classList.contains("text-danger")) {
                deleteBtn.classList.remove("text-danger");
            }
            if (editBtn.classList.contains("text-warning")) {
                editBtn.classList.remove("text-warning");
            }
            if (!info.classList.contains("d-none")) {
                info.classList.add("d-none");
            }


        }
    }
    if (editBtn) {
        editBtn.onclick = function() {

            showInfoBtn();

            editAction("bi bi-pencil-square replaceable_icon");
            if (!editBtn.classList.contains("text-warning")) {
                editBtn.classList.add("text-warning");
            }
            if (deleteBtn.classList.contains("text-danger")) {
                deleteBtn.classList.remove("text-danger");
            }


        };
    }
    if (deleteBtn) {
        deleteBtn.onclick = function() {

            showInfoBtn();

            deleteAction("bi bi-x-circle replaceable_icon");
            if (!deleteBtn.classList.contains("text-danger")) {
                deleteBtn.classList.add("text-danger");
            }
            if (editBtn.classList.contains("text-warning")) {
                editBtn.classList.remove("text-warning");
            }


        };
    }
}

function showInfoBtn() {

    let info = document.getElementById("info");
    if (info.classList.contains("d-none")) {
        info.classList.remove("d-none");
    }

}


function infoAction(aClass) {
    let instances = document.getElementsByClassName("instance");
    for (let i = 0; i < instances.length; i++) {
        instances[i].querySelector(".replaceable_icon").className = aClass;
        instances[i].querySelector("a").removeAttribute("onclick");

    }
}

function editAction(aClass) {
    let instances = document.getElementsByClassName("instance");
    for (let i = 0; i < instances.length; i++) {
        instances[i].querySelector(".replaceable_icon").className = aClass;
        instances[i].querySelector("a").onclick = function(e) {
            e.preventDefault();
            let link = instances[i].querySelector("a").getAttribute('href');
            location.replace("cycle-form" + link.slice(9));
        };
    }
}

function deleteAction(aClass) {
    let instances = document.getElementsByClassName("instance");
    for (let i = 0; i < instances.length; i++) {
        instances[i].querySelector(".replaceable_icon").className = aClass;
        instances[i].querySelector("a").onclick = function(e) {
            e.preventDefault();
            let link = instances[i].querySelector("a").getAttribute('href');
            location.replace("save_milestone" + link.slice(9) + "&del=1");
        };
    }
}

function checkform() {
    let flag = 0;
    let aform = document.querySelector("form");
    let name = document.querySelector("#milestoneName");
    let bottles = document.querySelector("#numOfPlastics");
    let cans = document.querySelector("#numOfCans");
    let boxes = document.querySelector("#numOfBoxes");
    let date = aform.querySelector('#endDate');

    if (name.value == "") {
        if (!name.classList.contains('is-invalid'))
            name.classList.add('is-invalid');
        flag = 1;
    } else {
        if (name.classList.contains('is-invalid'))
            name.classList.remove('is-invalid');

        if (!name.classList.contains('is-valid'))
            name.classList.add('is-valid');
    }

    if (bottles.value == 0 && cans.value == 0 && boxes.value == 0) {




        if (!bottles.classList.contains('is-invalid'))
            bottles.classList.add('is-invalid');

        if (!cans.classList.contains('is-invalid'))
            cans.classList.add('is-invalid');

        if (!boxes.classList.contains('is-invalid'))
            boxes.classList.add('is-invalid');

        flag = 1;
    } else {

        if (bottles.classList.contains('is-valid'))
            bottles.classList.remove('is-valid');

        if (!bottles.classList.contains('is-valid'))
            bottles.classList.add('is-valid');

        if (cans.classList.contains('is-valid'))
            cans.classList.remove('is-valid');

        if (!cans.classList.contains('is-valid'))
            cans.classList.add('is-valid');

        if (boxes.classList.contains('is-valid'))
            boxes.classList.remove('is-valid');
    }
    if (!boxes.classList.contains('is-valid'))
        boxes.classList.add('is-valid');


    if (date.value != "" && !date.classList.contains('is-valid')) {
        date.classList.add('is-valid');
    }

    if (flag == 1) {
        event.preventDefault();
    }


};


///////////////////////////////////////////////////////////////////////////////////////

function dropDown(data) {

    const ulFrag = document.createDocumentFragment();


    for (const key in data.categories) {
        const li = document.createElement('li');

        const sHtml = `<a class="dropdown-item" href='list_page.php?cat=${data.categories[key].replace('"','')}'>${data.categories[key].replace('"','')}</a>`;
        li.innerHTML = sHtml;
        ulFrag.appendChild(li);
    }

    document.getElementById("drop").appendChild(ulFrag);


}




function galleryBadge() {
        const btn = document.querySelector('#Badgeinput');        
        const radioButtons = document.querySelectorAll('input[name="galleryBadge"]');
        btn.addEventListener("click", () => {
            let selectedSize;
            for (const radioButton of radioButtons) {
                if (radioButton.checked) {
                    selectedSize = radioButton.value;
                    break;
                }
            }
    
        });
}