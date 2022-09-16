const paymentSuccess = true; // true
const marks = 90;


function enroll() {
    console.log('Course enrollment is in progress.');

    // promise definition
    const promise = new Promise(function(resolve, reject){
        setTimeout(function() {
            if (paymentSuccess) {
                resolve('Payment Done');
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
                resolve('You have enough marks. So ');
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

async function course() {
    try {
        const payment = await enroll();
        const markStatus = await progress();
        const message = await getCertificate();

        console.log(message);
        // console.log(payment, markStatus, message);
    } catch (error) {
        console.log(error)
    }
}

course();
// enroll()
//     .then(progress)
//     .then(getCertificate)
//     .then(function(value){
//         console.log(value);
//     })
//     .catch(function(err) {
//         console.log(err);
//     })

// node 85_async_await.js 