// import dayjs from "dayjs";
const weekday = dayjs.extend(window.dayjs_plugin_weekday);
const weekOfYear = dayjs.extend(window.dayjs_plugin_weekOfYear);

dayjs.extend(weekday);
dayjs.extend(weekOfYear);

// check if mobile device
const isMobile = !window.matchMedia('only screen and (min-width: 768px)').matches
console.log(isMobile);
document.getElementById("calendar").innerHTML = `
<div class="calendar-month">
  <section class="calendar-month-header">
    <div
      id="selected-month"
      class="calendar-month-header-selected-month"
    ></div>
    <section class="calendar-month-header-selectors">
      <span id="previous-month-selector"><</span>
      <span id="present-month-selector">Today</span>
      <span id="next-month-selector">></span>
    </section>
  </section>

  <ol
    id="days-of-week"
    class="day-of-week"
  /></ol>

  <ol
    id="calendar-days"
    class="days-grid"
  >
  </ol>
</div>
`;

const WEEKDAYS = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
const TODAY = dayjs().format("YYYY-MM-DD");

const INITIAL_YEAR = dayjs().format("YYYY");
const INITIAL_MONTH = dayjs().format("M");

let selectedMonth = dayjs(new Date(INITIAL_YEAR, INITIAL_MONTH - 1, 1));
let currentMonthDays;
let previousMonthDays;
let nextMonthDays;

const daysOfWeekElement = document.getElementById("days-of-week");

WEEKDAYS.forEach((weekday) => {
    const weekDayElement = document.createElement("li");
    daysOfWeekElement.appendChild(weekDayElement);
    weekDayElement.innerText = weekday;
});

createCalendar();
initMonthSelectors();

function createCalendar(year = INITIAL_YEAR, month = INITIAL_MONTH) {
    const calendarDaysElement = document.getElementById("calendar-days");

    document.getElementById("selected-month").innerText = dayjs(
        new Date(year, month - 1)
    ).format("MMMM YYYY");

    removeAllDayElements(calendarDaysElement);

    currentMonthDays = createDaysForCurrentMonth(
        year,
        month,
        dayjs(`${year}-${month}-01`).daysInMonth()
    );

    previousMonthDays = createDaysForPreviousMonth(year, month);

    nextMonthDays = createDaysForNextMonth(year, month);

    const days = [...previousMonthDays, ...currentMonthDays, ...nextMonthDays];

    days.forEach((day) => {
        console.log(day);
        appendDay(day, calendarDaysElement);
    });

    renderEntries();
}

function appendDay(day, calendarDaysElement) {
    const dayElement = document.createElement("li");
    dayElement.id = day.date;
    const dayElementClassList = dayElement.classList;
    dayElementClassList.add("calendar-day");
    const dayOfMonthElement = document.createElement("span");
    dayOfMonthElement.classList.add('calendar-day-date-span');
    dayOfMonthElement.innerHTML = `<span class="calendar-day-date">${day.dayOfMonth}</span>`;
    dayElement.appendChild(dayOfMonthElement);
    calendarDaysElement.appendChild(dayElement);

    if (!day.isCurrentMonth) {
        dayElementClassList.add("calendar-day--not-current");
    }

    if (day.date === TODAY) {
        dayElementClassList.add("calendar-day--today");
    }

    if (isMobile) {
        dayElement.addEventListener('click', () => {
            const entries = dayElement.querySelectorAll('.calendar-mobile-details');
            console.log(entries);
            if (entries.length > 0) {
                const mobileDetailsContainer = document.querySelector('#calendar-mobile-details-container');
                mobileDetailsContainer.classList.remove('hidden');
                for (let entry of entries) {
                    const entryInnerHTML = entry.innerHTML;
                    const entryClone = entry.cloneNode();
                    entryClone.innerHTML = entryInnerHTML;
                    mobileDetailsContainer.appendChild(entryClone);
                    entryClone.classList.toggle('hidden');
                }
                mobileDetailsContainer.addEventListener('click', (e) => {
                    console.log(e.target.className);
                    if (!e.target.closest('.calendar-mobile-details')) {
                        // for (let entry of entries) {
                        //     entry.remove();
                        // }
                        mobileDetailsContainer.innerHTML = ``;
                        mobileDetailsContainer.classList.add('hidden');
                    }
                })
            }
        })
    }
}

function removeAllDayElements(calendarDaysElement) {
    let first = calendarDaysElement.firstElementChild;

    while (first) {
        first.remove();
        first = calendarDaysElement.firstElementChild;
    }
}

function getNumberOfDaysInMonth(year, month) {
    return dayjs(`${year}-${month}-01`).daysInMonth();
}

function createDaysForCurrentMonth(year, month) {
    return [...Array(getNumberOfDaysInMonth(year, month))].map((day, index) => {
        return {
            date: dayjs(`${year}-${month}-${index + 1}`).format("YYYY-MM-DD"),
            dayOfMonth: index + 1,
            isCurrentMonth: true
        };
    });
}

function createDaysForPreviousMonth(year, month) {
    const firstDayOfTheMonthWeekday = getWeekday(currentMonthDays[0].date);

    const previousMonth = dayjs(`${year}-${month}-01`).subtract(1, "month");

    // Cover first day of the month being sunday (firstDayOfTheMonthWeekday === 0)
    const visibleNumberOfDaysFromPreviousMonth = firstDayOfTheMonthWeekday
        ? firstDayOfTheMonthWeekday - 1
        : 6;

    const previousMonthLastMondayDayOfMonth = dayjs(currentMonthDays[0].date)
        .subtract(visibleNumberOfDaysFromPreviousMonth, "day")
        .date();

    return [...Array(visibleNumberOfDaysFromPreviousMonth)].map((day, index) => {
        return {
            date: dayjs(
                `${previousMonth.year()}-${previousMonth.month() + 1}-${
                    previousMonthLastMondayDayOfMonth + index
                }`
            ).format("YYYY-MM-DD"),
            dayOfMonth: previousMonthLastMondayDayOfMonth + index,
            isCurrentMonth: false
        };
    });
}

function createDaysForNextMonth(year, month) {
    const lastDayOfTheMonthWeekday = getWeekday(
        `${year}-${month}-${currentMonthDays.length}`
    );

    const nextMonth = dayjs(`${year}-${month}-01`).add(1, "month");

    const visibleNumberOfDaysFromNextMonth = lastDayOfTheMonthWeekday
        ? 7 - lastDayOfTheMonthWeekday
        : lastDayOfTheMonthWeekday;

    return [...Array(visibleNumberOfDaysFromNextMonth)].map((day, index) => {
        return {
            date: dayjs(
                `${nextMonth.year()}-${nextMonth.month() + 1}-${index + 1}`
            ).format("YYYY-MM-DD"),
            dayOfMonth: index + 1,
            isCurrentMonth: false
        };
    });
}

function getWeekday(date) {
    return dayjs(date).weekday();
}

function initMonthSelectors() {
    document
        .getElementById("previous-month-selector")
        .addEventListener("click", function () {
            selectedMonth = dayjs(selectedMonth).subtract(1, "month");
            createCalendar(selectedMonth.format("YYYY"), selectedMonth.format("M"));
        });

    document
        .getElementById("present-month-selector")
        .addEventListener("click", function () {
            selectedMonth = dayjs(new Date(INITIAL_YEAR, INITIAL_MONTH - 1, 1));
            createCalendar(selectedMonth.format("YYYY"), selectedMonth.format("M"));
        });

    document
        .getElementById("next-month-selector")
        .addEventListener("click", function () {
            selectedMonth = dayjs(selectedMonth).add(1, "month");
            createCalendar(selectedMonth.format("YYYY"), selectedMonth.format("M"));
        });
}

async function getEntries() {
    return await fetch('http://localhost/sites/JournalingProject/controller/api/getEntries.php')
        .then(res => res.json())
        .then(data => {
            console.log(data);
            return data;
        })
        .catch(err => console.log(err));
}

async function renderEntries() {
    const entries = await getEntries();
    const dates = document.querySelectorAll('.calendar-day');
    for (let entry of entries) {
        for (let date of dates) {
            if (entry.date_created.slice(0,10) === date.id) {
                if (!isMobile) {
                    const weekDay = getWeekday(date.id);
                    const entryLink = document.createElement('span');
                    entryLink.classList.add('calendar-entry-link');
                    entryLink.innerText = `● ${entry.title}`;
                    entryLink.addEventListener('click', () => {
                        const existing = document.querySelector('.calendar-entry-link-details');
                        if (existing) existing.remove();
                        const detailContainer = document.createElement('span');
                        detailContainer.classList.add('calendar-entry-link-details');
                        if (weekDay == 1 || weekDay == 2 || weekDay == 3) {
                            detailContainer.classList.add('calendar-entry-link-details-left');
                        } else {
                            detailContainer.classList.add('calendar-entry-link-details-right');
                        }
                        const tempTextContent = document.createElement('div');
                        tempTextContent.innerHTML = entry.text_content;
                        detailContainer.innerHTML = `
                            <svg class="calendar-entry-close" onclick="removeCard(this)" xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="#000000" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none"></rect>
                                <circle class="close-svg-circle" cx="128" cy="128" r="96" fill="none" stroke="#000000" stroke-miterlimit="10" stroke-width="16"></circle>
                                <line class="close-svg-line" x1="160" y1="96" x2="96" y2="160" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                                <line class="close-svg-line" x1="160" y1="160" x2="96" y2="96" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                            </svg>
                            <h2 class="calendar-entry-card-title">${entry.title}</h2>
                            <div class="calendar-entry-card-textContent">${tempTextContent.innerText}</div>
                            <div class="calendar-entry-card-bottom">
                                <span class="calendar-entry-card-location">
                                    <i class="ph-map-pin"></i>
                                    ${entry.location}
                                </span>
                                <span class="calendar-entry-card-date">
                                    <i class='bx bx-calendar'></i>
                                    ${entry.month} ${entry.day}, ${entry.year}
                                </span>
                            </div>
                            <a class="calendar-entry-card-link" href="./index.php?action=viewEntry&id=${entry.u_id}">View Entry</a>
                        `;

                        entryLink.parentElement.appendChild(detailContainer);
                    })
                    date.appendChild(entryLink);
                } else if (isMobile) {
                    const mobileDetails = document.createElement('div');
                    mobileDetails.classList.add('calendar-mobile-details', 'hidden');
                    const tempTextContent = document.createElement('div');
                    tempTextContent.innerHTML = entry.text_content;
                    mobileDetails.innerHTML = `
                            <h2 class="calendar-entry-card-title">${entry.title}</h2>
                            <div class="calendar-entry-card-textContent">${tempTextContent.innerText}</div>
                            <div class="calendar-entry-card-bottom">
                                <span class="calendar-entry-card-location">
                                    <i class="ph-map-pin"></i>
                                    ${entry.location}
                                </span>
                                <span class="calendar-entry-card-date">
                                    <i class='bx bx-calendar'></i>
                                    ${entry.month} ${entry.day}, ${entry.year}
                                </span>
                            </div>
                            <a class="calendar-entry-card-link" href="./index.php?action=viewEntry&id=${entry.u_id}">View Entry</a>
                        `;
                    date.appendChild(mobileDetails);
                    date.classList.add('calendar-mobile-date-has-entries');
                }
            }
        }
    }
}

function removeCard(el) {
    const parent = el.parentElement;
    parent.remove();
}