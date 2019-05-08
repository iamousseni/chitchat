function date(mese,anno){
    var bis,option;
    var bis=anno%4;

        if(mese==1 || mese==3 || mese==5|| mese==7 || mese==8  || mese==10  || mese==12)
            days = 31;
        else if(mese==4 ||mese==6 ||mese==9 ||mese==11)
            days = 30;
        else if(bis == 0 && mese == 2)
            days = 29;
        else if(bis != 0 && mese == 2)
            days = 28;

        for(i=0;i<days;i++){
            option+="<option value="+(i+1)+">"+(i+1)+"</option>";
        }  
        document.getElementById("day").innerHTML=option;
}