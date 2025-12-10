<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SGAL') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
    <script>
        // Modal management functions
        function openAcceptModal(cleaningId) {
            document.getElementById('acceptForm').action = `/cleaner/dashboard/${cleaningId}/update-status`;
            document.getElementById('acceptModal').classList.remove('hidden');
        }

        function closeAcceptModal() {
            document.getElementById('acceptModal').classList.add('hidden');
        }

        function openDeclineModal(cleaningId) {
            document.getElementById('declineForm').action = `/cleaner/dashboard/${cleaningId}/update-status`;
            document.getElementById('declineModal').classList.remove('hidden');
        }

        function closeDeclineModal() {
            document.getElementById('declineModal').classList.add('hidden');
        }

        function openRescheduleModal(cleaningId) {
            document.getElementById('rescheduleForm').action = `/cleaner/dashboard/${cleaningId}/update-status`;
            document.getElementById('rescheduleModal').classList.remove('hidden');
        }

        function closeRescheduleModal() {
            document.getElementById('rescheduleModal').classList.add('hidden');
        }

        function openStartModal(cleaningId) {
            document.getElementById('startForm').action = `/cleaner/dashboard/${cleaningId}/update-status`;
            document.getElementById('startModal').classList.remove('hidden');
        }

        function closeStartModal() {
            document.getElementById('startModal').classList.add('hidden');
        }

        function openCompleteModal(cleaningId) {
            document.getElementById('completeForm').action = `/cleaner/dashboard/${cleaningId}/update-status`;
            document.getElementById('completeModal').classList.remove('hidden');
        }

        function closeCompleteModal() {
            document.getElementById('completeModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const modals = [
                'acceptModal',
                'declineModal',
                'rescheduleModal',
                'startModal',
                'completeModal'
            ];

            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        }

        // Close modals with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modals = [
                    'acceptModal',
                    'declineModal',
                    'rescheduleModal',
                    'startModal',
                    'completeModal'
                ];

                modals.forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (!modal.classList.contains('hidden')) {
                        modal.classList.add('hidden');
                    }
                });
            }
        });

        // Set minimum date for reschedule to today
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            const rescheduleDateInput = document.querySelector('input[name="reschedule_date"]');
            if (rescheduleDateInput) {
                rescheduleDateInput.min = today;
            }
        });
    </script>
</html>
