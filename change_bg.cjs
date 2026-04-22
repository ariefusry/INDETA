const fs = require("fs");
const files = [
    "resources/views/user/artikel.blade.php",
    "resources/views/user/artikel_detail.blade.php",
    "resources/views/user/destinasi.blade.php",
    "resources/views/user/destinasi_detail.blade.php",
    "resources/views/user/index.blade.php",
];

files.forEach((f) => {
    let c = fs.readFileSync(f, "utf8");
    // Ubah bg-gray-50 menjadi bg-[#fcfaf5] (krem terang yang hangat) supaya sinkron dengan warna #d6d6a8 dan #3e2723
    c = c.replace(/body class="bg-gray-50 /g, 'body class="bg-[#fbfcfa] ');
    fs.writeFileSync(f, c);
    console.log(f + " updated");
});
