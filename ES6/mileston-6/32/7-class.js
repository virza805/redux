class Support {
    name;
    designation = 'Support Web Dev';
    address;

    constructor(name, address) {
        this.name = name;
        this.address = address;
    }
    startSession() {
        console.log(this.name, 'Start a support session');
    }
}

const amir = new Support('Tanvir', 'Saver, Dhaka-1340');
console.log(amir);



