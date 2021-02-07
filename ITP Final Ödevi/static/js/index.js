const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
const pageTitle = document.getElementById("page-title")

signUpButton.addEventListener('click', () => {
  container.classList.add("right-panel-active");
  pageTitle.innerHTML = "KAYIT SAYFASI";
});

signInButton.addEventListener('click', () => {
  container.classList.remove("right-panel-active");
  document.getElementById("page-title").innerHTML = "GİRİŞ SAYFASI";
});