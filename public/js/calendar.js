// import dayjs from "dayjs";
const weekday = dayjs.extend(window.dayjs_plugin_weekday);
const weekOfYear = dayjs.extend(window.dayjs_plugin_weekOfYear);

dayjs.extend(weekday);
dayjs.extend(weekOfYear);

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
                const entryLink = document.createElement('a');
                entryLink.innerText = entry.title;
                entryLink.setAttribute('href', `index.php?action=viewEntry&id=${entry.u_id}`);
                date.appendChild(entryLink);
            }
        }
    }
}