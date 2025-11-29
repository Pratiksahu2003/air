import Swal from 'sweetalert2';
import axios from 'axios';

// Contact form handler with SweetAlert2
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    if (!contactForm) return;

    // Get CSRF token
    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : null;

    // Configure axios
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    if (csrfToken) {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
    }

    // Client-side validation function
    function validateContactForm() {
        const name = contactForm.querySelector('input[name="name"]').value.trim();
        const email = contactForm.querySelector('input[name="email"]').value.trim();
        const phone = contactForm.querySelector('input[name="phone"]').value.trim();
        const subject = contactForm.querySelector('input[name="subject"]').value.trim();
        const message = contactForm.querySelector('textarea[name="message"]').value.trim();

        if (!name) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please enter your name.',
                confirmButtonColor: '#0d6efd'
            });
            return false;
        }

        if (!email) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please enter your email address.',
                confirmButtonColor: '#0d6efd'
            });
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
            return false;
        }

        if (!phone) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please enter your phone number.',
                confirmButtonColor: '#0d6efd'
            });
            return false;
        }

        if (!subject) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please enter a subject for your message.',
                confirmButtonColor: '#0d6efd'
            });
            return false;
        }

        if (!message) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please enter your message.',
                confirmButtonColor: '#0d6efd'
            });
            return false;
        }

        if (message.length < 10) {
            Swal.fire({
                icon: 'error',
                title: 'Message Too Short',
                text: 'Please enter a message with at least 10 characters.',
                confirmButtonColor: '#0d6efd'
            });
            return false;
        }

        return true;
    }

    // Form submit handler
    contactForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Client-side validation
        if (!validateContactForm()) {
            return;
        }

        const formData = new FormData(contactForm);
        const data = Object.fromEntries(formData.entries());
        const submitButton = contactForm.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.innerHTML;

        // Show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';

        axios.post(contactForm.getAttribute('action') || '/contact', data)
            .then(function (response) {
                // Success message
                Swal.fire({
                    icon: 'success',
                    title: 'Message Sent Successfully!',
                    html: response.data.message || 'Thank you for contacting us! We will get back to you soon.',
                    confirmButtonColor: '#0d6efd',
                    confirmButtonText: 'OK',
                    timer: 5000,
                    timerProgressBar: true
                }).then(() => {
                    contactForm.reset();
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
                        errorTitle = 'Too Many Requests';
                        errorMessage = error.response.data.message || 'You have reached the limit of contact requests. Please try again later.';
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
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            });
    });
});

