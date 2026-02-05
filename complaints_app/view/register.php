<?php
// Registration page.
// Customer can create a row in the customer table.
// Required fields are email, first name, last name, and password.

require_once("view/header.php");
?>

<!-- Registration Section -->
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-white mb-2">Create your account</h2>
            <p class="text-gray-400">Join VelocityNet to submit and track your complaints</p>
        </div>

        <?php if (isset($errorMessage) && $errorMessage != "") { ?>
            <!-- Show validation or insert errors -->
            <div class="bg-red-500/10 border border-red-500/20 rounded-lg p-4 mb-6">
                <div class="flex">
                    <svg class="w-5 h-5 text-red-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="ml-3 text-sm text-red-400"><?php echo $errorMessage; ?></p>
                </div>
            </div>
        <?php } ?>

        <?php if (isset($successMessage) && $successMessage != "") { ?>
            <!-- Show success message after insert -->
            <div class="bg-green-500/10 border border-green-500/20 rounded-lg p-4 mb-6">
                <div class="flex">
                    <svg class="w-5 h-5 text-green-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <p class="ml-3 text-sm text-green-400"><?php echo $successMessage; ?></p>
                </div>
            </div>
        <?php } ?>
        
        <!-- Registration Form Card -->
        <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl shadow-2xl p-8">
            <form action="index.php?action=register" method="post" class="space-y-6">
                
                <!-- Required Fields Section -->
                <div class="space-y-6">
                    <div class="border-b border-gray-700 pb-6">
                        <h3 class="text-lg font-medium text-white mb-4">Required Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Email Field -->
                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                                    Email Address <span class="text-red-400">*</span>
                                </label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    required
                                    class="w-full px-3 py-3 bg-gray-900/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="your.email@example.com"
                                >
                            </div>
                            
                            <!-- First Name -->
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-300 mb-2">
                                    First Name <span class="text-red-400">*</span>
                                </label>
                                <input
                                    id="first_name"
                                    name="first_name"
                                    type="text"
                                    required
                                    class="w-full px-3 py-3 bg-gray-900/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="John"
                                >
                            </div>
                            
                            <!-- Last Name -->
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-300 mb-2">
                                    Last Name <span class="text-red-400">*</span>
                                </label>
                                <input
                                    id="last_name"
                                    name="last_name"
                                    type="text"
                                    required
                                    class="w-full px-3 py-3 bg-gray-900/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="Doe"
                                >
                            </div>
                            
                            <!-- Password -->
                            <div class="md:col-span-2">
                                <label for="customer_password" class="block text-sm font-medium text-gray-300 mb-2">
                                    Password <span class="text-red-400">*</span>
                                </label>
                                <input
                                    id="customer_password"
                                    name="customer_password"
                                    type="password"
                                    required
                                    class="w-full px-3 py-3 bg-gray-900/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="Create a secure password"
                                >
                            </div>
                        </div>
                    </div>
                    
                    <!-- Optional Fields Section -->
                    <div>
                        <h3 class="text-lg font-medium text-white mb-4">Contact Information (Optional)</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Street Address -->
                            <div class="md:col-span-2">
                                <label for="street_address" class="block text-sm font-medium text-gray-300 mb-2">
                                    Street Address
                                </label>
                                <input
                                    id="street_address"
                                    name="street_address"
                                    type="text"
                                    class="w-full px-3 py-3 bg-gray-900/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="123 Main Street"
                                >
                            </div>
                            
                            <!-- City -->
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-300 mb-2">
                                    City
                                </label>
                                <input
                                    id="city"
                                    name="city"
                                    type="text"
                                    class="w-full px-3 py-3 bg-gray-900/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="New York"
                                >
                            </div>
                            
                            <!-- State -->
                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-300 mb-2">
                                    State
                                </label>
                                <input
                                    id="state"
                                    name="state"
                                    type="text"
                                    class="w-full px-3 py-3 bg-gray-900/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="NY"
                                >
                            </div>
                            
                            <!-- Zip Code -->
                            <div>
                                <label for="zip_code" class="block text-sm font-medium text-gray-300 mb-2">
                                    Zip Code
                                </label>
                                <input
                                    id="zip_code"
                                    name="zip_code"
                                    type="text"
                                    class="w-full px-3 py-3 bg-gray-900/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="10001"
                                >
                            </div>
                            
                            <!-- Phone Number -->
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-300 mb-2">
                                    Phone Number
                                </label>
                                <input
                                    id="phone_number"
                                    name="phone_number"
                                    type="tel"
                                    class="w-full px-3 py-3 bg-gray-900/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="(555) 123-4567"
                                >
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="pt-6">
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                    >
                        Create Account
                    </button>
                </div>
            </form>
            
            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-400">
                    Already have an account?
                    <a href="index.php?action=login" class="text-blue-400 hover:text-blue-300 font-medium transition-colors duration-200">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>
        
        <!-- Additional Info -->
        <div class="text-center">
            <p class="text-sm text-gray-500">
                By creating an account, you agree to our Terms of Service and Privacy Policy
            </p>
        </div>
    </div>
</div>

<?php require_once("view/footer.php"); ?>
