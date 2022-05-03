document.writeln(`<img style="display:none;" id='sushiMovente' src="data:image/png;base64,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" alt="">`);
const cambiaStyle = document.getElementById('sushiMovente');
cambiaStyle.style.width ="60px";
cambiaStyle.style.position ="fixed";
cambiaStyle.style.top ="0";
cambiaStyle.style.left ="0";
cambiaStyle.style.display ="block";
cambiaStyle.style.zIndex ="10000000";

let maxW = document.documentElement.clientWidth - 60;
let minW = 0;
let maxH = document.documentElement.clientHeight - 40;
let minH = 0;
let tempo = 4000;
const sushino = setInterval(() => {
    lanciasushi();
}, tempo);

window.addEventListener("resize", function(){
    maxW = document.documentElement.clientWidth - 60;
    minW = 0;
    maxH = document.documentElement.clientHeight - 40;
    minH = 0;
    lanciasushi();
});

cambiaStyle.addEventListener("click", function(){
    clearInterval(sushino);
    cambiaStyle.style.transform = "none";
    setTimeout(() => {
        clearInterval(sushino);
        cambiaStyle.style.transition =`all 600ms linear`;
        cambiaStyle.style.transform = "scale(0)";
    }, 500);
    setTimeout(() => {
        cambiaStyle.remove();
    }, 1100);
});

let lastPosX = 0;
let lastPosY = 0;
let randomX = 0;
let randomY = 0;
let privilegiaPositivi = true;
let positivi = 0;
function lanciasushi(){
    //console.log(maxW,maxH);// qua leggo la cosa giù decrementata
    //e a volte il dinosauro supera la with
    const elemento = document.getElementById('sushiMovente');
    //(maxW - 60)
    //(maxH - 40)
    randomX += Math.floor(Math.random()*401-200);
    randomY += Math.floor(Math.random()*401-200);

    if(randomX < minW + 150 )
        privilegiaPositivi = true;
    if(randomX > maxW - 150 )
        privilegiaPositivi = false;

    if(privilegiaPositivi){
        if(randomX < lastPosX){
            //console.log('privilegio i positivi');
            while(randomX < lastPosX || randomY < lastPosY){
                randomX += 20;
                randomY += 10;
            }
        } 
    } else {
        if(randomX > lastPosX){
            //console.log('privilegio i negativi');
            while(randomX > lastPosX || randomY > lastPosY){
                randomX -= 20;
                randomY -= 10;
            }
        } 
    }

    if(randomX < minW){
        randomX = minW + 100;
        //console.log('randomX < minW')
    }
    if(randomX > maxW){
        randomX = maxW - 100;
        //console.log('randomX > maxW')
    }
    if(randomY < minH){
        randomY = minH + 100;
        //console.log('randomY < minH')
    }
    if(randomY > maxH){
        randomY = maxH - 100;
        //console.log('randomY > maxH')
    }

    let time = (Math.abs(randomX - lastPosX) + Math.abs(randomY - lastPosY))/100;
    time = time.toFixed(1);
    if(time > 3.5)
        time = 3.5;
    if(randomX > (maxW/2) + 100)
        document.getElementById('sushiMovente').style.transform ="rotateY(180deg)";
    if(randomX < (maxW/2) - 100)
        document.getElementById('sushiMovente').style.transform ="rotateY(0deg)";
    document.getElementById('sushiMovente').style.transition =`top ${time}s, left ${time}s`;
    //console.log('time',time)
    //console.log(randomX,randomY,lastPosX,lastPosY);
    lastPosX =randomX;
    lastPosY =randomY;
    elemento.style.left = `${randomX}px`;
    elemento.style.top = `${randomY}px`;
}

//0.5 ogni 100px
