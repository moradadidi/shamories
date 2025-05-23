<x-master title="Email Verification Successful" darkmode>
    <div class="max-w-lg mx-auto text-center py-12 px-6 dark:bg-gray-800">
        <!-- Success Title -->
        <h1 class="text-3xl font-bold text-green-600 dark:text-green-400 mb-6">Email Verification Successful!</h1>

        <!-- User Greeting -->
        <p class="text-lg text-gray-700 dark:text-gray-300 mb-4">Hello {{ $name }},</p>

        <!-- Success Message -->
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">
            We're excited to let you know that your email address has been successfully verified. Thank you for confirming your account. You can now enjoy all the features we offer!
        </p>

        <!-- Next Steps / Call to Action -->
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">
            If you’re ready to get started, click the button below to log in and explore your account.
        </p>

        <!-- Call to Action Button -->
        <a href="{{ route('login.show') }}" class="inline-block px-8 py-3 bg-green-600 dark:bg-green-700 text-white font-semibold rounded-lg shadow hover:bg-green-700 dark:hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-300 dark:focus:ring-green-400">
            Log in to Your Account
        </a>

        <!-- Support Info -->
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-6">
            If you have any questions or need further assistance, feel free to contact our support team.
        </p>
    </div>
</x-master>


