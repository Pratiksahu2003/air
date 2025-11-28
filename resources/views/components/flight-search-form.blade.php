<!-- Flight Search Form Component -->
<div class="flight-search-card">
    <div class="main-tabs">
        <button class="main-tab active" data-tab="flights"><i class="fas fa-plane me-1"></i>FLIGHTS</button>
        <button class="main-tab" data-tab="group-booking"><i class="fas fa-users me-1"></i>GROUP BOOKING</button>
    </div>
    <div class="trip-type-selection">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tripType" id="oneway" value="oneway" checked>
            <label class="form-check-label" for="oneway">Oneway</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tripType" id="roundTrip" value="roundtrip">
            <label class="form-check-label" for="roundTrip">Round Trip</label>
        </div>
    </div>
    <form id="flightSearchForm" class="search-form">
        <div class="row g-2 mb-2">
            <div class="col-md-6">
                <label class="form-label">FROM</label>
                <div class="input-group position-relative">
                    <span class="input-group-text"><i class="fas fa-plane-departure"></i></span>
                    <input type="text" class="form-control" id="fromCity" placeholder="Delhi, India (DEL)" value="Delhi, India (DEL)" autocomplete="off">
                    <div class="airport-suggestions" id="fromSuggestions"></div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">TO</label>
                <div class="input-group position-relative">
                    <span class="input-group-text"><i class="fas fa-plane-arrival"></i></span>
                    <input type="text" class="form-control" id="toCity" placeholder="Mumbai, India (BOM)" value="Mumbai, India (BOM)" autocomplete="off">
                    <div class="airport-suggestions" id="toSuggestions"></div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">DEPARTURE DATE</label>
                <input type="date" class="form-control" id="departureDate" required>
            </div>
            <div class="col-md-6" id="returnDateContainer" style="display: none;">
                <label class="form-label">RETURN DATE</label>
                <input type="date" class="form-control" id="returnDate" placeholder="Select Return Date">
            </div>
        </div>
        <div class="row g-2 mb-2">
            <div class="col-md-4">
                <label class="form-label">ADULTS</label>
                <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary passenger-btn" data-field="adults" data-action="decrease">-</button>
                    <input type="number" class="form-control text-center" id="adults" value="1" min="1" max="50" readonly>
                    <button type="button" class="btn btn-outline-secondary passenger-btn" data-field="adults" data-action="increase">+</button>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">CHILDREN</label>
                <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary passenger-btn" data-field="children" data-action="decrease">-</button>
                    <input type="number" class="form-control text-center" id="children" value="0" min="0" max="50" readonly>
                    <button type="button" class="btn btn-outline-secondary passenger-btn" data-field="children" data-action="increase">+</button>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">INFANTS</label>
                <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary passenger-btn" data-field="infants" data-action="decrease">-</button>
                    <input type="number" class="form-control text-center" id="infants" value="0" min="0" max="50" readonly>
                    <button type="button" class="btn btn-outline-secondary passenger-btn" data-field="infants" data-action="increase">+</button>
                </div>
            </div>
        </div>
        <div class="row g-2 mb-3">
            <div class="col-md-6">
                <label class="form-label">CONTACT NUMBER</label>
                <input type="tel" class="form-control" id="contactNumber" placeholder="Enter your phone number" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">EMAIL ADDRESS</label>
                <input type="email" class="form-control" id="emailAddress" placeholder="Enter your email address" required>
            </div>
        </div>
        <div class="row g-2">
            <div class="col-md-6">
                <button type="button" class="btn btn-whatsapp w-100" id="whatsappBtn">
                    <span>WHATSAPP</span>
                    <i class="fab fa-whatsapp ms-2"></i>
                </button>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-gmail w-100" id="gmailBtn">
                    <span>GMAIL</span>
                    <i class="fab fa-google ms-2"></i>
                </button>
            </div>
        </div>
    </form>
</div>

