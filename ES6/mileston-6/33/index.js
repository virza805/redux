const shop = {
    name: 'virza',
    address: 'Saver Dhaka',
    profit: '564.505',
    products: ['virza', 'KuterShilpo', 'Software'],
    owner: {
        name: 'Tanvir Hasan',
        profession: 'Web Developer'
    },
    isExpensive: true
}

const shopStringified = JSON.stringify(shop);
console.log(shopStringified);

const converted = JSON.parse(shopStringified); // converted string to object
console.log(converted.owner);