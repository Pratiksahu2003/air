<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        // Only admins can access settings
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Only admins can access settings');
        }

        $config = config('site');
        
        return view('admin.settings.index', compact('config'));
    }

    /**
     * Get current site configuration (API endpoint)
     */
    public function getConfig()
    {
        // Only admins can access settings
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Only admins can access settings'
            ], 403);
        }

        $config = config('site');

        return response()->json([
            'success' => true,
            'data' => $config
        ]);
    }

    /**
     * Update site configuration
     */
    public function update(Request $request)
    {
        // Only admins can access settings
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Only admins can access settings'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'full_name' => 'nullable|string|max:255',
            'logo' => 'nullable|string|max:255',
            'logo_file' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
            'favicon' => 'nullable|string|max:255',
            'favicon_file' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg,ico,webp|max:1024',
            'description' => 'nullable|string',
            'contact.phone' => 'nullable|string|max:255',
            'contact.phone_display' => 'nullable|string|max:255',
            'contact.email' => 'nullable|email|max:255',
            'contact.admin_email' => 'nullable|email|max:255',
            'contact.address' => 'nullable|string',
            'contact.support_hours' => 'nullable|string|max:255',
            'social.facebook' => 'nullable|url|max:255',
            'social.twitter' => 'nullable|url|max:255',
            'social.instagram' => 'nullable|url|max:255',
            'social.linkedin' => 'nullable|url|max:255',
            'social.youtube' => 'nullable|url|max:255',
            'services.group_booking' => 'nullable|string|max:255',
            'services.air_charter' => 'nullable|string|max:255',
            'services.mice' => 'nullable|string|max:255',
            'services.fix_departure' => 'nullable|string|max:255',
            'services.corporate_travel' => 'nullable|string|max:255',
            'features.best_deals' => 'nullable|string|max:255',
            'features.dedicated_support' => 'nullable|string|max:255',
            'features.secure_booking' => 'nullable|string|max:255',
            'features.instant_confirmation' => 'nullable|string|max:255',
            'features.zero_cancellation' => 'nullable|string|max:255',
            'meta.keywords' => 'nullable|string',
            'meta.author' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $configPath = config_path('site.php');
            
            // Get current config
            $currentConfig = config('site');
            
            // Handle logo file upload
            $logoPath = $currentConfig['logo'] ?? 'Logo/logo.png';
            if ($request->hasFile('logo_file')) {
                $logoFile = $request->file('logo_file');
                $logoDir = public_path('Logo');
                
                // Create directory if it doesn't exist
                if (!File::exists($logoDir)) {
                    File::makeDirectory($logoDir, 0755, true);
                }
                
                // Get file extension
                $extension = $logoFile->getClientOriginalExtension();
                $filename = 'logo.' . $extension;
                
                // Delete old logo if exists
                $oldLogoPath = public_path($logoPath);
                if (File::exists($oldLogoPath) && $oldLogoPath !== public_path('Logo/' . $filename)) {
                    File::delete($oldLogoPath);
                }
                
                // Move uploaded file
                $logoFile->move($logoDir, $filename);
                $logoPath = 'Logo/' . $filename;
            } elseif ($request->filled('logo')) {
                // Use provided logo path
                $logoPath = $request->input('logo');
            }
            
            // Handle favicon file upload
            $faviconPath = $currentConfig['favicon'] ?? 'favicon/fav.png';
            if ($request->hasFile('favicon_file')) {
                $faviconFile = $request->file('favicon_file');
                $faviconDir = public_path('favicon');
                
                // Create directory if it doesn't exist
                if (!File::exists($faviconDir)) {
                    File::makeDirectory($faviconDir, 0755, true);
                }
                
                // Get file extension
                $extension = $faviconFile->getClientOriginalExtension();
                $filename = 'fav.' . $extension;
                
                // Delete old favicon if exists
                $oldFaviconPath = public_path($faviconPath);
                if (File::exists($oldFaviconPath) && $oldFaviconPath !== public_path('favicon/' . $filename)) {
                    File::delete($oldFaviconPath);
                }
                
                // Move uploaded file
                $faviconFile->move($faviconDir, $filename);
                $faviconPath = 'favicon/' . $filename;
            } elseif ($request->filled('favicon')) {
                // Use provided favicon path
                $faviconPath = $request->input('favicon');
            }
            
            // Merge with new values
            $newConfig = [
                'name' => $request->input('name', $currentConfig['name'] ?? ''),
                'tagline' => $request->input('tagline', $currentConfig['tagline'] ?? ''),
                'full_name' => $request->input('full_name', $currentConfig['full_name'] ?? ''),
                'logo' => $logoPath,
                'favicon' => $faviconPath,
                'description' => $request->input('description', $currentConfig['description'] ?? ''),
                'contact' => [
                    'phone' => $request->input('contact.phone', $currentConfig['contact']['phone'] ?? ''),
                    'phone_display' => $request->input('contact.phone_display', $currentConfig['contact']['phone_display'] ?? ''),
                    'email' => $request->input('contact.email', $currentConfig['contact']['email'] ?? ''),
                    'admin_email' => $request->input('contact.admin_email', $currentConfig['contact']['admin_email'] ?? ''),
                    'address' => $request->input('contact.address', $currentConfig['contact']['address'] ?? ''),
                    'support_hours' => $request->input('contact.support_hours', $currentConfig['contact']['support_hours'] ?? ''),
                ],
                'social' => [
                    'facebook' => $request->input('social.facebook', $currentConfig['social']['facebook'] ?? '#'),
                    'twitter' => $request->input('social.twitter', $currentConfig['social']['twitter'] ?? '#'),
                    'instagram' => $request->input('social.instagram', $currentConfig['social']['instagram'] ?? '#'),
                    'linkedin' => $request->input('social.linkedin', $currentConfig['social']['linkedin'] ?? '#'),
                    'youtube' => $request->input('social.youtube', $currentConfig['social']['youtube'] ?? '#'),
                ],
                'services' => [
                    'group_booking' => $request->input('services.group_booking', $currentConfig['services']['group_booking'] ?? ''),
                    'air_charter' => $request->input('services.air_charter', $currentConfig['services']['air_charter'] ?? ''),
                    'mice' => $request->input('services.mice', $currentConfig['services']['mice'] ?? ''),
                    'fix_departure' => $request->input('services.fix_departure', $currentConfig['services']['fix_departure'] ?? ''),
                    'corporate_travel' => $request->input('services.corporate_travel', $currentConfig['services']['corporate_travel'] ?? ''),
                ],
                'features' => [
                    'best_deals' => $request->input('features.best_deals', $currentConfig['features']['best_deals'] ?? ''),
                    'dedicated_support' => $request->input('features.dedicated_support', $currentConfig['features']['dedicated_support'] ?? ''),
                    'secure_booking' => $request->input('features.secure_booking', $currentConfig['features']['secure_booking'] ?? ''),
                    'instant_confirmation' => $request->input('features.instant_confirmation', $currentConfig['features']['instant_confirmation'] ?? ''),
                    'zero_cancellation' => $request->input('features.zero_cancellation', $currentConfig['features']['zero_cancellation'] ?? ''),
                ],
                'meta' => [
                    'keywords' => $request->input('meta.keywords', $currentConfig['meta']['keywords'] ?? ''),
                    'author' => $request->input('meta.author', $currentConfig['meta']['author'] ?? ''),
                ],
            ];

            // Generate PHP file content
            $phpContent = $this->generateConfigFile($newConfig);

            // Write to file
            File::put($configPath, $phpContent);

            // Clear config cache
            if (function_exists('opcache_reset')) {
                opcache_reset();
            }
            Artisan::call('config:clear');

            return response()->json([
                'success' => true,
                'message' => 'Settings updated successfully!',
                'data' => $newConfig
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating settings: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate PHP config file content
     */
    private function generateConfigFile(array $config): string
    {
        $content = "<?php\n\n";
        $content .= "return [\n";
        $content .= "    /*\n";
        $content .= "    |--------------------------------------------------------------------------\n";
        $content .= "    | Site Basic Information\n";
        $content .= "    |--------------------------------------------------------------------------\n";
        $content .= "    |\n";
        $content .= "    | This file contains all the basic information about the AirRJ website\n";
        $content .= "    | including site name, contact details, social media links, etc.\n";
        $content .= "    |\n";
        $content .= "    */\n\n";

        // Basic fields
        $content .= "    'name' => " . $this->formatValue($config['name']) . ",\n";
        $content .= "    'tagline' => " . $this->formatValue($config['tagline'] ?? '') . ",\n";
        $content .= "    'full_name' => " . $this->formatValue($config['full_name'] ?? '') . ",\n";
        $content .= "    'logo' => " . $this->formatValue($config['logo'] ?? '') . ",\n";
        $content .= "    'favicon' => " . $this->formatValue($config['favicon'] ?? '') . ",\n";
        $content .= "    'description' => " . $this->formatValue($config['description'] ?? '') . ",\n";
        $content .= "    \n";

        // Contact
        $content .= "    'contact' => [\n";
        $content .= "        'phone' => " . $this->formatValue($config['contact']['phone'] ?? '') . ", // For tel: links (no spaces)\n";
        $content .= "        'phone_display' => " . $this->formatValue($config['contact']['phone_display'] ?? '') . ", // For display (with spaces)\n";
        $content .= "        'email' => " . $this->formatValue($config['contact']['email'] ?? '') . ",\n";
        $content .= "        'admin_email' => " . $this->formatValue($config['contact']['admin_email'] ?? '') . ", // Admin/notification email for contact form\n";
        $content .= "        'address' => " . $this->formatValue($config['contact']['address'] ?? '') . ",\n";
        $content .= "        'support_hours' => " . $this->formatValue($config['contact']['support_hours'] ?? '') . ",\n";
        $content .= "    ],\n\n";

        // Social
        $content .= "    'social' => [\n";
        $content .= "        'facebook' => " . $this->formatValue($config['social']['facebook'] ?? '#') . ",\n";
        $content .= "        'twitter' => " . $this->formatValue($config['social']['twitter'] ?? '#') . ",\n";
        $content .= "        'instagram' => " . $this->formatValue($config['social']['instagram'] ?? '#') . ",\n";
        $content .= "        'linkedin' => " . $this->formatValue($config['social']['linkedin'] ?? '#') . ",\n";
        $content .= "        'youtube' => " . $this->formatValue($config['social']['youtube'] ?? '#') . ",\n";
        $content .= "    ],\n\n";

        // Services
        $content .= "    'services' => [\n";
        $content .= "        'group_booking' => " . $this->formatValue($config['services']['group_booking'] ?? '') . ",\n";
        $content .= "        'air_charter' => " . $this->formatValue($config['services']['air_charter'] ?? '') . ",\n";
        $content .= "        'mice' => " . $this->formatValue($config['services']['mice'] ?? '') . ",\n";
        $content .= "        'fix_departure' => " . $this->formatValue($config['services']['fix_departure'] ?? '') . ",\n";
        $content .= "        'corporate_travel' => " . $this->formatValue($config['services']['corporate_travel'] ?? '') . ",\n";
        $content .= "    ],\n\n";

        // Features
        $content .= "    'features' => [\n";
        $content .= "        'best_deals' => " . $this->formatValue($config['features']['best_deals'] ?? '') . ",\n";
        $content .= "        'dedicated_support' => " . $this->formatValue($config['features']['dedicated_support'] ?? '') . ",\n";
        $content .= "        'secure_booking' => " . $this->formatValue($config['features']['secure_booking'] ?? '') . ",\n";
        $content .= "        'instant_confirmation' => " . $this->formatValue($config['features']['instant_confirmation'] ?? '') . ",\n";
        $content .= "        'zero_cancellation' => " . $this->formatValue($config['features']['zero_cancellation'] ?? '') . ",\n";
        $content .= "    ],\n\n";

        // Meta
        $content .= "    'meta' => [\n";
        $content .= "        'keywords' => " . $this->formatValue($config['meta']['keywords'] ?? '') . ",\n";
        $content .= "        'author' => " . $this->formatValue($config['meta']['author'] ?? '') . ",\n";
        $content .= "    ],\n";
        $content .= "];\n";

        return $content;
    }

    /**
     * Format value for PHP array
     */
    private function formatValue($value): string
    {
        if (is_null($value)) {
            return "''";
        }
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_numeric($value)) {
            return $value;
        }
        // Escape single quotes and backslashes
        $value = str_replace('\\', '\\\\', $value);
        $value = str_replace("'", "\\'", $value);
        return "'" . $value . "'";
    }
}

