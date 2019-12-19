function highlightCards(ids, parentCadeira){
    x = document.getElementsByClassName("cadeira-container");
    for(i=0; i<x.length; i++)
        x[i].classList.remove("clicked");
    
    x = document.getElementsByClassName("cadeira-dropdown")
    for(i=0; i<x.length; i++)
        x[i].style.display = "none";
    ids.forEach(element => {
        console.log(element);
        highlight(element);
        if(screen.width<=768){
            console.log("cadeira-dropdown-"+parentCadeira+"-"+element);
            temp = document.getElementById("cadeira-dropdown-"+parentCadeira+"-"+element);
            temp.style.display="inherit"
        }
    });
}

function displayGrupoEletiva(id){
    x = document.getElementById("grupo-"+id);
    if(!x.classList.contains("cadeira-grupo-body-active")){
        x = document.getElementsByClassName("cadeira-grupo-body");
        for(i=0; i<x.length; i++)
            x[i].classList.remove("cadeira-grupo-body-active");
        x = document.getElementById("grupo-"+id);
        x.classList.add("cadeira-grupo-body-active");
    }
    else{
        x.classList.remove("cadeira-grupo-body-active")
    }
}

function highlight(item){
    element = document.getElementById("cadeira-"+item);
    element.classList.add("clicked");
}

function displayModal(id){
    element = document.getElementById("ementa-"+id);
    element.style.display = "block";
}

function closeModal(id){
    element = document.getElementById("ementa-"+id);
    element.style.display="none";
}