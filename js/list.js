window.onload = function() {
    fetch("json/sort.json")
        .then(response => response.json())
        .then(data => dropDown(data));


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
            location.replace("http://se.shenkar.ac.il/software-engineers/Cycle/cycle-form" + link.slice(9));
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
            location.replace("http://se.shenkar.ac.il/software-engineers/Cycle/save_milestone" + link.slice(9) + "&del=1");
        };
    }
}


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