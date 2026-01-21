function expand(element) {
    element.style.height = 'auto';
    element.style.height = (element.scrollHeight - 10) + 'px';
}

function erase(element) {
    var yes = element.nextElementSibling;
    if (yes.style.display === 'none') {
	    yes.style.display = 'inline';
    } else {
	    yes.style.display = 'none';
    }
}

function prevent(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
    }
}
