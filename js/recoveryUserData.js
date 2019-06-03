function recoveryData(){
    let xhttp = new XMLHttpRequest();
    xhttp.open('GET', 'modules/API/recoveryUserData.php');
    xhttp.send();
}
window.addEventListener('beforeunload', function(){
    recoveryData();
});

window.addEventListener('load', function(){
    recoveryData();
});
