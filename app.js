
function inIframe () {
    var inframe=null;
    var currentpage=window.location.href;
    if(!currentpage.includes('index.php' ) && !currentpage.includes('home.php' ) ){
        try {
            inframe= window.self !== window.top;
        } catch (e) {
            inframe= true;
        }
        if(!inframe){
            top.window.location.href='index.php';
        }
    }
    
}
//inIframe();

// // Este script programa o modal sobre novo level

// let newLevelDialog = document.getElementById("newLevelDialog");
// let showLevelDialogButton = document.getElementById("itemPositionButton");

// if(!newLevelDialog.showModal) {
//     dialogPolyfill.registerDialog(newLevelDialog);
// };

// showLevelDialogButton.addEventListener('click', ()=> {
//     newLevelDialog.showModal();
// });

// newLevelDialog.querySelector('.close').addEventListener('click', ()=> {
//     newLevelDialog.close();
// });

// // Este script programa o modal sobre nova recompensa

// let newItemDialog = document.getElementById("newItemDialog");
// let showItemDialogButton = document.getElementById("itemShareButton");

// if(!newItemDialog.showModal) {
//     dialogPolyfill.registerDialog(newItemDialog);
// };

// showItemDialogButton.addEventListener('click', ()=> {
//     newItemDialog.showModal();
//     Iniciar();
//     function stop() {
//         clearInterval(myvar);
//     }

//     setTimeout(stop, 1200)
// });

// newItemDialog.querySelector('.close').addEventListener('click', ()=> {
//     newItemDialog.close();
// });