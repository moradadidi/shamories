<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Confirmation</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        /* Inline Tailwind fallback for email client compatibility */
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f7fafc; }
        a.button-link {
            background-color: #4299e1;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
        }
        a.button-link:hover {
            background-color: #2b6cb0;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">

  <table class="w-full max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
    <!-- Logo -->
    <tr>
      <td class="text-center pb-4">
        <img src="{{ asset('storage/profile/okkke.jpeg') }}" alt="adidi Logo" class="mx-auto w-32 h-auto">
      </td>
    </tr>

    <!-- Welcome Message -->
    <tr>
      <td class="text-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Welcome, {{ $name }}!</h1>
        <p class="text-gray-600">Thank you for joining us, {{ $name }}. Please confirm your email to activate your account and get started.</p>
      </td>
    </tr>

    <!-- Confirmation Link -->
    <tr>
      <td class="py-6 text-center">
        <a href="{{$href}}" class="text-blue-500 hover:underline">Confirm Your Account</a>
      </td>
    </tr>

    <!-- Instructions -->
    <tr>
      <td class="text-center text-sm text-gray-600 py-4">
        <p>If you did not sign up for this account, you can safely ignore this email. If you have any questions, please contact our support team.</p>
      </td>
    </tr>

    <!-- Footer -->
    <tr>
      <td class="pt-8 text-center text-xs text-gray-500">
        <p>© 2024 Our Platform. All rights reserved.</p>
        <p>1234 Your Street, City, Country</p>
        <p><a href="#" class="text-blue-500 hover:underline">Privacy Policy</a> | <a href="#" class="text-blue-500 hover:underline">Contact Us</a></p>
      </td>
    </tr>
  </table>

</body>
</html>
