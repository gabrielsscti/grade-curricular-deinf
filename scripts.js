function highlightCards(ids, parentCadeira){
    x = document.getElementsByClassName("cadeira-container");
    for(i=0; i<x.length; i++)
        x[i].classList.remove("clicked");
    
    x = document.getElementsByClassName("cadeira-dropdown")
    for(i=0; i<x.length; i++)
        x[i].style.display = "none";
    ids.forEach(element => {
        highlight(element);
        if(screen.width<=768){
            console.log("cadeira-dropdown-"+parentCadeira+"-"+element);
            temp = document.getElementById("cadeira-dropdown-"+parentCadeira+"-"+element);
            temp.style.display="inherit"
        }
    });
}

function highlight(item){
    element = document.getElementById("cadeira-"+item);
    element.classList.add("clicked");
}