document.addEventListener('DOMContentLoaded', () => {
    const validation = document.querySelectorAll('.validation');  
    const validation2 = document.querySelectorAll('.validation2'); 
    const hidden = document.querySelectorAll('.hidden');          
    const hidden2 = document.querySelectorAll('.hidden2');        
    const validation3 = document.querySelectorAll('.validation3'); 
    const hidden3 = document.querySelectorAll('.hidden3');        

    
    validation.forEach(val => {
        val.addEventListener('click', () => {
            hidden.forEach(hid => {
                hid.classList.toggle('pop-up');
            });
        });
    });

    
    validation2.forEach(val => {
        val.addEventListener('click', () => {
            hidden2.forEach(hid => {
                hid.classList.toggle('pop-up2');
            });
        });
    });

    
    validation3.forEach(val => {
        val.addEventListener('click', (e) => {
            const id = e.target.getAttribute('data-id');
            const popup = document.getElementById(`popup-${id}`);
            if (popup) {
                popup.classList.toggle('pop-up3');
            }
        });
    });
});
