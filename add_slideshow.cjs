const fs = require("fs");
let c = fs.readFileSync("resources/views/user/index.blade.php", "utf8");

c = c.replace(
    '<img src="https://images.unsplash.com/photo-1553624520-22c608051786?q=80&w=1600&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover">',
    `<div id="hero-slider" class="absolute inset-0 w-full h-full">
            <img src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?q=80&w=1600&auto=format&fit=crop" class="w-full h-full object-cover transition-opacity duration-1000">
        </div>`,
);

const newScript = `        let currentSlide = 0;
        let slideImages = [];
        
        async function loadHeroSlideshow() {
            if (!supabaseClient) return;
            const { data, error } = await supabaseClient
                .from('destinations')
                .select('thumbnail')
                .not('thumbnail', 'is', null)
                .limit(10);
                
            if (!error && data && data.length > 0) {
                slideImages = data.map(dest => {
                    let imageUrl = dest.thumbnail;
                    if (imageUrl && !imageUrl.startsWith('http')) {
                       imageUrl = SUPABASE_URL + '/storage/v1/object/public/destinations/' + imageUrl;
                    }
                    return imageUrl;
                }).filter(Boolean);
                
                if (slideImages.length > 0) {
                    startSlideshow();
                }
            }
        }
        
        function startSlideshow() {
            const slider = document.getElementById('hero-slider');
            if(slideImages.length > 0) {
                slider.innerHTML = \`<img src="\${slideImages[0]}" class="w-full h-full object-cover absolute inset-0 transition-opacity duration-1000 opacity-100" id="slide-img-0">\`;
            }
            
            if(slideImages.length > 1) {
                setInterval(() => {
                    currentSlide = (currentSlide + 1) % slideImages.length;
                    const oldImg = slider.querySelector('img');
                    
                    const newImg = document.createElement('img');
                    newImg.src = slideImages[currentSlide];
                    newImg.className = 'w-full h-full object-cover absolute inset-0 transition-opacity duration-1000 opacity-0';
                    slider.appendChild(newImg);
                    
                    // Trigger fade
                    setTimeout(() => {
                        newImg.classList.remove('opacity-0');
                        newImg.classList.add('opacity-100');
                    }, 50);
                    
                    setTimeout(() => {
                        if(oldImg && oldImg.parentNode) {
                            oldImg.parentNode.removeChild(oldImg);
                        }
                    }, 1000);
                    
                }, 5000); // Ganti tiap 5 detik
            }
        }

        checkSession();`;

c = c.replace("checkSession();", newScript);
c = c.replace(
    "loadArtikelHome();",
    "loadArtikelHome();\n        loadHeroSlideshow();",
);

fs.writeFileSync("resources/views/user/index.blade.php", c);
console.log("Slideshow script injected");
