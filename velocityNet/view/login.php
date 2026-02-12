<?php
// Login page.
// Displays output for this part of the site.
// Uses controller/model data to fill in the page.

require_once("header.php");
?>

<!-- Login Section -->
<div class="min-h-[calc(100vh-12rem)] flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <h2 class="font-serif text-4xl font-medium text-[#f5f3eb] mb-3">Welcome back</h2>
            <p class="text-stone-400">Sign in to manage your support tickets</p>
        </div>

        <!-- Login Form Card -->
        <div class="bg-[#1d211a]/60 backdrop-blur-sm border border-stone-700/50 rounded-xl shadow-2xl p-8">
<!-- form to submit data -->
            <form class="space-y-6" method="POST" action="#">
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-stone-300 mb-2">
                        Email address
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        required
                        class="w-full px-4 py-3 bg-[#151912] border border-stone-700 rounded-lg text-[#f5f3eb] placeholder-stone-500 focus:outline-none focus:ring-2 focus:ring-[#a8b89a]/30 focus:border-[#a8b89a] transition-all duration-200"
                        placeholder="you@example.com"
                    >
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-stone-300 mb-2">
                        Password
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        class="w-full px-4 py-3 bg-[#151912] border border-stone-700 rounded-lg text-[#f5f3eb] placeholder-stone-500 focus:outline-none focus:ring-2 focus:ring-[#a8b89a]/30 focus:border-[#a8b89a] transition-all duration-200"
                        placeholder="Enter your password"
                    >
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input
                            id="remember-me"
                            name="remember-me"
                            type="checkbox"
                            class="h-4 w-4 rounded border-stone-600 bg-[#151912] text-[#a8b89a] focus:ring-[#a8b89a]/30 focus:ring-offset-0"
                        >
                        <label for="remember-me" class="ml-2 block text-sm text-stone-400">
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="text-sm text-[#a8b89a] hover:text-[#c8c9c4] transition-colors duration-200">
                        Forgot password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-[#1d211a] hover:bg-[#252a21] text-[#f5f3eb] font-medium py-3 px-4 rounded-lg border border-stone-600 hover:border-stone-500 transition-all duration-200"
                >
                    Sign in
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-stone-700/50"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-[#1d211a] text-stone-500">or</span>
                </div>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <p class="text-stone-400">
                    Don't have an account?
                    <a href="register.php" class="text-[#a8b89a] hover:text-[#c8c9c4] font-medium transition-colors duration-200">
                        Create one
                    </a>
                </p>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="text-center">
            <p class="text-sm text-stone-500">
                Secure, encrypted connection
            </p>
        </div>
    </div>
</div>

<?php require_once("footer.php"); ?>