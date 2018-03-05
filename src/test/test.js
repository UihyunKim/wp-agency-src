var canvas = $("<canvas>"); //Create the canvas element

//Create a layer which overlaps the whole window
canvas.css({position:"fixed", top:"0", left:"0",
            width:"100%", height:"100%", "z-index":9001});

//Add an event listener to the canvas element
canvas.click(function(ev){
    var x = ev.pageX, y = ev.pageY;
    var canvas = this.getContext("2d");
    canvas.drawWindow(window, x, y, 1, 1, "transparent");
    var data = canvas.getImageData(0, 0, 1, 1).data;
    var hex = rgb2hex(data[0], data[1], data[2]);
    alert(hex);
    console.log(ev);
    $(this).remove();
});

canvas.appendTo("body:first"); //:first, in case of multiple <body> tags (hmm?)

//Functions used for conversion from RGB to HEX
function rgb2hex(R,G,B){return num2hex(R)+num2hex(G)+num2hex(B);}
function num2hex(n){
    if (!n || !parseInt(n)) return "00";
    n = Math.max(0,Math.floor(Math.round(n),255)).toString(16);
    return n.length == 1 ? "0"+n : n;
}