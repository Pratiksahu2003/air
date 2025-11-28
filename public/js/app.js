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
const tabButtons = document.querySelectorAll('.tab-btn');
const passengersInput = document.getElementById('passengers');
const increasePassengersBtn = document.getElementById('increasePassengers');
const decreasePassengersBtn = document.getElementById('decreasePassengers');
const scrollTopBtn = document.getElementById('scrollTop');

// Set minimum date to today
const today = new Date().toISOString().split('T')[0];
departureDateInput.min = today;
if (returnDateInput) {
    returnDateInput.min = today;
}

// Tab Switching
tabButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        tabButtons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        const tabType = btn.getAttribute('data-tab');
        if (tabType === 'round-trip') {
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

// Passenger Counter
increasePassengersBtn.addEventListener('click', () => {
    const current = parseInt(passengersInput.value);
    if (current < 9) {
        passengersInput.value = current + 1;
    }
});

decreasePassengersBtn.addEventListener('click', () => {
    const current = parseInt(passengersInput.value);
    if (current > 1) {
        passengersInput.value = current - 1;
    }
});

// Form Submission
flightSearchForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const fromCity = fromCityInput.value;
    const toCity = toCityInput.value;
    const departureDate = departureDateInput.value;
    const returnDate = returnDateInput.value;
    const passengers = passengersInput.value;
    const tripType = document.querySelector('.tab-btn.active').getAttribute('data-tab');
    
    if (!fromCity || !toCity || !departureDate) {
        alert('Please fill in all required fields');
        return;
    }
    
    if (tripType === 'round-trip' && !returnDate) {
        alert('Please select return date');
        return;
    }
    
    // Show loading state
    const submitBtn = flightSearchForm.querySelector('.search-btn');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span class="loading-spinner"></span> Searching...';
    submitBtn.disabled = true;
    
    // Simulate API call
    setTimeout(() => {
        alert(`Flight search initiated!\n\nFrom: ${fromCity}\nTo: ${toCity}\nDeparture: ${departureDate}\n${tripType === 'round-trip' ? `Return: ${returnDate}\n` : ''}Passengers: ${passengers}\n\nThis is a demo. In a real application, this would redirect to flight results.`);
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 1500);
});

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

