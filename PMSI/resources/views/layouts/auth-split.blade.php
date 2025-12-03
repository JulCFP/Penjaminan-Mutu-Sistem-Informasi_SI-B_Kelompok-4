<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Haritani</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .haritani-bg { background-color: #849C26; }
        .haritani-text { color: #849C26; }
        .btn-haritani { background-color: #849C26; color: white; transition: 0.3s; }
        .btn-haritani:hover { background-color: #6d821e; }
    </style>
</head>
<body class="h-screen w-full overflow-hidden bg-white">

    <div class="flex w-full h-full">
        <div class="hidden md:block w-1/2 h-full relative">
            <img src="{{ asset('images/login-bg.png') }}" 
                 class="absolute inset-0 w-full h-full object-cover" 
                 alt="Background Haritani">
            <div class="absolute inset-0 bg-black/10"></div>
        </div>

        <div class="w-full md:w-1/2 bg-white flex flex-col justify-center items-center p-8 overflow-y-auto">
            <div class="w-full max-w-md">
                <div class="flex justify-end mb-8">
                    <div class="haritani-bg text-white px-6 py-2 rounded-full font-bold flex items-center gap-2 shadow-lg">
                        <span>★ HARITANI</span>
                    </div>
                </div>

                @yield('content')

                <div class="mt-8 text-center text-gray-500 text-sm">
                    @yield('footer-link')
                </div>
            </div>
        </div>
    </div>

</body>
</html>