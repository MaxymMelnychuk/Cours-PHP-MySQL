const validation = document.querySelector('.validation');
const validation2 =  document.querySelector('.validation2');
const hidden = document.querySelectorAll('.hidden');
const hidden2 = document.querySelectorAll('.hidden2');
const pop2 = document.querySelectorAll('.pop-up2');
const pop = document.querySelectorAll('.pop-up');



    validation.addEventListener('click', () => {
        hidden.forEach(hid => {
            hid.classList.toggle('pop-up');
        });
    
    
});

validation2.addEventListener('click', () => {
    hidden2.forEach(hid => {
        hid.classList.toggle('pop-up2');
    });


});
