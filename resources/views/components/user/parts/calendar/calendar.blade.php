@props(['title' => null])

<div id="calendar-container" class="w-full h-full py-10 bg-black/90">
    <x-user.parts.calendar.month />

    <div id="calendar"
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 w-[90%] mx-auto gap-x-8 gap-y-16 sm:gap-y-20 pb-20"></div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const calendar = document.getElementById("calendar");
            let currentMonth = new Date().getMonth() + 1;
            let currentYear = new Date().getFullYear();
            let currentRequest = null;
            let isLoading = false;

            // Make year and month globally accessible
            window.currentYear = currentYear;
            window.currentMonth = currentMonth;

            // --- Listen for year changes from year selector ---
            window.addEventListener('year-changed', (e) => {
                currentYear = e.detail.year;
                window.currentYear = currentYear;
                updateCalendar(currentMonth, currentYear);
                renderMonthButtons(currentMonth);
                updateCalendarTitle(currentYear); // Update title when year changes
            });

            // Function to update calendar title
            function updateCalendarTitle(year) {
                const titleElement = document.getElementById('calendar-title');
                if (titleElement) {
                    titleElement.textContent = `КАЛЕНДАР ${year}`;
                }
            }

            updateCalendar(currentMonth, currentYear);
            renderMonthButtons(currentMonth);

            // Function to handle month navigation
            function changeMonth(direction) {
                if (direction === 'prev') {
                    if (currentMonth === 1) {
                        currentMonth = 12;
                        currentYear--;
                    } else {
                        currentMonth--;
                    }
                } else if (direction === 'next') {
                    if (currentMonth === 12) {
                        currentMonth = 1;
                        currentYear++;
                    } else {
                        currentMonth++;
                    }
                }
                
                // Update global variables
                window.currentYear = currentYear;
                window.currentMonth = currentMonth;
                
                // Emit year change if year actually changed (when crossing December-January boundary)
                if ((direction === 'prev' && currentMonth === 12) || 
                    (direction === 'next' && currentMonth === 1)) {
                    const yearEvent = new CustomEvent('year-changed', { 
                        detail: { year: currentYear } 
                    });
                    window.dispatchEvent(yearEvent);
                }
                
                // Update title whenever month changes (in case year changed)
                updateCalendarTitle(currentYear);
                
                updateCalendar(currentMonth, currentYear);
                renderMonthButtons(currentMonth);
            }

            function updateCalendar(month, year) {
                if (isLoading && currentRequest) {
                    console.log('Cancelling previous request...');
                    currentRequest.abort();
                }

                isLoading = true;
                calendar.innerHTML = '<div class="col-span-3 text-center text-white py-20">Се вчитува...</div>';

                const controller = new AbortController();
                currentRequest = controller;

                fetch(`/calendar/data?month=${month}&year=${year}`, {
                        signal: controller.signal
                    })
                    .then(res => {
                        if (controller.signal.aborted) return Promise.reject(new Error('Request cancelled'));
                        if (!res.ok) throw new Error('Network response was not ok');
                        return res.json();
                    })
                    .then(data => {
                        if (controller.signal.aborted) return;

                        calendar.innerHTML = '';

                        if (Object.keys(data).length === 0) {
                            calendar.innerHTML =
                                '<div class="col-span-3 text-center text-white py-20">Нема програмирани претстави за овој месец.</div>';
                            return;
                        }

                        Object.keys(data).forEach(day => {
                            const play = data[day];
                            const card = document.createElement("div");
                            card.className = "relative w-full h-full";

                            const escapeHtml = (unsafe) => {
                                return unsafe.replace(/[&<"'>]/g, function(m) {
                                    return {
                                        '&': '&amp;',
                                        '<': '&lt;',
                                        '>': '&gt;',
                                        '"': '&quot;',
                                        "'": '&#39;'
                                    }[m];
                                });
                            };

                            card.innerHTML = `
                                <div class="absolute -bottom-8 -left-4 flex items-center z-20 overflow-visible">
                                    <div class="absolute w-24 h-24 rounded-full bg-gradient-to-br from-black/80 to-black/0 blur-2xl -z-10 left-0 bottom-0"></div>
                                    <div>
                                        <p class="text-white text-8xl font-bold leading-none">${day}</p>
                                    </div>
                                </div>

                                <div class="group relative w-full h-80 rounded-3xl shadow-lg overflow-hidden">
                                    <div class="relative w-full h-full flex text-xl font-semibold bg-white">
                                        <img src="${escapeHtml(play.photo)}" class="w-full h-full object-cover absolute inset-0 transition-opacity duration-300 group-hover:opacity-0" />

                                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-between p-4 bg-white text-right">
                                            <div class="flex flex-col gap-y-4">
                                                <h1 class="text-black text-4xl max-sm:text-center md:text-2xl break-words overflow-hidden">${escapeHtml(play.title)}</h1>
                                                <h2 class="text-red-500 text-3xl max-sm:text-center md:text-xl break-words overflow-hidden">${escapeHtml(play.time)}</h2>
                                            </div>

                                            <div class="text-right text-xs font-light max-sm:hidden break-words overflow-hidden">
                                                <p>Автор:</p>
                                                <p class="break-words">${escapeHtml(play.author)}</p>
                                                <p>Режија:</p>
                                                <p class="break-words">${escapeHtml(play.director)}</p>
                                                <p class="text-red-600 font-semibold max-sm:text-2xl mt-2 break-words">${escapeHtml(play.price)}</p>
                                            </div>

                                            <div class="bottom-6 right-4 flex justify-end gap-x-5 text-xs pt-2">
                                                <a href="${escapeHtml(play.ticket_url)}" target="_blank" class="text-white bg-red-800 py-2 px-2 rounded hover:bg-red-700 transition-colors duration-200 max-sm:text-xl">КУПИ КАРТА</a>
                                                <a href="/play/${play.id}"
                                    class="text-red-800 bg-white border-2 border-red-800 w-8 h-8 max-sm:w-12 max-sm:h-12 text-xl rounded flex items-center justify-center hover:bg-red-50 transition-colors duration-200">i</a>
                                        </div>
                                    </div>
                                </div>
                            `;
                            calendar.appendChild(card);
                        });
                    })
                    .catch(error => {
                        if (error.name === 'AbortError' || error.message === 'Request cancelled') {
                            console.log('Request was cancelled - this is normal');
                            return;
                        }

                        console.error('Error fetching calendar data:', error);
                        calendar.innerHTML =
                            '<div class="col-span-3 text-center text-red-500 py-20">Грешка при вчитување на податоците.</div>';
                    })
                    .finally(() => {
                        isLoading = false;
                        if (currentRequest === controller) currentRequest = null;
                    });
            }

            function renderMonthButtons(activeMonth) {
                const container = document.getElementById('month-selector');
                if (!container) return;

                container.innerHTML = '';
                container.className = '';

                const monthNames = ['ЈАНУАРИ', 'ФЕВРУАРИ', 'МАРТ', 'АПРИЛ', 'МАЈ', 'ЈУНИ', 'ЈУЛИ', 'АВГУСТ',
                    'СЕПТЕМВРИ', 'ОКТОМВРИ', 'НОЕМВРИ', 'ДЕКЕМВРИ'
                ];
                const isMobile = window.innerWidth < 640;

                if (isMobile) {
                    container.className =
                        "flex justify-center items-center w-full max-w-screen-xl mx-auto pb-10 text-center text-[#595959]";

                    const div = document.createElement('div');
                    div.className =
                        'flex items-center justify-center gap-4 text-orange-500 font-semibold select-none text-[24px]/[32px]';

                    const leftArrow = document.createElement('button');
                    leftArrow.innerHTML = '&lt;';
                    leftArrow.className = 'text-white text-3xl hover:text-orange-500 transition';
                    leftArrow.type = 'button';
                    leftArrow.addEventListener('click', () => changeMonth('prev'));

                    const label = document.createElement('span');
                    label.textContent = monthNames[activeMonth - 1];

                    const rightArrow = document.createElement('button');
                    rightArrow.innerHTML = '&gt;';
                    rightArrow.className = 'text-white text-3xl hover:text-orange-500 transition';
                    rightArrow.type = 'button';
                    rightArrow.addEventListener('click', () => changeMonth('next'));

                    div.appendChild(leftArrow);
                    div.appendChild(label);
                    div.appendChild(rightArrow);
                    container.appendChild(div);

                } else {
                    container.className =
                        "grid grid-cols-5 w-full max-w-screen-xl mx-auto pb-10 text-[32px]/[40px] text-center text-[#595959]";

                    const getWrappedMonth = offset => {
                        const index = (activeMonth - 1 + offset + 12) % 12;
                        return index + 1;
                    };
                    const offsets = [-2, -1, 0, 1, 2];

                    offsets.forEach(offset => {
                        const monthNum = getWrappedMonth(offset);
                        const div = document.createElement('div');
                        div.className = 'flex items-center justify-center gap-2 select-none';

                        if (offset === 0) {
                            div.className =
                                'relative flex items-center justify-center text-orange-500 font-semibold select-none';
                            const label = document.createElement('span');
                            label.textContent = monthNames[monthNum - 1];

                            const leftArrow = document.createElement('button');
                            leftArrow.innerHTML = '&lt;';
                            leftArrow.className =
                                'absolute left-0 text-white text-2xl hover:text-orange-500 transition p-2';
                            leftArrow.type = 'button';
                            leftArrow.addEventListener('click', () => changeMonth('prev'));

                            const rightArrow = document.createElement('button');
                            rightArrow.innerHTML = '&gt;';
                            rightArrow.className =
                                'absolute right-0 text-white text-2xl hover:text-orange-500 transition p-2';
                            rightArrow.type = 'button';
                            rightArrow.addEventListener('click', () => changeMonth('next'));

                            div.appendChild(leftArrow);
                            div.appendChild(label);
                            div.appendChild(rightArrow);
                        } else {
                            div.textContent = monthNames[monthNum - 1];
                            div.className += ' cursor-pointer text-white hover:text-orange-500 transition';
                            div.dataset.month = monthNum;
                            div.addEventListener('click', () => {
                                currentMonth = monthNum;
                                window.currentMonth = currentMonth;
                                updateCalendar(currentMonth, currentYear);
                                renderMonthButtons(currentMonth);
                            });
                        }
                        container.appendChild(div);
                    });
                }
            }

            window.showPlayInfo = function(title, description) {
                if (description && description.trim()) {
                    alert(`${title}\n\n${description}`);
                } else {
                    alert(`${title}\n\nНема дополнителни информации.`);
                }
            };

            window.addEventListener('resize', debounce(() => {
                renderMonthButtons(currentMonth);
            }, 200));

            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this,
                        args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        func.apply(context, args);
                    }, wait);
                };
            }
        });
    </script>
</div>