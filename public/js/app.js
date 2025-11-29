// Airport Data
const airports = [
    { code: 'DEL', name: 'Delhi', country: 'India', full: 'Delhi, India (DEL)' },
    { code: 'BOM', name: 'Mumbai', country: 'India', full: 'Mumbai, India (BOM)' },
    { code: 'BLR', name: 'Bangalore', country: 'India', full: 'Bangalore, India (BLR)' },
    { code: 'GOI', name: 'Goa', country: 'India', full: 'Goa, India (GOI)' },
    { code: 'MAA', name: 'Chennai', country: 'India', full: 'Chennai, India (MAA)' },
    { code: 'CCU', name: 'Kolkata', country: 'India', full: 'Kolkata, India (CCU)' },
    { code: 'HYD', name: 'Hyderabad', country: 'India', full: 'Hyderabad, India (HYD)' },
    { code: 'PNQ', name: 'Pune', country: 'India', full: 'Pune, India (PNQ)' },
    { code: 'AMD', name: 'Ahmedabad', country: 'India', full: 'Ahmedabad, India (AMD)' },
    { code: 'COK', name: 'Kochi', country: 'India', full: 'Kochi, India (COK)' },
    { code: 'JAI', name: 'Jaipur', country: 'India', full: 'Jaipur, India (JAI)' },
    { code: 'LKO', name: 'Lucknow', country: 'India', full: 'Lucknow, India (LKO)' },
    { code: 'IXC', name: 'Chandigarh', country: 'India', full: 'Chandigarh, India (IXC)' },
    { code: 'GAU', name: 'Guwahati', country: 'India', full: 'Guwahati, India (GAU)' },
    { code: 'TRV', name: 'Trivandrum', country: 'India', full: 'Trivandrum, India (TRV)' },
    { code: 'DXB', name: 'Dubai', country: 'UAE', full: 'Dubai, United Arab Emirates (DXB)' },
    { code: 'AUH', name: 'Abu Dhabi', country: 'UAE', full: 'Abu Dhabi, United Arab Emirates (AUH)' },
    { code: 'SIN', name: 'Singapore', country: 'Singapore', full: 'Singapore (SIN)' },
    { code: 'BKK', name: 'Bangkok', country: 'Thailand', full: 'Bangkok, Thailand (BKK)' },
    { code: 'KUL', name: 'Kuala Lumpur', country: 'Malaysia', full: 'Kuala Lumpur, Malaysia (KUL)' },
    { code: 'LHR', name: 'London', country: 'UK', full: 'London, United Kingdom (LHR)' },
    { code: 'JFK', name: 'New York', country: 'USA', full: 'New York, United States (JFK)' },
    { code: 'LAX', name: 'Los Angeles', country: 'USA', full: 'Los Angeles, United States (LAX)' },
    { code: 'CDG', name: 'Paris', country: 'France', full: 'Paris, France (CDG)' },
    { code: 'FRA', name: 'Frankfurt', country: 'Germany', full: 'Frankfurt, Germany (FRA)' },
    { code: 'SYD', name: 'Sydney', country: 'Australia', full: 'Sydney, Australia (SYD)' },
    { code: 'NRT', name: 'Tokyo', country: 'Japan', full: 'Tokyo, Japan (NRT)' },
    { code: 'HKG', name: 'Hong Kong', country: 'Hong Kong', full: 'Hong Kong (HKG)' },
    { code: 'DOH', name: 'Doha', country: 'Qatar', full: 'Doha, Qatar (DOH)' },
    { code: 'KWI', name: 'Kuwait', country: 'Kuwait', full: 'Kuwait (KWI)' }
];

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

// Set minimum date to today
const today = new Date().toISOString().split('T')[0];
departureDateInput.min = today;
if (returnDateInput) {
    returnDateInput.min = today;
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

// Trip Type Radio Buttons
const tripTypeRadios = document.querySelectorAll('input[name="tripType"]');
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

// Airport Suggestions
function showSuggestions(input, suggestionsContainer) {
    const value = input.value.toLowerCase();
    
    if (value.length < 2) {
        suggestionsContainer.classList.remove('show');
        return;
    }
    
    const filtered = airports.filter(airport => 
        airport.name.toLowerCase().includes(value) ||
        airport.code.toLowerCase().includes(value) ||
        airport.country.toLowerCase().includes(value) ||
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

// Swap Cities Functionality
const swapCitiesBtn = document.getElementById('swapCities');
if (swapCitiesBtn) {
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

// Event Listeners for Airport Suggestions
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

// Passenger Counters (Adults, Children, Infants)
const passengerButtons = document.querySelectorAll('.passenger-btn');
passengerButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        const field = btn.getAttribute('data-field');
        const action = btn.getAttribute('data-action');
        const input = document.getElementById(field);
        const current = parseInt(input.value);
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

function updatePassengerButtons(field) {
    const input = document.getElementById(field);
    const value = parseInt(input.value);
    const min = field === 'adults' ? 1 : 0;
    const max = 50;
    
    const decreaseBtn = document.querySelector(`.passenger-btn[data-field="${field}"][data-action="decrease"]`);
    const increaseBtn = document.querySelector(`.passenger-btn[data-field="${field}"][data-action="increase"]`);
    
    if (decreaseBtn) decreaseBtn.disabled = value <= min;
    if (increaseBtn) increaseBtn.disabled = value >= max;
}

// Initialize button states
['adults', 'children', 'infants'].forEach(field => {
    updatePassengerButtons(field);
});

// WhatsApp Button
const whatsappBtn = document.getElementById('whatsappBtn');
if (whatsappBtn) {
    whatsappBtn.addEventListener('click', () => {
        const fromCity = fromCityInput.value;
        const toCity = toCityInput.value;
        const departureDate = departureDateInput.value;
        const returnDate = returnDateInput.value;
        const adults = document.getElementById('adults').value;
        const children = document.getElementById('children').value;
        const infants = document.getElementById('infants').value;
        const contactNumber = document.getElementById('contactNumber').value;
        const emailAddress = document.getElementById('emailAddress').value;
        const tripType = document.querySelector('input[name="tripType"]:checked').value;
        
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
if (gmailBtn) {
    gmailBtn.addEventListener('click', () => {
        const fromCity = fromCityInput.value;
        const toCity = toCityInput.value;
        const departureDate = departureDateInput.value;
        const returnDate = returnDateInput.value;
        const adults = document.getElementById('adults').value;
        const children = document.getElementById('children').value;
        const infants = document.getElementById('infants').value;
        const contactNumber = document.getElementById('contactNumber').value;
        const emailAddress = document.getElementById('emailAddress').value;
        const tripType = document.querySelector('input[name="tripType"]:checked').value;
        
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

// Set return date minimum to departure date
departureDateInput.addEventListener('change', () => {
    if (returnDateInput) {
        returnDateInput.min = departureDateInput.value;
        if (returnDateInput.value && returnDateInput.value < departureDateInput.value) {
            returnDateInput.value = departureDateInput.value;
        }
    }
});

// Scroll to Top
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

// Navbar Scroll Effect
let lastScroll = 0;
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll > 100) {
        navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
    } else {
        navbar.style.boxShadow = 'none';
    }
    
    lastScroll = currentScroll;
});

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

// Axios setup for contact form (if present on page)
if (typeof axios !== 'undefined') {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : null;

        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        if (csrfToken) {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
        }

        const successAlert = document.getElementById('contactSuccess');
        const errorAlert = document.getElementById('contactError');

        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            if (successAlert) {
                successAlert.classList.add('d-none');
            }
            if (errorAlert) {
                errorAlert.classList.add('d-none');
                errorAlert.innerHTML = '';
            }

            const formData = new FormData(contactForm);
            const data = Object.fromEntries(formData.entries());

            axios.post(contactForm.getAttribute('action') || '/contact', data)
                .then(function (response) {
                    if (successAlert) {
                        successAlert.textContent = response.data.message || 'Thank you for contacting us! We will get back to you soon.';
                        successAlert.classList.remove('d-none');
                    } else {
                        alert(response.data.message || 'Thank you for contacting us! We will get back to you soon.');
                    }
                    contactForm.reset();
                })
                .catch(function (error) {
                    let message = 'Something went wrong. Please try again later.';
                    if (error.response && error.response.status === 422 && error.response.data.errors) {
                        const errors = error.response.data.errors;
                        message = '';
                        Object.keys(errors).forEach(function (field) {
                            errors[field].forEach(function (err) {
                                message += `<div>${err}</div>`;
                            });
                        });
                    }

                    if (errorAlert) {
                        errorAlert.innerHTML = message;
                        errorAlert.classList.remove('d-none');
                    } else {
                        alert(message.replace(/<[^>]*>?/gm, ''));
                    }
                });
        });
    }
}

