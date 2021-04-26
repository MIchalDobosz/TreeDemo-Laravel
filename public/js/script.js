function displayOptions(id) {

    let textId = "editInput"+id;
    let submitId = "editSubmit"+id;
    let deleteId = "delete"+id;
    let optionsId = "optionsToggle"+id;
    let selectId = "editSelect"+id;
    let newId = "newInput"+id;
    let newSubmit = "newSubmit"+id;
    let sortId = "sort"+id;
    let foldId = "fold"+id;


    if (document.getElementById(textId).style.display == "none") {
        document.getElementById(textId).style.display = "inline";
        document.getElementById(submitId).style.display = "inline";
        document.getElementById(optionsId).style.display = "inline";
        document.getElementById(sortId).style.display = "inline";
        document.getElementById(foldId).style.display = "inline";
        if (document.getElementById(selectId) != null && document.getElementById(deleteId) != null) {
            document.getElementById(selectId).style.display = "inline";
            document.getElementById(deleteId).style.display = "inline";
        }
        document.getElementById(newId).style.display = "inline";
        document.getElementById(newSubmit).style.display = "inline";

    } else {
        document.getElementById(textId).style.display = "none";
        document.getElementById(submitId).style.display = "none";
        document.getElementById(optionsId).style.display = "none";
        document.getElementById(sortId).style.display = "none";
        document.getElementById(foldId).style.display = "none";
        if (document.getElementById(selectId) != null && document.getElementById(deleteId) != null) {
            document.getElementById(selectId).style.display = "none";
            document.getElementById(deleteId).style.display = "none";
        }
        document.getElementById(newId).style.display = "none";
        document.getElementById(newSubmit).style.display = "none";
    }
}


function fold(id) {


    let ulId = 'ul'+id;

    if (document.getElementById(ulId) == null) return;
    let children = document.getElementById(ulId).children;
    let foldId = 'fold'+id;
    let fold = document.getElementById(foldId);
    let action = "";
    let actioBlock = "";

    if (fold.value == "Fold") {
        action = "none";
        actioBlock = "none";
        fold.value = "Unfold";
    } else {
        action = "list-item";
        actioBlock = "block";
        fold.value = "Fold";

    }

    for (let i=0; i < children.length; i++) {
        if (children[i].nodeName == 'UL') {
            children[i].style.display = actioBlock;
        } else {
            children[i].style.display = action;

        }
    }
}

function sort(currentNode) {

    if (currentNode.nodeType == null) {
        if (document.getElementById('ul'+currentNode) == null) return;
        currentNode = document.getElementById('ul'+currentNode);
    }

    let childrenArr = Array.from(currentNode.children);

    let sortId = currentNode.id.replace('ul', 'sort');
    let sortButton = document.getElementById(sortId);

    if (sortButton.value == 'Sort ASC') {
        childrenArr.sort(function(a, b){
            if (a.innerText < b.innerText) return -1;
                if (a.innerText > b.innerText) return 1;
                return 0;
        });
        sortButton.value = 'Sort DSC';
    } else {
        childrenArr.sort(function(a, b){
            if (a.innerText > b.innerText) return -1;
                if (a.innerText < b.innerText) return 1;
                return 0;
        });
        sortButton.value = 'Sort ASC';
    }
    
    
    for(let i=0; i<childrenArr.length; i++) {
        if (childrenArr[i].id.includes('li')) {
            currentNode.appendChild(childrenArr[i]);
        }
    }

    for(let i=0; i<childrenArr.length; i++) {
        if (childrenArr[i].id.includes('ul')) {
            let id = childrenArr[i].id.replace('ul', 'li');
            let li = document.getElementById(id);
            currentNode.insertBefore(childrenArr[i], li.nextSibling);
        }
    }
    
}




