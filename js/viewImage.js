function viewImage(element){
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("modalImg");
    var span = document.getElementsByClassName("close")[0];

    modal.style.display = "block";
    modalImg.src = element.src;
    
    modal.addEventListener('click', function(){
        this.style.display = "none";
    });

    span.addEventListener('click', function(){
        modal.style.display = "none";
    });
}