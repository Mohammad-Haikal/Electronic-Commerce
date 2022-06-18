var myCarousel = document.querySelector("#carouselExampleCaptions");
var carousel = new bootstrap.Carousel(myCarousel, {
  interval: 5000,
  touch: true,
});

function paymentMethod(value) {
  if (value == 1) {
    if (!$("#onlineDiv").length) {
      $("#cashDiv").after(`
        <div id="onlineDiv" class="card p-3">
        <h4 class="mb-3">Online Payment</h4>
        <div class="row gy-3">
            <div class="col-md-6">
                <label for="cc-name" class="form-label">Name on card</label>
                <input type="text" class="form-control" required>
                <small class="text-muted">Full name as displayed on card</small>
            </div>

            <div class="col-md-6">
                <label for="cc-number" class="form-label">Credit card number</label>
                <input type="text" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label for="cc-expiration" class="form-label">Expiration</label>
                <input type="text" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label for="cc-cvv" class="form-label">CVV</label>
                <input type="text" class="form-control" required>
            </div>
          </div>
        </div>
      `);
    }
  } else if (value == 2) {
    if ($("#onlineDiv").length) {
      $("#onlineDiv").remove();
    }
  }
}
