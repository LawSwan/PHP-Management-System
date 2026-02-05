<?php
// Header layout.
// Keeps the same title and navigation across pages.
// Links are simple for now since login-based menus are not built yet.
?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VelocityNet Complaints</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="frontend/css/main.css">
    <script src="frontend/js/main.js" defer></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a'
                        },
                        dark: {
                            50: '#18181b',
                            100: '#27272a',
                            200: '#3f3f46',
                            300: '#52525b',
                            400: '#71717a',
                            500: '#a1a1aa',
                            600: '#d4d4d8',
                            700: '#e4e4e7',
                            800: '#f4f4f5',
                            900: '#fafafa'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #0c0c0e 0%, #1a1a1e 50%, #0c0c0e 100%);
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-gray-900 text-white antialiased">
    <!-- Navigation Header -->
    <nav class="bg-gray-900/80 backdrop-blur-sm border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo/Brand -->
                <div class="flex items-center">
                    <a href="index.php" class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">
                        VelocityNet
                    </a>
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="index.php" class="text-gray-300 hover:text-white hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-medium transition-all duration-200">
                            Home
                        </a>
                        <a href="index.php?action=enter_complaint" class="text-gray-300 hover:text-white hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-medium transition-all duration-200">
                            Enter Complaint
                        </a>
                        <a href="index.php?action=complaint_list" class="text-gray-300 hover:text-white hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-medium transition-all duration-200">
                            Complaint List
                        </a>
                        <a href="index.php?action=sitemap" class="text-gray-300 hover:text-white hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-medium transition-all duration-200">
                            Site Map
                        </a>
                    </div>
                </div>
                
                <!-- Auth Links -->
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center space-x-4">
                        <a href="index.php?action=login" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-all duration-200">
                            Login
                        </a>
                        <a href="index.php?action=register" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-all duration-200">
                            Register
                        </a>
                    </div>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button class="text-gray-300 hover:text-white hover:bg-gray-700 p-2 rounded-md">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Content Container -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
