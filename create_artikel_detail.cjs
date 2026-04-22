const fs = require("fs");

let content = fs.readFileSync(
    "resources/views/user/destinasi_detail.blade.php",
    "utf8",
);

// Title and Meta
content = content.replace(
    /<title>.*?<\/title>/g,
    "<title>Detail Artikel - INDETA</title>",
);

// Nav bar active tabs
content = content.replace(
    '<a href="/destinasi" class="text-[#3e2723] hover:text-[#5d4037] font-bold transition-colors">Destinasi</a>',
    '<a href="/destinasi" class="text-[#3e2723] hover:text-[#5d4037] font-semibold transition-colors">Destinasi</a>',
);
content = content.replace(
    '<a href="/artikel" class="text-[#3e2723] hover:text-[#5d4037] font-semibold transition-colors">Artikel</a>',
    '<a href="/artikel" class="text-[#3e2723] hover:text-[#5d4037] font-bold transition-colors">Artikel</a>',
);

// Back Buttons
content = content.replace(
    'href="/destinasi" id="btn-back"',
    'href="/artikel" id="btn-back"',
);
content = content.replace("Kembali ke Destinasi", "Kembali ke Artikel");

// Remove reviews section
const reviewStart = content.indexOf(
    '<div class="mt-12 bg-white p-6 md:p-8 rounded-2xl shadow-xl">',
);
const reviewEnd = content.indexOf("<!-- Supabase Logic -->");
if (reviewStart !== -1 && reviewEnd !== -1) {
    content = content.substring(0, reviewStart) + content.substring(reviewEnd);
}

// Layout replacements:
// Dest.name -> dest.title
content = content.replace(/dest\.name/g, "dest.title");
content = content.replace(
    /destinasi tidak ditemukan/gi,
    "artikel tidak ditemukan",
);
content = content.replace(/id="dest-title"/g, 'id="art-title"');
content = content.replace(/id="dest-desc"/g, 'id="art-prolog"');
content = content.replace(
    /document\.getElementById\('dest-title'\)/g,
    "document.getElementById('art-title')",
);
content = content.replace(
    /document\.getElementById\('dest-desc'\)/g,
    "document.getElementById('art-prolog')",
);

// We need to inject the content part. Where should it go?
// Below `<p id="art-prolog" class="text-gray-600 text-lg md:text-xl leading-relaxed"></p>`
const infoBoxHtmlStart = content.indexOf(
    '<div id="maps-header" class="hidden">',
);
const infoBoxHtmlEnd = content.indexOf("<!-- Image Logic -->");

const replacementHtml = `

        <div class="mt-8 border-t pt-8">
            <div id="art-content" class="text-gray-800 text-base md:text-lg leading-loose whitespace-pre-line text-justify space-y-4 font-serif"></div>
        </div>

        `;

if (infoBoxHtmlStart !== -1 && infoBoxHtmlEnd !== -1) {
    // Replace the Gmaps and Tour Packages UI side with the rich content text area
    content =
        content.substring(0, infoBoxHtmlStart) +
        replacementHtml +
        "        " +
        content.substring(infoBoxHtmlEnd);
}

// In Script Logic
content = content.replace(/'destinations'/g, "'articles'");

// Also remove review JS logics
const reviewLogicStart = content.indexOf("// Review Subm");
const reviewLogicEnd = content.indexOf("// Logout Modal Logic");
if (reviewLogicStart !== -1 && reviewLogicEnd !== -1) {
    content =
        content.substring(0, reviewLogicStart) +
        content.substring(reviewLogicEnd);
}

const renderDestLogicStart = content.indexOf("function renderDestination(dest");
const renderDestLogicEnd = content.indexOf("// Image Logic");

const replRenderScript = `function renderDestination(dest) {
        document.getElementById('loading-state').classList.add('hidden');
        contentArea.classList.remove('hidden');

        document.getElementById('art-title').textContent = dest.title;
        document.getElementById('art-prolog').textContent = dest.prolog;
        
        let artBody = '';
        if(dest.content) {
            artBody = dest.content; // text replacement based on newlines handled via CSS \`whitespace-pre-line\`
        }
        document.getElementById('art-content').textContent = dest.content;

`;

if (renderDestLogicStart !== -1 && renderDestLogicEnd !== -1) {
    content =
        content.substring(0, renderDestLogicStart) +
        replRenderScript +
        "        " +
        content.substring(renderDestLogicEnd);
}

// The get reviews from initpage logic
content = content.replace(/await fetchReviews\(.*\);/g, "");

fs.writeFileSync("resources/views/user/artikel_detail.blade.php", content);
console.log("created an artikel detail page!");
