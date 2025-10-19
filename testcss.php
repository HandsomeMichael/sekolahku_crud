<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link href="./output.css" rel="stylesheet"> -->
   <link rel="stylesheet" href="src/output.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-8">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>
    <form action="#" method="POST" class="space-y-5">
      
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" id="email" name="email" required
          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" 
          placeholder="you@example.com">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" id="password" name="password" required
          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
          placeholder="••••••••">
      </div>

      <div class="flex items-center justify-between text-sm">
        <label class="flex items-center gap-2">
          <input type="checkbox" class="text-blue-600 rounded focus:ring-blue-500">
          Remember me
        </label>
        <a href="#" class="text-blue-600 hover:underline">Forgot password?</a>
      </div>

      <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
        Sign In
      </button>

    </form>

    <p class="text-sm text-gray-600 text-center mt-6"> Don't have an account? 
      <a href="#" class="text-red-200 font-medium hover:underline">Register</a>
    </p>
  </div>
</body>
</html>