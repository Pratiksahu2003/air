import axios from 'axios';

// Airport Data - Loaded dynamically from database
let airports = [];

// Fetch airports from API using axios
async function loadAirports() {
    try {
        const response = await axios.get('/api/airports');
        airports = response.data;
        console.log('Airports loaded:', airports.length);
    } catch (error) {
        console.error('Error loading airports:', error);
        // Fallback to empty array if API fails
        airports = [];
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Load airports when page loads
    loadAirports();

    // DOM Elements
    const fromCityInput = document.getElementById('fromCity');
    const toCityInput = document.getElementById('toCity');
    const fromSuggestions = document.getElementById('fromSuggestions');
    const toSuggestions = document.getElementById('toSuggestions');
    const departureDateInput = document.getElementById('departureDate');
    const returnDateInput = document.getElementById('returnDate');
    const returnDateContainer = document.getElementById('returnDateContainer');
    const flightSearchForm = document.getElementById('flightSearchForm');
    const scrollTopBtn = document.getElementById('scrollTop');

    // Set minimum date to today (only if departure input exists on page)
    const today = new Date().toISOString().split('T')[0];
    if (departureDateInput) {
        departureDateInput.min = today;
        if (returnDateInput) {
            returnDateInput.min = today;
        }
    }

    // Main Tabs Switching (FLIGHTS / GROUP BOOKING)
    const mainTabs = document.querySelectorAll('.main-tab');
    mainTabs.forEach(btn => {
        btn.addEventListener('click', () => {
            mainTabs.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const tabType = btn.getAttribute('data-tab');
            if (tabType === 'group-booking') {
                window.location.href = '/group-booking';
            }
        });
    });

    // Trip Type Radio Buttons (only if they exist)
    const tripTypeRadios = document.querySelectorAll('input[name="tripType"]');
    if (tripTypeRadios.length > 0 && returnDateContainer && returnDateInput) {
        tripTypeRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === 'roundtrip') {
                    returnDateContainer.style.display = 'block';
                    returnDateInput.required = true;
                } else {
                    returnDateContainer.style.display = 'none';
                    returnDateInput.required = false;
                }
            });
        });
    }

    // Airport Suggestions
    function showSuggestions(input, suggestionsContainer) {
        const value = input.value.toLowerCase();
        
        if (value.length < 2) {
            suggestionsContainer.classList.remove('show');
            return;
        }
        
        // Wait for airports to load if not yet loaded
        if (airports.length === 0) {
            // Show loading message or wait
            suggestionsContainer.innerHTML = '<div class="suggestion-item">Loading airports...</div>';
            suggestionsContainer.classList.add('show');
            return;
        }
        
        const filtered = airports.filter(airport => 
            airport.name.toLowerCase().includes(value) ||
            airport.code.toLowerCase().includes(value) ||
            airport.country.toLowerCase().includes(value) ||
            airport.city.toLowerCase().includes(value) ||
            airport.full.toLowerCase().includes(value)
        ).slice(0, 10);
        
        if (filtered.length === 0) {
            suggestionsContainer.classList.remove('show');
            return;
        }
        
        suggestionsContainer.innerHTML = filtered.map(airport => `
            <div class="suggestion-item" data-code="${airport.code}" data-full="${airport.full}">
                <span class="suggestion-code">${airport.code}</span>
                <span>${airport.full}</span>
            </div>
        `).join('');
        
        suggestionsContainer.classList.add('show');
        
        // Add click handlers
        suggestionsContainer.querySelectorAll('.suggestion-item').forEach(item => {
            item.addEventListener('click', () => {
                input.value = item.getAttribute('data-full');
                suggestionsContainer.classList.remove('show');
            });
        });
    }

    // Swap Cities Functionality (only if both inputs exist)
    const swapCitiesBtn = document.getElementById('swapCities');
    if (swapCitiesBtn && fromCityInput && toCityInput) {
        swapCitiesBtn.addEventListener('click', () => {
            const fromValue = fromCityInput.value;
            const toValue = toCityInput.value;
            
            fromCityInput.value = toValue;
            toCityInput.value = fromValue;
            
            // Trigger input event to update suggestions if needed
            fromCityInput.dispatchEvent(new Event('input'));
            toCityInput.dispatchEvent(new Event('input'));
        });
    }

    // Event Listeners for Airport Suggestions (only if fields exist)
    if (fromCityInput && toCityInput && fromSuggestions && toSuggestions) {
        fromCityInput.addEventListener('input', () => {
            showSuggestions(fromCityInput, fromSuggestions);
        });

        toCityInput.addEventListener('input', () => {
            showSuggestions(toCityInput, toSuggestions);
        });

        // Close suggestions when clicking outside
        document.addEventListener('click', (e) => {
            if (!fromCityInput.contains(e.target) && !fromSuggestions.contains(e.target)) {
                fromSuggestions.classList.remove('show');
            }
            if (!toCityInput.contains(e.target) && !toSuggestions.contains(e.target)) {
                toSuggestions.classList.remove('show');
            }
        });
    }

    // Passenger Counters (Adults, Children, Infants) - only if buttons exist
    const passengerButtons = document.querySelectorAll('.passenger-btn');
    if (passengerButtons.length > 0) {
        passengerButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const field = btn.getAttribute('data-field');
                const action = btn.getAttribute('data-action');
                const input = document.getElementById(field);
                
                if (!input) return; // Safety check
                
                const current = parseInt(input.value) || 0;
                const max = field === 'adults' ? 50 : 50;
                const min = field === 'adults' ? 1 : 0;
                
                if (action === 'increase' && current < max) {
                    input.value = current + 1;
                } else if (action === 'decrease' && current > min) {
                    input.value = current - 1;
                }
                
                // Update button states
                updatePassengerButtons(field);
            });
        });
    }

    function updatePassengerButtons(field) {
        const input = document.getElementById(field);
        if (!input) return; // Safety check
        
        const value = parseInt(input.value) || 0;
        const min = field === 'adults' ? 1 : 0;
        const max = 50;
        
        const decreaseBtn = document.querySelector(`.passenger-btn[data-field="${field}"][data-action="decrease"]`);
        const increaseBtn = document.querySelector(`.passenger-btn[data-field="${field}"][data-action="increase"]`);
        
        if (decreaseBtn) decreaseBtn.disabled = value <= min;
        if (increaseBtn) increaseBtn.disabled = value >= max;
    }

    // Initialize button states (only if passenger inputs exist)
    ['adults', 'children', 'infants'].forEach(field => {
        const input = document.getElementById(field);
        if (input) {
            updatePassengerButtons(field);
        }
    });

    // WhatsApp Button
    const whatsappBtn = document.getElementById('whatsappBtn');
    if (whatsappBtn && fromCityInput && toCityInput && departureDateInput) {
        whatsappBtn.addEventListener('click', () => {
            const fromCity = fromCityInput.value;
            const toCity = toCityInput.value;
            const departureDate = departureDateInput.value;
            const returnDate = returnDateInput ? returnDateInput.value : '';
            const adultsInput = document.getElementById('adults');
            const childrenInput = document.getElementById('children');
            const infantsInput = document.getElementById('infants');
            const contactNumberInput = document.getElementById('contactNumber');
            const emailAddressInput = document.getElementById('emailAddress');
            const tripTypeRadio = document.querySelector('input[name="tripType"]:checked');
            
            const adults = adultsInput ? adultsInput.value : '';
            const children = childrenInput ? childrenInput.value : '';
            const infants = infantsInput ? infantsInput.value : '';
            const contactNumber = contactNumberInput ? contactNumberInput.value : '';
            const emailAddress = emailAddressInput ? emailAddressInput.value : '';
            const tripType = tripTypeRadio ? tripTypeRadio.value : 'oneway';
            
            if (!fromCity || !toCity || !departureDate || !contactNumber || !emailAddress) {
                alert('Please fill in all required fields');
                return;
            }
            
            if (tripType === 'roundtrip' && !returnDate) {
                alert('Please select return date');
                return;
            }
            
            const message = `Flight Booking Request:\n\nFrom: ${fromCity}\nTo: ${toCity}\nDeparture: ${departureDate}\n${tripType === 'roundtrip' ? `Return: ${returnDate}\n` : ''}Adults: ${adults}\nChildren: ${children}\nInfants: ${infants}\nContact: ${contactNumber}\nEmail: ${emailAddress}`;
            const phoneNumber = '917838848340'; // Replace with your WhatsApp business number
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        });
    }

    // Gmail Button
    const gmailBtn = document.getElementById('gmailBtn');
    if (gmailBtn && fromCityInput && toCityInput && departureDateInput) {
        gmailBtn.addEventListener('click', () => {
            const fromCity = fromCityInput.value;
            const toCity = toCityInput.value;
            const departureDate = departureDateInput.value;
            const returnDate = returnDateInput ? returnDateInput.value : '';
            const adultsInput = document.getElementById('adults');
            const childrenInput = document.getElementById('children');
            const infantsInput = document.getElementById('infants');
            const contactNumberInput = document.getElementById('contactNumber');
            const emailAddressInput = document.getElementById('emailAddress');
            const tripTypeRadio = document.querySelector('input[name="tripType"]:checked');
            
            const adults = adultsInput ? adultsInput.value : '';
            const children = childrenInput ? childrenInput.value : '';
            const infants = infantsInput ? infantsInput.value : '';
            const contactNumber = contactNumberInput ? contactNumberInput.value : '';
            const emailAddress = emailAddressInput ? emailAddressInput.value : '';
            const tripType = tripTypeRadio ? tripTypeRadio.value : 'oneway';
            
            if (!fromCity || !toCity || !departureDate || !contactNumber || !emailAddress) {
                alert('Please fill in all required fields');
                return;
            }
            
            if (tripType === 'roundtrip' && !returnDate) {
                alert('Please select return date');
                return;
            }
            
            const subject = 'Flight Booking Request';
            const body = `Flight Booking Request:\n\nFrom: ${fromCity}\nTo: ${toCity}\nDeparture: ${departureDate}\n${tripType === 'roundtrip' ? `Return: ${returnDate}\n` : ''}Adults: ${adults}\nChildren: ${children}\nInfants: ${infants}\nContact: ${contactNumber}\nEmail: ${emailAddress}`;
            const email = 'Groups@AirRj.com';
            const gmailUrl = `https://mail.google.com/mail/?view=cm&fs=1&to=${email}&su=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
            window.open(gmailUrl, '_blank');
        });
    }

    // Set return date minimum to departure date (only if departure input exists)
    if (departureDateInput) {
        departureDateInput.addEventListener('change', () => {
            if (returnDateInput) {
                returnDateInput.min = departureDateInput.value;
                if (returnDateInput.value && returnDateInput.value < departureDateInput.value) {
                    returnDateInput.value = departureDateInput.value;
                }
            }
        });
    }

    // Scroll to Top (only if button exists)
    if (scrollTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Smooth Scrolling for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Navbar Scroll Effect (only if navbar exists)
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        let lastScroll = 0;
        
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
            } else {
                navbar.style.boxShadow = 'none';
            }
            
            lastScroll = currentScroll;
        });
    }

    // Animation on Scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    }, observerOptions);

    // Observe all cards and sections
    document.querySelectorAll('.airline-card, .service-card, .route-item').forEach(el => {
        observer.observe(el);
    });

    // Initialize
    console.log('FareHawker website initialized');
});

// Contact form is now handled by resources/js/contact.js via Vite
