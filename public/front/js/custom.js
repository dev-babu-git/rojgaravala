
function initShareButton() {
  const shareToggle = document.getElementById('shareToggle');
  const sharePanel = document.getElementById('sharePanel');

  if (!shareToggle || !sharePanel) {

    setTimeout(initShareButton, 200);
    return;
  }

  shareToggle.addEventListener('click', function () {
    sharePanel.classList.toggle('open');
  });
}

document.addEventListener("DOMContentLoaded", initShareButton);


let scrollTopBtn = document.getElementById("scrollTopBtn");
// Show button after scrolling 200px
window.onscroll = function () {
  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
    scrollTopBtn.style.display = "block";
  } else {
    scrollTopBtn.style.display = "none";
  }
};
// When clicked → scroll to top
scrollTopBtn.addEventListener("click", function () {
  window.scrollTo({ top: 0, behavior: "smooth" });
}); 
(function() {
    // Show/hide password
    document.querySelectorAll('.toggle-password').forEach(function(element){
        element.addEventListener('click', function(){
            const input = document.querySelector(this.getAttribute('toggle'));
            if(input.type === 'password'){
                input.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });

    // Password match check
    const password = document.getElementById('password');
    const confirm = document.getElementById('password_confirmation');
    const msg = document.getElementById('passwordMatchMsg');
    const registerBtn = document.getElementById('registerBtn');

    function checkMatch(){
        if(confirm.value === ''){
            msg.classList.add('d-none');
            registerBtn.disabled = false;
            return;
        }
        if(password.value !== confirm.value){
            msg.classList.remove('d-none');
            registerBtn.disabled = true;
        } else {
            msg.classList.add('d-none');
            registerBtn.disabled = false;
        }
    }

    password.addEventListener('keyup', checkMatch);
    confirm.addEventListener('keyup', checkMatch);
})();
 