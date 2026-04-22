const fs = require('fs');
const txt = fs.readFileSync('temp_html.txt','utf8');
const matches = [...txt.matchAll(/id=['"](.*?)['"]/g)];
console.log(matches.map(m=>m[1]).join(', '));
