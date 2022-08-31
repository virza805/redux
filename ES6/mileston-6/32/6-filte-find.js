const numbers = [4, 6, 8, 10, 56, 45, 50, 95, 31, 80, 5,];
const bigNumbers = numbers.filter( number => number > 20);
const smallNumbers = numbers.filter( number => number < 11);
console.log(bigNumbers);
console.log(smallNumbers);

const products = [
    { name: 'water bottle', price: 50, color: 'yellow'},
    { name: 'mobile phone', price: 1500, color: 'black'},
    { name: 'Smart Watch', price: 3000, color: 'black'},
    { name: 'water bottle', price: 30, color: 'pink'},
    { name: 'water Glass', price: 3, color: 'White'},
];

const expensive = products.filter(product => product.price < 100);
console.log(expensive);

const black = products.filter(product => product.color == 'black');
// console.log(black);

const blackItem = products.find( product => product.color == 'black');
console.log(blackItem);

