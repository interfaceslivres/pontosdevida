var canvas;//o elemento canvas sobre o qual desenharemos
var ctx;//o "contexto" da canvas que será utilizado (2D ou 3D)
var x = 5;//posição horizontal do objeto (com valor inicial)
var y = 0;//posição vertical do objeto (com valor inicial)
var WIDTH = 250;//largura da área retangular
var HEIGHT = 250;//altura da área retangular
var tile1 = new Image();//Imagem que será carregada e desenhada na canvas
var posicao = 0;//Indicador da posição atual do personagem
var NUM_POSICOES = 5;//Quantidade de imagens que compõem o movimento



   
function desenhar() {
    tile1.src = "../img/chestcut.png";
    ctx.drawImage(tile1, x*206, y, 206, 203, 50, 25, 206, 203);
}

function LimparTela() {
    ctx.fillStyle = "rgb(233,233,233)";
    ctx.beginPath();
    ctx.rect(0,0,WIDTH, HEIGHT);
    ctx.closePath();
    ctx.fill();
} 


function Atualizar() {
    LimparTela();
    desenhar();
    x++

    if(x >= NUM_POSICOES) {
        x=0;
    }
}

function Iniciar() {
    canvas = document.getElementById("levelUpCanvas");
    canvas.width = WIDTH;
    canvas.height = HEIGHT;
    ctx = canvas.getContext("2d");
    myvar = setInterval(Atualizar, 200)
    return myvar;
}

// Iniciar()

// function stop() {
//     clearInterval(myvar);
// }

// setTimeout(stop, 1200)


