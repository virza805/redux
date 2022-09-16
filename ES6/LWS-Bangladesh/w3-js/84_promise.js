const paymentSuccess = false; // true
const marks = 90;


function enroll() {
    console.log('Course enrollment is in progress.');

    // promise definition
    const promise = new Promise(function(resolve, reject){
        setTimeout(function() {
            if (paymentSuccess) {
                resolve('Task 2');
            } else {
                reject('Payment failed!');
            }
        }, 2000);
    });

    return promise;

}

function progress() {
    console.log('Course on progress.');

    // promise definition
    const promise = new Promise(function(resolve, reject){
        setTimeout(function() {
            if (marks >= 80) {
                resolve();
            } else {
                reject('You could not get enough marks to get the certificate');
            }
        }, 3000);
    });

    return promise;

}

function getCertificate() {
    console.log('Preparing your certificate!');

    // promise definition
    const promise = new Promise(function(resolve){
        
        setTimeout(function() {
            resolve('Congrats! You got the certificate.');
        }, 1000);
    });

    return promise;

}


enroll()
    .then(progress)
    .then(getCertificate)
    .then(function(value){
        console.log(value);
    })
    .catch(function(err) {
        console.log(err);
    })

// node 84_promise.js 