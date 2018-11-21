export class JhStImg {
    constructor() {
        this._isHandleImageFallback = false;
        this._sources = [];
    }
    srcWatchHandler() {
        this.addIntersectionObserver();
    }
    srcsetWatchHandler() {
        this.addIntersectionObserver();
    }
    sourcesWatchHandler() {
        this.addIntersectionObserver();
    }
    documentScrollHandler() {
        if (this._isHandleImageFallback) {
            this.fallbackLazyLoad();
        }
    }
    windowResizeHandler() {
        if (this._isHandleImageFallback) {
            this.fallbackLazyLoad();
        }
    }
    windowRrientationchangeHandler() {
        if (this._isHandleImageFallback) {
            this.fallbackLazyLoad();
        }
    }
    componentWillLoad() {
        this._hasIntersectionObserver = 'IntersectionObserver' in window;
    }
    componentDidLoad() {
        this.addIntersectionObserver();
    }
    componentDidUnload() {
        this.removeIntersectionObserver();
    }
    handleImage() {
        if (this.sources) {
            this._sources = typeof this.sources === 'string' ? JSON.parse(this.sources) : this.sources;
        }
        else {
            this._sources = [];
        }
        if (this._hasIntersectionObserver) {
            setTimeout(() => {
                const image = this.el.querySelector('img');
                if (image.getAttribute('data-src')) {
                    image.setAttribute('src', image.getAttribute('data-src'));
                    image.removeAttribute('data-src');
                }
                if (image.getAttribute('data-srcset')) {
                    image.setAttribute('srcset', image.getAttribute('data-srcset'));
                    image.removeAttribute('data-srcset');
                }
            }, this._sources.length === 0 ? 0 : 300);
        }
        else {
            this._isHandleImageFallback = true;
            this.fallbackLazyLoad();
        }
    }
    fallbackLazyLoad() {
        const image = this.el.querySelector('img');
        if ((image.getBoundingClientRect().top <= window.innerHeight && image.getBoundingClientRect().bottom >= 0)
            && getComputedStyle(image).display !== 'none') {
            if (image.getAttribute('data-src')) {
                image.setAttribute('src', image.getAttribute('data-src'));
                image.removeAttribute('data-src');
            }
            if (image.getAttribute('data-srcset')) {
                image.setAttribute('srcset', image.getAttribute('data-srcset'));
                image.removeAttribute('data-srcset');
            }
        }
    }
    ;
    addIntersectionObserver() {
        if (!this.src && !this.srcset) {
            return;
        }
        if (this._hasIntersectionObserver) {
            this.removeIntersectionObserver();
            this.io = new IntersectionObserver((data) => {
                if (data[0].isIntersecting) {
                    this.handleImage();
                    this.removeIntersectionObserver();
                }
            });
            this.io.observe(this.el.querySelector('img'));
        }
        else {
            this.handleImage();
        }
    }
    removeIntersectionObserver() {
        if (this.io) {
            this.io.disconnect();
            this.io = null;
        }
    }
    render() {
        if (this._sources.length) {
            return h("picture", null,
                this._sources.map((source) => {
                    return h("source", { sizes: source.sizes, srcSet: source.srcset, type: source.type, media: source.media });
                }),
                h("img", { "data-src": this.src, "data-srcset": this.srcset, alt: this.alt, class: this.imgClass }));
        }
        else {
            return h("img", { "data-src": this.src, "data-srcset": this.srcset, alt: this.alt, class: this.imgClass });
        }
    }
    static get is() { return "jh-st-img"; }
    static get properties() { return {
        "_hasIntersectionObserver": {
            "state": true
        },
        "_isHandleImageFallback": {
            "state": true
        },
        "_sources": {
            "state": true
        },
        "alt": {
            "type": String,
            "attr": "alt"
        },
        "el": {
            "elementRef": true
        },
        "imgClass": {
            "type": String,
            "attr": "img-class"
        },
        "sources": {
            "type": "Any",
            "attr": "sources",
            "watchCallbacks": ["sourcesWatchHandler"]
        },
        "src": {
            "type": String,
            "attr": "src",
            "watchCallbacks": ["srcWatchHandler"]
        },
        "srcset": {
            "type": String,
            "attr": "srcset",
            "watchCallbacks": ["srcsetWatchHandler"]
        }
    }; }
    static get listeners() { return [{
            "name": "document:scroll",
            "method": "documentScrollHandler",
            "passive": true
        }, {
            "name": "window:resize",
            "method": "windowResizeHandler",
            "passive": true
        }, {
            "name": "window:orientationchange",
            "method": "windowRrientationchangeHandler"
        }]; }
    static get style() { return "/**style-placeholder:jh-st-img:**/"; }
}
