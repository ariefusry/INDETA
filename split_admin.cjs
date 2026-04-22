const fs = require('fs');
let c = fs.readFileSync('resources/views/admin/dashboard.blade.php', 'utf8');
const scriptPart = c.substring(c.indexOf('<script '));
const htmlPart = c.substring(0, c.indexOf('<script '));

fs.writeFileSync('temp_html.txt', htmlPart);
fs.writeFileSync('temp_script.txt', scriptPart);
