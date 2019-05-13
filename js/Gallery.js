function Gallery(srcImg) {
    return `
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                     <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="` + srcImg + `" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>`;
}

var image = document.getElementsByClassName('image');
for (let x = 0; x < image.length; x++) {
    image[x].addEventListener('click', function() {
        this.innerHTML = Gallery(this.src);
    });
}