document.getElementById('add-border').addEventListener('click', function() {
    // console.log('add border clicked'); // for check add border button work
    const container = document.getElementById('friend-container');
    container.style.border = '3px solid yellow';
});

// add background color
document.getElementById('add-bgColor').addEventListener('click', function() {
    const friends = document.getElementsByClassName('friend');
    for (const friend of friends) {
        friend.style.backgroundColor = 'lightblue';
    }
});

// add Friend to replase old
document.getElementById('replase-friend').addEventListener('click', function() {
    const container = document.getElementById('friend-container');

    container.innerHTML = `
    <div class="friend">
        <h3 class="friend-name">Tanzil</h3>
        <p>He is student</p>
    </div>
    `;
});

// add new Friend
document.getElementById('add-friend').addEventListener('click', function() {
    const container = document.getElementById('friend-container');
    const friendDiv = document.createElement('div');
    friendDiv.classList.add('friend');

    friendDiv.innerHTML = `
        <h3 class="friend-name">Tanzil</h3>
        <p>He is student</p>
    `;
    container.appendChild(friendDiv);
});


