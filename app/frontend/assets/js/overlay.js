function clickOverlay(id) {
    //if overlay is open, close it and opposite
    if (document.getElementById(id).style.display == 'block') {
        document.getElementById(id).style.display = 'none';
    }
    else {
        document.getElementById(id).style.display = 'block';
    }
}
