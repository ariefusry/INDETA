const fs = require("fs");
let content = fs.readFileSync(
    "resources/views/user/destinasi_detail.blade.php",
    "utf8",
);

const detailsStart = content.indexOf(
    '<ul class="space-y-6 text-sm md:text-base font-medium leading-relaxed" id="details-container">',
);
console.log(content.substring(detailsStart - 500, detailsStart + 5000));
