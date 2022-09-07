// অবজেক্ট এ একাধিক প্রোপাটির ভ্যালু একসাথে বেরকরে ভ্যারিয়েবল এ রাখাকে Destructuring বলে। 
// Extracting the value of multiple properties of an object together and keeping it in a variable is called Destructuring.

// node 9-destructuring.js

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

const company = {
    name: 'vir-za',
    ceo: { id: 1, name: 'Tanvir', food: 'swites'},
    web: { worker: 'website', employee: 200, framework: 'react', 
            tech: { first: 'html', second: 'css', third: 'javaScript', fourth: 'php'}
        }
}
//  const work = company.web.work;
//  const framework = company.web.framework;
const { work, framework } = company.web;
const { food } = company.ceo;
const { first, second, third } = company.web.tech;
 console.log( first, food, work );

// array destructuring
const [p, q] = [45, 37, 91, 86];
console.log(p, q);

const [best, faltu] = ['moskun', 'momotaj', 'porashi', 'monySha'];
console.log(best, faltu);

const { sky, color, money } = { sky: 'blue', soil: 'matti', color: 'red', money: 564505};
