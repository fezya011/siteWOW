<footer class="border-t border-[#e3e3e0] bg-white">
    <div class="container mx-auto px-4 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <a href="{{ url('/posts') }}" class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-[#F53003]" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 0H0V48H24V42H10.5V0Z" fill="currentColor"/>
                        <path d="M32 20C30.5 17.5 27.5 15.5 23.5 14.5C19.5 13.5 15.5 13 11.5 13C8 13 5 14 2.5 16C0 18 0 21 0 25C0 29 1 32 3 34C5 36 8 37 12 37C16 37 19 36 22 34C25 32 27 29 28 25C29 21 29 17 27 14C25 11 22 9 18 8C14 7 10 7 6 8C2 9 0 11 0 14C0 17 2 19 5 20C8 21 11 21 15 21C19 21 22 21 25 20C28 19 30 17 32 14C34 11 34 8 32 5C30 2 27 0 23 0C19 0 16 2 14 5C12 8 12 11 13 14C14 17 16 19 19 20C22 21 25 21 29 21C33 21 36 21 39 20C42 19 44 17 45 14C46 11 46 8 45 5C43 2 40 0 37 0C34 0 31 2 30 5C29 8 29 11 30 14C31 17 33 19 36 20C39 21 42 21 46 21C50 21 53 21 56 20C59 19 61 17 62 14C63 11 63 8 62 5C60 2 57 0 54 0C51 0 48 2 47 5" fill="currentColor"/>
                    </svg>
                    <span class="text-lg font-semibold text-[#1b1b18]">Laravel Posts</span>
                </a>
                <p class="mt-2 text-sm text-[#706f6c]">A community for Laravel developers</p>
            </div>

            <div class="flex space-x-6">
                <a href="{{ url('/about') }}" class="text-sm text-[#706f6c] hover:text-[#1b1b18] transition-colors">About</a>
                <a href="#" class="text-sm text-[#706f6c] hover:text-[#1b1b18] transition-colors">Contact</a>
                <a href="#" class="text-sm text-[#706f6c] hover:text-[#1b1b18] transition-colors">Privacy</a>
                <a href="#" class="text-sm text-[#706f6c] hover:text-[#1b1b18] transition-colors">Terms</a>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-[#e3e3e0] text-center">
            <p class="text-sm text-[#706f6c]">© {{ date('Y') }} Laravel Posts. All rights reserved.</p>
        </div>
    </div>
</footer>
