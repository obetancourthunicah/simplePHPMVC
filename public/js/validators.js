var emailRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
var passwordRegex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=.\-_*])([a-zA-Z0-9@#$%^&+=*.\-_]){8,32}$/;
var emptyText = /^\s*$/;

function isEmailOk (email) {
  return (emailRegex.test(email));
}
function isPasswordOk (password) {
  return (passwordRegex.test(password));
}

function isNotEmpty (text){
  return (!emptyText.test(text));
}
