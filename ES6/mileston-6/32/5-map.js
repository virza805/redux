const friend = ['konok', 'Tonny', 'Afroza', 'Onamica', 'Shown'];
const fLengths = friend.map( friend => friend.length );
console.log(fLengths);

const products = [
    { name: 'water bottle', price: 50, color: 'yellow'},
    { name: 'mobile phone', price: 1500, color: 'black'},
    { name: 'Smart Watch', price: 3000, color: 'black'},
    { name: 'water bottle', price: 30, color: 'pink'},
    { name: 'water Glass', price: 3, color: 'White'},
];
const productNames = products.map(product => product.name);
const productPrices = products.map(product => product.price);
console.log(productNames);
console.log(productPrices);


products.forEach(product => console.log(product));

