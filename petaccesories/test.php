<div id="onlineDiv">
    <h4 class="mb-3">Credit Card Payment</h4>
    <div class="row gy-3">
        <div class="col-md-6">
            <label for="cc-name" class="form-label">Name on card</label>
            <input type="text" class="form-control" id="cc-name" placeholder="" required>
            <small class="text-muted">Full name as displayed on card</small>
            <div class="invalid-feedback">
                Name on card is required
            </div>
        </div>

        <div class="col-md-6">
            <label for="cc-number" class="form-label">Credit card number</label>
            <input type="text" class="form-control" id="cc-number" placeholder="" required>
            <div class="invalid-feedback">
                Credit card number is required
            </div>
        </div>

        <div class="col-md-3">
            <label for="cc-expiration" class="form-label">Expiration</label>
            <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
            <div class="invalid-feedback">
                Expiration date required
            </div>
        </div>

        <div class="col-md-3">
            <label for="cc-cvv" class="form-label">CVV</label>
            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
            <div class="invalid-feedback">
                Security code required
            </div>
        </div>
    </div>

    <hr class="my-4">
    <button id="onlinePayBtn" class="w-100 myFilledCustomBtn btn-lg" type="submit">Continue to checkout</button>
</div>