var a;
function pass(){
    if(a==1)
    {
        document.getElementById("userp").type='text';
        document.getElementById('pass-icon').src='eye.png';

        a=0;
    }
    else{
        document.getElementById("userp").type='password';
        document.getElementById('pass-icon').src='hidden.png';
        a=1;
        
    }}