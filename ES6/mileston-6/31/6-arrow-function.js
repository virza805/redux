// function declaration in set with default value.
function addWithDefault(num1, num2 = 3) {
    // num2 = undefined || 10;  # this is old style1

    // if (num2 === undefined) { # this is old style2
    //    num2 = 0;
    // }
    let tanvir = num1 + num2;
    return tanvir;
}

// function declaration
function add(num1, num2) {
    return num1 + num2;
}

// function expression
const add2 = function add2(num1, num2) {
    return num1 + num2;
}

// function expression (anonymous)
const add3 = function (num1, num2) {
    return num1 + num2;
}

// arrow function
const add4 = (num1, num2) => num1 + num2;

const sum1 = add(15, 6);
const sum2 = add2(15, 17);
const sum3 = add3(15, 17);
const sum4 = add4(15, 17);
const sumDefault = addWithDefault(17);

console.log(sum1, sum2, sum3, sum4, sumDefault);



// node 6-arrow-function.js







