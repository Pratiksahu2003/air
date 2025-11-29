import Swal from 'sweetalert2';
import axios from 'axios';
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

// Group booking form handler with SweetAlert2
document.addEventListener('DOMContentLoaded', function() {
    const groupBookingForm = document.getElementById('groupBookingForm');
    if (!groupBookingForm) return;

    // Get CSRF token
    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : null;

    // Configure axios
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    if (csrfToken) {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
    }

    // Get form elements
    const fromCityInput = document.getElementById('fromCity');
    const toCityInput = document.getElementById('toCity');
    const fromSuggestions = document.getElementById('fromSuggestions');
    const toSuggestions = document.getElementById('toSuggestions');
    const departureDateInput = document.getElementById('departureDate');
    const returnDateInput = document.getElementById('returnDate');
    const swapCitiesBtn = document.getElementById('swapCities');

    // Airport data
    let airports = [];

    // Load airports from API
    async function loadAirports() {
        try {
            const response = await axios.get('/api/airports');
            if (response.data) {
                airports = response.data;
                console.log('Airports loaded:', airports.length);
            }
        } catch (error) {
            console.error('Error loading airports:', error);
            airports = [];
        }
    }

    // Load airports on page load
    loadAirports();

    // Initialize Flatpickr for Departure Date
    let departureDatePicker = null;
    let returnDatePicker = null;

    if (departureDateInput) {
        departureDatePicker = flatpickr(departureDateInput, {
            dateFormat: 'Y-m-d',
            minDate: 'today',
            altInput: false,
            allowInput: false,
            clickOpens: true,
            locale: {
                firstDayOfWeek: 1
            }
        });
    }

    // Initialize Flatpickr for Return Date
    if (returnDateInput) {
        returnDatePicker = flatpickr(returnDateInput, {
            dateFormat: 'Y-m-d',
            minDate: 'today',
            altInput: false,
            allowInput: false,
            clickOpens: true,
            locale: {
                firstDayOfWeek: 1
            }
        });
    }

    // Update return date minDate when departure date changes
    if (departureDatePicker && returnDatePicker) {
        departureDateInput.addEventListener('change', function() {
            if (this.value) {
                returnDatePicker.set('minDate', this.value);
                if (returnDateInput.value && returnDateInput.value < this.value) {
                    returnDateInput.value = '';
                }
            }
        });
    }

    // Airport Suggestions
    function showSuggestions(input, suggestionsContainer) {
        const value = input.value.toLowerCase();
        
        if (value.length < 2) {
            suggestionsContainer.classList.remove('show');
            return;
        }
        
        if (airports.length === 0) {
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

    // Event Listeners for Airport Suggestions
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

    // Swap Cities Functionality
    if (swapCitiesBtn && fromCityInput && toCityInput) {
        swapCitiesBtn.addEventListener('click', () => {
            const fromValue = fromCityInput.value;
            const toValue = toCityInput.value;
            
            fromCityInput.value = toValue;
            toCityInput.value = fromValue;
            
            fromCityInput.dispatchEvent(new Event('input'));
            toCityInput.dispatchEvent(new Event('input'));
        });
    }

    // Client-side validation function
    function validateGroupBookingForm() {
        const fromCity = fromCityInput?.value.trim() || '';
        const toCity = toCityInput?.value.trim() || '';
        const departureDate = departureDateInput?.value || '';
        const returnDate = returnDateInput?.value || '';
        const passengers = document.querySelector('select[name="passengers"]')?.value || '';
        const name = document.querySelector('input[name="name"]')?.value.trim() || '';
        const email = document.querySelector('input[name="email"]')?.value.trim() || '';
        const phone = document.querySelector('input[name="phone"]')?.value.trim() || '';

        if (!fromCity) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please select departure city.',
                confirmButtonColor: '#0d6efd'
            });
            fromCityInput?.focus();
            return false;
        }

        if (!toCity) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please select destination city.',
                confirmButtonColor: '#0d6efd'
            });
            toCityInput?.focus();
            return false;
        }

        if (fromCity === toCity) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Departure and destination cities cannot be the same.',
                confirmButtonColor: '#0d6efd'
            });
            return false;
        }

        if (!departureDate) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please select departure date.',
                confirmButtonColor: '#0d6efd'
            });
            departureDateInput?.focus();
            return false;
        }

        if (returnDate && returnDate < departureDate) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Return date must be after departure date.',
                confirmButtonColor: '#0d6efd'
            });
            returnDateInput?.focus();
            return false;
        }

        if (!passengers) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please select number of passengers.',
                confirmButtonColor: '#0d6efd'
            });
            return false;
        }

        if (!name) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please enter your name.',
                confirmButtonColor: '#0d6efd'
            });
            document.querySelector('input[name="name"]')?.focus();
            return false;
        }

        if (!email) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please enter your email address.',
                confirmButtonColor: '#0d6efd'
            });
            document.querySelector('input[name="email"]')?.focus();
            return false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Email',
                text: 'Please enter a valid email address.',
                confirmButtonColor: '#0d6efd'
            });
            document.querySelector('input[name="email"]')?.focus();
            return false;
        }

        if (!phone) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please enter your phone number.',
                confirmButtonColor: '#0d6efd'
            });
            document.querySelector('input[name="phone"]')?.focus();
            return false;
        }

        return true;
    }

    // Form submit handler
    groupBookingForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Client-side validation
        if (!validateGroupBookingForm()) {
            return;
        }

        // Get dates from flatpickr instances or input values
        let departureDate = '';
        let returnDateValue = null;
        
        if (departureDatePicker && departureDatePicker.selectedDates.length > 0) {
            departureDate = departureDatePicker.formatDate(departureDatePicker.selectedDates[0], 'Y-m-d');
        } else if (departureDateInput?.value) {
            departureDate = departureDateInput.value;
        }
        
        if (returnDateInput?.value) {
            if (returnDatePicker && returnDatePicker.selectedDates.length > 0) {
                returnDateValue = returnDatePicker.formatDate(returnDatePicker.selectedDates[0], 'Y-m-d');
            } else {
                returnDateValue = returnDateInput.value;
            }
        }

        const formData = {
            from_city: fromCityInput?.value.trim() || '',
            to_city: toCityInput?.value.trim() || '',
            departure_date: departureDate,
            return_date: returnDateValue,
            passengers: document.querySelector('select[name="passengers"]')?.value || '',
            name: document.querySelector('input[name="name"]')?.value.trim() || '',
            email: document.querySelector('input[name="email"]')?.value.trim() || '',
            phone: document.querySelector('input[name="phone"]')?.value.trim() || '',
            organization: document.querySelector('input[name="organization"]')?.value.trim() || '',
            requirements: document.querySelector('textarea[name="requirements"]')?.value.trim() || '',
        };

        const submitButton = groupBookingForm.querySelector('button[type="submit"]');
        const originalButtonText = submitButton ? submitButton.innerHTML : 'Submit';

        // Show loading state
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
        }

        axios.post('/group-booking/submit', formData)
            .then(function (response) {
                // Success message with remaining requests info
                let successMessage = response.data.message || 'Thank you for your group booking request! We will contact you shortly with the best group fare quotes.';
                
                if (response.data.remaining_requests !== undefined) {
                    const remaining = response.data.remaining_requests;
                    if (remaining > 0) {
                        successMessage += `<br><br><small style="color: #6c757d;">You have <strong>${remaining}</strong> request${remaining !== 1 ? 's' : ''} remaining in the next 24 hours.</small>`;
                    } else {
                        successMessage += `<br><br><small style="color: #6c757d;">You have reached your daily limit. Please wait 24 hours before submitting another request.</small>`;
                    }
                }
                
                Swal.fire({
                    icon: 'success',
                    title: 'Request Submitted Successfully!',
                    html: successMessage,
                    confirmButtonColor: '#0d6efd',
                    confirmButtonText: 'OK',
                    timer: 5000,
                    timerProgressBar: true
                }).then(() => {
                    groupBookingForm.reset();
                    // Reset date pickers
                    if (departureDatePicker) {
                        departureDatePicker.clear();
                    }
                    if (returnDatePicker) {
                        returnDatePicker.clear();
                    }
                });
            })
            .catch(function (error) {
                let errorTitle = 'Error';
                let errorMessage = 'Something went wrong. Please try again later.';
                let errorDetails = '';

                if (error.response) {
                    // Server responded with error
                    if (error.response.status === 422 && error.response.data.errors) {
                        // Validation errors
                        errorTitle = 'Validation Error';
                        const errors = error.response.data.errors;
                        errorDetails = '<ul style="text-align: left; margin-top: 10px;">';
                        Object.keys(errors).forEach(function (field) {
                            errors[field].forEach(function (err) {
                                errorDetails += `<li>${err}</li>`;
                            });
                        });
                        errorDetails += '</ul>';
                        errorMessage = 'Please correct the following errors:';
                    } else if (error.response.status === 429) {
                        // Rate limit error
                        errorTitle = 'Daily Limit Reached';
                        errorMessage = error.response.data.message || 'You have reached the limit of group booking requests. Please try again later.';
                        
                        if (error.response.data.retry_after) {
                            errorDetails = `<br><br><small style="color: #6c757d;">You can submit again ${error.response.data.retry_after}.</small>`;
                        }
                        
                        if (error.response.data.used !== undefined && error.response.data.limit !== undefined) {
                            errorDetails += `<br><small style="color: #6c757d;">You have used <strong>${error.response.data.used}</strong> out of <strong>${error.response.data.limit}</strong> allowed requests in 24 hours.</small>`;
                        }
                    } else if (error.response.data.message) {
                        errorMessage = error.response.data.message;
                    }
                } else if (error.request) {
                    // Request made but no response
                    errorTitle = 'Network Error';
                    errorMessage = 'Unable to connect to the server. Please check your internet connection and try again.';
                }

                Swal.fire({
                    icon: 'error',
                    title: errorTitle,
                    html: errorMessage + errorDetails,
                    confirmButtonColor: '#0d6efd',
                    confirmButtonText: 'OK'
                });
            })
            .finally(function () {
                // Restore button state
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;
                }
            });
    });
});

