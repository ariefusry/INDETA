const fs = require('fs');
let html = fs.readFileSync('resources/views/user/destinasi_detail.blade.php', 'utf8');

const regex = /<ul id="reviews-list".*?<\/ul>/si;
let newUl = `
<ul id="reviews-list" class="pl-4 space-y-4">
    <!-- Diisi JS -->
</ul>
<button type="button" id="btn-show-all-reviews" class="ml-4 mt-3 text-emerald-600 font-semibold hover:text-emerald-700 text-sm hidden">
    Lihat Semua Ulasan &rarr;
</button>
`;

html = html.replace(regex, newUl);

const allReviewsModal = `
<!-- All Reviews Modal -->
<div id="all-reviews-modal" class="fixed inset-0 z-50 hidden bg-[rgba(0,0,0,0.5)] flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative flex flex-col max-h-[80vh]">
        <button type="button" id="close-all-reviews-modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h3 class="text-xl font-bold text-gray-800 mb-4">Semua Ulasan</h3>
        <div class="overflow-y-auto pr-2 pb-4 flex-1">
            <ul id="all-reviews-list" class="space-y-4">
                <!-- Diisi JS -->
            </ul>
        </div>
    </div>
</div>
`;

if (!html.includes('id="all-reviews-modal"')) {
    html = html.replace('<!-- Modal Review -->', allReviewsModal + '\n<!-- Modal Review -->');
}

// Replace fetchReviews entirely to add sorting by rating and logic.
const fetchStartIdx = html.indexOf('async function fetchReviews(destId) {');
const fetchEndIdx = html.indexOf('window.fetchReviews = fetchReviews;');

if (fetchStartIdx > -1 && fetchEndIdx > -1) {
    const newJS = `async function fetchReviews(destId) {
          const { data: reviews, error } = await supabaseClient
            .from('reviews')
            .select('*')
            .eq('destination_id', destId)
            // fetch semua dulu
            .order('created_at', { ascending: false });

          if (error) {
              console.error("Gagal load review:", error);
              return;
          }

          const reviewsList = document.getElementById('reviews-list');
          const avgStarsContainer = document.getElementById('avg-stars');
          const avgRatingElem = document.getElementById('avg-rating');
          const ratingCountElem = document.getElementById('rating-count');
          const btnShowAll = document.getElementById('btn-show-all-reviews');

          // Star SVG Templates
          const starSvg = '<svg class="w-4 h-4 text-yellow-400 drop-shadow-sm" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
          const grayStarSvg = '<svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';

          if (!reviews || reviews.length === 0) {
              if (avgRatingElem) avgRatingElem.textContent = "0.0";
              if (avgStarsContainer) {
                  let html = '';
                  for(let i=0; i<5; i++) html += grayStarSvg;
                  avgStarsContainer.innerHTML = html;
              }
              if (ratingCountElem) ratingCountElem.textContent = "(0 ulasan pengunjung)";

              reviewsList.innerHTML = '<p class="text-gray-500 italic ml-2">Belum ada pengunjung yang mengulas.</p>';
              if(btnShowAll) btnShowAll.classList.add('hidden');
              return;
          }

          // Calc average rating
          const totalRating = reviews.reduce((sum, r) => sum + r.rating, 0);    
          const avgRatingStr = (totalRating / reviews.length).toFixed(1);
          const avgRatingNum = Math.round(totalRating / reviews.length);
          
          if (avgRatingElem) avgRatingElem.textContent = avgRatingStr;
          
          if (avgStarsContainer) {
              let avgHtml = '';
              for(let i=0; i<5; i++) {
                  avgHtml += (i < avgRatingNum) ? starSvg : grayStarSvg;
              }
              avgStarsContainer.innerHTML = avgHtml;
          }

          if (ratingCountElem) ratingCountElem.textContent = \`(\${reviews.length} ulasan pengunjung)\`;

          // Generate HTML helper
          const generateReviewHtml = (r) => {
             const safeComment = r.comment ? r.comment.replace(/</g, "&lt;").replace(/>/g, "&gt;") : '';
             let starsHtml = '<div class="flex space-x-0.5">';
             for(let i = 0; i < 5; i++) {
                 starsHtml += i < r.rating ? starSvg : grayStarSvg;
             }
             starsHtml += '</div>';

             return \`<li class="bg-gray-50 p-4 pt-3 rounded-xl w-full border border-gray-100 flex flex-col shadow-sm">
                <div class="flex justify-between items-center mb-2 gap-2">
                    \${starsHtml}
                </div>
                <p class="text-gray-700 text-sm break-words flex-1">\${safeComment}</p>
             </li>\`;
          };

          // Sort reviews by rating (highest first) for the main view
          const sortedReviews = [...reviews].sort((a,b) => b.rating - a.rating);
          
          // Display top 2 reviews in main view
          const top2 = sortedReviews.slice(0, 2);
          reviewsList.innerHTML = top2.map(generateReviewHtml).join("");

          // Display all in modal
          const allReviewsList = document.getElementById('all-reviews-list');
          if (allReviewsList) {
              allReviewsList.innerHTML = sortedReviews.map(generateReviewHtml).join("");
          }

          if (btnShowAll) {
              if (reviews.length > 2) {
                  btnShowAll.classList.remove('hidden');
              } else {
                  btnShowAll.classList.add('hidden');
              }
          }
      }

      `;

    html = html.substring(0, fetchStartIdx) + newJS + html.substring(fetchEndIdx);
}

// Attach event listener for the new button
const evtEndIdx = html.indexOf('// Modal UI Listeners');
if (evtEndIdx > -1 && !html.includes("document.getElementById('btn-show-all-reviews')")) {
    const eventsJS = `
      // Modal All Reviews
      const btnShowAll = document.getElementById('btn-show-all-reviews');
      if(btnShowAll) {
          btnShowAll.addEventListener('click', () => {
              document.getElementById('all-reviews-modal').classList.remove('hidden');
          });
      }
      
      const btnCloseAll = document.getElementById('close-all-reviews-modal');
      if(btnCloseAll) {
          btnCloseAll.addEventListener('click', () => {
              document.getElementById('all-reviews-modal').classList.add('hidden');
          });
      }

      // Modal UI Listeners
`;

    html = html.replace('// Modal UI Listeners', eventsJS);
}


fs.writeFileSync('resources/views/user/destinasi_detail.blade.php', html);
console.log('Script Node Berhasil!');