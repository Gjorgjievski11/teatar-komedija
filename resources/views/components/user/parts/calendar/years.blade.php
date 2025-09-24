@props(['data'])

<div class="w-full bg-black/90 pt-10">
    <div class="flex items-center justify-center gap-8 text-[32px] text-center text-[#595959]" id="year-selector">
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        let currentDisplayYear = new Date().getFullYear();

        renderYearButtons(currentDisplayYear);

        function renderYearButtons(activeYear) {
    const container = document.getElementById('year-selector');
    if (!container) return;

    container.innerHTML = '';
    const isMobile = window.innerWidth < 640;

    if (isMobile) {
        container.className = "flex justify-center items-center w-full max-w-screen-xl mx-auto pb-6 text-center text-[#595959]";

        const div = document.createElement('div');
        div.className = 'flex items-center justify-center gap-4 text-orange-500 font-semibold select-none text-[24px]/[32px]';

        const leftArrow = document.createElement('button');
        leftArrow.innerHTML = '&lt;';
        leftArrow.className = 'text-white text-3xl hover:text-orange-500 transition';
        leftArrow.type = 'button';
        leftArrow.addEventListener('click', () => {
            currentYear--;
            renderYearButtons(currentYear);
            if (typeof updateCalendar === 'function') updateCalendar(currentMonth, currentYear);
        });

        const label = document.createElement('span');
        label.textContent = activeYear;

        const rightArrow = document.createElement('button');
        rightArrow.innerHTML = '&gt;';
        rightArrow.className = 'text-white text-3xl hover:text-orange-500 transition';
        rightArrow.type = 'button';
        rightArrow.addEventListener('click', () => {
            currentYear++;
            renderYearButtons(currentYear);
            if (typeof updateCalendar === 'function') updateCalendar(currentMonth, currentYear);
        });

        div.appendChild(leftArrow);
        div.appendChild(label);
        div.appendChild(rightArrow);
        container.appendChild(div);
    } else {
        container.className = "grid grid-cols-5 w-full max-w-screen-xl mx-auto pb-10 text-[32px]/[40px] text-2xl text-center text-[#595959]";

        const offsets = [-2, -1, 0, 1, 2];

        offsets.forEach(offset => {
            const year = activeYear + offset;
            const div = document.createElement('div');
            div.className = 'flex items-center justify-center gap-2 select-none';

            if (offset === 0) {
                div.className = 'relative flex items-center justify-center text-orange-500 font-semibold select-none';

                const label = document.createElement('span');
                label.textContent = year;

                const leftArrow = document.createElement('button');
                leftArrow.innerHTML = '&lt;';
                leftArrow.className = 'absolute left-0 text-white text-2xl hover:text-orange-500 transition p-2';
                leftArrow.type = 'button';
                leftArrow.addEventListener('click', () => {
                    currentYear--;
                    renderYearButtons(currentYear);
                    if (typeof updateCalendar === 'function') updateCalendar(currentMonth, currentYear);
                });

                const rightArrow = document.createElement('button');
                rightArrow.innerHTML = '&gt;';
                rightArrow.className = 'absolute right-0 text-white text-2xl hover:text-orange-500 transition p-2';
                rightArrow.type = 'button';
                rightArrow.addEventListener('click', () => {
                    currentYear++;
                    renderYearButtons(currentYear);
                    if (typeof updateCalendar === 'function') updateCalendar(currentMonth, currentYear);
                });

                div.appendChild(leftArrow);
                div.appendChild(label);
                div.appendChild(rightArrow);
            } else {
                div.textContent = year;
                div.className += ' cursor-pointer text-white hover:text-orange-500 transition';
                div.dataset.year = year;
                div.addEventListener('click', () => {
                    currentYear = year;
                    renderYearButtons(currentYear);
                    if (typeof updateCalendar === 'function') updateCalendar(currentMonth, currentYear);
                });
            }

            container.appendChild(div);
        });
    }
}


        function handleYearNavigation(event) {
            const button = event.target;

            if (button.innerHTML === '&lt;') {
                currentDisplayYear--;
            } else if (button.innerHTML === '&gt;') {
                currentDisplayYear++;
            } else if (!isNaN(button.textContent)) {
                currentDisplayYear = parseInt(button.textContent);
            }

            currentYear = currentDisplayYear;
            renderYearButtons(currentDisplayYear);

            if (typeof updateCalendar === 'function') updateCalendar(currentMonth, currentYear);
            if (typeof renderMonthButtons === 'function') renderMonthButtons(currentMonth);
        }

        window.addEventListener('resize', () => {
            renderYearButtons(currentDisplayYear);
        });

        window.renderYearButtons = renderYearButtons;
    });
</script>
