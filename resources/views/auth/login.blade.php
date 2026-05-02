<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login - Bina Abdi Wiyata</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --blue-deep:  #1e3a5f;
            --blue-mid:   #2563eb;
            --blue-soft:  #3b82f6;
            --blue-pale:  #dbeafe;
            --blue-ghost: #eff6ff;
            --gold:       #c9a84c;
            --text-main:  #1e293b;
            --text-muted: #64748b;
        }
        body { font-family: 'DM Sans', sans-serif; }

        .noise-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none; z-index: 0;
        }

        .gold-rule {
            display: inline-block;
            width: 3rem;
            height: 2px;
            background: linear-gradient(90deg, var(--gold), transparent);
            border-radius: 999px;
        }

        .tab-btn {
            flex: 1;
            padding: 0.6rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            border-radius: 0.6rem;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .tab-btn.active {
            background: var(--blue-mid);
            color: white;
            box-shadow: 0 2px 8px rgba(37,99,235,0.3);
        }
        .tab-btn.inactive {
            background: transparent;
            color: var(--text-muted);
        }
        .tab-btn.inactive:hover {
            background: var(--blue-ghost);
            color: var(--blue-deep);
        }

        .form-input {
            width: 100%;
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--text-main);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .form-input:focus {
            border-color: var(--blue-soft);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        }
        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }
    </style>
    <script>
        function switchLoginMethod(method) {
            const label = document.getElementById('identifier-label');
            const input = document.getElementById('identifier');
            if (method === 'email') {
                label.innerText = 'Email';
                input.setAttribute('type', 'email');
                input.setAttribute('placeholder', 'Enter your email');
            } else {
                label.innerText = 'NIS / NIP';
                input.setAttribute('type', 'text');
                input.setAttribute('placeholder', 'Enter your NIS or NIP');
            }
            document.getElementById('login_type').value = method;
            document.getElementById('email-tab').className   = 'tab-btn ' + (method === 'email'    ? 'active' : 'inactive');
            document.getElementById('nis-nip-tab').className = 'tab-btn ' + (method === 'nisn_nip' ? 'active' : 'inactive');
        }
    </script>
</head>
<body class="noise-bg relative min-h-screen flex items-center justify-center bg-gradient-to-br from-[#eff6ff] via-white to-[#dbeafe] px-4 py-12">

    <!-- Decorative orbs -->
    <div class="absolute top-0 right-0 w-80 h-80 rounded-full bg-blue-100 opacity-50 blur-3xl pointer-events-none -translate-y-1/3 translate-x-1/4"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-blue-200 opacity-30 blur-3xl pointer-events-none translate-y-1/3 -translate-x-1/4"></div>

    <div class="relative z-10 w-full max-w-5xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row border border-[var(--blue-pale)]">

        <!-- Left: Branding Panel -->
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-b from-[#eff6ff] to-[#dbeafe] flex-col justify-center items-center p-10 relative">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[var(--blue-mid)] to-blue-400"></div>

            <img src="{{ asset('images/login.webp') }}"
                 alt="School"
                 class="w-full object-cover rounded-2xl mb-8">

            <div class="flex items-center gap-3 mb-2">
                <img src="{{ asset('images/baw-logo.webp') }}" alt="Logo" class="w-9 h-9 object-contain">
                <h2 class="text-2xl font-bold text-[var(--blue-deep)]">Bina Abdi Wiyata</h2>
            </div>
            <div class="flex justify-center my-3"><span class="gold-rule"></span></div>
            <p class="text-xs text-[var(--text-muted)] text-center italic tracking-wide">
                A Life-improving Centre for Community Learning Activities
            </p>
        </div>

        <!-- Right: Form Panel -->
        <div class="w-full md:w-1/2 py-8 px-4 md:px-8 md:p-10">

            <!-- Mobile Header -->
            <div class="flex items-center justify-center gap-3 mb-6 md:hidden">
                <img src="{{ asset('images/baw-logo.webp') }}" alt="Logo" class="w-8 h-8 object-contain">
                <h2 class="text-xl font-bold text-[var(--blue-deep)]">Bina Abdi Wiyata</h2>
            </div>

            <div class="hidden md:block text-center mb-8">
                <span class="text-xs font-semibold tracking-widest uppercase text-[var(--blue-soft)]">Welcome Back</span>
                <h2 class="text-3xl font-bold text-[var(--blue-deep)] mt-1">Sign In</h2>
                <div class="flex justify-center mt-3"><span class="gold-rule"></span></div>
            </div>

            <!-- Errors -->
            @if ($errors->any())
                <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Tabs -->
            <div class="flex gap-1.5 mb-6 p-1 bg-[var(--blue-ghost)] rounded-xl">
                <button id="email-tab" class="tab-btn active" onclick="switchLoginMethod('email')">Email</button>
                <button id="nis-nip-tab" class="tab-btn inactive" onclick="switchLoginMethod('nisn_nip')">NIS / NIP</button>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <input type="hidden" id="login_type" name="login_type" value="email">

                <div>
                    <label id="identifier-label" class="form-label">Email</label>
                    <input id="identifier" type="email" name="identifier"
                           class="form-input"
                           placeholder="Enter your email" required>
                </div>

                <div>
                    <label class="form-label">Password</label>
                    <input type="password" name="password"
                           class="form-input"
                           placeholder="Enter your password" required>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('password.request') }}"
                       class="text-xs font-medium text-[var(--blue-soft)] hover:text-[var(--blue-deep)] transition-colors duration-200">
                        Forgot Password?
                    </a>
                </div>

                <button type="submit"
                        class="w-full bg-[var(--blue-mid)] text-white py-3.5 rounded-xl font-semibold text-sm hover:bg-blue-700 transition-colors duration-200 shadow-md">
                    Sign In
                </button>
            </form>

            <div class="mt-8 flex justify-center">
                <a href="{{ route('welcome') }}"
                   class="inline-flex items-center gap-1.5 text-sm font-medium text-[var(--text-muted)] hover:text-[var(--blue-mid)] transition-colors duration-200 group">
                    <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Landing Page
                </a>
            </div>
        </div>
    </div>
</body>
</html>