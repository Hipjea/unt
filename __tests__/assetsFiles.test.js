const fs = require('fs');

const fileExists = (file) => {
    try {
        if (fs.existsSync(file)) {
            return true;
        } else {
            return false;
        }
    } catch (err) {
        console.error(err);
    }
}

const fontPrefix = './assets/fonts';
const fontFiles = [
    `${fontPrefix}/Lato-Regular.ttf`,
    `${fontPrefix}/Lato-Thin.ttf`,
    `${fontPrefix}/Montserrat-Medium.ttf`,
    `${fontPrefix}/Montserrat-Regular.ttf`,
    `${fontPrefix}/Montserrat-SemiBold.ttf`,
    `${fontPrefix}/OpenSans-Regular.ttf`
];

const imagePrefix = './assets/images';
const imageFiles = [
    `${imagePrefix}/background-newsletter.jpg`,
    `${imagePrefix}/default_image.png`,
    `${imagePrefix}/first-page.svg`,
    `${imagePrefix}/goto-arrow.svg`,
    `${imagePrefix}/iconeLien.jpg`,
    `${imagePrefix}/iconePlus.jpg`,
    `${imagePrefix}/iut-en-ligne-blanc.png`,
    `${imagePrefix}/last-page.svg`,
    `${imagePrefix}/link-arrow.svg`,
    `${imagePrefix}/loading-placeholder.svg`,
    `${imagePrefix}/logo_uoh_blanc.png`,
    `${imagePrefix}/logo-facebook.png`,
    `${imagePrefix}/logo-linkedin.png`,
    `${imagePrefix}/logo-twitter.png`,
    `${imagePrefix}/logoUN-blanc.png`,
    `${imagePrefix}/menu-close.svg`,
    `${imagePrefix}/menu.svg`,
    `${imagePrefix}/news-default.svg`,
    `${imagePrefix}/next.svg`,
    `${imagePrefix}/placeholder.png`,
    `${imagePrefix}/previous.svg`,
    `${imagePrefix}/ulogo-uoh-new.png`,
    `${imagePrefix}/uness-blanc.png`,
    `${imagePrefix}/unisciel-blanc.png`,
    `${imagePrefix}/unit-blanc.png`,
    `${imagePrefix}/unjf-blanc.png`,
    `${imagePrefix}/uoh-blanc.png`,
    `${imagePrefix}/uved-blanc.png`
];

const jsPrefix = './assets/js';
const jsFiles = [
    `${jsPrefix}/app-main.js`,
    `${jsPrefix}/app-notice.js`,
    `${jsPrefix}/app-resultats.js`,
    `${jsPrefix}/bootstrap.js`,
    `${jsPrefix}/carousel.js`,
    `${jsPrefix}/fontawesome.js`,
    `${jsPrefix}/jstree.js`,
    `${jsPrefix}/lazy-loading.js`,
    `${jsPrefix}/menu.js`,
    `${jsPrefix}/notice.js`,
    `${jsPrefix}/scroll-scale.js`,
    `${jsPrefix}/search.js`,
    `${jsPrefix}/toCopy/customize-preview.js`,
    `${jsPrefix}/toCopy/urgent-styles.js`
];

const scssPrefix = './assets/scss';
const scssFiles = [
    `${scssPrefix}/app.scss`,
    `${scssPrefix}/bootstrap.scss`,
    `${scssPrefix}/fontawesome.scss`
];

describe("File presence", () => {
    it('has all the fonts files', () => {
        fontFiles.forEach(file => expect(fileExists(file)).toBe(true));
    });

    it('has all the images files', () => {
        imageFiles.forEach(file => expect(fileExists(file)).toBe(true));
    });

    it('has all the js files', () => {
        jsFiles.forEach(file => expect(fileExists(file)).toBe(true));
    });

    it('has all the scss files', () => {
        scssFiles.forEach(file => expect(fileExists(file)).toBe(true));
    });

    it('has all the scss dependencies files', () => {
        const regex = /@import[^;]*;/gm
        fs.readFile(`${scssPrefix}/app.scss`, 'utf8' , (err, data) => {
            if (err) {
                console.error(err);
                return
            }
            const imports = data.match(regex);
            const partials = [];
            imports.forEach(imp => {
                const match = imp.match(/"(.*?)"/);
                if (match) {
                    const partial = `${scssPrefix}/_${match[1]}.scss`;
                    partials.push(partial);
                };
            });
            partials.forEach(file => expect(fileExists(file)).toBe(true));
        })
    });
});