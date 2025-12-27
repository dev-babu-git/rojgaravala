
        function initShareButton() {
            const shareToggle = document.getElementById('shareToggle');
            const sharePanel = document.getElementById('sharePanel');
            
            if (!shareToggle || !sharePanel) {
               
                setTimeout(initShareButton, 200);
                return;
            }

            shareToggle.addEventListener('click', function() {
                sharePanel.classList.toggle('open');
            });
        }

        document.addEventListener("DOMContentLoaded", initShareButton);
   

 let scrollTopBtn = document.getElementById("scrollTopBtn");
  // Show button after scrolling 200px
  window.onscroll = function() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
      scrollTopBtn.style.display = "block";
    } else {
      scrollTopBtn.style.display = "none";
    }
  };
  // When clicked → scroll to top
  scrollTopBtn.addEventListener("click", function() {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });