<footer class="bg-[#161616] text-white text-sm py-12 px-6 flex flex-col md:flex-row gap-y-10 md:gap-y-0 md:gap-x-10">
    <div id="address" class="flex flex-col gap-y-6 md:gap-y-12 w-full md:w-1/4">
        <p>НУ Театар Комедија © {{ date('Y') }}</p>
        <p>Бул. Климент Охридски бр.27, Скопје 1000, Северна Македонија</p>
    </div>

    <livewire:user.news-letter-sender />

    <div id="our-links" class="flex flex-col gap-y-4 w-full md:w-1/4 items-center md:items-start">
        <div class="flex gap-x-4 justify-center md:justify-start">
            <a href="https://www.facebook.com/TeatarKomedija"><img src="{{ asset('./images/contact-icons/Facebook-logo.svg') }}" alt=""></a>
            <a href="https://www.instagram.com/teatarkomedija/"><img src="{{ asset('./images/contact-icons/Instagram-logo.svg') }}" alt=""></a>
            <a href="https://x.com/teatarkomedija"><img src="{{ asset('./images/contact-icons/Twitter-(X)-logo.svg') }}" alt=""></a>
        </div>
        <p class="text-center md:text-left md:w-3/5">
            Администрација: 02 310 9999
            Билетарница: 071 330 233
        </p>
    </div>
</footer>
