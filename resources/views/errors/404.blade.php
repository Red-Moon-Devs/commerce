<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page non trouvée</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Incluez votre CSS ici -->
</head>
<body class="">
   <section class="flex items-center h-full p-16 dark:bg-gray-50 dark:text-gray-800">
	    <div class="container flex flex-col items-center justify-center px-5 mx-auto my-8">
            <div class="max-w-md text-center">
                <h2 class="mb-8 font-extrabold text-9xl dark:text-gray-400">
                    <span class="sr-only">Error</span>404
                </h2>
                <p class="text-2xl font-semibold md:text-3xl">Sorry, we couldn't find this page.</p>
                <p class="mt-4 mb-8 dark:text-gray-600">But dont worry, you can find plenty of other things on our homepage.</p>
                <a rel="noopener noreferrer"  href="{{ url('/') }}" class="px-8 py-3 font-semibold rounded dark:bg-violet-600 dark:text-gray-50">Back to homepage</a>
            </div>
	    </div>
    </section>
</body>
</html>
