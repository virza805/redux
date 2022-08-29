// 1 array 
const numbers = [1, 2, 3, 4, 6];
const numberCount = numbers.length; // Count total pice of array elamint
numbers.pop(); // remove single pice of array elamint
numbers.push(); // add single pice of array elamint
numbers[2] = 555; // change 3 pocition of array elamint

// 2 check whether 222 included in the array
if (numbers.includes(222) != -1) {}
if (numbers.includes(222)) {}

// 3 loop = while, for 
for (const number of numbers) {}

// 4 function
function fullName(first, second) {
    const name = first + '' + second;
}
const person = fullName('Tanvir', 'Hasan');

// 5 object
const bottle = {
    color: 'yellow',
    contain: 'water',
    price: 50,
}