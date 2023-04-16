<footer role="footer" class="footer main-footer bg-dark" id="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3">
                <h5>Information</h5>
                <ul>
                    <li>
                        <a href="{{ url('/page/about-us') }}">About Us</a>
                    </li>
                    <li>
                        <a href="{{ url('/page/delivery-information') }}">Delivery Information</a>
                    </li>
                    <li>
                        <a href="{{ url('/page/privacy-policy') }}">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="{{ url('/page/terms-conditions') }}">Terms & Conditions</a>
                    </li>
                </ul>   
            </div>
            <div class="col-6 col-md-3">
                <h5>Customer Service</h5>
                <ul>
                    <li>
                        <a href="{{ url('/page/contact-us') }}">Contact Us</a>
                    </li>
                    <li>
                        <a href="{{ url('/page/returns') }}">Returns</a>
                    </li>
                    <li>
                        <a href="{{ url('/page/site-map') }}">Site Map</a>
                    </li>
                </ul>   
            </div>
            <div class="col-6 col-md-3">
                <h5>Extras</h5>
                <ul>
                    <li>
                        <a href="{{ url('/page/brands') }}">Brands</a>
                    </li>
                    <li>
                        <a href="{{ url('/page/gift-certificates') }}">Gift Certificates</a>
                    </li>
                    <li>
                        <a href="{{ url('/page/specials') }}">Specials</a>
                    </li>
                </ul>   
            </div>
             <div class="col-6 col-md-3">
                <h5>My Account</h5>
                <ul>
                    <li>
                        <a href="{{ url('/account') }}">My Account</a>
                    </li>
                    <li>
                        <a href="{{ url('/account/order-history') }}">Order History</a>
                    </li>
                    <li>
                        <a href="{{ url('/page/wishlist') }}">Wishlist</a>
                    </li>
                    <li>
                        <a href="{{ url('/page/newsletter') }}">Newsletter</a>
                    </li>
                </ul>   
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="divider bg-white mt24 mb24"></div>
                <p>{{ config('app.name') }} © {{ date('Y') }}</p>
            </div>
        </div>
    </div>
</footer>