const numbers = [23, 42, 33, 53, 96, 35];
console.log(numbers);
console.log(...numbers);

const max = Math.max(42, 33, 53, 96, 35);
const maxInArray = Math.max(...numbers, 85, 99, 105);
console.log(max, maxInArray);


const numbers2 = [...numbers, 87]
numbers.push(77);
console.log(numbers);
console.log(numbers2);


// 2. default parameter || 5. spread or three dots (...)
function maxNumber(array = []) {
    const max = Math.max(...array);
    return max;
}
const biggest = maxNumber();
console.log(biggest);

// 3. template string
















