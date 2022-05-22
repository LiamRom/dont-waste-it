function generateLink() {
    let number = document.getElementById("numberToSend").value;
    let numberNo0 = number.substring(1);
    let Open="972";
    let result = Open.concat(numberNo0);
    let message = document.getElementById("messageToSend").value;
    let url = "https://api.whatsapp.com/send?phone=";
    let end_url = `${url}${result}?&text=${message}`;
    window.open (end_url);
}