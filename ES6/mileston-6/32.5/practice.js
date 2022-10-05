// * 1. let & const = let value change kora jai && const value not change
// * 2. template string = ``
// * 2.a: use variable
// * 2.b: use object property

// * 3. arrow function
// * 3.a: with one parameter. will return the number after dividing by 5
// * 3.b: with two parameters. will add tow to each number and then multiply the result.
const multiplyResult = (num1, num2) => (num1 + 2) * (num2 + 2);
// * 3.c: with three parameters. will multiply all three parameters
// * 3.d: with two parameters but it will be a multi line arrow function. will add two to each number and then multiply the result. make sure you return the result

// * 4. [Home work]: JavaScript function declaration vs arrow function
// function declaration
function add1(num1, num2) {
    return num1 + num2;
}
// arrow function
const add2 = (num1, num2) => num1 + num2;;

//  * 5. array of numbers. and then map to get each elements multiplied by 5. must use arrow function
const numbers = [4, 6, 8, 10];
const multipliedBy5 = number => number * 5; // arrow function use
const output2 = numbers.map(multipliedBy5); // map function use
// console.log(output2);

//  * 6. [Challenging] numbers of array. get odd numbers by using filter with arrow function
const numbers6 = [4, 6, 8, 10, 56, 45, 50, 95, 31, 80, 5, 101];
const oddNumbers = number => number % 2 == 1; // arrow function use
const output6 = numbers6.filter(oddNumbers); // filter function use
console.log(output6);

// * 7. [Challenging] array of objects (E.g. products). use find to get the object with price 5000.
const products = [
    { name: 'water bottle', price: 50, color: 'yellow' },
    { name: 'mobile phone', price: 1500, color: 'black' },
    { name: 'Smart Watch', price: 3000, color: 'black' },
    { name: 'water bottle', price: 30, color: 'pink' },
    { name: 'water Glass', price: 3, color: 'White' },
    { name: 'Air bauds', price: 5000, color: 'White' },
];

const expensive = products.filter(product => product.price < 100);
console.log(expensive);

const black = products.filter(product => product.color == 'black');
// console.log(black);

const blackItem = products.find(product => product.color == 'black');
const productPriceItem = products.find(product => product.price == 5000);
console.log(productPriceItem);


// * 8. You have an object. Now use destructing to create a simple variable of any property of the object.
// অবজেক্ট এ একাধিক প্রোপাটির ভ্যালু একসাথে বেরকরে ভ্যারিয়েবল এ রাখাকে Destructuring বলে। 
const fish = {
        id: 564505,
        name: 'Elish Mash',
        price: 564,
        phone: 9531805,
        dress: 'Silver',
        address: 'Chandpur'
    }
    // const phone = fish.phone;
    // const price = fish.price;
    // const dress = fish.dress;
const { phone, price, dress } = fish;
console.log(phone, dress);
// array destructuring
const [p, q] = [45, 37, 91, 86];
console.log(p, q);


// * 10. [Optional] just a write a function with three parameters and the last parameter will have a default parameter with value 7. this function will take three parameters and will return the sum of all the three parameters. 
// function declaration in set with default value.
function addWithDefault(num1, num2, num3 = 7) {
    let tanvir = num1 + num2 + num3;
    return tanvir;
}
// node practice.js