/*
    DEABRA RIFAI OPPURE SPIEGAMI PERCHÈ NON CAPISCO
*/

function viewImage(element) {
    document.getElementById('display-messages').innerHTML =  `
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mylargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                     <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="` + element.src + `" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
}
