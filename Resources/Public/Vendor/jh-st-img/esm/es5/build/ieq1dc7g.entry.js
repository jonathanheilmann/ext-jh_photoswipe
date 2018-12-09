/*! Built with http://stenciljs.com */
import{h}from"../jhstimg.core.js";var JhStImg=function(){function e(){this._sources=[],this._isFallbackImageLoaded=!1,this._isHandleImageFallback=!1,this._isUnsupportedPictureElementImageLoaded=!1}return e.prototype.srcWatchHandler=function(){this._isUnsupportedPictureElementImageLoaded=!1,this.addIntersectionObserver()},e.prototype.sourcesWatchHandler=function(e){this.updateSources(e,!0),this.addIntersectionObserver()},e.prototype.documentScrollHandler=function(){!1===this._hasIntersectionObserver&&this.fallback()},e.prototype.windowResizeHandler=function(){!1===this._hasIntersectionObserver&&this.fallback()},e.prototype.windowRrientationchangeHandler=function(){!1===this._hasIntersectionObserver&&this.fallback()},e.prototype.componentWillLoad=function(){this._hasIntersectionObserver="IntersectionObserver"in window;var e=document.createElement("picture");this._hasPictureElementSupport=e.toString().includes("HTMLPictureElement")},e.prototype.componentDidLoad=function(){this.addIntersectionObserver()},e.prototype.componentDidUnload=function(){this.removeIntersectionObserver()},e.prototype.addIntersectionObserver=function(){var e=this;if(!this.src)throw new Error("Required attribute in web component `jh-st-img` not set.");this._hasIntersectionObserver?(this.removeIntersectionObserver(),this.io=new IntersectionObserver(function(t){t[0].isIntersecting&&(e.updateSources(e.sources),e.handleUnsupportedPictureElement(),e.removeIntersectionObserver())}),this.io.observe(this.el.querySelector("img"))):!1===this._isFallbackImageLoaded&&this.fallback()},e.prototype.handleUnsupportedPictureElement=function(){!1===this._hasPictureElementSupport&&!1===this._isUnsupportedPictureElementImageLoaded&&(this.el.querySelector("img").setAttribute("src",this.src),this._isUnsupportedPictureElementImageLoaded=!0)},e.prototype.fallback=function(){if(!1===this._isFallbackImageLoaded){var e=this.el.querySelector("img");e.getBoundingClientRect().top<=window.innerHeight&&e.getBoundingClientRect().bottom>=0&&"none"!==getComputedStyle(e).display&&(this.updateSources(this.sources),this.handleUnsupportedPictureElement(),this._isFallbackImageLoaded=!0)}},e.prototype.updateSources=function(e,t){if(void 0===t&&(t=!1),0===this._sources.length||!1!==t)if(e){for(var r="string"==typeof e?JSON.parse(e):e,n=r.length-1;n>=0;n--)r[n].type&&"image/jpg"===r[n].type&&(r[n].type="image/jpeg");this._sources=r}else this._sources=[{sizes:null,srcset:this.src,type:null,media:null}]},e.prototype.removeIntersectionObserver=function(){this.io&&(this.io.disconnect(),this.io=null)},e.prototype.render=function(){return h("picture",null,this._sources.map(function(e){return h("source",{sizes:e.sizes,srcSet:e.srcset,type:e.type,media:e.media})}),h("img",{src:"",alt:this.alt,class:this.imgClass}))},Object.defineProperty(e,"is",{get:function(){return"jh-st-img"},enumerable:!0,configurable:!0}),Object.defineProperty(e,"properties",{get:function(){return{_sources:{state:!0},alt:{type:String,attr:"alt"},el:{elementRef:!0},imgClass:{type:String,attr:"img-class"},sources:{type:"Any",attr:"sources",watchCallbacks:["sourcesWatchHandler"]},src:{type:String,attr:"src",watchCallbacks:["srcWatchHandler"]}}},enumerable:!0,configurable:!0}),Object.defineProperty(e,"listeners",{get:function(){return[{name:"document:scroll",method:"documentScrollHandler",passive:!0},{name:"window:resize",method:"windowResizeHandler",passive:!0},{name:"window:orientationchange",method:"windowRrientationchangeHandler"}]},enumerable:!0,configurable:!0}),Object.defineProperty(e,"style",{get:function(){return"jh-st-img{display:block}jh-st-img img{max-width:100%;max-height:100%}"},enumerable:!0,configurable:!0}),e}();export{JhStImg};