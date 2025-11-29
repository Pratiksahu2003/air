@extends('admin.layouts.dashboard')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Site Configuration</h5>
        <p class="text-muted mb-0 small">Manage all site settings and information</p>
    </div>
    <div class="card-body">
        <form id="settingsForm" enctype="multipart/form-data">
            <!-- Basic Information -->
            <div class="mb-4">
                <h6 class="border-bottom pb-2 mb-3"><i class="fas fa-info-circle me-2"></i>Basic Information</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Site Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tagline" class="form-label">Tagline</label>
                        <input type="text" class="form-control" id="tagline" name="tagline">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="logo_file" class="form-label">Logo File</label>
                        <input type="file" class="form-control" id="logo_file" name="logo_file" accept="image/*" onchange="previewImage(this, 'logo_preview')">
                        <small class="text-muted">Upload a new logo (PNG, JPG, GIF, SVG, WEBP - Max 2MB)</small>
                        <div class="invalid-feedback"></div>
                        <div class="mt-2">
                            <label class="form-label small">Current Logo:</label>
                            <div class="border rounded p-2 bg-light" style="max-width: 200px;">
                                <img id="logo_preview" src="{{ asset(config('site.logo')) }}" alt="Logo Preview" class="img-fluid" style="max-height: 80px; width: auto;">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="logo" class="form-label small">Or Enter Logo Path:</label>
                            <input type="text" class="form-control form-control-sm" id="logo" name="logo" placeholder="Logo/logo.png">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="favicon_file" class="form-label">Favicon File</label>
                        <input type="file" class="form-control" id="favicon_file" name="favicon_file" accept="image/*" onchange="previewImage(this, 'favicon_preview')">
                        <small class="text-muted">Upload a new favicon (PNG, JPG, GIF, SVG, ICO, WEBP - Max 1MB)</small>
                        <div class="invalid-feedback"></div>
                        <div class="mt-2">
                            <label class="form-label small">Current Favicon:</label>
                            <div class="border rounded p-2 bg-light" style="max-width: 100px;">
                                <img id="favicon_preview" src="{{ asset(config('site.favicon')) }}" alt="Favicon Preview" class="img-fluid" style="max-height: 32px; width: auto;">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="favicon" class="form-label small">Or Enter Favicon Path:</label>
                            <input type="text" class="form-control form-control-sm" id="favicon" name="favicon" placeholder="favicon/fav.png">
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mb-4">
                <h6 class="border-bottom pb-2 mb-3"><i class="fas fa-phone me-2"></i>Contact Information</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contact_phone" class="form-label">Phone (for tel: links)</label>
                        <input type="text" class="form-control" id="contact_phone" name="contact[phone]" placeholder="+917838848340">
                        <small class="text-muted">No spaces (e.g., +917838848340)</small>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="contact_phone_display" class="form-label">Phone (for display)</label>
                        <input type="text" class="form-control" id="contact_phone_display" name="contact[phone_display]" placeholder="+91 78388 48340">
                        <small class="text-muted">With spaces for display</small>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="contact_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="contact_email" name="contact[email]">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="contact_admin_email" class="form-label">Admin Email</label>
                        <input type="email" class="form-control" id="contact_admin_email" name="contact[admin_email]">
                        <small class="text-muted">For notifications and contact form</small>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="contact_address" class="form-label">Address</label>
                        <textarea class="form-control" id="contact_address" name="contact[address]" rows="2"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="contact_support_hours" class="form-label">Support Hours</label>
                        <input type="text" class="form-control" id="contact_support_hours" name="contact[support_hours]" placeholder="24/7 Customer Support">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="mb-4">
                <h6 class="border-bottom pb-2 mb-3"><i class="fas fa-share-alt me-2"></i>Social Media Links</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="social_facebook" class="form-label">Facebook</label>
                        <input type="url" class="form-control" id="social_facebook" name="social[facebook]" placeholder="https://facebook.com/...">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="social_twitter" class="form-label">Twitter</label>
                        <input type="url" class="form-control" id="social_twitter" name="social[twitter]" placeholder="https://twitter.com/...">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="social_instagram" class="form-label">Instagram</label>
                        <input type="url" class="form-control" id="social_instagram" name="social[instagram]" placeholder="https://instagram.com/...">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="social_linkedin" class="form-label">LinkedIn</label>
                        <input type="url" class="form-control" id="social_linkedin" name="social[linkedin]" placeholder="https://linkedin.com/...">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="social_youtube" class="form-label">YouTube</label>
                        <input type="url" class="form-control" id="social_youtube" name="social[youtube]" placeholder="https://youtube.com/...">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>

            <!-- Services -->
            <div class="mb-4">
                <h6 class="border-bottom pb-2 mb-3"><i class="fas fa-briefcase me-2"></i>Services</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="services_group_booking" class="form-label">Group Booking</label>
                        <input type="text" class="form-control" id="services_group_booking" name="services[group_booking]">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="services_air_charter" class="form-label">Air Charter Services</label>
                        <input type="text" class="form-control" id="services_air_charter" name="services[air_charter]">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="services_mice" class="form-label">MICE Solutions</label>
                        <input type="text" class="form-control" id="services_mice" name="services[mice]">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="services_fix_departure" class="form-label">Fix Departure</label>
                        <input type="text" class="form-control" id="services_fix_departure" name="services[fix_departure]">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="services_corporate_travel" class="form-label">Corporate Travel</label>
                        <input type="text" class="form-control" id="services_corporate_travel" name="services[corporate_travel]">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="mb-4">
                <h6 class="border-bottom pb-2 mb-3"><i class="fas fa-star me-2"></i>Features</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="features_best_deals" class="form-label">Best Deals</label>
                        <input type="text" class="form-control" id="features_best_deals" name="features[best_deals]">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="features_dedicated_support" class="form-label">Dedicated Support</label>
                        <input type="text" class="form-control" id="features_dedicated_support" name="features[dedicated_support]">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="features_secure_booking" class="form-label">Secure Booking</label>
                        <input type="text" class="form-control" id="features_secure_booking" name="features[secure_booking]">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="features_instant_confirmation" class="form-label">Instant Confirmation</label>
                        <input type="text" class="form-control" id="features_instant_confirmation" name="features[instant_confirmation]">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="features_zero_cancellation" class="form-label">Zero Cancellation</label>
                        <input type="text" class="form-control" id="features_zero_cancellation" name="features[zero_cancellation]">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>

            <!-- Meta Information -->
            <div class="mb-4">
                <h6 class="border-bottom pb-2 mb-3"><i class="fas fa-tags me-2"></i>Meta Information</h6>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="meta_keywords" class="form-label">Keywords</label>
                        <input type="text" class="form-control" id="meta_keywords" name="meta[keywords]" placeholder="keyword1, keyword2, keyword3">
                        <small class="text-muted">Comma-separated keywords</small>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="meta_author" class="form-label">Author</label>
                        <input type="text" class="form-control" id="meta_author" name="meta[author]">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary" onclick="resetForm()">Reset</button>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span>
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Set up Axios defaults
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Base URL for assets
const baseUrl = '{{ url("/") }}';

// Load settings on page load
document.addEventListener('DOMContentLoaded', function() {
    loadSettings();
    
    // Handle form submission
    document.getElementById('settingsForm').addEventListener('submit', handleFormSubmit);
});

// Load current settings
function loadSettings() {
    axios.get('{{ route("admin.api.settings.index") }}')
        .then(function(response) {
            const config = response.data.data;
            
            // Basic Information
            document.getElementById('name').value = config.name || '';
            document.getElementById('tagline').value = config.tagline || '';
            document.getElementById('full_name').value = config.full_name || '';
            document.getElementById('logo').value = config.logo || '';
            document.getElementById('favicon').value = config.favicon || '';
            document.getElementById('description').value = config.description || '';
            
            // Update preview images
            if (config.logo) {
                const logoPath = config.logo.startsWith('/') ? config.logo.substring(1) : config.logo;
                document.getElementById('logo_preview').src = baseUrl + '/' + logoPath;
            }
            if (config.favicon) {
                const faviconPath = config.favicon.startsWith('/') ? config.favicon.substring(1) : config.favicon;
                document.getElementById('favicon_preview').src = baseUrl + '/' + faviconPath;
            }
            
            // Contact Information
            document.getElementById('contact_phone').value = config.contact?.phone || '';
            document.getElementById('contact_phone_display').value = config.contact?.phone_display || '';
            document.getElementById('contact_email').value = config.contact?.email || '';
            document.getElementById('contact_admin_email').value = config.contact?.admin_email || '';
            document.getElementById('contact_address').value = config.contact?.address || '';
            document.getElementById('contact_support_hours').value = config.contact?.support_hours || '';
            
            // Social Media
            document.getElementById('social_facebook').value = config.social?.facebook || '';
            document.getElementById('social_twitter').value = config.social?.twitter || '';
            document.getElementById('social_instagram').value = config.social?.instagram || '';
            document.getElementById('social_linkedin').value = config.social?.linkedin || '';
            document.getElementById('social_youtube').value = config.social?.youtube || '';
            
            // Services
            document.getElementById('services_group_booking').value = config.services?.group_booking || '';
            document.getElementById('services_air_charter').value = config.services?.air_charter || '';
            document.getElementById('services_mice').value = config.services?.mice || '';
            document.getElementById('services_fix_departure').value = config.services?.fix_departure || '';
            document.getElementById('services_corporate_travel').value = config.services?.corporate_travel || '';
            
            // Features
            document.getElementById('features_best_deals').value = config.features?.best_deals || '';
            document.getElementById('features_dedicated_support').value = config.features?.dedicated_support || '';
            document.getElementById('features_secure_booking').value = config.features?.secure_booking || '';
            document.getElementById('features_instant_confirmation').value = config.features?.instant_confirmation || '';
            document.getElementById('features_zero_cancellation').value = config.features?.zero_cancellation || '';
            
            // Meta
            document.getElementById('meta_keywords').value = config.meta?.keywords || '';
            document.getElementById('meta_author').value = config.meta?.author || '';
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error loading settings. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
            console.error('Error:', error);
        });
}

// Preview image before upload
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Handle form submission
function handleFormSubmit(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const spinner = document.getElementById('submitSpinner');
    
    submitBtn.disabled = true;
    if (spinner) {
        spinner.classList.remove('d-none');
    }
    
    const formData = new FormData(e.target);
    
    // Send FormData directly for file uploads
    // Add _method field for Laravel to recognize as PUT
    formData.append('_method', 'PUT');
    
    axios.post('{{ route("admin.api.settings.update") }}', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: response.data.message,
                confirmButtonColor: '#0d6efd',
                timer: 2000,
                timerProgressBar: true
            }).then(() => {
                // Reload settings to update previews if files were uploaded
                if (document.getElementById('logo_file').files.length > 0 || 
                    document.getElementById('favicon_file').files.length > 0) {
                    loadSettings();
                    // Clear file inputs
                    document.getElementById('logo_file').value = '';
                    document.getElementById('favicon_file').value = '';
                }
            });
        })
        .catch(function(error) {
            if (error.response && error.response.status === 422) {
                // Validation errors
                const errors = error.response.data.errors;
                let errorMessages = [];
                
                Object.keys(errors).forEach(key => {
                    // Handle nested keys like 'contact.phone'
                    const fieldId = key.replace(/\./g, '_').replace(/\[|\]/g, '');
                    const input = document.getElementById(fieldId) || document.querySelector(`[name="${key}"]`);
                    if (input) {
                        input.classList.add('is-invalid');
                        const feedback = input.nextElementSibling || input.parentElement.querySelector('.invalid-feedback');
                        if (feedback && feedback.classList.contains('invalid-feedback')) {
                            feedback.textContent = errors[key][0];
                        }
                    }
                    errorMessages.push(errors[key][0]);
                });
                
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: errorMessages.join('<br>'),
                    confirmButtonColor: '#0d6efd'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.response?.data?.message || 'An error occurred. Please try again.',
                    confirmButtonColor: '#0d6efd'
                });
            }
        })
        .finally(function() {
            submitBtn.disabled = false;
            if (spinner) {
                spinner.classList.add('d-none');
            }
        });
}

// Reset form
function resetForm() {
    Swal.fire({
        title: 'Are you sure?',
        text: "This will reload the current settings from the server.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, reset it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            loadSettings();
            // Clear file inputs
            document.getElementById('logo_file').value = '';
            document.getElementById('favicon_file').value = '';
            // Clear validation errors
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            document.querySelectorAll('.invalid-feedback').forEach(el => {
                el.textContent = '';
            });
        }
    });
}
</script>
@endpush

