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







