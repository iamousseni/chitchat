/*
    DEABRA RIFAI OPPURE SPIEGAMI PERCHÈ NON CAPISCO
*/

function viewImage(element) {
    document.getElementById('ciao').innerHTML =  `
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active"> <img src="http://animalglamour.net/wp-content/uploads/2014/03/IMG_0997.jpg" class="d-block w-100" alt="..."> </div>
                    <div class="carousel-item"> <img src="https://www.legadelcane.org/wp-content/uploads/IMG-20180211-WA0014.jpg" class="d-block w-100" alt="..."> </div>
                    <div class="carousel-item"> <img src="https://www.ideegreen.it/wp-content/uploads/2015/12/gatto-obeso2.jpg" class="d-block w-100" alt="..."> </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="" aria-hidden="true"><img src="images/baseline-keyboard_arrow_left-24px.svg" width=50px></span> <span class="sr-only">Previous</span> </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="" aria-hidden="true"><img src="images/baseline-keyboard_arrow_right-24px.svg" width=50px></span> <span class="sr-only">Next</span></a>
            </div>
        </div>
    </div>
</div>`;
}
