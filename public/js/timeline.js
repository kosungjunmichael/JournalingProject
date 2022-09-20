let monthsArr = [
  "January",
  "Feburary",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December"
];

let monthContainer = document.querySelector('.monthContainer');

for (let month of monthsArr){
  let monthEntry = document.querySelectorAll(`.month.${month}`);

  let monthGroup = document.createElement('div');
  monthGroup.classlist.add('monthGroup');

  monthGroup.appendChild(monthEntry);
  monthContainer.appendChild(monthGroup);
}