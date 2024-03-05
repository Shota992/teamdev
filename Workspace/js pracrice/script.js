const age= prompt();
if(age<=3){
    console.log("赤ちゃん");
}
else if(3<age && age<=18){
    console.log("子供");
}
else if(18<age && age<=64){
    console.log("大人");
}
else{
    console.log("お年寄り");
}