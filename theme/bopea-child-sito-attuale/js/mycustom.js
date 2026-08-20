function rotateBanners(containerId, banners, hrefs, srcs, interval) {
  var container = document.getElementById(containerId);
  if (!container) {
    console.log("NO " + containerId.toUpperCase() + "_BANNER");
    return;
  }

  var i = 0;
  container.innerHTML = banners[i];
  var link = document.querySelector("#" + containerId + " a"); // Get the link within the container
  var img = document.querySelector("#" + containerId + " img"); // Get the img within the container

  function rotate() {
    if (i >= banners.length) {
        i = 0;
    }
    if (link && img) {
        // Se l'href è vuoto o "#", disabilita il link
        if (hrefs[i] === "" || hrefs[i] === "#") {
            link.style.pointerEvents = "none";
            link.style.cursor = "default";
            link.removeAttribute("href"); // Rimuove completamente l'href
        } else {
            link.style.pointerEvents = "auto";
            link.style.cursor = "pointer";
            link.href = hrefs[i];
        }
        
        img.src = "";
        img.src = srcs[i];
        i++;
    	}
	}

  rotate();
  setInterval(rotate, interval);
}

function handleScreenChange() {
  const mqMobile = window.matchMedia("(max-width: 768px)");
  const mqDesktop = window.matchMedia("(min-width: 769px)");

  if (mqMobile.matches) {
    rotateBanners(
      "banner-attaccante-mobile",
      [
        '<a href="https://mainsolution.eu/" id="link-banner-am" target="_blank"><img id="img-banner-am" alt="banner" src="/wp-content/uploads/2024/10/main-solution-test-mobile.webp"></img></a>',
      ],
      ["https://mainsolution.eu"],
      ["/wp-content/uploads/2024/10/main-solution-test-mobile.webp"],
      7000
    );

    rotateBanners(
      "banner-centrocampo-mobile",
      [
        '<a href="#" id="link-banner-cm" target="_blank"><img id="img-banner-cm" alt="banner" src="/wp-content/uploads/2025/09/centrocampo-un-milione-giallo-mobile.webp"></img></a>',
        '<a href="https://socialmediafactory.it" id="link-banner-cm" target="_blank"><img id="img-banner-cm" alt="banner" src="/wp-content/uploads/2024/10/BANNER-mobile.webp"></img></a>',
        '<a href="#" id="link-banner-cm" target="_blank"><img id="img-banner-cm" alt="banner" src="/wp-content/uploads/2025/09/centrocampo-un-milione-rosso-mobile.webp"></img></a>',
      ],
      ["#", "https://socialmediafactory.it", "#"],
      [
        "/wp-content/uploads/2025/09/centrocampo-un-milione-giallo-mobile.webp",
        "/wp-content/uploads/2024/10/BANNER-mobile.webp",
        "/wp-content/uploads/2025/09/centrocampo-un-milione-rosso-mobile.webp",
      ],
      5000
    );
  rotateBanners(
      "banner-difensore-mobile",
      [
        '<a id="link-banner-dm" alt="" href="" target="_blank" style="border-radius:10px;"><img id="img-banner-dm" loading="lazy" alt="" src="/wp-content/uploads/2025/09/azuki-banner-difensore-mobile.webp"></img></a>',
        
      ],
      ["#"],
      [
        "/wp-content/uploads/2025/09/azuki-banner-difensore-mobile.webp",
      ],
      5000000
    );
    rotateBanners(
      "banner-contatti-mobile",
      [
        '<a href="#" id="link-banner-contatti-mobile" target="_blank"><img id="img-banner-contatti-mobile" loading="lazy" alt="banner" src="/wp-content/uploads/2025/09/centrocampo-un-milione-giallo-mobile.webp"></img></a>',
      ],
      ["https://wa.me/393279876695"],
      [
        "/wp-content/uploads/2025/09/contattaci-un-milione-desktop.webp",
      ],
      5000
    );
  }

  if (mqDesktop.matches) {
    rotateBanners(
      "banner-attaccante-desktop",
      [
        '<a href="https://mainsolution.eu/" id="link-banner-ad" target="_blank" style="border-radius:10px;"><img id="img-banner-ad" alt="banner" src="/wp-content/uploads/2024/10/main-solution-test-desktop-2.webp"></img></a>',
      ],
      ["https://mainsolution.eu"],
      ["/wp-content/uploads/2024/10/main-solution-test-desktop-2.webp"],
      7000
    );

    rotateBanners(
      "banner-centrocampo-desktop",
      [
      	'<a href="" id="link-banner-cd" target="_blank"><img id="img-banner-cd" loading="lazy" alt="banner" src="/wp-content/uploads/2025/09/sponsor-betpassion-centrocampo-desktop.webp"></img></a>',
        '<a href="" id="link-banner-cd" target="_blank"><img id="img-banner-cd" loading="lazy" alt="banner" src="/wp-content/uploads/2025/09/centrocampo-un-milione-giallo-desktop.webp"></img></a>',
        '<a href="https://socialmediafactory.it" id="link-banner-cd" target="_blank"><img id="img-banner-cd" loading="lazy" alt="banner" src="/wp-content/uploads/2024/10/BANNER-desktop.webp"></img></a>',
      ],
      ["https://betpassiontipster.it/promozioni-stadio-catanzaro/",  "#", "https://socialmediafactory.it",],
      [
      	"/wp-content/uploads/2025/09/sponsor-betpassion-centrocampo-desktop.webp",
        "/wp-content/uploads/2025/09/centrocampo-un-milione-giallo-desktop.webp",
        "/wp-content/uploads/2024/10/BANNER-desktop.webp",
        
      ],
      5000
    );
  rotateBanners(
      "banner-difensore-desktop",
      [
        '<a id="link-banner-dd" alt="" href="" target="_blank" style="border-radius:10px;"><img id="img-banner-dd" loading="lazy" alt="" src="/wp-content/uploads/2025/09/azuki-banner-difensore-desktop.webp"></img></a>',
      ],
      ["#"],
      [
        "/wp-content/uploads/2025/09/azuki-banner-difensore-desktop.webp",
      ],
      5000000
    );
    rotateBanners(
      "banner-contatti-desktop",
      [
        '<a href="#" id="link-banner-contatti-desktop" target="_blank"><img id="img-banner-contatti-desktop" loading="lazy" alt="banner" src="/wp-content/uploads/2025/09/contattaci-un-milione-desktop.webp"></img></a>',
      ],
      ["https://wa.me/393279876695"],
      [
        "/wp-content/uploads/2025/09/contattaci-un-milione-desktop.webp",
      ],
      5000
    );
  }
}

window.addEventListener("load", handleScreenChange);
window.addEventListener("resize", handleScreenChange);
