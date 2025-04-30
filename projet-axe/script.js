document.addEventListener('DOMContentLoaded', () => {    // s'execute si tout est bien charger
    const validation = document.querySelectorAll('.validation');  
    const validation2 = document.querySelectorAll('.validation2'); 
    const hidden = document.querySelectorAll('.hidden');          
    const hidden2 = document.querySelectorAll('.hidden2');        //je selectionne avec ce que je vais travailler
    const validation3 = document.querySelectorAll('.validation3'); 
   

    // a chaque fois quand on click sur enregister, il va afficher une pop-up de confirmation
    validation.forEach(val => {
        val.addEventListener('click', () => {
            hidden.forEach(hid => {
                hid.classList.toggle('pop-up');
            });
        });
    });

     // pareil que 1er
    validation2.forEach(val => {
        val.addEventListener('click', () => {
            hidden2.forEach(hid => {
                hid.classList.toggle('pop-up2');
            });
        });
    });

     // a chaque lien quand on click sur supprimer, il va afficher une pop-up de confirmation
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
