<!-- Flight Search Form Component -->
<div class="flight-search-card">
    <div class="main-tabs">
        <button class="main-tab active" data-tab="flights"><i class="fas fa-plane me-1"></i>FLIGHTS</button>
        <button class="main-tab" data-tab="group-booking"><i class="fas fa-users me-1"></i>GROUP BOOKING</button>
    </div>
    
    <form id="flightSearchForm" class="search-form">
        <!-- Trip Type Selection -->
        <div class="trip-type-selection">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tripType" id="oneway" value="oneway" checked>
                <label class="form-check-label" for="oneway"><i class="fas fa-arrow-right me-1"></i>Oneway</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tripType" id="roundTrip" value="roundtrip">
                <label class="form-check-label" for="roundTrip"><i class="fas fa-exchange-alt me-1"></i>Round Trip</label>
            </div>
        </div>

        <!-- Route & Dates Section -->
        <div class="form-section">
            <div class="row g-3">
                <div class="col-lg-3 col-md-3 col-sm-6 position-relative">
                    <label class="form-label"><i class="fas fa-plane-departure me-1"></i>FROM</label>
                    <div class="input-group position-relative">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        <input type="text" class="form-control" id="fromCity" placeholder="Delhi, India (DEL)"
                            value="" autocomplete="off">
                        <div class="airport-suggestions" id="fromSuggestions"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 position-relative">
                    <label class="form-label"><i class="fas fa-plane-arrival me-1"></i>TO</label>
                    <div class="input-group position-relative">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        <input type="text" class="form-control" id="toCity" placeholder="Mumbai, India (BOM)"
                            value="" autocomplete="off">
                        <div class="airport-suggestions" id="toSuggestions"></div>
                    </div>
                    <button type="button" class="btn-swap-cities" id="swapCities" title="Swap cities">
                        <i class="fas fa-exchange-alt"></i>
                    </button>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <label class="form-label"><i class="fas fa-calendar-alt me-1"></i>DEPARTURE</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        <input type="date" class="form-control" id="departureDate" required>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6" id="returnDateContainer" style="display: none;">
                    <label class="form-label"><i class="fas fa-calendar-check me-1"></i>RETURN</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        <input type="date" class="form-control" id="returnDate" placeholder="Select Return Date">
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information & Passengers Section -->
        <div class="form-section">
            <div class="row g-3">
               
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <label class="form-label"><i class="fas fa-user me-1"></i>ADULTS</label>
                    <div class="input-group passenger-group">
                        <button type="button" class="btn btn-outline-secondary passenger-btn" data-field="adults"
                            data-action="decrease">−</button>
                        <input type="number" class="form-control text-center" id="adults" value="1" min="1"
                            max="50" readonly>
                        <button type="button" class="btn btn-outline-secondary passenger-btn" data-field="adults"
                            data-action="increase">+</button>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <label class="form-label"><i class="fas fa-child me-1"></i>CHILDREN</label>
                    <div class="input-group passenger-group">
                        <button type="button" class="btn btn-outline-secondary passenger-btn" data-field="children"
                            data-action="decrease">−</button>
                        <input type="number" class="form-control text-center" id="children" value="0" min="0"
                            max="50" readonly>
                        <button type="button" class="btn btn-outline-secondary passenger-btn" data-field="children"
                            data-action="increase">+</button>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <label class="form-label"><i class="fas fa-baby me-1"></i>INFANTS</label>
                    <div class="input-group passenger-group">
                        <button type="button" class="btn btn-outline-secondary passenger-btn" data-field="infants"
                            data-action="decrease">−</button>
                        <input type="number" class="form-control text-center" id="infants" value="0"
                            min="0" max="50" readonly>
                        <button type="button" class="btn btn-outline-secondary passenger-btn" data-field="infants"
                            data-action="increase">+</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <label class="form-label"><i class="fas fa-phone me-1"></i>CONTACT NUMBER</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                        <input type="tel" class="form-control" id="contactNumber" placeholder="Enter your phone number"
                            required>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <label class="form-label"><i class="fas fa-envelope me-1"></i>EMAIL ADDRESS</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                        <input type="email" class="form-control" id="emailAddress" placeholder="Enter your email address"
                            required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="form-actions">
            <div class="row g-3">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <button type="button" class="btn btn-whatsapp w-100" id="whatsappBtn">
                        <i class="fab fa-whatsapp me-2"></i>
                        <span>Send via WhatsApp</span>
                    </button>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <button type="button" class="btn btn-gmail w-100" id="gmailBtn">
                        <i class="fab fa-google me-2"></i>
                        <span>Send via Gmail</span>
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>
