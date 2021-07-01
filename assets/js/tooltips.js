import tippy from 'tippy.js';

$(function () {
    tippy('.tip', {
        // default
        placement: 'top-end',
        content: (reference) => reference.getAttribute('title'),
        allowHTML: false,
        animation: 'fade',
    });
});
