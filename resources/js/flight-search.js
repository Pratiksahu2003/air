import Swal from 'sweetalert2';
import axios from 'axios';
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

// Flight search form handler with SweetAlert2
document.addEventListener('DOMContentLoaded', function() {
    const flightSearchForm = document.getElementById('flightSearchForm');
    if (!flightSearchForm) return;

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
    const departureDateInput = document.getElementById('departureDate');
    const returnDateInput = document.getElementById('returnDate');
    const returnDateContainer = document.getElementById('returnDateContainer');
    const adultsInput = document.getElementById('adults');
    const childrenInput = document.getElementById('children');
    const infantsInput = document.getElementById('infants');
    const contactNumberInput = document.getElementById('contactNumber');
    const emailAddressInput = document.getElementById('emailAddress');
    const tripTypeRadios = document.querySelectorAll('input[name="tripType"]');

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

    // Handle trip type change
    if (tripTypeRadios.length > 0) {
        tripTypeRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === 'roundtrip') {
                    returnDateContainer.style.display = 'block';
                    if (returnDateInput) {
                        returnDateInput.required = true;
                        // Update minDate of return date picker to departure date
                        if (departureDatePicker && departureDateInput.value) {
                            returnDatePicker.set('minDate', departureDateInput.value);
                        }
                    }
                } else {
                    returnDateContainer.style.display = 'none';
                    if (returnDateInput) {
                        returnDateInput.required = false;
                        returnDateInput.value = '';
                    }
                }
            });
        });
    }

    // Update return date minDate when departure date changes
    if (departureDatePicker && returnDatePicker) {
        departureDateInput.addEventListener('change', function() {
            if (this.value) {
                returnDatePicker.set('minDate', this.value);
                // If return date is already selected and is before new departure date, clear it
                if (returnDateInput.value && returnDateInput.value < this.value) {
                    returnDateInput.value = '';
                }
            }
        });
    }

    // Client-side validation function
    function validateFlightSearchForm() {
        const tripType = document.querySelector('input[name="tripType"]:checked')?.value || 'oneway';
        const fromCity = fromCityInput?.value.trim() || '';
        const toCity = toCityInput?.value.trim() || '';
        const departureDate = departureDateInput?.value || '';
        const returnDate = returnDateInput?.value || '';
        const adults = adultsInput?.value || '';
        const children = childrenInput?.value || '';
        const infants = infantsInput?.value || '';
        const contactNumber = contactNumberInput?.value.trim() || '';
        const email = emailAddressInput?.value.trim() || '';

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

        if (tripType === 'roundtrip' && !returnDate) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please select return date for round trip.',
                confirmButtonColor: '#0d6efd'
            });
            returnDateInput?.focus();
            return false;
        }

        if (!contactNumber) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please enter your contact number.',
                confirmButtonColor: '#0d6efd'
            });
            contactNumberInput?.focus();
            return false;
        }

        if (!email) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please enter your email address.',
                confirmButtonColor: '#0d6efd'
            });
            emailAddressInput?.focus();
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
            emailAddressInput?.focus();
            return false;
        }

        return true;
    }

    // Form submit handler
    flightSearchForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Client-side validation
        if (!validateFlightSearchForm()) {
            return;
        }

        const tripType = document.querySelector('input[name="tripType"]:checked')?.value || 'oneway';
        
        // Get dates from flatpickr instances or input values
        let departureDate = '';
        let returnDateValue = null;
        
        if (departureDatePicker && departureDatePicker.selectedDates.length > 0) {
            departureDate = departureDatePicker.formatDate(departureDatePicker.selectedDates[0], 'Y-m-d');
        } else if (departureDateInput?.value) {
            departureDate = departureDateInput.value;
        }
        
        if (tripType === 'roundtrip') {
            if (returnDatePicker && returnDatePicker.selectedDates.length > 0) {
                returnDateValue = returnDatePicker.formatDate(returnDatePicker.selectedDates[0], 'Y-m-d');
            } else if (returnDateInput?.value) {
                returnDateValue = returnDateInput.value;
            }
        }
        
        const formData = {
            trip_type: tripType,
            from_city: fromCityInput?.value.trim() || '',
            to_city: toCityInput?.value.trim() || '',
            departure_date: departureDate,
            return_date: returnDateValue,
            adults: parseInt(adultsInput?.value || 1),
            children: parseInt(childrenInput?.value || 0),
            infants: parseInt(infantsInput?.value || 0),
            contact_number: contactNumberInput?.value.trim() || '',
            email: emailAddressInput?.value.trim() || '',
        };

        const submitButton = flightSearchForm.querySelector('button[type="submit"]');
        const originalButtonText = submitButton ? submitButton.innerHTML : 'Submit';

        // Show loading state
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
        }

        axios.post('/flight-search/submit', formData)
            .then(function (response) {
                // Success message with remaining requests info
                let successMessage = response.data.message || 'Thank you for your flight search request! We will contact you shortly.';
                
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
                    // Optionally reset form or keep the data
                    // flightSearchForm.reset();
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
                        errorMessage = error.response.data.message || 'You have reached the limit of flight search requests. Please try again later.';
                        
                        // Add additional details if available
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

