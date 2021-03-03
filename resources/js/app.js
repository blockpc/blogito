require('./bootstrap');
require('alpinejs');
import hljs from 'highlight.js';
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('pre code').forEach((block) => {
        // console.log(
        //     block.parentElement.parentElement,
        //     block.parentElement.parentElement.classList.contains('ck'),
        // );
        // if ( block.parentElement.parentElement.classList.contains('ck') ) {
        //     return;
        // }
        hljs.highlightBlock(block);
    });
});