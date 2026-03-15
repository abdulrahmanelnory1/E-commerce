<x-guest-layout>
    <style>
        .auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 5px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .auth-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.25rem;
            text-align: center;
        }

        .auth-subtitle {
            text-align: center;
            color: #9ca3af;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        .input-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
        }

        .input-field {
            width: 100%;
            padding: 0.65rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.9rem;
            color: #333;
            transition: all 0.3s ease;
            outline: none;
            box-sizing: border-box;
        }

        .input-field:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102,126,234,0.15);
        }

        .btn-login {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102,126,234,0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102,126,234,0.45);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 1.25rem 0;
        }

        .divider hr {
            flex: 1;
            border: none;
            border-top: 2px solid #f3f4f6;
        }

        .divider span {
            color: #9ca3af;
            font-size: 0.8rem;
            white-space: nowrap;
        }

        .social-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0.65rem 1rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            flex: 1;
        }

        .social-btn:hover {
            transform: translateY(-2px);
        }

        .btn-google {
            border: 2px solid #e5e7eb;
            color: #333;
            background: white;
        }

        .btn-google:hover {
            border-color: #667eea;
            box-shadow: 0 5px 15px rgba(102,126,234,0.15);
            color: #333;
        }

        .btn-facebook {
            border: 2px solid #1877F2;
            color: #1877F2;
            background: white;
        }

        .btn-facebook:hover {
            background: #1877F2;
            color: white;
            box-shadow: 0 5px 15px rgba(24,119,242,0.3);
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.83rem;
            color: #6b7280;
            cursor: pointer;
        }

        .remember-label input {
            accent-color: #667eea;
            width: 15px;
            height: 15px;
        }

        .forgot-link {
            font-size: 0.83rem;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-link:hover { text-decoration: underline; }

        .register-link {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.85rem;
            color: #6b7280;
        }

        .register-link a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover { text-decoration: underline; }

        .error-msg {
            text-align: center;
            color: #ef4444;
            font-size: 0.82rem;
            margin-top: 0.75rem;
            padding: 0.5rem;
            background: #fef2f2;
            border-radius: 8px;
        }
    </style>

    <div class="auth-card">

        <h1 class="auth-title">👋 Welcome Back</h1>
        <p class="auth-subtitle">Sign in to your account to continue</p>

        {{-- Session Status --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="input-group">
                <label class="input-label" for="email">Email Address</label>
                <input id="email"
                       class="input-field"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required autofocus autocomplete="username"
                       placeholder="you@example.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Password --}}
            <div class="input-group">
                <label class="input-label" for="password">Password</label>
                <input id="password"
                       class="input-field"
                       type="password"
                       name="password"
                       required autocomplete="current-password"
                       placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Remember + Forgot --}}
            <div class="remember-row">
                <label class="remember-label">
                    <input type="checkbox" name="remember" id="remember_me">
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            {{-- Login Button --}}
            <button type="submit" class="btn-login">
                Sign In
            </button>

        </form>

        {{-- Divider --}}
        <div class="divider">
            <hr><span>or continue with</span><hr>
        </div>

        {{-- Social Buttons --}}
        <div style="display:flex; gap:10px;">
            <a href="{{ route('social.redirect', 'google') }}" class="social-btn btn-google">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="18" height="18">
                Google
            </a>
            <a href="{{ route('social.redirect', 'facebook') }}" class="social-btn btn-facebook">
                <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" width="18" height="18">
                Facebook
            </a>
        </div>

        {{-- Error Message --}}
        @if(session('error'))
            <div class="error-msg">{{ session('error') }}</div>
        @endif

        {{-- Register Link --}}
        <div class="register-link">
            Don't have an account?
            <a href="{{ route('register') }}">Create one</a>
        </div>

    </div>

</x-guest-layout>