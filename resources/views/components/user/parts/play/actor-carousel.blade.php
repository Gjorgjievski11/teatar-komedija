<section id="actors-carousel" class="relative z-10 py-10 bg-white text-black mx-12">
    <div class="swiper actors-carousel px-2">
        <div class="swiper-wrapper my-2 m-1">
            @foreach ($actors as $employee)
                <div class="swiper-slide h-full py-2 px-1">
                    <div class="bg-white rounded-xl shadow text-center p-3 w-48 h-64 flex flex-col items-center gap-y-3">
                        <img src="{{ $employee->employee->images->first()->path ?? asset('/images/no_image.png') }}"
                             alt="{{ $employee->employee->name }}"
                             class="w-full h-36 object-cover rounded-[20px] mb-2" />
                        <p class="text-xs text-black leading-tight mb-0.5 truncate">{{ $employee->role_name }}</p>
                        <p class="text-sm font-bold text-black leading-tight truncate">
                            {{ $employee->employee->name }} {{ $employee->employee->surname }}
                        </p>
                    </div>
                </div>
            @endforeach 
        </div>
    </div>
</section>