<footer class="border-t border-[#e3e3e0] bg-white">
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <a href="{{ url('/posts') }}" class="flex items-center space-x-2 logo-wrap">
                    <svg class="w-8 h-8 text-[#F53003]" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Тень -->
                        <circle cx="26" cy="26" r="18" fill="currentColor" fill-opacity="0.2"/>
                        <!-- Основной круг -->
                        <circle cx="22" cy="22" r="18" fill="currentColor"/>
                        <!-- Стрелка -->
                        <path d="M14 30L30 14M30 14H18M30 14V26" stroke="#FDFDFC" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="text-xl font-mono font-semibold text-[#1b1b18]">
                        <span class="text-[#1b1b18]">/</span>postly<span class="logo-cursor">_</span>
                    </span>
                </a>
                <p class="mt-2 text-sm text-[#706f6c]">A community for developers</p>
            </div>

            <div class="flex space-x-6">
                <a href="{{ url('/about') }}" class="text-sm text-[#706f6c] hover:text-[#1b1b18] transition-colors">About</a>
                <a href="#" class="text-sm text-[#706f6c] hover:text-[#1b1b18] transition-colors">Contact</a>
                <a href="#" class="text-sm text-[#706f6c] hover:text-[#1b1b18] transition-colors">Privacy</a>
                <a href="#" class="text-sm text-[#706f6c] hover:text-[#1b1b18] transition-colors">Terms</a>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-[#e3e3e0] text-center">
            <p class="text-sm text-[#706f6c]">© {{ date('Y') }} Postly. All rights reserved.</p>
        </div>
    </div>
</footer>
