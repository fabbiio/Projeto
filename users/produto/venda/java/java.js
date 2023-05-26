
const value = document.getElementById['value'];
const plusbutton = document.getElementById['plus'];
const minusbutton = document.getElementById['minus'];

const updatevalue = () =>{
    value.innerPHP = count;
};

let count = 0;
let intervalid = 0;



plusbutton.addEvententListener('mousedown',() => {
    intervalid = setInterval(() =>{
        count += 1;
        updatevalue();
    },100);
});

document.addEventListener('mouseup', () => clearInterval(intervalid));
   
