window.onload = function() {

    let recycleBtn = document.querySelector("#recycleBtn");
    recycleBtn.onclick = function() {
        if (!recycleBtn.classList.contains("d-none")) {
            recycleBtn.classList.add("d-none");
            let recycleLinks = document.querySelectorAll(".cycleLinks");
            for (let i = 0; i < recycleLinks.length; i++) {
                if (recycleLinks[i].classList.contains("d-none")) {
                    recycleLinks[i].classList.remove("d-none");
                }
            }
        }

    };

}