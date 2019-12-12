function highlightCards(ids){
    x = document.getElementsByClassName("cadeira-container");
    for(i=0; i<x.length; i++)
        x[i].classList.remove("clicked");
    ids.forEach(element => {
        highlight(element);
    });
}

function highlight(item){
    element = document.getElementById("cadeira-"+item);
    element.classList.add("clicked");
}