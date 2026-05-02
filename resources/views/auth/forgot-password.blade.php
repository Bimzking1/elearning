<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Forgot Password - Bina Abdi Wiyata</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
</head>
<body class="noise-bg relative min-h-screen flex items-center justify-center bg-gradient-to-br from-[#eff6ff] via-white to-[#dbeafe] px-4 py-12">

    <!-- Decorative orbs -->
    <div class="absolute top-0 right-0 w-80 h-80 rounded-full bg-blue-100 opacity-50 blur-3xl pointer-events-none -translate-y-1/3 translate-x-1/4"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-blue-200 opacity-30 blur-3xl pointer-events-none translate-y-1/3 -translate-x-1/4"></div>

    <div class="relative z-10 w-full max-w-md mx-auto bg-white rounded-2xl shadow-xl overflow-hidden border border-[var(--blue-pale)]">

        <!-- Top accent bar -->
        <div class="h-1 bg-gradient-to-r from-[var(--blue-mid)] to-blue-400"></div>

        <div class="p-8 md:p-10">

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-[var(--blue-pale)] mb-4">
                    <svg class="w-5 h-5 text-[var(--blue-mid)]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
                <p class="text-xs font-semibold tracking-widest uppercase text-[var(--blue-soft)] mb-1">Account Recovery</p>
                <h2 class="text-2xl font-bold text-[var(--blue-deep)]">Forgot Password</h2>
                <div class="flex justify-center mt-3"><span class="gold-rule"></span></div>
                <p class="text-sm text-[var(--text-muted)] mt-4 leading-relaxed">
                    Enter your registered email and we'll send you a link to reset your password.
                </p>
            </div>

            <!-- Status Message -->
            @if (session('status'))
                <div class="mb-5 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-start gap-2">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

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

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="form-label">Registered Email</label>
                    <input type="email" name="email" required
                           placeholder="Enter your registered email at PKBM"
                           class="form-input" />
                </div>

                <button type="submit"
                        class="w-full bg-[var(--blue-mid)] text-white py-3.5 rounded-xl font-semibold text-sm hover:bg-blue-700 transition-colors duration-200 shadow-md">
                    Send Reset Link
                </button>
            </form>

            <!-- Back links -->
            <div class="mt-7 flex flex-col items-center gap-2">
                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-1.5 text-sm font-medium text-[var(--text-muted)] hover:text-[var(--blue-mid)] transition-colors duration-200 group">
                    <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Login
                </a>
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